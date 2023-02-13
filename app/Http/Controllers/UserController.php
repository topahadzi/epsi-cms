<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\User;
class UserController extends Controller
{
    public function login(Request $req){
        
        $response = Http::post(config("app.api_url")."signin", [
            'email' => $req['email'],
            'password' => $req['password'],
        ])->json();

        if ($response['msg'] == 'success logon') {
            if (!$response['user']['verifikasi']) {
                return redirect()->back()->with("error","Akun Belum di Verifikasi, Hubungi Admin!");
            }
    
            if ($response['user']['roles'] == 'orangtua') {
                return redirect()->back()->with("error","Akun Orang Tua Tidak Diberi Akses Masuk");
            }
    
            $nik = array_key_exists('nik',$response['user']) ? $response['user']['nik'] : '';
            $posyandu_id = array_key_exists('posyandu', $response['user']) ? $response['user']['posyandu'] : '';

            $req->session()->put(['token_user' => $response['access_token']]);
            $req->session()->put(['name' => $response['user']['name']]);
            $req->session()->put(['roles' => $response['user']['roles']]);
            $req->session()->put(['nik' => $nik]);
            $req->session()->put(['posyandu_id' => $posyandu_id]);
            $req->session()->put(['verifikasi' => $response['user']['verifikasi']]);
            $req->session()->put(['id_user' => $response['user']['_id']]);
            return redirect('/');
        } else {
            return redirect()->back()->with("error","Gagal Login");
        }
    }

    public function register(Request $req){
        
        $response = Http::post(config("app.api_url")."signup", [
            'email' => $req['email'],
            'password' => $req['pass'],
            'name' => $req['name'],
            'roles' => 'kader',
        ])->json();        
        if ($response['msg'] === "User sudah Ada") {
            return redirect()->back()->with("error","User sudah terdaftar");
        }
        if ($response['msg'] === "Success Register") {
            return redirect('/login')->with('success', "Register Success");
        } else {
            return redirect()->back()->with("error","Gagal Login");
        }
    }
    
    public function logout(Request $req){
        $req->session()->flush();
        return redirect('/login');
    }

    public function index(){
        return View("user/user");
    }

    public function tambah(){
        return View("user/user_tambah");
    }

    public function create(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles' => 'required'
            // 'photo' => 'image|mimes:png,jpg,jpeg',
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
            'name' =>   "email",
            'contents' => $req->email,
        ];
        $payload[] = [
            'name' =>   "password",
            'contents' => $req->password,
        ];
        $payload[] = [
            'name' =>   "roles",
            'contents' => $req->roles,
        ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."signup", [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        $res = json_decode($response, true);
        if ($res['msg'] === "Success Register") {
            return redirect('/user')->with("success","Tambah User");
        } elseif ($res['msg'] === "User sudah Ada") {
            return redirect()->back()->with("error","Menambah User, Karena Sudah Ada");
        } else {
            return redirect()->back()->with("error","Menambah User");
        }
    }

    public function edit($id){
        return View("user/user_edit", ['id' => $id]);
    }

    public function update(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            'roles' => 'required'
            // 'photo' => 'image|mimes:png,jpg,jpeg',
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
            'name' =>   "email",
            'contents' => $req->email,
        ];
        if ($req->password != '') {
            $payload[] = [
                'name' =>   "password",
                'contents' => $req->password,
            ];
        }
        $payload[] = [
            'name' =>   "roles",
            'contents' => $req->roles,
        ];

        $client = new Client();
        $response = $client->post(config("app.api_url")."user/update/".$req->id, [
            'headers' => [
                'Authorization' => 'Bearer ' .session()->get('token_user'),
            ],
            'multipart' => $payload
        ])->getBody()->getContents();

        if (json_decode($response, true)['msg'] === 'Success Update') {
            return redirect('/user')->with("success","Update User");
        } else {
            return redirect()->back()->with("error","Update User");
        }
    }

    public function delete(Request $req)
    {
        dd($req);
    }
    
    public function detail($id){
        return View("user/user_detail", [ 'id' => $id]);
    }
}
