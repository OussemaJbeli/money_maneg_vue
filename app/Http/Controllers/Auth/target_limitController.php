<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Target_limit;
use App\Models\User;
use App\Models\Carrency;
use App\Models\Exchange_rate;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use DateTime;

use function Termwind\render;

class target_limitController extends Controller
{

    public function index()
    { 
            return Inertia::render('Limit/index');
    }
        /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $id)
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
}
