@extends('layout.master')

@section('title', "Buat Arsip")

@section('content')

<form action="{{ route('archive.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="a">a</label>
        <select name="a" class="form-control select2" id="pilihkategori" onChange="getCategory()">
            <option disabled selected>Pilih</option>
            @foreach ($archiveCategories as $item)
                <option value="{{ $item->id }}"> {{ $item->name }} </option>
            @endforeach
        </select>
        @error('a')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="a">a</label>
        <select name="a" class="form-control select2">
            <option disabled selected>Pilih</option>
            @foreach ($archiveCategoryForms as $item)
                <option value="{{ $item->id }}" data-category="{{ $item->category_id }}"> {{ $item->name }} </option>
            @endforeach
        </select>
        @error('a')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
    @foreach ($archiveCategoryForms as $item)
            <td>{{ $item->name }}</td>
    @endforeach

    <script>

        function getCategory() {
            var e = document.getElementById("pilihkategori");
            var strUser = e.value;

            console.log(strUser);
        }
        
    </script>

@endsection