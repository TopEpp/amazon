<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');

    }

    public function index()
    {
        // // call event check dates type
        // $date = event(new SwitchDates(Input::get('date')));

        // // call event permission sale
        // if (Auth::user()->permission == 3) {
        //     $val = event(new getDataDashboardSale($date));
        // } else {
        //     $val = event(new getDataDashboard($date));
        // }

        // // convert data to chart
        // $data = [];
        // $label = [];
        // // $data['label'] = 'จำนวน';
        // $data['backgroundColor'] = 'rgb(216, 105, 65)';
        // foreach ($val[0]['chart_data'] as $key => $value) {
        //     $label[$key] = $value->month;
        //     $data['data'][$key] = $value->total;
        // }

        // $chartjs = app()->chartjs
        //     ->name('barChartDashboard')
        //     ->type('bar')
        //     ->size(['width' => 400, 'height' => 200])
        //     ->labels($label)
        //     ->datasets([$data])
        //     ->options([
        //         'legend' => [
        //             'display' => false,
        //         ],
        //         'scales' => [
        //             'xAxes' => [
        //                 [
        //                     'stacked' => true,
        //                     'gridLines' => [
        //                         'display' => false,
        //                     ],
        //                 ],
        //             ],
        //             'yAxes' => [
        //                 [
        //                     'ticks' => [
        //                         'beginAtZero' => true,
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ]);

        // return $orderDataTable->with(['date' => $date])
        //     ->render('dashboard.index', ['chartjs' => $chartjs,
        //         'total' => $val[0]['orders_max'],
        //         'money' => $val[0]['money_all'],
        //         'dates' => $date]
        //     );
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])

            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => ['#F09216'],
                    'data' => [69],
                ],
                [
                    "label" => "",
                    'backgroundColor' => ['#F09216'],
                    'data' => [59],
                ],
                [
                    "label" => "",
                    'backgroundColor' => ['#F09216'],
                    'data' => [22],
                ],
            ])
            ->options(['legend' => [
                'display' => false,
            ],
            ]);

        return view('dashboard.index', compact('chartjs'));
    }
}
