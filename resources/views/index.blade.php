@extends('layout.master')

@section('title', "Beranda")

@section('content')
    <a class="btn btn-primary" href="{{ url('arsip/create') }}">Tambah Arsip Baru</a>

@endsection