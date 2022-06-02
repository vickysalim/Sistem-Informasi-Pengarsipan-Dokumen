@extends('layout.master')

@section('title', "Kategori Arsip")

@section('content')
    <a class="btn btn-primary" href="{{ url('category/create') }}">Tambah Kategori Baru</a>

    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif
    <table class="table mt-2">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="70%">Nama Kategori</th>
                <th width="10%">Jumlah Arsip</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalArchive = 0
            @endphp
            @foreach ($archiveCategories as $item)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @php
                            $i = 0
                        @endphp
                        @foreach ($archives as $item2)
                            @if ($item2->category_id == $item->id)
                                @php
                                    $i++
                                @endphp                              
                            @endif
                        @endforeach
                        <a href="{{ route('category.show', $item->id) }}">{{ $i }}</a>
                    </td>
                    <td>
                        <a class="btn btn-primary m-1" href="{{ url('category/'.$item->id) }}">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a class="btn btn-danger m-1" href="{{ url('category/'.$item->id.'/delete') }}" onclick="return confirm('Apakah anda yakin untuk menghapus kategori arsip ini? Seluruh arsip yang terkait akan dihapus.')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                @php
                    $totalArchive = $i + $totalArchive    
                @endphp
                @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total Arsip</td>
                <th colspan="2">{{ $totalArchive }}</td>
            </tr>
        </tfoot>
    </table>
@endsection