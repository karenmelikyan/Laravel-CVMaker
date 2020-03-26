<?php


namespace App;

use Illuminate\Http\Request;

class Personals
{
    use DataRepository;
    use RequestValidator;

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
    public function saveData(): ?array
    {
        if($this->checkFilling()){
            if($this->save()){
                return  $this->generateOk();
            }else{
                return $this->generateWarning('Something went wrong! Try again');
            }
        }else{
             return $this->generateWarning('All fields must be filled');
        }
    }

    /**
     * @return array
     */
    private function generateOk(): array
    {
        return[
            'cv_step' => 2,
        ];
    }

    /**
     * @param string $warningMessage
     * @return array
     */
    private function generateWarning(string $warningMessage): array
    {
        return[
            'cv_step' => 1,
            'message' => $warningMessage,
        ];
    }

    /**
     * @return bool
     */
    private function save(): bool
    {
        return $this->addOne([
            'user_id'   => $this->request->session()->get('user_id'),
            'pic_path'  => $this->request->session()->get('pic_path'),
            'name'      => $this->request->name,
            'last_name' => $this->request->last_name,
            'address'   => $this->request->address,
            'phone'     => $this->request->phone,
            'email'     => $this->request->email,
            ]);
    }

    /**
     * @return bool
     */
    private function checkFilling(): bool
    {
        return !$this->isFormEmpty([
            'name',
            'last_name',
            'address',
            'phone',
            'email'
        ]);
    }
}
