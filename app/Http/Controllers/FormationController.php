<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function projetFormation()
    {
    	return view('infoFormation');
    }

    public function infoANEREE()
    {
    	return view('infoANEREE');
    }
    public function souscriptionAide()
    {
    	return view('aide');
    }
}
