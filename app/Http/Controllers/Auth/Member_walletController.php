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
        
        // $historique_incame = Memeber_incame::where('id_user', Auth::user()->id)
        // ->selectRaw('*, DATE_FORMAT(created_at, "%d/%m/%Y") as created_at')
        // ->orderBy('created_at', 'desc')
        // ->get();

        foreach ($historique_incame as $income) {
            $income->format_created_at = $income->created_at->format('d/m/y');
            $income->TND = $income->totalTND;
            $income->USD = $income->totalUSD;
            $income->EUR = $income->totalEUR;
        }

        $TOTAL=[
            'TND' => ($total_incame[0]['TND'] - $total_expenses[0]['TND']),
            'EUR' => ($total_incame[0]['EUR'] - $total_expenses[0]['EUR']),
            'USD' => ($total_incame[0]['USD'] - $total_expenses[0]['USD'])
        ];

        return Inertia::render('Wallet/index',[
            'TOTAL' => $TOTAL,
            'total_expenses' => $total_expenses,
            'total_incame'=> $total_incame,
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
