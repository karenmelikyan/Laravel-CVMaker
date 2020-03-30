<?php


namespace App;

use Illuminate\Http\Request;

class Upload
{
    private string $hostName = 'http://cvmaker.local';
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array|null
     */
    public function uploadPhoto()
    {
        if($picPath = $this->fileUpload()){
            $this->request->session()->put('pic_path', $this->hostName . '/' . $picPath);
            //return $this->generateOK();
            return redirect('/thanks');
        }

        return $this->generateWarning('Photo not uploaded ...');


    }

    /**
     * @return array
     */
    private function generateOK(): array
    {
        return[
            'message' => '',
            'cv_step' => 1,
            'user'    => -2,
            'username'=> $this->request->session()->get('username'),
        ];
    }

    /**
     * @param string $message
     * @return array
     */
    private function generateWarning(string $warningMessage): array
    {
        return[
            'message' => $warningMessage,
            'cv_step' => 0,
            'user'    => -2,
            'username'=> $this->request->session()->get('username'),
        ];
    }

    /**
     * @return string
     */
    private function generateRandomFileName(): string
    {
        return substr(md5(rand()), 0, 10) . '.jpg';
    }

    /**
     * @return string|null
     */
    protected function fileUpload(): ?string
    {
        /**Check if the file is well uploaded*/
        if($_FILES['file']['error'] > 0) {
            return null;
        }
        /**Set up valid image extensions*/
        $extsAllowed = ['jpg', 'jpeg'];
        $extUpload = strtolower( substr( strrchr($_FILES['file']['name'], '.') ,1) ) ;

        /**Check if the uploaded file extension is allowed*/
        if (in_array($extUpload, $extsAllowed) ) {
            $_FILES['file']['name'] = $this->generateRandomFileName();
            $picPath = "pic/{$_FILES['file']['name']}";
            /**Upload the file on the server*/
            if(move_uploaded_file($_FILES['file']['tmp_name'], $picPath)){
               return $picPath;
            }else{
                return null;
            }
        }

        return null;
    }

}
