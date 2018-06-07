<?php
/**
 * Created by PhpStorm.
 * User: Anisa
 * Date: 3/13/2017
 * Time: 8:24 PM
 */

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use App\Kategori;

class ObatController extends Controller
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
        $data = Barang::all();
//        print_r($data);
        return view('admin/obat',compact('data',$data));
    }
    public function tambahObatForm()
    {
        return view('admin/tambahobat');
    }
    public function CreateObat(Request $request)
    {
        $input = new Barang;
        $input->NamaBarang = $request->nama;
        $input->IdKategori = $request->kategori;
        $input->JumlahPerPak = $request->jumlahpak;
        $input->JumlahPakTersedia = $request->tersedia;
        $input->save();
        if ($input){
            return redirect('/obat');
        }else{
            return "gagal";
        }
    }
    public function delete(Request $request)
    {
        $del = Barang::where('IdBarang','=',$request->idobat);
        $del->delete();
        if($del){
            return redirect('/obat');
        }else{
            return "gagal";
        }
    }
    public function UpdateObat(Request $request)
    {
        $upd= Barang::where('IdBarang','=',$request->idbarang);
        $upd->update([
            "NamaBarang" => $request->namaobat,
            "IdKategori" => $request->kategori,
            "JumlahPerPak" => $request->jumlahpak,
            "JumlahPakTersedia" => $request->tersedia
        ]);
        if ($request){
            return redirect('/obat');
        }else{
            return "gagal";
        }
    }

}