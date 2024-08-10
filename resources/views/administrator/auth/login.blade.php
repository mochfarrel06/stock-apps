@extends('auth.layouts.master')

@section('content')
    <!-- Layout Login -->
    <x-auth.auth-layout :title="'Admin Stok Barang FarrCode'" :route="'admin.store'" />
    <!-- End Layout Login -->
@endsection
