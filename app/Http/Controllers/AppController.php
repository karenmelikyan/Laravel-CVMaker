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
    */
    public function index(Request $request)
    {
//        $message = null;
//        $dataArr = [];
//
//        if($request->isMethod('post')){
//            switch($request->action){
//                case 'registration': $message = (new Users($request))->registration();
//                break;
//                case 'login':        $message = (new Users($request))->login();
//                break;
//                case 'logout':       $message = (new Users($request))->logout();
//                break;
//                case 'upload':       $dataArr = (new Upload($request))->uploadPhoto();
//                break;
//                case 'personals':    $dataArr = (new Personals($request))->saveData();
//                break;
//                case 'generics':     $dataArr = (new Generics($request))->saveData();
//                break;
//                case 'download':     $dataArr = (new Download($request))->downloadCV();
//                break;
//            }
//        }
//
//        /**
//         * View's logic
//         */
//        if($username = $request->session()->get('username')) {
//            if(!$dataArr){
//                return view('cvbuilding', [
//                    'username'=> $username,
//                    'cv_step' => 0,
//                ]);
//            }
//
//            return view('cvbuilding', ['username' => $username], $dataArr);
//        }
//
//        return view('reglog', [
//            'message' => $message,
//        ]);

        return view('content');
    }

    public function registration(Request $request)
    {
        $message = (new Users($request))->registration();
    }
    public function login(Request $request)
    {
        $message = (new Users($request))->login();
    }
    public function logout(Request $request)
    {
        $message = (new Users($request))->logout();
    }
    public function upload(Request $request)
    {
        $dataArr = (new Upload($request))->uploadPhoto();
    }
    public function personals(Request $request)
    {
        $dataArr = (new Personals($request))->saveData();
    }
    public function generics(Request $request)
    {
        $dataArr = (new Generics($request))->saveData();
    }
    public function download(Request $request)
    {
        $dataArr = (new Download($request))->downloadCV();
    }

}
