@extends('layouts.visitor.app')

@section('title', 'Search Names' . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', 'Search Names' . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', 'Search Names' . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', 'Search Names' . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', 'Search Names' . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    <section class="bg-blue align-items-center d-flex">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-white"> Search: {{ request()->query('search', '') }} </h1>
                    <div class="d-flex justify-content-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dark breadcrumb-dots mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Search </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-3">
        <div class="container">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="row g-4">
                        @if(isset($names) && count($names))
                            @foreach($names as $name)
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card shadow h-100">
                                        <div class="card-body">
                                            <h6 class="card-title mb-0">
                                                <a class="stretched-link" href="{{ route('name.show-by-id', $name) }}">
                                                    {{ $name->temp_name }}
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center">
                                <h4>Oh no! We couldn't find a single match for "{{ request()->query('search', '') }}" </h4>
                                <img src="{{ asset('assets/images/elements/sad-search.gif') }}" class="h-100px h-md-400px mb-4" alt="">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
