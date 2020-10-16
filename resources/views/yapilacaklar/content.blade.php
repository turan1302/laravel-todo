@extends('welcome')
@section('content')

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                Hoşgeldiniz:  <b>{{session()->get('user')->email}}</b>
                <a href="{{route('kullanici.cikis')}}">Çıkış Yap</a>
            </div>

        </div>
    </nav>

    <br><br><br><br>
   <div class="container">
       <form action="{{route('yapilacaklar.ekle')}}" method="post">
           @csrf
           <input type="text" class="form-control" name="name" value="{{old('name')}}">
           @error('name')
            <small style="color: red;">{{$message}}</small>
           @enderror
           <br>

           <input type="date" class="form-control" name="son_tarih" value="{{old('son_tarih')}}">
           @error('son_tarih')
           <small style="color: red;">{{$message}}</small>
           @enderror

           <br>

           <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Ekle</button>
       </form>
       <div class="row">
       </div>
       <table>
           <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Son Tarih</th>
               <th>İşlemler</th>
           </tr>

          @foreach($yapilacaklar as $yapilacak)
           <tr style="background-color: @if(date("Y-m-d")>$yapilacak->son_tarih)  bisque @else lightblue @endif">
               <td>{{$yapilacak->id}}</td>
               <td>{{$yapilacak->name}}</td>
               <td>{{$yapilacak->son_tarih}}</td>
               <td>
                   <a href="{{route('yapilacaklar.sil',$yapilacak->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</a>
                   @if($yapilacak->yapilma_durum==0)
                       <a href="{{route('yapilacaklar.yap',$yapilacak->id)}}" class="btn btn-warning btn-sm">Yapılmamış</a>
                   @else
                       <a href="{{route('yapilacaklar.yap',$yapilacak->id)}}" class="btn btn-primary btn-sm">Yapılmış</a>
                   @endif

                   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal{{$yapilacak->id}}">
                       Güncelle
                   </button>

                   <!-- The Modal -->
                   <div class="modal" id="myModal{{$yapilacak->id}}">
                       <div class="modal-dialog">
                           <div class="modal-content">

                               <!-- Modal Header -->
                               <div class="modal-header">
                                   <h4 class="modal-title">{{$yapilacak->id}} Numaralı Yapılacağı Güncelle</h4>
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                               </div>

                               <!-- Modal body -->
                               <div class="modal-body">
                                   <form action="{{route('yapilacaklar.guncelle',$yapilacak->id)}}" method="POST">
                                       @csrf
                                       <label for="">Yapılacak Adı</label>
                                       <input type="text" class="form-control" name="name_update" value="@if(old('name_update')) {{old('name_update')}} @else {{$yapilacak->name}} @endif">
                                       @error('name_update')
                                        <small style="color: red;">{{$message}}</small>
                                       @enderror
                                       <br>

                                       <input type="date" class="form-control" name="son_tarih_update" value="@if(old('son_tarih_update')) {{old('son_tarih_update')}} @else {{$yapilacak->son_tarih}} @endif">
                                       @error('son_tarih_update')
                                       <small style="color: red;">{{$message}}</small>
                                       @enderror

                                       <br>

                                       <button type="submit" class="btn btn-success btn-sm">Güncelle</button>
                                   </form>
                               </div>

                               <!-- Modal footer -->
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
                               </div>

                           </div>
                       </div>
                   </div>
               </td>
           </tr>
           @endforeach
       </table>
   </div>

    <br><br><br><br>

    <div class="container">
        <h3 class="text-center">Log Kayıtları</h3>
        <table id="datatable">
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Açıklama
                </th>
            </tr>
            </thead>
            <tbody align="Center">
            @foreach($loglar as $log)
            <tr>
                <td>
                    {{$log->id}}
                </td>
                <td>
                    {{$log->name}}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
