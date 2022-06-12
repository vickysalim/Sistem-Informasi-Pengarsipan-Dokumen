@extends('layout.master')

@section('title', "Buat Arsip")

@section('content')

<form action="{{ route('archive.store', ) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="c_id" value="{{$archiveCategory->id}}">

    <div class="form-group">
        <label>Nama Arsip</label>
        <input type="text" name="nama" class="form-control">
        @error('arsip')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label id="labelfile">File Arsip</label>
        <input type="file" name="arsip" class="form-control" id="inputfile">
        @error('arsip')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    @foreach ($archiveCategoryForms as $item)
        <div class="form-group">
            <label id="label{{ $item->id }}">{{ $item->name }}</label>
            <input type="text" class="form-control" id="deskripsi{{ $item->id }}" data-category="{{ $item->category_id }}" name="inputDescription{{$item->category_id}}[]" placeholder="Enter {{ $item->name }}">
            @if ($item->description != "")
            <label class="text-muted small">{{$item->description}}</label>
            @endif
        </div>
    @endforeach

    <input type="hidden" data-total="{{ $item->count() }}" id="totalField">

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>
</form>

@endsection