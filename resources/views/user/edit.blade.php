@extends('layout.master')

@section('title', 'Edit Hak Akses')

@section('content')
<form action="{{ route('user.alter', ['id' => $userPrivilege->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <div class="form-group">
        <label>Kategori</label>
        <input type="text" class="form-control" value="{{ $userPrivilege->category->name }}" disabled>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="read" value="1" disabled checked>
            <label class="custom-control-label">Lihat arsip</label>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch2" name="create" value="1"
            @if ($userPrivilege->create == 1)
                checked
            @endif>
            <label class="custom-control-label" for="customSwitch2">Buat arsip</label>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch3" name="update" value="1"
            @if ($userPrivilege->update == 1)
                checked
            @endif>
            <label class="custom-control-label" for="customSwitch3">Ubah arsip</label>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch4" name="delete" value="1"
            @if ($userPrivilege->delete == 1)
                checked
            @endif>
            <label class="custom-control-label" for="customSwitch4">Hapus arsip</label>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch5" name="download" value="1"
            @if ($userPrivilege->download == 1)
                checked
            @endif>
            <label class="custom-control-label" for="customSwitch5">Unduh arsip</label>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>
</form>
@endsection