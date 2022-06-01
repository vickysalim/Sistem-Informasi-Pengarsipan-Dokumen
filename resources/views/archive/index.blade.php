@extends('layout.master')

@section('title', "Beranda")

@section('content')
    <a class="btn btn-primary" href="{{ url('archive/create') }}">Tambah Arsip Baru</a>

    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif
    <table class="table mt-2">
        <thead>
            <tr>
                <th width="60%">Nama Arsip</th>
                <th width="25%">Kategori</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archives as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->archiveCategory->name }}</td>
                    <td>
                        <div class="row">
                            <a class="btn btn-primary m-1" href="{{ url('archive/'.$item->id) }}">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a class="btn btn-info m-1" href="{{ url('archive/download',$item->id)}}" download>
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                        <div class="row">
                            <a class="btn btn-warning m-1" href="{{ url('archive/'.$item->id.'/edit') }}">
                                <i class="fas fa-edit"></i> Ubah
                            </a>
                            <a class="btn btn-danger m-1" href="{{ url('archive/'.$item->id.'/delete') }}" onclick="return confirm('Apakah anda yakin untuk menghapus arsip ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection