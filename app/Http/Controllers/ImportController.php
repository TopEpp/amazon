<?php

namespace App\Http\Controllers;

use App\DataTables\ImportDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateImportRequest;
use App\Http\Requests\UpdateImportRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ImportItemRepository;
use App\Repositories\ImportRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

class ImportController extends AppBaseController
{
    /** @var  ImportRepository */
    private $importRepository;
    private $productRepository;
    private $importItemRepository;
    private $stockRepository;
    private $categoryRepository;

    public function __construct(ProductRepository $productRepo, ImportRepository $importRepo, ImportItemRepository $importItemRepo, StockRepository $stockRepo, CategoryRepository $categoryRepo)
    {
        $this->importRepository = $importRepo;
        $this->productRepository = $productRepo;
        $this->importItemRepository = $importItemRepo;
        $this->stockRepository = $stockRepo;
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Import.
     *
     * @param ImportDataTable $importDataTable
     * @return Response
     */
    public function index(ImportDataTable $importDataTable)
    {

        $import = DB::table('import_items')
            ->select('categorys.name', DB::raw('SUM(import_items.value) as total'))
            ->whereNull('imports.deleted_at')
            ->join('imports', 'imports.id', '=', 'import_items.import_id')
            ->join('products', 'products.id', '=', 'import_items.product_id')
            ->join('categorys', 'categorys.id', '=', 'products.category_id')
            ->groupBy('categorys.name')
            ->get();

        // dd($import);
        return $importDataTable->render('imports.index', ['import' => $import]);
    }

    /**
     * Show the form for creating a new Import.
     *
     * @return Response
     */
    public function create()
    {
        $category = $this->categoryRepository->all();
        return view('imports.create')->with('category', $category);
    }

    /**
     * Store a newly created Import in storage.
     *
     * @param CreateImportRequest $request
     *
     * @return Response
     */
    public function store(CreateImportRequest $request)
    {
        $input = $request->except('value', 'price_product');
        $input['user_id'] = Auth::user()->id;
        $input['import_status'] = 1;

        $import = $this->importRepository->create($input);

        $import_item = $request->value;
        $product_item = $request->price_product;

        $item_value = array();
        $item_product = array();
        $item_price = array();
        if ($import) {

            foreach ($import_item as $key => $value) {
                // update product
                $item_product['price'] = $product_item[$key];
                $product = $this->productRepository->update($item_product, $key);

                $item_value['import_id'] = $import->id;
                $item_value['product_id'] = $product->id;
                $item_value['stock_id'] = $product->stock->id;
                $item_value['value'] = $value;

                //sum price product
                $item_price[$key] = $item_value['value'] * $item_product['price'];
                //insert item
                $this->importItemRepository->create($item_value);

                //update value stock
                $stock = $this->stockRepository->findWithoutFail($item_value['stock_id']);
                $input_stock = array();
                $input_stock['value'] = $item_value['value'] + $stock->value;
                $stock = $this->stockRepository->update($input_stock, $item_value['stock_id']);
            }

            //update price
            $input = array();
            $input['price'] = array_sum($item_price);
            $import = $this->importRepository->update($input, $import->id);
        }

        Flash::success('เพิ่มนำเข้าสินค้า เรียบร้อย.');

        return redirect(route('imports.index'));
    }

    /**
     * Display the specified Import.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $import = $this->importRepository->findWithoutFail($id);

        if (empty($import)) {
            Flash::error('ไม่พบนำเข้าสินค้า');

            return redirect(route('imports.index'));
        }

        return view('imports.show')->with('import', $import);
    }

    /**
     * Show the form for editing the specified Import.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $import = $this->importRepository->findWithoutFail($id);
        $category = $this->categoryRepository->all();

        if (empty($import)) {
            Flash::error('ไม่พบนำเข้าสินค้า');

            return redirect(route('imports.index'));
        }
        // get item
        $item = array();
        foreach ($import->item as $key => $value) {
            $item[$value->product_id] = $value;
        }
        $import->value = $item;
        return view('imports.edit')->with(['import' => $import, 'category' => $category]);
    }

    /**
     * Update the specified Import in storage.
     *
     * @param  int              $id
     * @param UpdateImportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImportRequest $request)
    {
        $import = $this->importRepository->findWithoutFail($id);

        if (empty($import)) {
            Flash::error('ไม่พบนำเข้าสินค้า');

            return redirect(route('imports.index'));
        }

        $input = $request->except('value', 'price_product');

        $import_item = $request->value;
        $product_item = $request->price_product;

        $import = $this->importRepository->update($input, $id);

        $item = array();
        foreach ($import->item as $key => $value) {
            $item[$value->product_id] = $value;
        }

        $item_value = array();
        $item_product = array();
        $item_price = array();
        if ($import) {
            foreach ($import_item as $key => $value) {
                // update product
                $item_product['price'] = $product_item[$key];
                $product = $this->productRepository->update($item_product, $key);

                $item_value['import_id'] = $import->id;
                $item_value['product_id'] = $product->id;
                $item_value['stock_id'] = $product->stock->id;
                $item_value['value'] = $value;

                //sum price product
                $item_price[$key] = $item_value['value'] * $item_product['price'];

                if (!empty($item[$product->id])) {
                    $this->importItemRepository->update($item_value, $item[$product->id]->id);

                    //update value stock
                    $stock = $this->stockRepository->findWithoutFail($item_value['stock_id']);
                    $input_stock = array();
                    $value = $item_value['value'] - $item[$product->id]->value;

                    $input_stock['value'] = $value + $stock->value;

                    $stock = $this->stockRepository->update($input_stock, $item_value['stock_id']);
                } else {
                    $this->importItemRepository->create($item_value);

                    //update value stock
                    $stock = $this->stockRepository->findWithoutFail($item_value['stock_id']);
                    $input_stock = array();
                    $input_stock['value'] = $item_value['value'] + $stock->value;
                    $stock = $this->stockRepository->update($input_stock, $item_value['stock_id']);
                }

            }

            //update price
            $input = array();
            $input['price'] = array_sum($item_price);
            $import = $this->importRepository->update($input, $id);

        }

        Flash::success('แก้ไขนำเข้าสินค้า เรียบร้อย.');

        return redirect(route('imports.index'));
    }

    /**
     * Remove the specified Import from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $import = $this->importRepository->findWithoutFail($id);

        if (empty($import)) {
            Flash::error('ไม่พบนำเข้าสินค้า');

            return redirect(route('imports.index'));
        }

        // update stock
        foreach ($import->item as $key => $item) {
            $value = $item->stock->value - $item->value;
            $item->stock->update(['value' => $value]);
        }

        $this->importRepository->delete($id);

        Flash::success('ลบนำเข้าสินค้า เรียบร้อย.');

        return redirect(route('imports.index'));
    }
}
