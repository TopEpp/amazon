<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use App\Repositories\UnitsRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class StockController extends AppBaseController
{
    /** @var  StockRepository */
    private $stockRepository;
    private $productRepository;
    private $categoryRepository;
    private $unitsRepository;

    public function __construct(StockRepository $stockRepo, ProductRepository $productRepo, CategoryRepository $categoryRepo, UnitsRepository $unitsRepo)
    {
        $this->stockRepository = $stockRepo;
        $this->productRepository = $productRepo;
        $this->categoryRepository = $categoryRepo;
        $this->unitsRepository = $unitsRepo;
    }

    /**
     * Display a listing of the Stock.
     *
     * @param ProductDataTable $ProductDataTable
     * @return Response
     */
    public function index(ProductDataTable $ProductDataTable)
    {
        $categorys = $this->categoryRepository->pluck('name', 'id');
        $product = $this->productRepository->pluck('name', 'id');
        $units = $this->unitsRepository->pluck('name', 'id');
        return $ProductDataTable->render('stocks.index', ['category' => $categorys, 'product' => $product, 'unit' => $units]);
    }

    /**
     * Show the form for creating a new Stock.
     *
     * @return Response
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Store a newly created Stock in storage.
     *
     * @param CreateStockRequest $request
     *
     * @return Response
     */
    public function store(CreateStockRequest $request)
    {
        $input = $request->all();

        // test
        $input['categoty_id'] = 1;
        $input['user_id'] = Auth::user()->id;
        $input['order_id'] = 1;
        $input['import_id'] = 1;
        $stock = $this->stockRepository->create($input);

        Flash::success('Stock saved successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Display the specified Stock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        return view('stocks.show')->with('stock', $stock);
    }

    /**
     * Show the form for editing the specified Stock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stock = $this->stockRepository->findWithoutFail($id);

        $categorys = $this->categoryRepository->pluck('name', 'id');
        $product = $this->productRepository->pluck('name', 'id');
        $units = $this->unitsRepository->pluck('name', 'id');

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        return view('stocks.edit')->with(['stock' => $stock, 'category' => $categorys, 'product' => $product,'unit' => $units]);
    }

    /**
     * Update the specified Stock in storage.
     *
     * @param  int              $id
     * @param UpdateStockRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockRequest $request)
    {
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }
        $input = $request->all();
        // test
        $input['categoty_id'] = 1;
        $input['user_id'] = Auth::user()->id;

        $input['order_id'] = 1;
        $input['import_id'] = 1;

        $stock = $this->stockRepository->update($input, $id);

        Flash::success('Stock updated successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Remove the specified Stock from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        $this->stockRepository->delete($id);

        Flash::success('Stock deleted successfully.');

        return redirect(route('stocks.index'));
    }
}
