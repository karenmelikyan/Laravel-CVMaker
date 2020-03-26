<?php

namespace App;

use Illuminate\Http\Request;

trait RequestValidator
{
    private Request $request;

    /**
     * @param array $fields
     * @param int $minLong
     * @param int $maxLong
     * @return bool
     */
    public function isFormFieldsLong(array $fields, int $minLong, int $maxLong): bool
    {
        foreach($fields as $field){
            if(strlen($this->request->$field) < $minLong ||
                strlen($this->request->$field) > $maxLong){
                    return true;
            }
        }

        return false;
    }

    /**
     * @param array $fields
     * @return bool
     */
    public function isFormEmpty(array $fields): bool
    {
        foreach($fields as $field){
            if($this->request->$field === null){
               return true;
            }
        }

        return false;
    }

    /**
     * @param string $str
     * @return bool
     */
    public function sqlInjectionsValidator(string $str): bool{
        // TODO
    }
}
