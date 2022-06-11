@extends('layout.master')

@section('title', 'Buat Hak Akses')

@section('content')

<form action="{{ route('user.grant', $user->id) }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori" class="form-control select2" required>
            <option disabled selected>Pilih</option>
            @foreach ($archiveCategory as $item)
                @forelse ($userPrivilege as $item2)
                    @if ($item2->category_id == $item->id) 
                    @else
                        <option value="{{ $item->id }}"> {{ $item->name }}</option> 
                    @endif
                @empty
                    <option value="{{ $item->id }}"> {{ $item->name }}</option> 
                @endforelse
            @endforeach
        </select>
        @error('kategori')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <label>Berikan Hak Akses:</label>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="read" value="1" disabled checked>
            <label class="custom-control-label">Lihat arsip</label>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch2" name="create" value="1">
            <label class="custom-control-label" for="customSwitch2">Buat arsip</label>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch3" name="update" value="1">
            <label class="custom-control-label" for="customSwitch3">Ubah arsip</label>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch4" name="delete" value="1">
            <label class="custom-control-label" for="customSwitch4">Hapus arsip</label>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch5" name="download" value="1">
            <label class="custom-control-label" for="customSwitch5">Unduh arsip</label>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a class="btn btn-link" href="{{ url()->previous() }}">Kembali</a>
    </div>
</form>

@endsection