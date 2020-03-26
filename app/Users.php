<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Users
{
    use DataRepository;
    use RequestValidator;

    private Request $request;

    public function __construct(Request $request)
    {
        $this->tableName = 'users';
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function registration(): ?string
    {
        if($this->isFormEmpty(['username', 'password', 'passConf'])){
            return 'All fields must be filled';
        }else if($this->isUsernameExist($this->request->username)){
            return '`' . $this->request->username . '` username already exists';
        }else if($this->request->password !== $this->request->passConf){
            return 'The password do not confirmed';
        }

        $this->addOne([
            'username' => $this->request->username,
            'passwordHash' => Hash::make($this->request->password),
        ]);

        $this->request->session()->put('user_id', $this->getUserId());
        $this->request->session()->put('username', $this->request->username);

        return null;
    }

    /**
     * @return string|null
     */
    public function login(): ?string
    {
        if($this->isFormEmpty(['username', 'password'])){
            return 'All fields must be filled';
        }else if(!$this->isUsernameExist($this->request->username)) {
            return 'Something went wrong';
        }else if(!$this->isPasswordMatch($this->request->username, $this->request->password)){
            return 'Something went wrong';
        }

        $this->request->session()->put('user_id', $this->getUserId());
        $this->request->session()->put('username', $this->request->username);

        return null;
    }

    /**
     * @return string|null
     */
    public function logout(): ?string
    {
        $this->request->session()->put('user_id', false);
        $this->request->session()->put('pic_path', false);
        $this->request->session()->put('username', false);

        return null;
    }

    /**
     * @return int
     */
    private function getUserId(): ?int
    {
        $arr = $this->getByFieldValue('username', $this->request->username)->all();
        foreach ($arr as $elem){
            if($elem->id){
               return $elem->id;
            }
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
        $arr = $this->getByFieldValue('username', $this->request->username)->all();
        foreach($arr as $elem) {
            if(Hash::check($password, $elem->passwordHash)){
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
