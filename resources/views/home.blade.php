@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah Baru</a>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:10%">No</th>
                                    <th style="width:10%">NIP</th>
                                    <th style="width:10%">Nama</th>
                                    <th style="width:10%">Jabatan</th>
                                    <th style="width:5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarKaryawan as $key => $karyawan)
                                <tr>
                                    <th scope="row">{{ $daftarKaryawan->firstItem() + $key }}</th>
                                    <td>{{ $karyawan['nip'] }}</td>
                                    <td>{{ $karyawan['nama'] }}</td>
                                    <td>{{ $karyawan['jabatan']['nama'] }}</td>
                                    <td>
                                        <form action="{{ route('karyawan.delete',$karyawan->id) }}" method="POST">
                                            <a class="btn btn-info" 
                                            href="{{ route('karyawan.edit',$karyawan->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            Delete</button>
                                        </form>
                                    </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                       </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                          <ul class="pagination mb-0">
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
