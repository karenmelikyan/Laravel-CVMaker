<?php


namespace App;

use Illuminate\Http\Request;
use App\Jobs\SendCVLinkJob;

class Download
{
    use TemplateBuilder, DataRepository;

    private string $hostName = 'http://cvmaker.local';
    private Request $request;

    public function __construct(Request $request)
    {
        $this->tableName = 'queue';
        $this->request = $request;
    }

    public function downloadCV(): void
    {
        /**upload photo to buffer*/
        if($picPath = $this->photoUpload()){
            /** set current picture path in session, for correct*/
            /** template building in trait TemplateBuilder*/
            $this->request->session()->put('pic_path', $this->hostName . '/' . $picPath);
        }
        /**create template HTML template for cv*/
        $htmlTemplate = $this->buildTemplate();

        /**generate random name for cv*/
        $fileName = $this->generateRandomFileName() . '.html';

        /**write cv to `cv` folder of project*/
        file_put_contents('cv/' . $fileName, $htmlTemplate);

        /**write eMail, & cv path in `queue` table for send*/
        /** to user mail in queue process*/
        $this->addOne([
            'email'   => $this->request->session()->get('email'),
            'cv_path' => $this->hostName . '/cv/' . $fileName,
        ]);

        /**turn on email queue process*/
        SendCVLinkJob::dispatch();

        /**download the cv via user's browser*/
        $this->fileForceDownload('cv/' . $fileName);

    }

    /**
     * @return string
     */
    private function generateRandomFileName(): string
    {
        return substr(md5(rand()), 0, 10);
    }

    /**
     * @param string $filePath
     */
    protected function fileForceDownload(string $filePath)
    {
        if (file_exists($filePath)) {
            /** reset the buffer of input*/
            if (ob_get_level()) {
                ob_end_clean();
            }
            /** to force browser to show window of download */
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filePath));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            /** read file and send it to user*/
            readfile($filePath);
            exit;
        }
    }

    /**
     * @return string|null
     */
    protected function photoUpload(): ?string
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
            $_FILES['file']['name'] = $this->generateRandomFileName() . '.jpg';
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
