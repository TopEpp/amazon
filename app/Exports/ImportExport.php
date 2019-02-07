<?php

namespace App\Exports;

use App\Models\Import;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ImportExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $number;
    private $start;
    private $end;

    public function __construct(string $number = null, string $start = null, string $end = null)
    {
        $this->number = $number;
        $this->start = $start;
        $this->end = $end;

    }

    public function view(): View
    {
        $query = Import::join('users', 'users.id', '=', 'imports.user_id')
            ->join('import_items', 'import_items.import_id', '=', 'imports.id')
            ->select('users.name', 'imports.number', 'imports.remark', 'imports.date', DB::raw('sum(import_items.value) as value'));

        //search
        if ($this->number != '') {
            $query->where('imports.number', 'like', '%' . $this->number . '%');
        }

        if ($this->start != '' && $this->end != '') {
            $date = [$this->start, $this->end];
            $query->whereBetween('imports.date', $date);
        }
        $data = $query->groupby('imports.id')->get();

        return view('reports.excel_import', [
            'imports' => $data,
        ]);
    }
}
