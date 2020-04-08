<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Users
{
    use DataRepository;

    private Request $request;

    public function __construct(Request $request)
    {
        $this->tableName = 'users';
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function registration(): array
    {
        if($this->isUsernameExist($this->request->username)){
            return [
                'message' =>  '`' . $this->request->username . '` username already exists',
                'cv_step' => -1,
                'user'    => 0,
                'username'=> '',
            ];

        }else if($this->request->password !== $this->request->passConf){
            return [
                'message' => 'Password not confirmed',
                'cv_step' => -1,
                'user'    => 0,
                'username'=> '',
            ];
        }

        $this->addOne([
            'username' => $this->request->username,
            'email' => $this->request->email,
            'passwordHash' => Hash::make($this->request->password),
        ]);

        $this->request->session()->put('user_id', $this->getUserId());
        $this->request->session()->put('email', $this->getUserEmail());
        $this->request->session()->put('username', $this->request->username);

        return [
            'message' => '',
            'cv_step' => 0,
            'user'    => -2,
            'username'=> $this->request->username,
        ];
    }

    /**
     * @return string|null
     */
    public function login(): array
    {
        if(!$this->isUsernameExist($this->request->username)) {
            return [
                'message' => 'Something went wrong',
                'cv_step' => -1,
                'user'    => 1,
                'username'=> '',
            ];

        }else if(!$this->isPasswordMatch($this->request->username, $this->request->password)){
            return [
                'message' => 'Something went wrong',
                'cv_step' => -1,
                'user'    => 1,
                'username'=> '',
            ];
        }

        $this->request->session()->put('user_id', $this->getUserId());
        $this->request->session()->put('email', $this->getUserEmail());
        $this->request->session()->put('username', $this->request->username);

        return [
            'message' => '',
            'cv_step' => 0,
            'user'    => -2,
            'username'=> $this->request->username,
        ];
    }

    /**
     * @return string|null
     */
    public function logout(): array
    {
        $this->request->session()->put('user_id',  false);
        $this->request->session()->put('username', false);
        $this->request->session()->put('pic_path', false);
        $this->request->session()->put('email',    false);

        return [
            'message' => '',
            'cv_step' => -1,
            'user'    => -1,
            'username'=> '',
        ];
    }

    /**
     * @return string
     */
    private function getUserEmail(): ?string
    {
        if($arr = $this->getByFieldValue('username', $this->request->username)){
            return $arr[0]->email;
        }

        return null;
    }

    /**
     * @return int
     */
    private function getUserId(): ?int
    {
        if($arr = $this->getByFieldValue('username', $this->request->username)){
            return $arr[0]->id;
        }

        return null;
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    private function isPasswordMatch(string $username, string $password): bool
    {
        if($arr = $this->getByFieldValue('username', $this->request->username)){
            if(Hash::check($password, $arr[0]->passwordHash)){
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $username
     * @return bool
     */
    private function isUsernameExist(string $username): bool
    {
        if(count($this->getByFieldValue('username', $username)->all()) > 0) {
            return true;
        }

        return false;
    }

}
