<?php

$main_name = json_decode($name->name, true)['main']

?>

@extends('layouts.visitor.app')

@section('title', $main_name . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', $main_name . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', $main_name . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', $main_name . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', $main_name . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    <section class="bg-light py-0 py-sm-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1> {{ $main_name }} </h1>
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
                            {!! $name->articleBody !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pt-5 pt-lg-0">
                    <div class="row mb-5 mb-lg-0">
                        <div class="col-md-6 col-lg-12">
                            <div class="card card-body shadow p-4">
                                <h4 class="mb-3">
                                    Name Compatibility
                                </h4>
                                @if(isset($compatibilities) && is_array($compatibilities) && count($compatibilities))
                                    <ul class="list-inline mb-0">
                                        @foreach($compatibilities as $compatibility)
                                            <li class="list-inline-item">
                                                <a class="btn btn-outline-light btn-sm" href="{{ route('name.compatibility', [$compatibility->first_id, $compatibility->second_id]) }}">
                                                    @if($compatibility->first_name === $main_name)
                                                        {{ $compatibility->second_name }}
                                                    @else
                                                        {{ $compatibility->first_name }}
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <i>Coming Soon</i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
