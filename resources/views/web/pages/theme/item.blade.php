@extends('theme-store::web.layouts.main')

@section('title', 'Categories')

@push('styles')
    {{-- Category Pages Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/category.min.css') }}" />
@endpush

@section('content')
    {{-- Page Hero --}}
    @include('theme-store::web.components.common.hero-section', [
        'title' => $theme->name,
        'message' => $theme->description,
    ])

@endsection
