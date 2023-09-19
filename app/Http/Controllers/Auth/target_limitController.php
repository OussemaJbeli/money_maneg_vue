<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Items;
use App\Models\Target_limit;
use App\Models\User;
use App\Models\Carrency;
use App\Models\Exchange_rate;
use App\Models\Ticket;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Countable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use DateTime;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Testing\Constraints\CountInDatabase;
use LengthException;
use SebastianBergmann\LinesOfCode\Counter;

use function PHPUnit\Framework\countOf;
use function Termwind\render;

class target_limitController extends Controller
{

    public function index()
    { 
        $target_date_daynum=null;
        $target_date_dayname=null;
        $target_date_monthname=null;
        $target_date_days=null;
        $target_date_year=null;
        $target_mereg=null;
        $target_data_avrig=null;
        $target_deference=null;
        $target_count=null;
        $TND=null;
        $USD=null;
        $EUR=null;
        $total_days=null;
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
                    ->select('ticket_date',
                        DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                        DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                        DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                        )
                    ->where('items.user_id', Auth::user()->id)
                    ->groupBy('ticket_date')
                    ->get();
            }
            else{
                $target_mereg = Items::whereBetween('created_at', [$target_data['start_date'],$target_data['reset_date']])
                    ->select('ticket_date',
                        DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                        DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                        DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                        )
                    ->where('items.user_id', Auth::user()->id)
                    ->groupBy('ticket_date')
                    ->get();
            }
            
            $target_deference = Items::whereBetween('created_at', [$target_data['start_date'],$target_data['reset_date']])
                ->select('ticket_date',
                    DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                    DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                    DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                    )
                ->where('items.user_id', Auth::user()->id)
                ->get();

            $target_count = Ticket::whereBetween('created_at', [$target_data['start_date'],$target_data['reset_date']])
                ->where('user_id', Auth::user()->id)
                ->count();

            $TND = number_format(($target_deference[0]['TND'] * 100)/$target_data['limitTND'], 2);
            $USD = number_format(($target_deference[0]['USD'] * 100)/$target_data['limitUSD'], 2);
            $EUR = number_format(($target_deference[0]['EUR'] * 100)/$target_data['limitEUR'], 2);

