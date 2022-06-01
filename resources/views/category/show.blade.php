@extends('layout.master')

@section('title', "Arsip")

@section('content')

    <h4 class="m-1">{{$archiveCategory->name}}</h4>

    <a class="btn btn-link" href="{{ url('') }}">Kembali</a>

    <div>
        <a class="btn btn-primary" href="{{ url('archive/create') }}">Tambah Arsip Baru</a>
    </div>

    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif

    <table class="table mt-2">
        <thead>
            <tr>
                <th>Nama Arsip</th>
                @foreach ($archiveCategoryForm as $item)
                    @if ($item->category_id == $archiveCategory->id)
                        <th>{{ $item->name }}</th>
                    @endif
                @endforeach
                <th width="15%">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archive as $item)
                    @if ($item->category_id == $archiveCategory->id)
                        <tr>
                            <td>{{ $item->name }}</td>
                            @foreach ($archiveDescription as $item2)
                                @if ($item2->archive_id == $item->id)
                                    <td>{{ $item2->description }}</td>
                                @endif
                            @endforeach
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
                    @endif
                @endforeach
        </tbody>
    </table>

@endsection