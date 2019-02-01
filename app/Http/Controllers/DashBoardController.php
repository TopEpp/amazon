<?php

namespace App\Http\Controllers;

use App\Events\getDataDashboard;
use App\Events\getDataDashboardSale;
use App\Events\SwitchDates;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class DashBoardController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');

    }

    public function index()
    {
        // call event check dates type
        $date = event(new SwitchDates(Input::get('date')));

        // call event permission sale
        if (Auth::user()->type == 3) {
            $val = event(new getDataDashboardSale($date));
        } else {
            $val = event(new getDataDashboard($date));
        }

        // convert data to chart
        $data = [];
        $label = [];
        // $data['label'] = 'จำนวน';
        $data['backgroundColor'] = '#F09216';
        foreach ($val[0]['chart_data'] as $key => $value) {
            $label[$key] = Carbon::createFromFormat('Y-m-d h:i:s', $value->month)->format('d/m/Y');
            $data['data'][$key] = $value->total;
        }

        $chartjs = app()->chartjs
            ->name('barChartDashboard')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($label)
            ->datasets([$data])
            ->options([
                'legend' => [
                    'display' => false,
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true,
                            'gridLines' => [
                                'display' => false,
                            ],
                        ],
                    ],
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                            ],
                        ],
                    ],
                ],
            ]);

        return view('dashboard.index', ['chartjs' => $chartjs,
            'products' => $val[0]['orders_products'],
            'value_all' => $val[0]['value_all'],
        ]
        );
    }
}
