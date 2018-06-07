<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
        $data = User::where('IdLevel','=',0)->orWhere('IdLevel','=',2)->get() ;
        return view('admin/monitoringuser',compact('data',$data));
    }

    public function Verifikasi($id)
    {
        $verif= User::where('id','=',$id);
        $verif->update([
            "IdLevel" => 2
        ]);
        if ($id){
            return redirect('/user');
        }else{
            return "gagal";
        }
    }
}
