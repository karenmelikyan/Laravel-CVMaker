<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Upload;
use App\Personals;
use App\Generics;
use App\Download;

class AppController
{
    public function index(Request $request)
    {
        return view('cvbuilding');
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

//    public function upload(Request $request)
//    {
//        return (new Upload($request))->uploadPhoto();
//    }

    public function download(Request $request)
    {
         (new Upload($request))->uploadPhoto();
         (new Download($request))->downloadCV();
    }

}
