<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class RapotController extends Controller
{
    public function index(){
        return View("rapot/rapot");
    }

    public function rapot_anak($id){
        return View("rapot/rapot_anak", ["id_orangtua" => $id]);
    }

    public function rapot_anak_form($id_anak){
        return View("rapot/rapot_tambah", [ "id_anak" => $id_anak]);
    }

    public function rapot_anak_list($id_anak){
        return View("rapot/rapot_anak_list", [ "id_anak" => $id_anak]);
    }

    public function rapot_anak_add($id_anak){
        return View("rapot/rapot_anak_tambah", [ "id_anak" => $id_anak]);
    }

    public function rapot_anak_edit($id_anak, $id_rapor){
        return View("rapot/rapot_anak_edit", [ "id_anak" => $id_anak, "id_rapor" => $id_rapor]);
    }

    public function rapot_anak_form_tambah(Request $req){

        $date = date("Y-m-d");
        $timeStart = strtotime($req->tgl_lahir);
        $timeEnd = strtotime("$date");
        // Menambah bulan ini + semua bulan pada tahun sebelumnya
        $numBulan = (date("Y",$timeEnd)-date("Y",$timeStart))*12;
        // menghitung selisih bulan
        $numBulan += date("m",$timeEnd)-date("m",$timeStart);

        dd($numBulan);

        $req->validate([
            'tinggi_badan' => 'required',
            'berat_badan' => 'required'
        ]);

        $payload[] = ["name" =>   "anak", "contents" => $req->anak];
        $payload[] = ["name" =>   "name", "contents" => $req->name];
        $payload[] = ["name" =>   "umur", "contents" => $numBulan];
        $payload[] = ["name" =>   "bulan", "contents" => $req->bulan];
        $payload[] = ["name" =>   "tinggi_badan", "contents" => $req->tinggi_badan];
        $payload[] = ["name" =>   "berat_badan", "contents" => $req->berat_badan];
        $payload[] = ["name" =>   "hepatitis_a", "contents" => $req->hepatitis_a == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "hepatitis_b", "contents" => $req->hepatitis_b == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "bcg", "contents" => $req->bcg == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "dengue", "contents" => $req->dengue == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "dtp", "contents" => $req->dtp == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "hib", "contents" => $req->hib == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "influenza", "contents" => $req->influenza == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "je", "contents" => $req->je == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "mr", "contents" => $req->mr == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "pcv", "contents" => $req->pcv == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "polio", "contents" => $req->polio == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "rotavirus", "contents" => $req->rotavirus == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "tifoid", "contents" => $req->tifoid == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "varisela", "contents" => $req->varisela == 'on' ? true : 'false' ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."rapor/create", [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        if (json_decode($response, true)['msg'] === 'Success Rapor') {
            return redirect("/rapot_anak_list/$req->anak")->with("success","Update Rapor");
        } else {
            return redirect()->back()->with("error","Update Rapor");
        }
    }

    public function rapot_anak_form_update(Request $req){

        $date = date("Y-m-d");
        $timeStart = strtotime($req->tgl_lahir);
        $timeEnd = strtotime("$date");
        // Menambah bulan ini + semua bulan pada tahun sebelumnya
        $numBulan = (date("Y",$timeEnd)-date("Y",$timeStart))*12;
        // menghitung selisih bulan
        $numBulan += date("m",$timeEnd)-date("m",$timeStart);

        $req->validate([
            'tinggi_badan' => 'required',
            'berat_badan' => 'required'
        ]);

        $payload[] = ["name" =>   "name", "contents" => $req->name];
        $payload[] = ["name" =>   "umur", "contents" => $numBulan];
        $payload[] = ["name" =>   "bulan", "contents" => $req->bulan];
        $payload[] = ["name" =>   "tinggi_badan", "contents" => $req->tinggi_badan];
        $payload[] = ["name" =>   "berat_badan", "contents" => $req->berat_badan];
        $payload[] = ["name" =>   "hepatitis_a", "contents" => $req->hepatitis_a == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "hepatitis_b", "contents" => $req->hepatitis_b == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "bcg", "contents" => $req->bcg == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "dengue", "contents" => $req->dengue == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "dtp", "contents" => $req->dtp == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "hib", "contents" => $req->hib == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "influenza", "contents" => $req->influenza == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "je", "contents" => $req->je == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "mr", "contents" => $req->mr == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "pcv", "contents" => $req->pcv == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "polio", "contents" => $req->polio == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "rotavirus", "contents" => $req->rotavirus == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "tifoid", "contents" => $req->tifoid == 'on' ? true : 'false' ];
        $payload[] = ["name" =>   "varisela", "contents" => $req->varisela == 'on' ? true : 'false' ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."rapor/update/".$req->id_rapor, [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        if (json_decode($response, true)['msg'] === 'Success Update') {
            return redirect("/rapot_anak_list/$req->anak")->with("success","Update Rapor");
        } else {
            return redirect()->back()->with("error","Update Rapor");
        }
    }
}
