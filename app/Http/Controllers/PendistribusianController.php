<?php

namespace App\Http\Controllers;

use App\Pendistribusian;
use App\Puskesmas;
use App\Jarak;
use App\Users;
use Illuminate\Http\Request;

class PendistribusianController extends Controller
{

    private $rutes = [];
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $data = Pendistribusian::all();
        return view('admin/pendistribusianAdmin', compact('data', $data));
    }

    public function pendistribusian()
    {
        $data = Pendistribusian::all();
        return view('admin/pendistribusianAdmin', compact('data', $data));
    }

    public function pendistribusianUser()
    {
        $data = Pendistribusian::all();
        return view('user/pendistribusianUser', compact('data', $data));
    }

    public function tambahPendistribusian()
    {
        $data = Puskesmas::all();
        $iduser = Users::all();
        return view('user/detail')->with('data', $data)->with('iduser', $iduser);
    }

    public function routing(Request $request)
    {
        $nodes = [];
        for ($i = 0; $i < count($request->namapuskesmas) ; $i++) {
            $nodes[] = (int)$request->namapuskesmas[$i];
        }
        $hasil = [
            [(int)$request->namapuskesmas[0],(int)$request->namapuskesmas[count($request->namapuskesmas)-1]]
        ];

        $this->nested($nodes, $hasil);
        $nomer=0;
        $titik=$this->rutes;
        foreach($titik as $t) {
            $namapuskesmas = Puskesmas::where('IdPuskesmas', $t[0])->first();
            $hasilrute[$nomer] =$namapuskesmas->NamaPuskesmas;
            $hasilrutelatlong[$nomer] =$namapuskesmas->Lat.','.$namapuskesmas->Lng;
            $markerlat[$nomer]=$namapuskesmas->Lat;
            $markerlng[$nomer]= $namapuskesmas->Lng;
            $nomer++;
        }
        $tanggal = $request->tanggal;
        return view('user/hasilrouting')
            ->with('hasilrute', $hasilrute)
            ->with('hasilrutelatlong', $hasilrutelatlong)
            ->with('markerlat', $markerlat)
            ->with('markerlng', $markerlng)
            ->with('tanggal', $tanggal);
    }

    //mencari titik yang belum masuk ke route
    private function nested($nodes, $hasil)
    {
        if (count($hasil) == count($nodes) - 1) {
            $this->rutes = $hasil;
            $this->rutes[] = [$hasil[count($hasil)-1][1],$hasil[0][0]];
        } else {
            $min = 0;
            $n = 0;
            $indexAnu = 0;
            foreach ($hasil as $key => $h) {
                foreach ($nodes as $k => $node) {
                    if(!$this->adaGak($hasil,$node)){
                        $j1 = Jarak::jarak($h[0],$h[1])->first()->Jarak;
                        $j2 = Jarak::jarak($h[0],$node)->first()->Jarak;
                        $j3 = Jarak::jarak($h[1],$node)->first()->Jarak;
                        $total = $j2 + $j3 - $j1;
                        if($min == 0 || $total < $min){
                            $min = $total;
                            $indexAnu = $key;
                            $n = $node;
                        }
                    }

                }
            }
            $hasil = $this->sisipkan($hasil,$indexAnu,$n);
            $this->nested($nodes, $hasil);
        }
    }

    //hasil dari nested di sisipkan
    private function sisipkan($hasil,$index,$node)
    {
        $anu = [];
        for($i = 0;$i<$index;$i++)
            $anu[] = $hasil[$i];
        $anu[] = [$hasil[$index][0],$node];
        $anu[] = [$node,$hasil[$index][1]];

        for($n = $index + 1;$n < count($hasil);$n++)
            $anu[] = $hasil[$n];
        return $anu;
    }

    //mengecek titik tersebut udah dihitung apa belum
    private function adaGak($aa, $a)
    {
        foreach ($aa as $s) {
            if(!(array_search($a,$s) === false)){
                return true;
            }
        }
        return false;
    }


    public function createDistribusi(Request $request)
    {
//        return $request->all();
        $input = new Pendistribusian();
        $input->IdUser = $request->idlevel;
        $input->TanggalPengiriman = $request->tanggal;
        $input->Rute = strip_tags($request->puskesmas);
        $input->TotalJarak = $request->jarak;
        $input->save();
        if ($input){
            return redirect('/pendistribusianuser');
        }else{
            return "gagal";
        }
    }
}