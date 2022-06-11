@extends('layout.master')

@section('title', 'Edit Pengguna')

@section('content')
    <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>

    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif

    <div class="row">

        <div class="col-sm-5">
            <div class="card card-widget widget-user">
                <div class="widget-user-header bg-info">
                    <h3 class="mt-2 widget-user-desc">{{ $user->name }}</h3>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ asset('dist/img/user.png') }}" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ $user->email }}</h5>
                                <span class="description-text">EMAIl</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="description-block">
                                <h5 class="description-header">{{ $user->created_at }}</h5>
                                <span class="description-text">TANGGAL PEMBUATAN AKUN</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Ganti Password</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.reset', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

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

                        <div class="mt-4">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-key"></i> Ganti Password</button>
                        </div>
                    </form>
                </div>   
            </div>
        </div>
    </div>

    @if ($user->superadmin == 0)
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Hak Akses</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('user.access', $user->id) }}" class="btn btn-primary">Tambah Hak Akses</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50%">Kategori Arsip</th>
                            <th width="7%">Akses</th>
                            <th width="7%">Buat</th>
                            <th width="7%">Ubah</th>
                            <th width="7%">Hapus</th>
                            <th width="7%">Unduh</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $bool = ["<div class='text-danger'>&cross;</div>", "<div class='text-success'>&check;</div>"] 
                        @endphp
                        @foreach ($userPrivilege as $item)
                            <tr>
                                <td>{{ $item->category->name }}</td>
                                <td>{!! $bool[$item->read] !!}</td>
                                <td>{!! $bool[$item->create] !!}</td>
                                <td>{!! $bool[$item->update] !!}</td>
                                <td>{!! $bool[$item->delete] !!}</td>
                                <td>{!! $bool[$item->download] !!}</td>
                                <td>
                                    <div class="my-2">
                                        <a href="{{ route('user.modify', $item->id)}}" class="btn btn-primary"><i class="fas fa-user-secret"></i> Atur Ulang</a>
                                    </div>
                                    <div class="my-2">
                                        <a href="{{ route('user.revoke', $item->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>   
        </div>
    @endif

    <div class="my-2">
        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus pengguna ini?')"><i class="fas fa-trash"></i> Hapus Akun</a>
    </div>

@endsection