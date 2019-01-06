<?php

namespace App\Http\Controllers;

use App\DataTables\UnitsDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateUnitsRequest;
use App\Http\Requests\UpdateUnitsRequest;
use App\Repositories\UnitsRepository;
use Flash;
use Response;

class UnitsController extends AppBaseController
{
    /** @var  UnitsRepository */
    private $unitsRepository;

    public function __construct(UnitsRepository $unitsRepo)
    {
        $this->unitsRepository = $unitsRepo;
    }

    /**
     * Display a listing of the Units.
     *
     * @param UnitsDataTable $unitsDataTable
     * @return Response
     */
    public function index(UnitsDataTable $unitsDataTable)
    {
        return $unitsDataTable->render('units.index');
    }

    /**
     * Show the form for creating a new Units.
     *
     * @return Response
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created Units in storage.
     *
     * @param CreateUnitsRequest $request
     *
     * @return Response
     */
    public function store(CreateUnitsRequest $request)
    {
        $input = $request->all();

        $units = $this->unitsRepository->create($input);

        Flash::success('Units saved successfully.');

        return redirect(route('units.index'));
    }

    /**
     * Display the specified Units.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $units = $this->unitsRepository->findWithoutFail($id);

        if (empty($units)) {
            Flash::error('Units not found');

            return redirect(route('units.index'));
        }

        return view('units.show')->with('units', $units);
    }

    /**
     * Show the form for editing the specified Units.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $units = $this->unitsRepository->findWithoutFail($id);

        if (empty($units)) {
            Flash::error('Units not found');

            return redirect(route('units.index'));
        }

        return view('units.edit')->with('unit', $units);
    }

    /**
     * Update the specified Units in storage.
     *
     * @param  int              $id
     * @param UpdateUnitsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUnitsRequest $request)
    {
        $units = $this->unitsRepository->findWithoutFail($id);

        if (empty($units)) {
            Flash::error('Units not found');

            return redirect(route('units.index'));
        }

        $units = $this->unitsRepository->update($request->all(), $id);

        Flash::success('Units updated successfully.');

        return redirect(route('units.index'));
    }

    /**
     * Remove the specified Units from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $units = $this->unitsRepository->findWithoutFail($id);

        if (empty($units)) {
            Flash::error('Units not found');

            return redirect(route('units.index'));
        }

        $this->unitsRepository->delete($id);

        Flash::success('Units deleted successfully.');

        return redirect(route('units.index'));
    }
}
