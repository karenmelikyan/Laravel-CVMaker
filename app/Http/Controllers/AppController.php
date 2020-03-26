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
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * All requests, come to single action of this controller.
     * Check incoming request & if it's post request from some form, then
     * check from which of form it came, because in each form, exist
     * hidden filed that send some info about  themselves, then
     * the app logic delegates to the appropriate class.
     */
    public function index(Request $request)
    {
        $message = null;
        $dataArr = [];

        if($request->isMethod('post')){
            switch($request->action){
                case 'registration': $message = (new Users($request))->registration();
                break;
                case 'login':        $message = (new Users($request))->login();
                break;
                case 'logout':       $message = (new Users($request))->logout();
                break;
                case 'upload':       $dataArr = (new Upload($request))->uploadPhoto();
                break;
                case 'personals':    $dataArr = (new Personals($request))->saveData();
                break;
                case 'generics':     $dataArr = (new Generics($request))->saveData();
                break;
                case 'download':     $dataArr = (new Download($request))->downloadCV();
                break;
            }
        }

        /**
         * View's logic
         */
        if($username = $request->session()->get('username')) {
            if(!$dataArr){
                return view('cvbuilding', [
                    'username'=> $username,
                    'cv_step' => 0,
                ]);
            }

            return view('cvbuilding', ['username' => $username], $dataArr);
        }

        return view('reglog', [
            'message' => $message,
        ]);
    }
}
