@extends('layout.master')

@section('title', "Arsip")

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
                <th width="15%">Nama Arsip</th>
                <td>{{ $archive->name }}</td>
            </tr>
            <tr>
                <th>File</th>
                <td>
                    <a href="{{ url('archive/download',$archive->id)}}" download>{{ $archive->file_name }}</a>
                </td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>
                    @foreach ($archiveCategory as $item)
                        @if ($item->id == $archive->category_id)
                            {{ $item->name }}
                        @endif 
                    @endforeach
                </td>
            </tr>
            @foreach ($archiveCategoryForm as $item)
                @if ($item->category_id == $archive->category_id)
                    <tr>
                        <th>{{ $item->name }}</th>
                        @foreach ($archiveDescription as $item2)
                            @if ($item2->archive_id == $archive->id && $item2->archive_form_id == $item->id)
                                <td>{{ $item2->description }}</td>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </tbody>
    </table>

@endsection