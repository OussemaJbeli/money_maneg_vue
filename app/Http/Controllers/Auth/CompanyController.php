<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Companys;
use Illuminate\Support\Facades\DB;
use App\Models\Carrency;
use App\Models\Items;
use App\Models\Memebers;
use App\Models\Region;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CompanyController extends Controller
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
    public function create(Request $request)
    {
        $discription = $request->get('copmany_discription');
        $type = $request->get('Company_type');
        $name = $request->get('Company_Name');

        $randomNumber = Str::random(8);
        // Ensure uniqueness
        while (Companys::where('invitation_code', $randomNumber)->exists()) {
            $randomNumber = Str::random(8);
        }
        $Company = new Companys();
        $Company->company_id = $randomNumber;
        $Company->invitation_code = $randomNumber;
        $Company->name = $name;
        $Company->type = $type;
        $Company->discription = $discription;
        $Company->avatar = strtoupper($name[0]);
        $Company->main_currency = Auth::user()->main_currency;
        
        $Company->save();

        $Memeber = new Memebers();
        $Memeber->user_id = Auth::user()->id;
        $Memeber->id_company = $randomNumber;
        $Memeber->name = Auth::user()->name;
        $Memeber->email = Auth::user()->email;
        $Memeber->Post = "admin";

        $Memeber->save();
        
        return Redirect::back()
        ->with('success', 'campany create successfuly');
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $date_item)
    {

    }
}
