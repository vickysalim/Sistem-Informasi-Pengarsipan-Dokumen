@extends('layout.master')

@section('title', "Buat Kategori")

@section('content')

<form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="nama" class="form-control" required>
        @error('arsip')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <input type="text" name="deskripsi[]" class="form-control" required placeholder="Nama">
            </div>
            <input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan">
        </div>
    </div>

    <div id="newRow"></div>
    
    @error('deskripsi.*')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    @error('keterangan.*')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    
    <button id="addRow" type="button" class="btn btn-info">Tambah Deskripsi</button>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>
    </div>
</form>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div class="form-group" id="inputRow">';
        html += '<div class="input-group">';
        html += '<div class="input-group-prepend">';
        html += '<input type="text" name="deskripsi[]" class="form-control" required placeholder="Nama">';
        html += '</div>';
        html += '<input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputRow').remove();
    });
</script>

@endsection