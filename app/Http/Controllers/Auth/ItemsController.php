<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Carrency;
use App\Models\Exchange_rate;
use App\Models\Items;
use App\Models\Memeber_incame;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            ->where('user_id', Auth::user()->id)
            ->orderBy('items.created_at', 'desc')
            ->get()
            ->groupBy('ticket_id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request,string $id)
    {
        $categorie = $request->get('categorie');
        $item = $request->get('item');

        $Items = new Items();

        $Items->categories = $categorie;
        $Items->items = $item;

        $Items->save();
        
        return Redirect::back()
        ->with('success', 'item saved');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,User $user)
    {
        $this->storeTicket($user);

        $price = $request->get('price');
        $state = $request->get('state');
        $carrency = $request->get('carrency');
        $quentity = $request->get('quentity');
        $item = $request->get('item_name');
        $totalprice= $price*$quentity;

        $curency_name=Carrency::select('currency')
            ->where('id_carrency',$carrency)
            ->get();
        
        $extchange_currency=Exchange_rate::select('currencys','rate')
            ->where('base',$curency_name[0]['currency'])
            ->get();

        $items = new Items();
        $items->user_id = $user->id;
        $items->ticket_id = date('dmY');
        $items->ticket_date = date('d-m-Y');
        $items->id_region = $state;
        $items->id_currency = $carrency;
        $items->id_icon = $item;
        $items->item_prix = $price;
        $items->totalitem_prix = $totalprice;
        $items->item_quentity = $quentity;

        for($i=0;$i<3;$i++){
            switch ($extchange_currency[$i]['currencys']) {
                case 'TND':
                    $items->TND = ($extchange_currency[$i]['rate'] * $price);
                    $items->totalTND = ($extchange_currency[$i]['rate'] * $price) * $quentity;
                    break;
                case 'USD':
                    $items->USD = ($extchange_currency[$i]['rate'] * $price);
                    $items->totalUSD = ($extchange_currency[$i]['rate'] * $price) * $quentity;
                    break;
                case 'EUR':
                    $items->EUR = ($extchange_currency[$i]['rate'] * $price);
                    $items->totalEUR = ($extchange_currency[$i]['rate'] * $price) * $quentity;
                    break;
            }
        }
        $items->save();

        $Memeber = new Memeber_incame();

        $Memeber->id_user = Auth::user()->id;
        $Memeber->amount = -$totalprice;
        $Memeber->currency = $carrency;
        $Memeber->from_name = 'you';
        $Memeber->to_name = 'shop';
        $Memeber->type = 'shop';

        for($i=0;$i<3;$i++){
            switch ($extchange_currency[$i]['currencys']) {
                case 'TND':
                    $Memeber->totalTND = -($extchange_currency[$i]['rate'] * $price) * $quentity;
                    break;
                case 'USD':
                    $Memeber->totalUSD = -($extchange_currency[$i]['rate'] * $price) * $quentity;
                    break;
                case 'EUR':
                    $Memeber->totalEUR = -($extchange_currency[$i]['rate'] * $price) * $quentity;
                    break;
            }
        }

        $Memeber->save();

        return Redirect::back()
        ->with('success', 'item stored successfuly');
    }

    private function storeTicket(User $user)
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
        }
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
        $totalprice= $price*$quentity;

        $curency_name=Carrency::select('currency')
            ->where('id_carrency',$carrency)
            ->get();
        
        $extchange_currency=Exchange_rate::select('currencys','rate')
            ->where('base',$curency_name[0]['currency'])
            ->get();
        
            $item = Items::find($id);

            if ($item) {
                $item->id_region = $region;
                $item->id_currency = $carrency;
                $item->item_prix = $price;
                $item->totalitem_prix = $totalprice;
                $item->item_quentity = $quentity;
            
                // Calculate and update exchange rates
                for ($i = 0; $i < 3; $i++) {
                    switch ($extchange_currency[$i]['currencys']) {
                        case 'TND':
                            if($extchange_currency[$i]['currencys']==$curency_name[0]['currency']){
                                $item->TND = $extchange_currency[$i]['rate'] * 1;
                                $item->totalTND = ($extchange_currency[$i]['rate'] * $price) * 1;
                            }
                            else{
                                $item->TND = $extchange_currency[$i]['rate'] * $price;
                                $item->totalTND = ($extchange_currency[$i]['rate'] * $price) * $quentity;
                            }
                            break;
                        case 'USD':
                            if($extchange_currency[$i]['currencys']==$curency_name[0]['currency']){
                                $item->USD = $extchange_currency[$i]['rate'] * 1;
                                $item->totalUSD = ($extchange_currency[$i]['rate'] * $price) * 1;
                            }
                            else{
                                $item->USD = $extchange_currency[$i]['rate'] * $price;
                                $item->totalUSD = ($extchange_currency[$i]['rate'] * $price) * $quentity;
                            }
                            break;
                        case 'EUR':
                            if($extchange_currency[$i]['currencys']==$curency_name[0]['currency']){
                                $item->EUR = $extchange_currency[$i]['rate'] * 1;
                                $item->totalEUR = ($extchange_currency[$i]['rate'] * $price) * 1;
                            }
                            else{
                                $item->EUR = $extchange_currency[$i]['rate'] * $price;
                                $item->totalEUR = ($extchange_currency[$i]['rate'] * $price) * $quentity;
                            }
                            break;

                    }
                }
            
                // Save the updated item
                $item->save();
            }
            return Redirect::back()
            ->with('success', 'item updated successfuly');            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Items $item)
    {
        return Redirect::back()
        ->with('success', 'item deleted successfuly');  
    }
}
