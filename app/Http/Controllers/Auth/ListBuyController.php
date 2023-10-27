<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Carrency;
use App\Models\Items;
use App\Models\Region;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ListBuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Tickets/index', [
            'tickets' => Items::where('user_id', Auth::user()->id)
                ->select('ticket_date',
                        'ticket_id', 
                        DB::raw('SUM(item_quentity) as quentity'),
                        DB::raw('ROUND(SUM(totalTND), 3) as TND'),
                        DB::raw('ROUND(SUM(totalEUR), 3) as EUR'),
                        DB::raw('ROUND(SUM(totalUSD), 3) as USD'),
                )
                ->groupBy('ticket_date')
                ->get(),
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
    public function store(User $user)
    {

    }

    public function show(string $tickets)
    {

    }

    public function edit()
    {

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
    public function destroy(string $date_item)
    {

    }
}
