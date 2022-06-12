@extends('layout.master')

@section('title', "Arsip ".$archiveCategory->name)

@section('content')

@if ($userPrivilege != null && Auth::user()->superadmin == 0)
    @if($userPrivilege->create == 1)
        <form action="{{ route('archive.create', $archiveCategory->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary mb-2">Tambah Arsip Baru</button>
        </form>
    @endif
@endif
@if (Auth::user()->superadmin == 1)
    <form action="{{ route('archive.create', $archiveCategory->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mb-2">Tambah Arsip Baru</button>
    </form>
@endif

    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif

    <table class="table dt-responsive nowrap mt-2" id="table">
        <thead>
            <tr>
                <th class="all">Nama Arsip</th>
                @foreach ($archiveCategoryForm as $item)
                    @if ($item->category_id == $archiveCategory->id)
                        <th>{{ $item->name }}</th>
                    @endif
                @endforeach
                <th>Waktu Pengarsipan</th>
                <th class="all" width="15%">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archive as $item)
                    @if ($item->category_id == $archiveCategory->id)
                        <tr>
                            <td>{{ $item->name }}</td>
                            @foreach ($archiveDescription as $item2)
                                @if ($item2->archive_id == $item->id)
                                    <td>{{ $item2->description }}</td>
                                @endif
                            @endforeach
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if (Auth::user()->superadmin == 1)
                                <div class="row">
                                    <a class="btn btn-primary m-1" href="{{ url('archive/'.$item->id) }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>                                    
                                    <a class="btn btn-info m-1" href="{{ url('archive/download',$item->id)}}" download>
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
                                <div class="row">
                                    <a class="btn btn-warning m-1" href="{{ url('archive/'.$item->id.'/edit') }}">
                                        <i class="fas fa-edit"></i> Ubah
                                    </a>
                                    <a class="btn btn-danger m-1" href="{{ url('archive/'.$item->id.'/delete') }}" onclick="return confirm('Apakah anda yakin untuk menghapus arsip ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                                @endif
                                @if ($userPrivilege != null && Auth::user()->superadmin == 0)
                                    <div class="row">
                                        
                                        @if ($userPrivilege->read == 1)
                                            <a class="btn btn-primary m-1" href="{{ url('archive/'.$item->id) }}">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        @endif
                                        
                                        @if ($userPrivilege->download == 1)
                                            <a class="btn btn-info m-1" href="{{ url('archive/download',$item->id)}}" download>
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                        @endif
                                        
                                    </div>
                                    <div class="row">
                                        @if ($userPrivilege->update == 1)
                                            <a class="btn btn-warning m-1" href="{{ url('archive/'.$item->id.'/edit') }}">
                                                <i class="fas fa-edit"></i> Ubah
                                            </a>
                                        @endif

                                        @if ($userPrivilege->delete == 1)
                                            <a class="btn btn-danger m-1" href="{{ url('archive/'.$item->id.'/delete') }}" onclick="return confirm('Apakah anda yakin untuk menghapus arsip ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        @endif
                                    </div> 
                                @endif
                                
                            </td>
                        </tr>
                    @endif
                @endforeach
        </tbody>
    </table>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function () {
          $('#table').DataTable({
            "responsive": true,
            "language": {
                "lengthMenu": "Menampilkan _MENU_ arsip per halaman",
                "emptyTable": "<div style='margin: 16px;'>Belum ada arsip yang dibuat</div>",
                "zeroRecords": "<div style='margin: 16px;'>Arsip tidak ditemukan</div>",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Arsip tidak ditemukan",
                "infoFiltered": "(berdasarkan filter _MAX_ arsip tersedia)",
                "paginate": {
                    "first":      "Awal",
                    "last":       "Akhir",
                    "next":       "Selanjutnya",
                    "previous":   "Sebelumnya"
                },
                "search": "Cari:"
            }
          });
        });
      </script>

@endsection