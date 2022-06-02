@extends('layout.master')

@section('title', "Kategori Arsip")

@section('content')
    <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>

    <table class="table">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th width="15%">Nama</th>
                <td>{{ $archiveCategory->name }}</td>
            </tr>
            @foreach ($archiveCategoryForm as $item)
                @if ($item->category_id == $archiveCategory->id)
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $item->name }}</td>
                    </div>
                @endif
            @endforeach
        </tbody>
    </table>

@endsection