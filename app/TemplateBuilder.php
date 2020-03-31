<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


trait TemplateBuilder
{
    private Request $request;

    private function buildTemplate(): ?string
    {
        $strTemp = '';
        $cvArray = $this->getLastCvData();

        $strTemp .= file_get_contents('template/1_head.php');
        $strTemp .= file_get_contents('template/2_in_front_picture.php');
        $strTemp .= $cvArray['pic_path'];
        $strTemp .= file_get_contents('template/3_in_front_name.php');
        $strTemp .= $cvArray['name'];
        $strTemp .= ' ';
        $strTemp .= $cvArray['last_name'];
        $strTemp .= file_get_contents('template/4_in_front_email.php');
        $strTemp .= $cvArray['email'];
        $strTemp .= file_get_contents('template/5_in_front_phone.php');
        $strTemp .= $cvArray['phone'];
        $strTemp .= file_get_contents('template/6_in_front_address.php');
        $strTemp .= $cvArray['address'];
        $strTemp .= file_get_contents('template/7_in_front_about.php');
        $strTemp .= $this->getDataWithListing($cvArray['about']);
        $strTemp .= file_get_contents('template/8_in_front_experience.php');
        $strTemp .= $this->getDataWithListing($cvArray['experience']);
        $strTemp .= file_get_contents('template/9_in_front_skills.php');
        $strTemp .= $this->getDataWithListing($cvArray['skills']);
        $strTemp .= file_get_contents('template/10_footer.php');

        return $strTemp;
    }


    /**
     * @param string $str
     * @return string|null
     */
    private function getDataWithListing(string $str): ?string
    {
        $startListing = '<div><span><span>';
        $endListing   = '</span></span></div>';

        $str = $startListing . $str;
        $str = str_replace( '|*|',  $endListing . $startListing, $str);
        return $str .= $endListing;
    }

    /**
     * @return array|null
     */
    private function getLastCvData(): ?array
    {
        /**get ID of current user from session*/
        $user_id = $this->request->session()->get('user_id');

        /**get current uploaded user picture path */
        $pic_path = $this->request->session()->get('pic_path');

        /**get data from 'personals` table by current user's ID*/
        $personalsArr = DB::table('personals')
            ->where(['user_id' => $user_id])->get();

        /**get last row from data*/
        $personalsArr = $personalsArr[count($personalsArr) - 1];

        /**get data from 'generics` table by current user's ID*/
        $genericsArr = DB::table('generics')
            ->where(['user_id' => $user_id])->get();

        /**get last row from data*/
        $genericsArr = $genericsArr[count($genericsArr) - 1];

        return [
            'pic_path'   => $pic_path,
            'name'       => $personalsArr->name,
            'last_name'  => $personalsArr->last_name,
            'address'    => $personalsArr->address,
            'phone'      => $personalsArr->phone,
            'email'      => $personalsArr->email,
            'about'      => $genericsArr->about,
            'experience' => $genericsArr->experience,
            'skills'     => $genericsArr->skills,
        ];
    }
}
