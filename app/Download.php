<?php


namespace App;

use Illuminate\Http\Request;

class Download
{
    use TemplateBuilder;
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array|null
     */
    public function downloadCV(): ?array
    {
        $htmlTemplate = $this->buildTemplate();
        $fileName = $this->generateRandomFileName();

        file_put_contents('cv/' . $fileName, $htmlTemplate);
        $this->fileForceDownload('cv/' . $fileName);

        return[
            'cv_step' => 3,
        ];
    }

    /**
     * @return string
     */
    private function generateRandomFileName(): string
    {
        return substr(md5(rand()), 0, 10) . '.html';
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
}
