@extends('layout.master')

@section('title', 'Buat Pengguna')

@section('content')

<form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
        @error('nama')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
        @error('password_confirmation')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="superadmin" value="1">
            <label class="custom-control-label" for="customSwitch1">Berikan hak akses super admin</label>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>
    </div>
</form>

@endsection