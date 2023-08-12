@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
                </div>
                <div class="card-body">
                   <form action="{{ route('karyawan.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" name="nip" id="nip">
                        @if ($errors->has('nip'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('nip') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-2">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-control" name="jabatan_id" id="jabatan">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($daftarJabatan as $jabatan)
                                <option value="{{ $jabatan['id'] }}">
                                    {{ $jabatan['nama'] }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('jabatan_id'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('jabatan_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-2">
                        <button class="btn btn-primary" 
                        type="submit">Simpan karyawan</button>
                    </div>
                   </form>
                </div>
                <div class="card-footer text-right">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection