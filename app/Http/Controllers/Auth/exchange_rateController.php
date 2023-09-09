<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Exchange_rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class exchange_rateController extends Controller
{

    public function index()
    {   
        /**********api request */
        // $key = '955383a8b7292ef7cf00b8339a8eb993';
        // $link= 'http://api.exchangeratesapi.io/v1/latest
        // ?access_key='.$key.
        // '& base ='..
        // '& symbols = GBP,JPY,EUR';
        // $ch= curl_init();
        // curl_setopt($ch, CURLOPT_URL,$link);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

        // $resp = curl_exec($ch);
        // $data = json_decode($resp,true);

        // return Inertia::render('Dashboard/index',[
        //     "api_currency" => $data
        // ]);
        for($i=0;$i<=12;$i++){
            $key='9491d8299dc7f640e0423d55';
            $link= 'https://v6.exchangerate-api.com/v6/'.$key.'/latest/'.$key;
            $ch= curl_init();
            curl_setopt($ch, CURLOPT_URL,$link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

            $resp = curl_exec($ch);
            $data = json_decode($resp,true);
            $Exchange = Exchange_rate::find($i);
            if ($Exchange) {
                $Exchange->update([
                    $Exchange->base = "",
                    $Exchange->currencys = "",
                    $Exchange->rate = "",
                ]);
            }
        }
        
        return Redirect::back()
        ->with('success', 'item saved');
    }

}
