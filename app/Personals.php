<?php


namespace App;

use Illuminate\Http\Request;

class Personals
{
    use DataRepository;

    private Request $request;

    /**
     * Personals constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->tableName = 'personals';
        $this->request = $request;
    }

    /**
     * @return array|null
     */
    public function saveData(): array
    {
        if($this->save()){
            return  $this->generateOk();
        }

        return $this->generateWarning('Something went wrong! Try again');
    }

    /**
     * @return array
     */
    private function generateOk(): array
    {
        return [
            'message' => '',
            'cv_step' => 1,
            'user'    => -2,
            'username'=> $this->request->session()->get('username'),
        ];
    }

    /**
     * @param string $warningMessage
     * @return array
     */
    private function generateWarning(string $warningMessage): array
    {
        return [
            'message' => $warningMessage,
            'cv_step' => 0,
            'user'    => -2,
            'username'=> $this->request->session()->get('username'),
        ];
    }

    /**
     * @return bool
     */
    private function save(): bool
    {
        return $this->addOne([
            'user_id'   => $this->request->session()->get('user_id'),
            'name'      => $this->request->name,
            'last_name' => $this->request->last_name,
            'address'   => $this->request->address,
            'phone'     => $this->request->phone,
            'email'     => $this->request->email,
            ]);
    }

}
