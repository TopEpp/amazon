<?php

namespace App\Http\Controllers;

use App\Events\getDataDashboard;
use App\Events\getDataDashboardSale;
use App\Events\SwitchDates;
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

        $color = ["#1D464F",
            "#116121",
            "#597A21",
            "#9E8A1B",
            "#38964B",
            "#199612",
            "#12966A",
            "#359612",
            "#549612",
            "#24633A",
            "#F09216"];
        foreach ($val[0]['chart_data'] as $key => $value) {
            $label[$key] = $value->name;
            $data['data'][$key] = $value->total;

            $data['backgroundColor'][$key] = $color[$key];
            $data['price'][$key] = $value->price;

        }
        $chartjs = app()->chartjs
            ->name('barChartDashboard')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])

            ->labels($label)
            ->datasets([$data])
            ->optionsRaw("{
                legend : {
                    display : false,
                },
                scales : {
                    'xAxes' : [
                        {
                            'stacked' : true,
                            'gridLines' : {
                                'display' : false,
                            },
                        },
                    ],
                    yAxes : [
                        {
                            'ticks' : {
                                'beginAtZero' : true,
                            },
                        },
                    ],
                },
                tooltips : {
                    enabled :true,
                    displayColors : false,
                    callbacks: {
                        title: function(tooltipItem, data) {
                          return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function(tooltipItem, data) {
                          return 'จำนวนสินค้า: '+data['datasets'][0]['data'][tooltipItem['index']];
                        },
                        afterLabel: function(tooltipItem, data) {
                            return 'ราคารวม: '+data['datasets'][0]['price'][tooltipItem['index']];
                          },
                    },
                },
            }");

        // 'tooltips' => {
        //     'enabled' => true,
        //     'displayColors' => false,
        //     'callbacks' => "{title:function(tooltipItem,data){return 'asd';}}",
        // ],
        //         $options = "{onClick:function(c,i){
        //                 var e = i[0];
        //                 var id= this.data.labels[e._index];
        //                 alert('we');
        // }}";
        //         $chartjs->optionsRaw($options);

        return view('dashboard.index', ['chartjs' => $chartjs,
            'products' => $val[0]['orders_products'],
            'value_all' => $val[0]['value_all'],
        ]
        );
    }
}
