<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(){
        return View("welcome");
    }
    public function data(){
        if (session()->get('posyandu_id') != '' || session()->get('roles') == 'admin') {
            return View("data");
        } else {
            return View("posyandu");
        };

    }

    public function update_posyandu(Request $req)
    {
        $req->validate([
            'posyandu' => 'required',
        ]);

        $payload[] = [
            "name" =>   "posyandu",
            "contents" => $req->posyandu,
        ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."user/update/".session()->get('id_user'), [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        if (json_decode($response, true)['msg'] === 'Success Update') {
            return redirect('/')->with("success","Update Lokasi Posyandu");
        } else {
            return redirect()->back()->with("error","Update Lokasi Posyandu");
        }
    }
}
