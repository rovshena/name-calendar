@extends('layouts.admin.app')

@section('title', __('Update Compatibility'))

@php
    $breadcrumbs[] = ['label' => __('Home'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Compatibilities'), 'url' => route('admin.compatibilities.index')];
    $breadcrumbs[] = ['label' => $compatibility->first_name . ' and ' . $compatibility->second_name, 'url' => route('admin.compatibilities.show', [$compatibility->first_id, $compatibility->second_id])];
    $breadcrumbs[] = ['label' => __('Update')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-heart fa-fw mr-2 text-muted"></i>
            {{ __('Compatibility:') . " " . $compatibility->first_name . ' and ' . $compatibility->second_name }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form method="post" action="{{ route('admin.compatibilities.update', [$compatibility->first_id, $compatibility->second_id]) }}" onsubmit="disableSubmitButton();">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="compatibility">
                                {{ __('Compatibility Percentage') }} <abbr title="{{ __('Required') }}">*</abbr>
                            </label>
                            <input type="number" step="1" min="0" max="100" class="form-control @error('compatibility') is-invalid @enderror" id="compatibility" value="{{ $compatibility->compatibility }}" name="compatibility" required autofocus>
                            @error('compatibility')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="content">
                                {{ __('Content') }} <abbr title="{{ __('Required') }}">*</abbr>
                            </label>
                            <textarea name="content" id="content" data-toggle="summernote" class="summernote form-control @error('content') is-invalid @enderror">{{ $compatibility->content }}</textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                            <span id="loading" class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span> {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('plugins.summernote')

@push('page.js')
    @if ($errors->any())
        <script>
            $('.invalid-feedback').show();
        </script>
    @endif
@endpush
