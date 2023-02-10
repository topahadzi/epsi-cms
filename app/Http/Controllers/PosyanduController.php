<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;

class PosyanduController extends Controller
{
    public function index(){
        return View("posyandu/posyandu");
    }

    public function tambah(){
        return View("posyandu/posyandu_tambah");
    }

    public function create(Request $req){

        $req->validate([
            'name' => 'required',
            // 'photo' => 'image|mimes:png,jpg,jpeg',
            'alamat' => 'required'
        ]);

        // if ($req->photo) {
        //     $file_path = $req->photo->getRealPath();
        //     $file_name = $req->photo->getClientOriginalName();
        //     $payload[] = [  
        //         'name' =>   'photo',
        //         'filename' => $file_name,
        //         'contents' => Psr7\Utils::tryFopen($file_path, 'r'),
        //     ];
        // }
     
        $payload[] = [
            "name" =>   "name",
            "contents" => $req->name,
        ];
        $payload[] = [
            'name' =>   "alamat",
            'contents' => $req->alamat,
        ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."posyandu/create", [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        $res = json_decode($response, true);

        if ($res['msg'] === 'Success Posyandu') {
            return redirect('/posyandu')->with("success","Tambah Posyandu");
        } elseif ($res['msg'] === 'Posyandu Sudah Ada') {
            return redirect()->back()->with("error","Menambah Posyandu, Karena Sudah Ada");
        } else {
            return redirect()->back()->with("error","Menambah Posyandu");
        }
    }

    public function edit($id){
        return View("posyandu/posyandu_edit", ['id' => $id]);
    }

    public function update(Request $req){
        $req->validate([
            'name' => 'required',
            // 'photo' => 'image|mimes:png,jpg,jpeg',
            'alamat' => 'required'
        ]);

        // if ($req->photo) {
        //     $file_path = $req->photo->getRealPath();
        //     $file_name = $req->photo->getClientOriginalName();
        //     $payload[] = [
        //         'name' =>   'photo',
        //         'filename' => $file_name,
        //         'contents' => Psr7\Utils::tryFopen($file_path, 'r'),
        //     ];
        // }

        $payload[] = [
            "name" =>   "name",
            "contents" => $req->name,
        ];
        $payload[] = [
            'name' =>   'alamat',
            'contents' => $req->alamat,
        ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."posyandu/update/".$req->id, [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        if (json_decode($response, true)['msg'] === 'Success Update') {
            return redirect('/posyandu')->with("success","Update Posyandu");
        } else {
            return redirect()->back()->with("error","Update Posyandu");
        }
    }

    public function delete(Request $req)
    {
        dd($req);
    }
    
    public function detail($id){
        return View("posyandu/posyandu_detail", [ 'id' => $id]);
    }
}
