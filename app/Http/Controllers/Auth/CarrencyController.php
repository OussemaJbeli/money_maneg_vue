<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Exchange;
use App\Models\Exchange_rate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CarrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $date_update = Exchange_rate::select('updated_at')
            ->where('id', 1)
            ->first();
        $carbonDate = Carbon::parse($date_update['updated_at']);
        $formattedDate = $carbonDate->format('d-m-y');
    
        return Inertia::render('Carrency/index',[
            'exchange_rate' => Exchange_rate::select(
                'base','currencys','rate','updated_at')
                ->where('base',Auth::user()->main_currency)
                ->get(),
            'update_at' => $formattedDate,
        ]);
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
    public function main_update( User $user , string $currency)
    {

        $user->update([
            $user->main_currency = $currency,
        ]);
        
        // return Redirect::back()
        // ->with('success', 'item saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
