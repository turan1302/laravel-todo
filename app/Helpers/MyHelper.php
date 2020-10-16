<?php

namespace App\Helpers;

class MyHelper{

    /** LOG KAYDI OLUŞTURMA **/
   static function log_ekle($email,$process){
        $log = new \App\Models\LoglarModel();
        $log->name = $email." ".$process;
        $log->save();
    }
}
