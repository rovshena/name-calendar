@extends('layouts.visitor.app')

@section('title', $page_name . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', $page_name . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', $page_name . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', $page_name . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', $page_name . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    <section class="bg-blue align-items-center d-flex">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-white"> {{ $page_name }} </h1>
                    <div class="d-flex justify-content-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dark breadcrumb-dots mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> {{ $page_name }} </li>
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
                        @foreach($names as $name)
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="card shadow h-100">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">
                                            @if ($name->articleBody === "-")
                                                {{ $name->temp_name }}
                                            @else
                                                <a href="{{ route('name.show-by-id', $name) }}">
                                                    {{ $name->temp_name }}
                                                </a>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
