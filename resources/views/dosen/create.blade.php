@extends('layout')
@section('title','Input Produk')
@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    {{ Form::open(['url'=>'dosen'])}}
    <table class="table table-bordered">
       
        <tr><td>Nama Dosen</td><td>{{ Form::text('name',null,['placeholder'=>'masukan nama dosen ','class'=>'form-control'])}}</td></tr>
        <tr><td>NIDN</td><td>{{ Form::number('nidn',null,['placeholder'=>'masukkan NIDN','class'=>'form-control'])}}</td></tr>
        <tr><td>Jenis Kelamin </td><td>{{ Form::select('jenis_kelamin',['Laki-Laki'=>'Laki-Laki','Perempuan'=>'Perempuan'],null,['class'=>'form-control'])}}</td></tr>
        <tr><td>Status </td><td>{{ Form::select('status',['akif'=>'aktif','tidak aktif'=>'tidak aktif'],null,['class'=>'form-control'])}}</td></tr>
        @if(empty(Auth::user()->prodi))
        <tr><td><label for="prodi">Prodi</label></td><td><select name="prodi" id="prodi">
                <option selected>Pilih Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
            </select></td></tr> 
        @endif
        <tr><td></td><td>    {{ Form::submit('Simpan Data',['class'=>'btn btn-success'])}}
                {{ Link_to('dosen','Kembali',['class'=>'btn btn-danger'])}}
                {{ Form::close()}}</td></tr>
    </table> 
@endsection