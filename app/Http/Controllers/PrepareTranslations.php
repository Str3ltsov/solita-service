<?php


namespace App\Http\Controllers;
trait PrepareTranslations {


    public function prepare( $input, $fields ){
        foreach ( config('translatable.locales') as $locale ){
            $locFields = array();
            foreach ($fields as $field){
                if (isset($input[$field."_".$locale]) && !empty(trim($input[$field . "_" . $locale])) ) {
//                    $locFields[$field] = isset($input[$field . "_" . $locale]) && !empty(trim($input[$field . "_" . $locale])) ? $input[$field . "_" . $locale] : null;
                    $locFields[$field] = $input[$field . "_" . $locale];
                    unset($input[$field . "_" . $locale]);
                }
            }
            if (!empty($locFields)) $input[$locale] = $locFields;
        }
        return $input;
    }


}
