<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Icons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IconsController extends Controller
{
    public function create(Request $request)
    {
        $categorie = $request->get('categories');
        $item = $request->get('item');

        $Items = new Icons();

        $Items->categories = $categorie;
        $Items->items = $item;
        $Items->added = true;

        $Items->save();
        
        return Redirect::back()
        ->with('success', 'item saved');
    }
}
