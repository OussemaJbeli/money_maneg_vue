<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Exchange_rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class exchange_rate_Controller extends Controller
{

    public function index()
    {   
        /**********api request */
        $currencies = [
            ['currency' => 'TND','index' => 1,'to' => 3],
            ['currency' => 'USD','index' => 4,'to' => 6],
            ['currency' => 'EUR','index' => 7,'to' => 9],
        ];
        foreach($currencies as $currency){
            $key='9491d8299dc7f640e0423d55';
            $link= 'https://v6.exchangerate-api.com/v6/'.$key.'/latest/'.$currency['currency'];
            $ch= curl_init();
            curl_setopt($ch, CURLOPT_URL,$link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    
            $resp = curl_exec($ch);
            $data = json_decode($resp,true);
            
            $this->insert_data($key,$data,$currency['index'],$currency['to']);
        }
        
        return Redirect::back()
        ->with('success', 'exchange rate is uptodate');  
    }
    private function insert_data($base, $targets, $index, $to)
    {
        $i=0;
            $clean_data=[
                ['currencys' => 'TND','rate' => $targets['conversion_rates']['TND']],
                ['currencys' => 'USD','rate' => $targets['conversion_rates']['USD']],
                ['currencys' => 'EUR','rate' => $targets['conversion_rates']['EUR']],
            ]; 
            for($id=$index;$id<=$to;$id++){

                $Exchange = Exchange_rate::find($id);
                $Exchange->base = $base;
                $Exchange->currencys = $clean_data[$i]['currencys'];
                $Exchange->rate = $clean_data[$i]['rate'];
                $i++;

            }
    }
    

}
