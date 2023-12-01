<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Exchange_rate;
use Illuminate\Support\Facades\DB;
use App\Models\Carrency;
use App\Models\Items;
use App\Models\Memeber_incame;
use App\Models\Region;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Member_walletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $total_expenses = Items::where('user_id', Auth::user()->id)
        ->select(
            DB::raw('ROUND(SUM(totalTND), 3) as TND'),
            DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
            DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
        )
        ->get();
        $total_incame = Memeber_incame::where('id_user', Auth::user()->id)
        ->select(
            DB::raw('ROUND(SUM(totalTND), 3) as TND'),
            DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
            DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
        )
        ->get();

        $historique_incame = Memeber_incame::where('id_user', Auth::user()->id)
        ->select('memeber_incames.*')
        ->orderBy('created_at', 'desc')
        ->get();

        foreach ($historique_incame as $income) {
            $income->format_created_at = $income->created_at->format('d/m/y');
            $income->TND = $income->totalTND;
            $income->USD = $income->totalUSD;
            $income->EUR = $income->totalEUR;
        }

        $TOTAL=[
            'TND' => round($total_incame[0]['TND'] - $total_expenses[0]['TND'],2),
            'EUR' => round($total_incame[0]['EUR'] - $total_expenses[0]['EUR'],2),
            'USD' => round($total_incame[0]['USD'] - $total_expenses[0]['USD'],2)
        ];


        $incame = Memeber_incame::where('id_user', Auth::user()->id)
        ->select(
            DB::raw('SUM(CASE WHEN totalTND > 0 THEN totalTND ELSE 0 END) as positiveTND'),
            DB::raw('SUM(CASE WHEN totalTND < 0 THEN -totalTND ELSE 0 END) as negativeTND'),
            DB::raw('SUM(CASE WHEN totalEUR > 0 THEN totalEUR ELSE 0 END) as positiveEUR'),
            DB::raw('SUM(CASE WHEN totalEUR < 0 THEN -totalEUR ELSE 0 END) as negativeEUR'),
            DB::raw('SUM(CASE WHEN totalUSD > 0 THEN totalUSD ELSE 0 END) as positiveUSD'),
            DB::raw('SUM(CASE WHEN totalUSD < 0 THEN -totalUSD ELSE 0 END) as negativeUSD'),
            DB::raw('DATE(created_at) as date')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->limit(7)
        ->orderBy(DB::raw('MIN(created_at)'), 'asc')
        ->get();
    
        $testmax = [];
        foreach ($incame as $incames) {
            $testmax[] = $incames->positiveTND;
        }

        $testmin = [];
        foreach ($incame as $incames) {
            $testmin[] = $incames->negativeTND;
        }

        $testdate = [];
        foreach ($incame as $incames) {
            $testdate[] = $incames->date;
        }

        return Inertia::render('Wallet/index',[
            'TOTAL' => $TOTAL,
            'total_expenses' => $total_expenses,
            'total_incame'=> $total_incame,
            'incame'=> $testmax,
            'expenses'=> $testmin,
            'dateChart'=> $testdate,
            'historique_incame'=> $historique_incame,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function expenses(Request $request)
    {
        $amount = $request->get('amount');
        $currency = $request->get('currency');
        $from = $request->get('from');
        $to = $request->get('to');

        $extchange_currency=Exchange_rate::select('currencys','rate')
            ->where('base',$currency)
            ->get();

        $Memeber = new Memeber_incame();

        $Memeber->id_user = Auth::user()->id;
        $Memeber->amount = -$amount;
        $Memeber->currency = $currency;
        $Memeber->from_name = $from;
        $Memeber->to_name = $to;
        $Memeber->type = 'expenses';

        for($i=0;$i<3;$i++){
            switch ($extchange_currency[$i]['currencys']) {
                case 'TND':
                    $Memeber->totalTND = -($extchange_currency[$i]['rate'] * $amount);
                    break;
                case 'USD':
                    $Memeber->totalUSD = -($extchange_currency[$i]['rate'] * $amount);
                    break;
                case 'EUR':
                    $Memeber->totalEUR = -($extchange_currency[$i]['rate'] * $amount);
                    break;
            }
        }

        $Memeber->save();
        
        return Redirect::back()
        ->with('success', 'expenses saved');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function incame(Request $request)
    {
        $amount = $request->get('amount');
        $currency = $request->get('currency');
        $from = $request->get('from');
        $to = $request->get('to');

        $extchange_currency=Exchange_rate::select('currencys','rate')
            ->where('base',$currency)
            ->get();

        $Memeber = new Memeber_incame();

        $Memeber->id_user = Auth::user()->id;
        $Memeber->amount = $amount;
        $Memeber->currency = $currency;
        $Memeber->from_name = $from;
        $Memeber->to_name = $to;
        $Memeber->type = 'income';

        for($i=0;$i<3;$i++){
            switch ($extchange_currency[$i]['currencys']) {
                case 'TND':
                    $Memeber->totalTND = ($extchange_currency[$i]['rate'] * $amount);
                    break;
                case 'USD':
                    $Memeber->totalUSD = ($extchange_currency[$i]['rate'] * $amount);
                    break;
                case 'EUR':
                    $Memeber->totalEUR = ($extchange_currency[$i]['rate'] * $amount);
                    break;
            }
        }


        $Memeber->save();
        
        return Redirect::back()
        ->with('success', 'incame saved');
    }
}
