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

class TicketsController extends Controller
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
                        DB::raw('SUM(item_quentity) as quentity')
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

        $currentDate = date('dmY'); // Get the current date in YYYY-MM-DD format
        $existingItem = Ticket::where('ticket_id', $currentDate)->first();

        if ($existingItem) {
            return Redirect::back();
        } 
        else {
            // Item with the current date doesn't exist, create one
            $ticket = new Ticket();
            $ticket->ticket_id = date('dmY');
            $ticket->ticket_date = date('d-m-Y');
            $ticket->user_id = $user->id;
            $ticket->save();
            return Redirect::back();
        }
    }

    public function show(string $tickets)
    {
        return Inertia::render('Tickets/show', [
            'items' => Items::select('items.*', 'regions.*', 'carrencies.*', 'icons.*')
            ->join('regions', 'regions.id_region', '=', 'items.id_region')
            ->join('carrencies', 'carrencies.id_carrency', '=', 'items.id_currency')
            ->join('icons', 'icons.id_icons', '=', 'items.id_icon')
            ->where('items.ticket_id', $tickets)
            ->get()
        ]);
    }

    public function edit()
    {
        return Inertia::render('Tickets/edite');
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
        Items::where('ticket_date', $date_item)->delete();
        return Redirect::back()->with('success', 'تم حذف المستخدم.');
    }
}
