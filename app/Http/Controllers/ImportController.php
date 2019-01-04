<?php

namespace App\Http\Controllers;

use App\DataTables\ImportDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateImportRequest;
use App\Http\Requests\UpdateImportRequest;
use App\Repositories\ImportRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ImportController extends AppBaseController
{
    /** @var  ImportRepository */
    private $importRepository;

    public function __construct(ImportRepository $importRepo)
    {
        $this->importRepository = $importRepo;
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
        return view('imports.create');
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
        $input = $request->all();

        $import = $this->importRepository->create($input);

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

        if (empty($import)) {
            Flash::error('Import not found');

            return redirect(route('imports.index'));
        }

        return view('imports.edit')->with('import', $import);
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

        $import = $this->importRepository->update($request->all(), $id);

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
