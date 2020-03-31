<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Upload;
use App\Personals;
use App\Generics;
use App\Download;
use App\Jobs\SendCVLinkJob;


class AppController extends Controller
{
    public function index(Request $request)
    {
        return view('content');
    }

    public function registration(Request $request)
    {
        return (new Users($request))->registration();
    }

    public function login(Request $request)
    {
        return (new Users($request))->login();
    }

    public function logout(Request $request)
    {
        return (new Users($request))->logout();
    }

    public function personals(Request $request)
    {
        return (new Personals($request))->saveData();
    }

    public function generics(Request $request)
    {
        return (new Generics($request))->saveData();
    }

    public function download(Request $request)
    {
        (new Download($request))->downloadCV();
    }

    public function reset(Request $request)
    {
        return[
            'user' => -2,
            'message' => '',
            'cv_step' => 0,
            'username' => $request->session()->get('username'),
        ];
    }

}
