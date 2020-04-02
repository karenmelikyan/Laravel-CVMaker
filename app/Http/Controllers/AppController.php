<?php


namespace App\Http\Controllers;

use App\Http\Requests\GenericDataRequestValidator;
use App\Http\Requests\LoginRequestValidator;
use App\Http\Requests\PersonalDataRequestValidator;
use App\Http\Requests\RegistRequestValidator;
use Illuminate\Http\Request;
use App\Users;
use App\Personals;
use App\Generics;
use App\Download;

class AppController
{
    public function index(Request $request)
    {
        return view('content');
    }

    public function registration(RegistRequestValidator $request)
    {
        return (new Users($request))->registration();
    }

    public function login(LoginRequestValidator $request)
    {
        return (new Users($request))->login();
    }

    public function logout(Request $request)
    {
        return (new Users($request))->logout();
    }

    public function personals(PersonalDataRequestValidator $request)
    {
        return (new Personals($request))->saveData();
    }

    public function generics(GenericDataRequestValidator $request)
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
