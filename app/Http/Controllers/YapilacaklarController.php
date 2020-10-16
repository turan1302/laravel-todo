<?php

namespace App\Http\Controllers;

use App\Helpers\MyHelper;
use App\Models\LoglarModel;
use App\Models\YapilacaklarModel;
use Illuminate\Http\Request;

class YapilacaklarController extends Controller
{
    public function index(){


        $yapilacaklar = YapilacaklarModel::where(array(
            "user_id"=>session()->get('user')->id
        ))->get();

        $loglar = LoglarModel::all();

        $viewData = [
            "yapilacaklar"=>$yapilacaklar,
            "loglar"=>$loglar
        ];

       return view("yapilacaklar.content",$viewData);
    }

    public function delete(int $id){
        $yapilacak = YapilacaklarModel::find($id);
        $yapilacak->delete();

       MyHelper::log_ekle(session()->get('user')->email,"{$yapilacak->name} Görevini Sildi");


        return redirect()->back();
    }

    public function insert(Request $request){
        $validate = $request->validate([
            "name"=>"required",
            "son_tarih"=>"required"
        ]);

       $yapilacak = new YapilacaklarModel();
       $yapilacak->name=$request->name;
       $yapilacak->user_id=session()->get('user')->id;
       $yapilacak->yapilma_durum=0;
       $yapilacak->son_tarih = $request->son_tarih;
       $yapilacak->save();

        MyHelper::log_ekle(session()->get('user')->email,"{$request->name} İsimli Yapılacak Ekledi");


        return redirect()->back();

    }

    public function do(int $id){
        $yapilacak = YapilacaklarModel::find($id);
       if ($yapilacak->yapilma_durum=="0"){
           $yapilacak->yapilma_durum = 1;
           $yapilacak->save();

           MyHelper::log_ekle(session()->get('user')->email,"{$id} Numaralı Görevi Gerçekleştirdi");


       }else{
           $yapilacak->yapilma_durum = 0;
           $yapilacak->save();
           MyHelper::log_ekle(session()->get('user')->email,"{$id} Numaralı Görevi Gerçekleştirmedi");

       }

       return redirect()->back();

    }

    public function update(Request $request,int $id){
        $validateData = $request->validate([
            "name_update"=>"required",
            "son_tarih_update"=>"required"
        ]);

        $yapilacak = YapilacaklarModel::find($id);
        $yapilacak->name = $request->name_update; // guncelleme işlemi için bu şekilde bir kullanım yaptım (name_update olarak geliyor bu kısım)
        $yapilacak->son_tarih=$request->son_tarih_update;
        $yapilacak->save();

        MyHelper::log_ekle(session()->get('user')->email,"{$id} Numaralı Görevi Güncelledi");


        return redirect()->back();

    }
}
