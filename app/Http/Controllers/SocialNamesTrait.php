<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

trait SocialNamesTrait {
    protected $name = "Anonymous";
    protected $email = "@anonymous.com";

    protected function HashForAll(){
        $date   = new \DateTime(); //this returns the current date time
        $result = $date->format('Y-m-d-H-i-s');
        return Hash::make(strval(rand(0,10000000)) . $result);
    }
    public function getName($name) {
        if (($name !== null ) && !empty(trim($name))) return $name;
        return $this->name . $this->HashForAll();
    }

    public function getEmail($email) {
        if (($email !== null ) && !empty(trim($email))) return $email;
        return $this->HashForAll() . $this->email;
    }



}
