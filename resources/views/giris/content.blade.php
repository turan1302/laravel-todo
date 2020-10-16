@extends('welcome')
@section('content')



    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <?php if (session('warning')) {  ?>
                <small style="color: red;">Bilgilere Ait Kullanıcı Bulunamadı</small>
                <?php } ?>

                <h3>Giriş Yap</h3>
                <form method="post" action="{{route('kullanici.giris')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Adresiniz</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="E-Mail Adresinizi Giriniz">
                        @error('email')
                        <small style="color: red;">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Şifreniz</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                               placeholder="Şifrenizi Giriniz">
                        @error('password')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Giriş Yap!</button>
                </form>
            </div>

            <div class="col-md-6">
                <?php if (session('alert')) {  ?>
                <small style="color: red;">Kayıt İşleminiz Başarılı :) Bislgilerinizle Giriş Yapabilirsiniz</small>
                <?php } ?>
                <h3>Kayıt Ol</h3>
                <form method="POST" action="{{route('kullanici.kayit')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Adresiniz</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{old('email')}}" aria-describedby="emailHelp"
                               placeholder="E-Mail Adresinizi Giriniz">
                        @error('email')
                            <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Şifreniz</label>
                        <input type="password" class="form-control" name="password" value="{{old('password')}}" id="exampleInputPassword1"
                               placeholder="Şifrenizi Giriniz">
                        @error('password')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info">Kayıt Ol</button>
                </form>
            </div>
        </div>
    </div>
@endsection
