@extends('layout.master')

@section('title', "Edit Arsip")

@section('content')

<form action="{{ route('archive.update', ['archive' => $archive->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <div class="form-group">
        <label>Nama Arsip</label>
        <input type="text" class="form-control" name="name" placeholder="Enter nama arsip"
            value="{{ old('name') ?? $archive->name }}">

        @error('nama')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>File</label>
        <input type="file" class="form-control" name="file_name">

        @error('arsip')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="fakultas_id">Kategori Arsip</label>
        <input class="form-control" disabled value="@foreach ($archiveCategory as $item)@if ($item->id == $archive->category_id){{ $item->name }}@endif @endforeach">
    </div>

    @foreach ($archiveCategoryForm as $item)
        @if ($item->category_id == $archive->category_id)
            <div class="form-group">
                <label>{{ $item->name }}</label>
                @foreach ($archiveDescription as $item2)
                    @if ($item2->archive_id == $archive->id && $item2->archive_form_id == $item->id)
                        <input type="hidden" name="description_id[]" value="{{ Crypt::encrypt($item2->id); }}">
                        <input type="text" class="form-control" name="description[]" placeholder="Enter {{$item->name}}" value="{{ $item2->description }}">
                    @endif
                @endforeach
            </div>
        @endif
    @endforeach
    
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>
</form>

@endsection