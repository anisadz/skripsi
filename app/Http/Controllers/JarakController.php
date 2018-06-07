<?php
/**
 * Created by PhpStorm.
 * User: Anisa
 * Date: 3/15/2017
 * Time: 9:44 PM
 */

namespace App\Http\Controllers;

use App\Jarak;
use App\Puskesmas;
use Illuminate\Http\Request;

class JarakController extends Controller
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

        $data = Jarak::all();
        return view('user/tabeljarak',compact('data',$data));
    }
    public function tambahJarakPuskesmas()
    {
        $data = Puskesmas::all();
        return view('user/tambahjarak',compact('data',$data));
    }
    public function CreateJarak(Request $request)
    {
        $input = new Jarak;
        $input->IdPuskesmasAwal = $request->idpuskesmas1;
        $input->IdPuskesmasTujuan = $request->idpuskesmas2;
        $input->Jarak = $request->jarak;
//        $input->save();
        $id1=$request->idpuskesmas1;
        $id2=$request->idpuskesmas2;
//        $awal= Puskesmas::where('IdPuskesmasAwal','=',$request->idpuskesmas1)->orWhere('IdPuskesmasTujuan','=',$request->idpuskesmas2);
        $cek1=Jarak::where('IdPuskesmasAwal','=',$id1)->where('IdPuskesmasTujuan','=',$id2)->count();
        $cek2=Jarak::where('IdPuskesmasTujuan','=',$id1)->where('IdPuskesmasAwal','=',$id2)->count();
        if($cek1>0 || $cek2>0){
            return "jarak telah dihitung";
        }
        else{
            $input->save();
            if ($input){
                return redirect('/jarak');
            }else{
                return "gagal";
            }
        }

    }

}