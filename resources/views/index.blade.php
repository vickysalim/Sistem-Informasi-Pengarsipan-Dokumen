@extends('layout.master')

@section('title', "Beranda")

@section('content')
    @if (session()->has('info'))
        <div class="alert alert-success">
            {{ session()->get('info') }}
        </div>
    @endif

    @foreach ($archiveCategory as $item)
        <a class="btn btn-primary" href="{{ route('category.show', $item->id) }}">{{ $item->name }}</a>
    @endforeach

@endsection