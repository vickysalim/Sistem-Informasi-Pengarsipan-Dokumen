@extends('layout.master')

@section('title', 'Pengguna')

@section('content')
    <div>
        <a class="btn btn-primary mb-2" href="{{ url('user/create') }}">Tambah Pengguna Baru</a>
    </div>

    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th width="35%">Nama</th>
                <th width="25%">Email</th>
                <th width="15%">Tanggal Pembuatan Akun</th>
                <th width="10%">Super Admin</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    @php
                        $bool = ["<div class='text-danger'>&cross;</div>", "<div class='text-success'>&check;</div>"] 
                    @endphp
                    {!! $bool[$item->superadmin] !!}
                </td>
                <td>
                    <a href="{{ url('user/'.$item->id) }}" class="btn btn-primary"><i class="fas fa-cog"></i> Pengaturan</a>
                    {{-- <div class="my-2">
                        <a href="user.show" class="btn btn-primary"><i class="fas fa-user-secret"></i> Atur Hak Akses</a>
                    </div>
                    <div class="my-2">
                        <a href="user.reset" class="btn btn-warning"><i class="fas fa-key"></i> Reset Password</a>
                    </div>
                    <div class="my-2">
                        <a href="user.destroy" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus Akun</a>
                    </div> --}}
                    
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection