<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        /**********api request */
        // $key='9491d8299dc7f640e0423d55';
        // $link= 'https://v6.exchangerate-api.com/v6/'.$key.'/latest/EUR';
        // //base = USD
        // $ch= curl_init();
        // curl_setopt($ch, CURLOPT_URL,$link);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

        // $resp = curl_exec($ch);
        // $data = json_decode($resp,true);

        // echo '<pre>';
        // print_r('base => '.$data['base_code']);
        // print_r('JPY => '.$data['conversion_rates']['JPY']);
        // print_r('TND => '.$data['conversion_rates']['TND']);
        // print_r('USD => '.$data['conversion_rates']['USD']);
        // echo '</pre>';

        // return Inertia::render('Dashboard/index',[
        //     "api_currency" => $data
        // ]);
        return Inertia::render('Dashboard/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
