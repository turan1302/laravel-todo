<?php

namespace App\Http\Controllers;

use App\Models\KullanicilarModel;
use Illuminate\Http\Request;

class GirisController extends Controller
{
    public function index(){
        return view('giris.content');
    }

    public function giris(Request $request){
        $validate = $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);

        $kullanici = KullanicilarModel::where(array(
            "email"=>$request->email,
            "password"=>md5($request->password)
        ))->first();

        if ($kullanici){
           session()->put('user',$kullanici);
            return redirect()->route('yapilacaklar');
        }else{
            return redirect()->back()->with("warning","alert");
        }

    }

    public function kayit(Request $request){
        $validateDData = $request->validate([
            "email"=>"required|email|unique:kullanicilar_models",
            "password"=>"required|min:8|max:32"
        ]);

        $kullanici_ekle = new KullanicilarModel();
        $kullanici_ekle->email = $request->email;
        $kullanici_ekle->password = md5($request->password);
        $kullanici_ekle->save();

        return redirect()->back()->with("alert","register is succeded");


    }

    public function cikis(){
        session()->remove('user');
        return redirect()->route('giris-sayfasi');
    }
}
