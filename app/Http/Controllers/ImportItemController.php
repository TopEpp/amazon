<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImportItemRequest;
use App\Http\Requests\UpdateImportItemRequest;
use App\Repositories\ImportItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ImportItemController extends AppBaseController
{
    /** @var  ImportItemRepository */
    private $importItemRepository;

    public function __construct(ImportItemRepository $importItemRepo)
    {
        $this->importItemRepository = $importItemRepo;
    }

    /**
     * Display a listing of the ImportItem.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->importItemRepository->pushCriteria(new RequestCriteria($request));
        $importItems = $this->importItemRepository->all();

        return view('import_items.index')
            ->with('importItems', $importItems);
    }

    /**
     * Show the form for creating a new ImportItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('import_items.create');
    }

    /**
     * Store a newly created ImportItem in storage.
     *
     * @param CreateImportItemRequest $request
     *
     * @return Response
     */
    public function store(CreateImportItemRequest $request)
    {
        $input = $request->all();

        $importItem = $this->importItemRepository->create($input);

        Flash::success('Import Item saved successfully.');

        return redirect(route('importItems.index'));
    }

    /**
     * Display the specified ImportItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $importItem = $this->importItemRepository->findWithoutFail($id);

        if (empty($importItem)) {
            Flash::error('Import Item not found');

            return redirect(route('importItems.index'));
        }

        return view('import_items.show')->with('importItem', $importItem);
    }

    /**
     * Show the form for editing the specified ImportItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $importItem = $this->importItemRepository->findWithoutFail($id);

        if (empty($importItem)) {
            Flash::error('Import Item not found');

            return redirect(route('importItems.index'));
        }

        return view('import_items.edit')->with('importItem', $importItem);
    }

    /**
     * Update the specified ImportItem in storage.
     *
     * @param  int              $id
     * @param UpdateImportItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImportItemRequest $request)
    {
        $importItem = $this->importItemRepository->findWithoutFail($id);

        if (empty($importItem)) {
            Flash::error('Import Item not found');

            return redirect(route('importItems.index'));
        }

        $importItem = $this->importItemRepository->update($request->all(), $id);

        Flash::success('Import Item updated successfully.');

        return redirect(route('importItems.index'));
    }

    /**
     * Remove the specified ImportItem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $importItem = $this->importItemRepository->findWithoutFail($id);

        if (empty($importItem)) {
            Flash::error('Import Item not found');

            return redirect(route('importItems.index'));
        }

        $this->importItemRepository->delete($id);

        Flash::success('Import Item deleted successfully.');

        return redirect(route('importItems.index'));
    }
}
