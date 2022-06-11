@extends('layout.master')

@section('title', "Buat Arsip")

@section('content')

<form action="{{ route('archive.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Nama Arsip</label>
        <input type="text" name="nama" class="form-control">
        @error('arsip')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Kategori Arsip</label>
        <select name="kategori" class="form-control select2" id="pilihkategori" onChange="getCategory()">
            <option disabled selected>Pilih</option>
            @foreach ($archiveCategories as $item)
                @foreach ($userPrivileges as $item2)
                    @if ($item2->category_id == $item->id && $item2->user_id == Auth::user()->id && Auth::user()->superadmin == 0)
                        <option value="{{ $item->id }}"> {{ $item->name }} </option> 
                    @endif
                @endforeach
                @if (Auth::user()->superadmin == 1)
                    <option value="{{ $item->id }}"> {{ $item->name }} </option> 
                @endif
            @endforeach
        </select>
        @error('kategori')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label id="labelfile" style="display: none;">File Arsip</label>
        <input type="file" style="display:none" name="arsip" class="form-control" id="inputfile">
        @error('arsip')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    @foreach ($archiveCategoryForms as $item)
        @foreach ($userPrivileges as $item2)
                <div class="form-group">
                    <label id="label{{ $item->id }}" style="display: none;">{{ $item->name }}</label>
                    <input type="text" style="display:none" class="form-control" id="deskripsi{{ $item->id }}" data-category="{{ $item->category_id }}" name="inputDescription{{$item->category_id}}[]" placeholder="Enter {{ $item->name }}">
                </div>
        @endforeach
    @endforeach

    <input type="hidden" data-total="{{ $item->count() }}" id="totalField">

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>
</form>

    <script>

        function getCategory() {
            var category = document.getElementById("pilihkategori");
            var strCategory = category.value;

            var totalfield = document.getElementById("totalField");
            var totalfield_int = parseInt(totalfield.getAttribute("data-total"));

            document.getElementById("labelfile").style.display='inline';
            document.getElementById("inputfile").style.display='inline';

            for(let i = 1; i <= totalfield_int; i++) {
                var element = document.getElementById("deskripsi".concat(i));
                var text = element.getAttribute("data-category"); 

                var element2 = document.getElementById("label".concat(i));

                element.style.display='none';
                element2.style.display='none';

                element.value="";

                if(parseInt(strCategory) == text) {
                    element.style.display='inline';
                    element2.style.display='inline';
                }
            }

            

        }
        
    </script>

@endsection