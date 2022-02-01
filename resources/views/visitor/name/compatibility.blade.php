@extends('layouts.visitor.app')

@section('title', __('Name Compatibility') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', __('Name Compatibility') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', __('Name Compatibility') . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', __('Name Compatibility') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', __('Name Compatibility') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    <section class="bg-light py-0 py-sm-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1> Name Compatibility </h1>
                    <h2> {{ $compatibility->first_name }} and {{ $compatibility->second_name }} </h2>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-0 py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow rounded-2 p-0">
                        <div class="card-body p-4">
                            {!! $compatibility->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pt-5 pt-lg-0">
                    <div class="row mb-5 mb-lg-0">
                        <div class="col-md-6 col-lg-12">
                            <div class="card card-body shadow p-4">
                                <h4 class="mb-3 text-center">
                                    Compatibility
                                </h4>
                                <div class="text-center">
                                    <h2 class="mb-0">
                                        {{ $compatibility->compatibility_percentage }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
