@extends('layouts.admin.app')

@section('title', __('Update Grabber'))

@php
    $breadcrumbs[] = ['label' => __('Home'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Grabbers'), 'url' => route('admin.grabbers.index')];
    $breadcrumbs[] = ['label' => __('Grabber ID:') . " " . $grabber->id];
    $breadcrumbs[] = ['label' => __('Update')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-cogs fa-fw mr-2 text-muted"></i>
            {{ __('Grabber ID:') . " " . $grabber->id }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form method="post" action="{{ route('admin.grabbers.update', $grabber) }}" onsubmit="disableSubmitButton();">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="name">
                                {{ __('Name') }} <abbr title="{{ __('Required') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $grabber->name }}" name="name" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="link">
                                {{ __('Link') }} <abbr title="{{ __('Required') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" value="{{ $grabber->link }}" name="link" required>
                            @error('link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="gender">
                                {{ __('Gender') }} <abbr title="{{ __('Required') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('gender') is-invalid @enderror" id="gender" value="{{ $grabber->gender }}" name="gender" required>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="letter">
                                {{ __('Letter') }} <abbr title="{{ __('Required') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('letter') is-invalid @enderror" id="letter" value="{{ $grabber->letter }}" name="letter" required>
                            @error('letter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="nationality">
                                {{ __('Nationality') }} <abbr title="{{ __('Required') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('nationality') is-invalid @enderror" id="nationality" value="{{ $grabber->nationality }}" name="nationality" required>
                            @error('nationality')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="religion">
                                {{ __('Religion') }}
                            </label>
                            <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" value="{{ $grabber->religion }}" name="religion">
                            @error('religion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="articleBody">
                                {{ __('Article Body') }} <abbr title="{{ __('Required') }}">*</abbr>
                            </label>
                            <textarea name="articleBody" id="articleBody" data-toggle="summernote" class="summernote form-control @error('articleBody') is-invalid @enderror">{{ $grabber->articleBody }}</textarea>
                            @error('articleBody')
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
