<?php

namespace App\Http\Controllers;

use App\DataTables\ImportDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateImportRequest;
use App\Http\Requests\UpdateImportRequest;
use App\Repositories\ImportItemRepository;
use App\Repositories\ImportRepository;
use App\Repositories\ProductRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class ImportController extends AppBaseController
{
    /** @var  ImportRepository */
    private $importRepository;
    private $productRepository;
    private $importItemRepository;

    public function __construct(ProductRepository $productRepo, ImportRepository $importRepo, ImportItemRepository $importItemRepo)
    {
        $this->importRepository = $importRepo;
        $this->productRepository = $productRepo;
        $this->importItemRepository = $importItemRepo;
    }

    /**
     * Display a listing of the Import.
     *
     * @param ImportDataTable $importDataTable
     * @return Response
     */
    public function index(ImportDataTable $importDataTable)
    {
        return $importDataTable->render('imports.index');
    }

    /**
     * Show the form for creating a new Import.
     *
     * @return Response
     */
    public function create()
    {
        $product = $this->productRepository->all();
        return view('imports.create')->with('product', $product);
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
        $input = $request->except('value');

        $input['user_id'] = Auth::user()->id;

        $import = $this->importRepository->create($input);

        $import_item = $request->value;
        $item_value = array();
        if ($import) {

            foreach ($import_item as $key => $value) {
                // get product
                $product = $this->productRepository->findWithoutFail($key);
                $item_value['import_id'] = $import->id;
                $item_value['product_id'] = $product->id;
                $item_value['stock_id'] = $product->stock->id;
                $item_value['value'] = $value;
                $this->importItemRepository->create($item_value);
            }

        }

        Flash::success('Import saved successfully.');

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
            Flash::error('Import not found');

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
        $product = $this->productRepository->all();

        if (empty($import)) {
            Flash::error('Import not found');

            return redirect(route('imports.index'));
        }
        // get item
        $item = array();
        foreach ($import->item as $key => $value) {
            $item[$value->id] = $value;
        }
        $import->value = $item;

        return view('imports.edit')->with(['import' => $import, 'product' => $product]);
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
            Flash::error('Import not found');

            return redirect(route('imports.index'));
        }

        $input = $request->except('value');

        $import_item = $request->value;

        $import = $this->importRepository->update($input, $id);

        $item = array();
        foreach ($import->item as $key => $value) {
            $item[$value->id] = $value;
        }

        $item_value = array();
        if ($import) {
            foreach ($import_item as $key => $value) {
                // get product
                $product = $this->productRepository->findWithoutFail($key);
                $item_value['import_id'] = $import->id;
                $item_value['product_id'] = $product->id;
                $item_value['stock_id'] = $product->stock->id;
                $item_value['value'] = $value;
                if (!empty($item[$key])) {
                    $this->importItemRepository->update($item_value, $item[$key]->id);
                } else {
                    $this->importItemRepository->create($item_value);
                }

            }

        }

        Flash::success('Import updated successfully.');

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
            Flash::error('Import not found');

            return redirect(route('imports.index'));
        }

        $this->importRepository->delete($id);

        Flash::success('Import deleted successfully.');

        return redirect(route('imports.index'));
    }
}
