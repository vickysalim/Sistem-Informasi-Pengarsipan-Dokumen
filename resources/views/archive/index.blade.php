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
                <th width="55%">Nama Arsip</th>
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
                        <a class="btn btn-primary" href="{{ url('download',$item->file_name)}}" download>Unduh</a>
                        <a class="btn btn-warning" href="{{ url('archive/'.$item->id) }}">Ubah</a>
                        <a class="btn btn-danger" href="{{ url('archive/'.$item->id) }}">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection