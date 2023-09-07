<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Items/index', [
            'items_list' => Items::select('items.*', 'regions.*', 'carrencies.*', 'icons.*')
            ->join('regions', 'regions.id_region', '=', 'items.id_region')
            ->join('carrencies', 'carrencies.id_carrency', '=', 'items.id_currency')
            ->join('icons', 'icons.id_icons', '=', 'items.id_icon')
            ->get()
            ->groupBy('ticket_id'),
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
    public function store(Request $request,User $user,Ticket $tickets)
    {
        
        $price = $request->get('price');
        $state = $request->get('state');
        $carrency = $request->get('carrency');
        $quentity = $request->get('quentity');
        $item = $request->get('item_name');

        $items = new Items();
        $items->user_id = $user->id;
        $items->ticket_id = date('dmY');
        $items->ticket_date = date('d-m-Y');
        $items->id_region = $state;
        $items->id_currency = $carrency;
        $items->id_icon = $item;
        $items->item_prix = $price;
        $items->item_quentity = $quentity;
        $items->save();

        return Redirect::back()
        ->with('success', 'item saved');
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
    public function edit(string $tickets)
    {
        return Inertia::render('Items/show', [
            'items' => Items::select('items.*', 'regions.*', 'carrencies.*', 'icons.*')
            ->join('regions', 'regions.id_region', '=', 'items.id_region')
            ->join('carrencies', 'carrencies.id_carrency', '=', 'items.id_currency')
            ->join('icons', 'icons.id_icons', '=', 'items.id_icon')
            ->where('items.ticket_id', $tickets)
            ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $price = $request->get('price');
        $region = $request->get('state');
        $carrency = $request->get('currency');
        $quentity = $request->get('quentity');

        $item = Items::find($id);
        if ($item) {
            $item->update([
                $item->id_region = $region,
                $item->id_currency = $carrency,
                $item->item_prix = $price,
                $item->item_quentity = $quentity,
            ]);
        }
        
        return Redirect::back()
        ->with('success', 'item saved');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Items $item)
    {
        $item->delete();
        return Redirect::back()->with('success', 'تم حذف المستخدم.');
    }
}