            switch ($target_data['limit_type']) {
                case 'monthly':
                    $endDate = new DateTime('last day of this month');
                    $total_days = $endDate->format('j');
                    break;
                case 'dayly':
                    $total_days = 1;
                    break;
                case 'custom':
                    $date1 = Carbon::parse($target_data['start_date']);
                    $date2 = Carbon::parse($target_data['reset_date']);
                    $total_days = $date1->diffInDays($date2);
                    break;
            }
        }

        return Inertia::render('Limit/index',[
            'today'=> Items::where('user_id', Auth::user()->id)
            ->where('ticket_date', date('d-m-Y'))
            ->select(
                DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                )
            ->where('items.user_id', Auth::user()->id)
            ->get(),

            'Target_limit' => [
                'target_data' => $target_data,
                'target_mereg' => $target_mereg,
                'target_deference' => $target_deference,
                'target_length' => $target_count,
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
                'total_days'=>$total_days,
            ]
        ]);
    }
        /**
     * Show the form for creating a new resource.
     */
    public function create_dachboard(Request $request, string $id)
    {
        $endDate = new DateTime('last day of this month');
        $last_day = $endDate->format('j');

        $limit_type_date = $request->get('selectedOption_add');
        $limit_value = $request->get('value_add');
        $limit_currency = $request->get('currency_add');
        $limit_avrig= 0;
        $limit_reset_date= null;
        $limit_start_date= null;
        $message=null;

        switch ($limit_type_date) {
            case 'monthly':
                $limit_avrig = $limit_value/$last_day;
                $limit_reset_date = $last_day.'-'.date('m').'-'.date('Y');
                $limit_start_date = '1-'.date('m').'-'.date('Y');
                break;
            case 'dayly':
                $limit_avrig = $limit_value;
                $limit_reset_date = date('d-m-Y');
                $limit_start_date = date('d-m-Y');
                break;
            case 'custom':
                //ragne date
                $date1 = Carbon::parse($request->get('date_from_add'));
                $date2 = Carbon::parse($request->get('date_to_add'));
                $range_date = $date1->diffInDays($date2);
                $limit_avrig = $limit_value/$range_date;
                $limit_start_date = $date1 ;
                $limit_reset_date = $date2 ;
                break;
            }

        $extchange_currency=Exchange_rate::select('currencys','rate')
            ->where('base',$limit_currency)
            ->get();

        //test
        $limit = Target_limit::find($id);

        if($limit){

            $limit->limit_type = $limit_type_date;
            $limit->start_date = $limit_start_date;
            $limit->reset_date = $limit_reset_date;
            switch ($limit_currency) {
                case 'TND':
                    $limit->id_currency = 1;
                    break;
                case 'USD':
                    $limit->id_currency = 2;
                    break;
                case 'EUR':
                    $limit->id_currency = 3;
                    break;
            }
            for($i=0;$i<3;$i++){
                switch ($extchange_currency[$i]['currencys']) {
                    case 'TND':
                        $limit->limitTND = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayTND = ($extchange_currency[$i]['rate'] * $limit_avrig);
                        break;
                    case 'USD':
                        $limit->limitUSD = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayUSD = $limit_avrig * $extchange_currency[$i]['rate'];
                        break;
                    case 'EUR':
                        $limit->limitEUR = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayEUR = $limit_avrig * $extchange_currency[$i]['rate'];
                        break;
                }
            }
            $limit->save();
            $message='limit money updated successfuly';
        }
        else{

            $limit = new Target_limit();

            $limit->user_id = Auth::user()->id;
            $limit->limit_type = $limit_type_date;
            $limit->start_date = $limit_start_date;
            $limit->reset_date = $limit_reset_date;
            switch ($limit_currency) {
                case 'TND':
                    $limit->id_currency = 1;
                    break;
                case 'USD':
                    $limit->id_currency = 2;
                    break;
                case 'EUR':
                    $limit->id_currency = 3;
                    break;
            }
            for($i=0;$i<3;$i++){
                switch ($extchange_currency[$i]['currencys']) {
                    case 'TND':
                        $limit->limitTND = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayTND = ($extchange_currency[$i]['rate'] * $limit_avrig);
                        break;
                    case 'USD':
                        $limit->limitUSD = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayUSD = $limit_avrig * $extchange_currency[$i]['rate'];
                        break;
                    case 'EUR':
                        $limit->limitEUR = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayEUR = $limit_avrig * $extchange_currency[$i]['rate'];
                        break;
                }
            }
            $limit->save();
            $message='limit money created successfuly';
        }
        //
        return redirect()->route('dashboard')
        ->with('success', $message);
    }
    public function create_plan_target(Request $request, string $id)
    {
        $endDate = new DateTime('last day of this month');
        $last_day = $endDate->format('j');

        $limit_type_date = $request->get('selectedOption_add');
        $limit_value = $request->get('value_add');
        $limit_currency = $request->get('currency_add');
        $limit_avrig= 0;
        $limit_reset_date= null;
        $limit_start_date= null;
        $message=null;

        switch ($limit_type_date) {
            case 'monthly':
                $limit_avrig = $limit_value/$last_day;
                $limit_reset_date = $last_day.'-'.date('m').'-'.date('Y');
                $limit_start_date = '1-'.date('m').'-'.date('Y');
                break;
            case 'dayly':
                $limit_avrig = $limit_value;
                $limit_reset_date = date('d-m-Y');
                $limit_start_date = date('d-m-Y');
                break;
            case 'custom':
                //ragne date
                $date1 = Carbon::parse($request->get('date_from_add'));
                $date2 = Carbon::parse($request->get('date_to_add'));
                $range_date = $date1->diffInDays($date2);
                $limit_avrig = $limit_value/$range_date;
                $limit_start_date = $date1 ;
                $limit_reset_date = $date2 ;
                break;
            }

        $extchange_currency=Exchange_rate::select('currencys','rate')
            ->where('base',$limit_currency)
            ->get();

        //test
        $limit = Target_limit::find($id);

        if($limit){

            $limit->limit_type = $limit_type_date;
            $limit->start_date = $limit_start_date;
            $limit->reset_date = $limit_reset_date;
            switch ($limit_currency) {
                case 'TND':
                    $limit->id_currency = 1;
                    break;
                case 'USD':
                    $limit->id_currency = 2;
                    break;
                case 'EUR':
                    $limit->id_currency = 3;
                    break;
            }
            for($i=0;$i<3;$i++){
                switch ($extchange_currency[$i]['currencys']) {
                    case 'TND':
                        $limit->limitTND = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayTND = ($extchange_currency[$i]['rate'] * $limit_avrig);
                        break;
                    case 'USD':
                        $limit->limitUSD = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayUSD = $limit_avrig * $extchange_currency[$i]['rate'];
                        break;
                    case 'EUR':
                        $limit->limitEUR = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayEUR = $limit_avrig * $extchange_currency[$i]['rate'];
                        break;
                }
            }
            $limit->save();
            $message='limit money updated successfuly';
        }
        else{

            $limit = new Target_limit();

            $limit->user_id = Auth::user()->id;
            $limit->limit_type = $limit_type_date;
            $limit->start_date = $limit_start_date;
            $limit->reset_date = $limit_reset_date;
            switch ($limit_currency) {
                case 'TND':
                    $limit->id_currency = 1;
                    break;
                case 'USD':
                    $limit->id_currency = 2;
                    break;
                case 'EUR':
                    $limit->id_currency = 3;
                    break;
            }
            for($i=0;$i<3;$i++){
                switch ($extchange_currency[$i]['currencys']) {
                    case 'TND':
                        $limit->limitTND = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayTND = ($extchange_currency[$i]['rate'] * $limit_avrig);
                        break;
                    case 'USD':
                        $limit->limitUSD = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayUSD = $limit_avrig * $extchange_currency[$i]['rate'];
                        break;
                    case 'EUR':
                        $limit->limitEUR = ($extchange_currency[$i]['rate'] * $limit_value);
                        $limit->avrig_perdayEUR = $limit_avrig * $extchange_currency[$i]['rate'];
                        break;
                }
            }
            $limit->save();
            $message='limit money created successfuly';
        }
        //
        return redirect()->route('Limit')
        ->with('success', $message);
    }
}
