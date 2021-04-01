<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use Illuminate\Http\Request;

class AllergensController extends Controller
{
    public function show() {

        $allergens = Allergen::all()->sortBy('group_id')->groupBy('group_id');;
        return view('allergens.list_allergens')->with('allergens', $allergens);

    }

 

    public function stats() {

        return view('stats');

    }
}
