<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puskesmas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Puskesmas::all();
        for ($i = 0; $i < count($data); $i++) {
            $markerlat[$i] = $data[$i]->Lat;
            $markerlng[$i] = $data[$i]->Lng;
        }
        return view('generalview/dashboard')
            ->with('markerlat', $markerlat)
            ->with('markerlng', $markerlng);
    }
}
