<?php


namespace App;

use Illuminate\Http\Request;

class Generics
{
    use DataRepository;
    use RequestValidator;

    private Request $request;

    /**
     * Generics constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->tableName = 'generics';
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
        return [
            'message' => '',
            'cv_step' => 2,
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
            'cv_step' => 1,
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
            'user_id'    => $this->request->session()->get('user_id'),
            'about'      => $this->request->about,
            'experience' => $this->request->experience,
            'skills'     => $this->request->skills
        ]);
    }

    /**
     * @return bool
     */
    private function checkFilling(): bool
    {
        return !$this->isFormEmpty([
            'about',
            'experience',
            'skills'
        ]);
    }
}
