@extends('layout.master')

@section('title', "Beranda")

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card bg-light d-flex flex-fill">
                @if (Auth::user()->superadmin == 1)
                    <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-success">Super Admin</div>
                    </div>
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 text-center">
                            <img src="{{ asset('dist/img/user.png') }}" alt="user-avatar" class="img-circle img-fluid">
                        </div>
                        <div class="col-10 my-auto">
                            <h2>Selamat datang, <b>{{ Auth::user()->name }}</b></h2>
                            <ul class="ml-4 mb-0 fa-ul">
                                <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: {{ Auth::user()->email }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif

    <h3><b>Kategori Arsip</b></h3>

    <div class="row">
        @foreach ($archiveCategory as $item)
            @foreach ($userPrivilege as $item2)
                @if ($item2->user_id == Auth::user()->id && $item2->read == 1 && $item2->category_id == $item->id && Auth::user()->superadmin == 0)
                    @component('components.custom-archive-card')
                        @slot('category_title')
                            {{ $item->name }}
                        @endslot

                        @slot('count')
                            @php
                                $x = 0;    
                            @endphp
                            @foreach ($archive as $item3)
                                @if ($item3->category_id == $item->id)
                                    @php
                                        $x++;
                                    @endphp
                                @endif
                            @endforeach
                            {{ $x }}
                        @endslot

                        @slot('link')
                            {{ route('category.show', $item->id) }}
                        @endslot
                    @endcomponent
                @endif 
            @endforeach
            
            @if(Auth::user()->superadmin == 1)
                @component('components.custom-archive-card')
                    @slot('category_title')
                        {{ $item->name }}
                    @endslot

                    @slot('count')
                        @php
                            $x = 0;    
                        @endphp
                        @foreach ($archive as $item3)
                            @if ($item3->category_id == $item->id)
                                @php
                                    $x++;
                                @endphp
                            @endif
                        @endforeach
                        {{ $x }}
                    @endslot

                    @slot('link')
                        {{ route('category.show', $item->id) }}
                    @endslot
                @endcomponent
            @endif
        @endforeach
    </div>

@endsection