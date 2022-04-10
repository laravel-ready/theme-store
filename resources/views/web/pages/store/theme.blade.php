@extends('theme-store::web.layouts.main')

@section('title', 'Theme X')

@push('styles')
    {{-- Store Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/store.min.css') }}" />
@endpush

@section('content')
    {{-- ... --}}
@endsection

@section('scripts')

@endsection
