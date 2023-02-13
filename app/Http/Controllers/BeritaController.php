<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;

class BeritaController extends Controller
{
    public function index(){
        return View("berita/berita");
    }

    public function tambah(){
        return View("berita/berita_tambah");
    }

    public function create(Request $req){

        $req->validate([
            'title' => 'required',
            'photo' => 'image|mimes:png,jpg,jpeg',
            'description' => 'required'
        ]);

        if ($req->photo) {
            $file_path = $req->photo->getRealPath();
            $file_name = $req->photo->getClientOriginalName();
            $payload[] = [
                'name' =>   'photo',
                'filename' => $file_name,
                'contents' => Psr7\Utils::tryFopen($file_path, 'r'),
            ];
        }
     
        $payload[] = [
            "name" =>   "title",
            "contents" => $req->title,
        ];
        $payload[] = [
            'name' =>   'description',
            'contents' => $req->description,
        ];
        $payload[] = [
            'name' =>   'createdby',
            'contents' => strval(session()->get('id_user')),
        ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."berita/create", [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        if (json_decode($response, true)['msg'] === 'Success Create Berita') {
            return redirect('/berita')->with("success","Tambah Berita");
        } else {
            return redirect()->back()->with("error","Menambah Berita");
        }
    }

    public function edit($id){
        return View("berita/berita_edit", ['id' => $id]);
    }

    public function update(Request $req){
        $req->validate([
            'title' => 'required',
            'photo' => 'image|mimes:png,jpg,jpeg',
            'description' => 'required'
        ]);

        if ($req->photo) {
            $file_path = $req->photo->getRealPath();
            $file_name = $req->photo->getClientOriginalName();
            $payload[] = [
                'name' =>   'photo',
                'filename' => $file_name,
                'contents' => Psr7\Utils::tryFopen($file_path, 'r'),
            ];
        }

        $payload[] = [
            "name" =>   "title",
            "contents" => $req->title,
        ];
        $payload[] = [
            'name' =>   'description',
            'contents' => $req->description,
        ];
        $payload[] = [
            'name' =>   'createdby',
            'contents' => strval(session()->get('id_user')),
        ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."berita/update/".$req->id, [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        if (json_decode($response, true)['msg'] === 'Success Update') {
            return redirect('/berita')->with("success","Update Berita");
        } else {
            return redirect()->back()->with("error","Update Berita");
        }
    }

    public function delete(Request $req)
    {
        dd($req);
    }
    
    public function berita_detail($id){
        return View("berita/berita_detail", [ 'id' => $id]);
    }
}
