@extends('auth.layouts.master')

@section('content')
    <!-- Layout Login -->
    <x-auth.auth-layout :title="'Aplikasi Stok Barang CodeFa'" :route="'login.store'" />
    <!-- End Layout Login -->
@endsection
