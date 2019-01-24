<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use App\Repositories\UnitsRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;
    private $categoryRepository;
    private $unitsRepository;
    private $stockRepository;

    public function __construct(ProductRepository $productRepo, CategoryRepository $categoryRepo, UnitsRepository $unitsRepo, StockRepository $stockRepo)
    {
        $this->productRepository = $productRepo;
        $this->categoryRepository = $categoryRepo;
        $this->unitsRepository = $unitsRepo;
        $this->stockRepository = $stockRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        $categorys = $this->categoryRepository->pluck('name', 'id');
        $units = $this->unitsRepository->pluck('name', 'id');
        return $productDataTable->render('products.index', ['category' => $categorys, 'unit' => $units]);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $product = [];
        return view('products.create')->with('product', $product);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->create($input);

        $stock_input = array();
        $stock_input['product_id'] = $product->id;
        $stock_input['categoty_id'] = $input['category_id'];
        $stock_input['user_id'] = Auth::user()->id;
        $stock_input['value'] = 0;

        $stock = $this->stockRepository->create($stock_input);

        Flash::success('Product saved successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);
        $categorys = $this->categoryRepository->pluck('name', 'id');
        $units = $this->unitsRepository->pluck('name', 'id');

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('stocks.index'));
        }

        return view('products.edit')->with(['product' => $product, 'category' => $categorys, 'unit' => $units]);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('stocks.index'));
        }

        $input = $request->except('stock_id');
        $product = $this->productRepository->update($input, $id);

        if (empty($request->stock_id)) {
            $stock_input = array();
            $stock_input['product_id'] = $product->id;
            $stock_input['categoty_id'] = $input['category_id'];
            $stock_input['user_id'] = Auth::user()->id;
            $stock_input['value'] = 0;

            $stock = $this->stockRepository->create($stock_input);
        } else {
            $stock_input = array();
            $stock_input['product_id'] = $product->id;
            $stock_input['categoty_id'] = $input['category_id'];
            $stock_input['user_id'] = Auth::user()->id;
            $stock_input['value'] = 0;

            $stock = $this->stockRepository->update($stock_input, $request->stock_id);
        }

        Flash::success('Product updated successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('stocks.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('stocks.index'));
    }
}
