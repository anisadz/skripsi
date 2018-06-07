<?php
/**
 * Created by PhpStorm.
 * User: Anisa
 * Date: 3/13/2017
 * Time: 8:24 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puskesmas;

class PuskesmasController extends Controller
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
//        print_r($data);
        return view('admin/tabelpuskesmas',compact('data',$data));
    }
    public function tambahPuskesmas()
    {
        return view('admin/tambahpuskesmas');
    }
    public function CreatePuskesmas(Request $request)
    {
        $input = new Puskesmas;
        $input->NamaPuskesmas = $request->namapuskesmas;
        $input->AlamatPuskesmas = $request->alamatpuskesmas;
        $input->Kelurahan = $request->kelurahan;
        $input->Kecamatan = $request->kecamatan;
        $input->KodePos = $request->kodepos;
        $input->Telp = $request->telp;
        $input->Fax = $request->fax;
        $input->Lat = $request->lat;
        $input->Lng = $request->lng;
        $input->save();
        if ($input){
            return redirect('/puskesmas');
        }else{
            return "gagal";
        }
    }
    public function delete(Request $request)
    {
        $del= Puskesmas::where('IdPuskesmas','=',$request->idpuskesmas1);
        $del->delete();
        if($request){
            return redirect('/puskesmas');
        }else{
            echo "gagal";
        }
//        return view('admin/tambahpuskesmas');
    }
    public function UpdatePuskesmas(Request $request)
    {
        $upd= Puskesmas::where('IdPuskesmas','=',$request->idpuskesmas);
        $upd->update([
            "NamaPuskesmas" => $request->namapuskesmas,
            "AlamatPuskesmas" => $request->alamatpuskesmas,
            "Kelurahan" => $request->kelurahan,
            "Kecamatan" => $request->kecamatan,
            "KodePos" => $request->kodepos,
            "Telp" => $request->telp,
            "Fax" => $request->fax,
            "Lat" => $request->lat,
            "Lng" => $request->lng
        ]);
        if ($request){
            return redirect('/puskesmas');
        }else{
            return "gagal";
        }
    }

}