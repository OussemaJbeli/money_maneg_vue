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
        // $key = '955383a8b7292ef7cf00b8339a8eb993';
        // $link= 'http://api.exchangeratesapi.io/v1/latest?access_key='.$key;
        // $ch= curl_init();
        // curl_setopt($ch, CURLOPT_URL,$link);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

        // $resp = curl_exec($ch);
        // $data = json_decode($resp,true);

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
