<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Companys;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Carrency;
use App\Models\Exchange_rate;
use App\Models\Items;
use App\Models\Region;
use App\Models\Target_limit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use DateTime;
use DateInterval;
use PhpParser\Node\Stmt\Foreach_;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   // Set the week to start on Sunday
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);

        $date = Carbon::parse( date('d-m-Y'));
        $monthName = $date->format('F');
        $dayName = $date->format('l');
        //this month range
        $currentWeekStart = now()->startOfWeek();
        $currentWeekEnd = now()->endOfWeek();
        $currentMonth = Carbon::now()->startOfMonth();

        $startDate = new DateTime('first day of this month');
        $endDate = new DateTime('last day of this month');

        $startDatelast = new DateTime('first day of last month');
        $endDatelast = new DateTime('last day of last month');

        $dateRange = [];

        while ($startDate <= $endDate) {
            $dateRange[] = $startDate->format('j');
            $startDate->modify('+1 day');
        }

        $month_chart = Items::where('user_id', Auth::user()->id)
        ->select('ticket_date',
            DB::raw('ROUND(SUM(totalTND), 3) as TND'),
            DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
            DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
        )
        ->groupBy('ticket_date')
        ->get();

        $currentYear_num = date('Y'); 
        $currentMonth_num = date('m');
        $count=0;
        $chartRangeTND = [];
        $chartRangeUSD = [];
        $chartRangeEUR = [];

        for($i=1;$i<=$endDate->format('j');$i++){
            $dateString = sprintf('%02d-%02d-%04d', $i, $currentMonth_num,$currentYear_num);
            if (isset($month_chart[$count]) && $dateString == $month_chart[$count]['ticket_date']) {
                $chartRangeTND[$i] = $month_chart[$count]['TND'];
                $chartRangeUSD[$i] = $month_chart[$count]['USD'];
                $chartRangeEUR[$i] = $month_chart[$count]['EUR'];
                $count++;
            } else {
                $chartRangeTND[$i] = 0;
                $chartRangeUSD[$i] = 0;
                $chartRangeEUR[$i] = 0;
            }
        }

        //last month range
        $dateRange_last = [];

        while ($startDatelast <= $endDatelast) {
            $dateRange_last[] = $startDatelast->format('j');
            $startDatelast->modify('+1 day');
        }

        $lastYear_num = date('Y'); 
        $lasttMonth_num = date('m')-1;
        if(date('m')==1){
            $lastYear_num = date('Y')-1;
        }
        $count=0;
        $chartLastRangeTND = [];
        $chartLastRangeUSD = [];
        $chartLastRangeEUR = [];

        for($i=1;$i<=$endDate->format('j');$i++){
            $dateString = sprintf('%02d-%02d-%04d', $i, $lasttMonth_num,$lastYear_num);
            if (isset($month_chart[$count]) && $dateString == $month_chart[$count]['ticket_date']) {
                $chartLastRangeTND[$i] = $month_chart[$count]['TND'];
                $chartLastRangeUSD[$i] = $month_chart[$count]['USD'];
                $chartLastRangeEUR[$i] = $month_chart[$count]['EUR'];
                $count++;
            } else {
                $chartLastRangeTND[$i] = 0;
                $chartLastRangeUSD[$i] = 0;
                $chartLastRangeEUR[$i] = 0;
            }
        }

        //runk tickets
        $runk_tickets_price=Items::where('user_id', Auth::user()->id)
                ->select('ticket_date',
                    DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                    DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                    DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                    )
                ->groupBy('ticket_date')
                ->orderByRaw('SUM(TND) DESC')
                ->take(10)
                ->get();
        $runk_tickets_quentity=Items::where('user_id', Auth::user()->id)
                ->select('ticket_date',
                    DB::raw('SUM(item_quentity) as quentity'),
                )
                ->groupBy('ticket_date')
                ->orderByRaw('SUM(item_quentity) DESC')
                ->take(10)
                ->get();

        //runk item
        $runk_item_price=Items::select(
                    'id_icon','TND','EUR','USD','icons.*')
                ->join('icons', 'icons.id_icons', '=', 'items.id_icon')
                ->where('items.user_id', Auth::user()->id)
                ->orderBy('TND', 'desc')
                ->take(10)
                ->get();
        $runk_item_quentity=Items::select(
                    'id_icon','icons.*','item_quentity')
                ->join('icons', 'icons.id_icons', '=', 'items.id_icon')
                ->where('items.user_id', Auth::user()->id)
                ->orderBy('item_quentity', 'desc')
                ->take(10)
                ->get();
        //total
        $total_quentity=Items::where('user_id', Auth::user()->id)
        ->select(DB::raw('SUM(item_quentity) as quentity'))
        ->get();
        $total_price=Items::where('user_id', Auth::user()->id)
        ->select(                        
            DB::raw('ROUND(SUM(totalTND), 3) as TND'),
            DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
            DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
        )
        ->get();        
        //runk region
        $runk_region_price = Items::select(
                    'regions.state',
                    DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                    DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                    DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                )
                ->join('regions', 'regions.id_region', '=', 'items.id_region')
                ->where('items.user_id', Auth::user()->id)
                ->groupBy('regions.state')
                ->orderBy(DB::raw('ROUND(SUM(TND), 3)'), 'desc') 
                ->take(10)
                ->get();

        $runk_region_quentity=Items::select(
                    'regions.state',
                    DB::raw('SUM(item_quentity) as quentity'),
                )
                ->join('regions', 'regions.id_region', '=', 'items.id_region')
                ->where('items.user_id', Auth::user()->id)
                ->groupBy('regions.state')
                ->orderBy(DB::raw('SUM(item_quentity)'), 'desc') 
                ->take(10)
                ->get();
        //runk States
        $runk_states_price = Items::select(
                    'regions.region',
                    DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                    DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                    DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                )
                ->join('regions', 'regions.id_region', '=', 'items.id_region')
                ->where('items.user_id', Auth::user()->id)
                ->groupBy('regions.region')
                ->orderBy(DB::raw('ROUND(SUM(TND), 3)'), 'desc') 
                ->get();

        $runk_states_quentity=Items::select(
                    'regions.region',
                    DB::raw('SUM(item_quentity) as quentity'),
                )
                ->join('regions', 'regions.id_region', '=', 'items.id_region')
                ->where('items.user_id', Auth::user()->id)
                ->groupBy('regions.region')
                ->orderBy(DB::raw('SUM(item_quentity)'), 'desc') 
                ->get();
        //runk currency
        $runk_currency_price=Items::select( 
            'currency',                   
            DB::raw('ROUND(SUM(totalTND), 3) as TND'),
            DB::raw('ROUND(SUM(totalitem_prix), 3) as total_price'))
        ->join('carrencies', 'carrencies.id_carrency', '=', 'items.id_currency')
        ->where('items.user_id', Auth::user()->id)
        ->groupBy('id_currency')
        ->orderBy(DB::raw('SUM(totalTND)'), 'desc')
        ->take(10)
        ->get();
        
        $runk_currency_quentity=Items::select( 
                    'currency',                   
                    DB::raw('SUM(item_quentity) as quentity'),)
                ->join('carrencies', 'carrencies.id_carrency', '=', 'items.id_currency')
                ->where('items.user_id', Auth::user()->id)
                ->groupBy('id_currency')
                ->orderBy(DB::raw('SUM(item_quentity)'), 'desc')
                ->take(10)
                ->get();
        //plane target
        //vars
        $target_date_daynum=null;
        $target_date_dayname=null;
        $target_date_monthname=null;
        $target_date_days=null;
        $target_date_year=null;
        $target_mereg=null;
        $target_data_avrig=null;
        $TND=null;
        $USD=null;
        $EUR=null;
        //methods
        $target_data = Target_limit::where('user_id',Auth::user()->id)
        ->first();
        if($target_data){

            $target_data_avrig = Target_limit::select(
                DB::raw('ROUND(avrig_perdayTND, 2) as avrig_perdayTND'),
                DB::raw('ROUND(avrig_perdayEUR, 2) as avrig_perdayEUR'),
                DB::raw('ROUND(avrig_perdayUSD, 2) as avrig_perdayUSD'),
                )
            ->where('user_id', Auth::user()->id)
            ->first();

            $last_date_target = $target_data['reset_date'];

            $target_date_daynum=Carbon::parse($last_date_target)->format('j');
            $target_date_dayname=Carbon::parse($last_date_target)->format('l');
            $target_date_monthname=Carbon::parse($last_date_target)->format('F');

            $date1 = Carbon::createFromFormat('d-m-Y', date('d-m-Y'));
            $date2 = Carbon::parse($last_date_target);
            $target_date_days = $date1->diffInDays($date2);

            $target_date_year=Carbon::parse($last_date_target)->format('Y');;

            if($target_data['limit_type'] == 'dayly'){
                $target_mereg = Items::whereBetween('ticket_date', [$target_data['start_date'],$target_data['reset_date']])
                    ->select(
                        DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                        DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                        DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                        )
                    ->where('items.user_id', Auth::user()->id)
                    ->get();
            }
            else{
                $target_mereg = Items::whereBetween('created_at', [$target_data['start_date'],$target_data['reset_date']])
                    ->select(
                        DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                        DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                        DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                        )
                    ->where('items.user_id', Auth::user()->id)
                    ->get();
            }
            $TND = number_format(($target_mereg[0]['TND'] * 100)/$target_data['limitTND'], 2);
            $USD = number_format(($target_mereg[0]['USD'] * 100)/$target_data['limitUSD'], 2);
            $EUR = number_format(($target_mereg[0]['EUR'] * 100)/$target_data['limitEUR'], 2);
        }


        return Inertia::render('Dashboard/index', [
            'today'=> Items::where('user_id', Auth::user()->id)
                ->where('ticket_date', date('d-m-Y'))
                ->select(
                    DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                    DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                    DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                    )
                ->where('items.user_id', Auth::user()->id)
                ->get(),
            'date' => [
                'day' =>$dayName,
                'month' =>$monthName,
                'year' =>date('d-m-Y'),
            ],

            'chart' => [
                'thisMonth_select' =>[
                    'number_days' => $dateRange,
                    'TND' => $chartRangeTND,
                    'USD' => $chartRangeUSD,
                    'EUR' => $chartRangeEUR,
                ],
                'lastMonth_select' =>[
                    'number_days'=>$dateRange_last,
                    'TND' => $chartLastRangeTND,
                    'USD' => $chartLastRangeUSD,
                    'EUR' => $chartLastRangeEUR,
                ]
            ],

            'week'=> Items::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])
                ->select(
                    DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                    DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                    DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                    )
                ->where('items.user_id', Auth::user()->id)
                ->get(),

            'month'=> Items::whereMonth('created_at', $currentMonth->month)
                ->whereYear('created_at', $currentMonth->year)
                ->select(
                    DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                    DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                    DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                    )
                ->where('items.user_id', Auth::user()->id)
                ->get(),

            'items' => Items::select('items.*', 'regions.*', 'carrencies.*', 'icons.*')
                ->join('regions', 'regions.id_region', '=', 'items.id_region')
                ->join('carrencies', 'carrencies.id_carrency', '=', 'items.id_currency')
                ->join('icons', 'icons.id_icons', '=', 'items.id_icon')
                ->where('items.user_id', Auth::user()->id)
                ->get(),

            'regions_tab' => Region::select('region', 'state')
                ->get()
                ->groupBy('region'),

            'runk_Tickets' => [
                'runk_tickets_price' => $runk_tickets_price,
                'runk_tickets_quentity' => $runk_tickets_quentity,
                'total_quentity' =>$total_quentity,
                'total_price' =>$total_price,
            ],

            'runk_items' => [
                'runk_item_price' => $runk_item_price,
                'runk_item_quentity' => $runk_item_quentity,
                'total_quentity' =>$total_quentity,
                'total_price' =>$total_price,
            ],

            'runk_region' => [
                'runk_region_price' => $runk_region_price,
                'runk_region_quentity' => $runk_region_quentity,
            ],
            'runk_states' => [
                'runk_states_price' => $runk_states_price,
                'runk_states_quentity' => $runk_states_quentity,
            ],

            'runk_currency' => [
                'runk_currency_price' => $runk_currency_price,
                'runk_currency_quentity' => $runk_currency_quentity,
            ],

            'Target_limit' => [
                'target_data' => $target_data,
                'target_mereg' => $target_mereg,
                'percent'=>[
                    'TND'=>$TND,
                    'USD'=>$USD,
                    'EUR'=>$EUR,
                ],
                'target_data_avrig'=> $target_data_avrig,
                'daynum'=>$target_date_daynum,
                'dayname'=>$target_date_dayname,
                'monthname'=>$target_date_monthname,
                'rangday'=>$target_date_days,
                'year'=>$target_date_year,
            ],

            //list company
            

        ]);
        // return Inertia::render('Dashboard/App');
    }

    public function test()
    {
        return Inertia::render('Dashboard/App');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
