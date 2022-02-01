@extends('layouts.admin.app')

@section('title', __('Compatibilities'))

@php
    $breadcrumbs[] = ['label' => __('Home'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Compatibilities')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-heart fa-fw mr-2 text-muted"></i>
            {{ __('Compatibilities') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form action="{{ route('admin.compatibilities.store') }}" method="post" onsubmit="disableSubmitButton();">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-label-group mb-2 mb-md-0">
                                <select name="first_id" id="first_id" class="custom-select @error('first_id') is-invalid @enderror" required>
                                    <option value=""></option>
                                </select>
                                <label for="first_id">
                                    {{ __('First Name') }} <abbr title="{{ __('Required') }}">*</abbr>
                                </label>
                                @error('first_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-label-group mb-2 mb-md-0">
                                <select name="second_id" id="second_id" class="custom-select @error('second_id') is-invalid @enderror" required>
                                    <option value=""></option>
                                </select>
                                <label for="second_id">
                                    {{ __('Second Name') }} <abbr title="{{ __('Required') }}">*</abbr>
                                </label>
                                @error('second_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                                <span id="loading" class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span> {{ __('Add Compatibility') }}
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th> {{ __('First Name') }} </th>
                        <th> {{ __('Second Name') }} </th>
                        <th> {{ __('Compatibility') }} </th>
                        <th> {{ __('Content') }} </th>
                        <th style="width:160px; min-width:160px;">{{ __('Actions') }} </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
    order: [],
    ajax: "{{ route('admin.compatibilities.index') }}",
    columns: [
    {data: 'first_name'},
    {data: 'second_name'},
    {data: 'compatibility'},
    {data: 'content'},
    {
    data: 'actions',
    className: 'text-right',
    orderable: false,
    searchable: false
    }
    ]
@endsection

@section('datatable-select-event')
    datatable.on('select', function(e, dt, type, indexes){
    const first = datatable.rows(indexes).data()[0].first_id;
    const second = datatable.rows(indexes).data()[0].second_id;
    window.location.href = "{{ url()->current() }}" + "/" + first + "/" + second + "/edit";
    });
@endsection

@include('plugins.delete_item')
@include('plugins.select2')

@push('page.js')
    <script type="text/javascript">
        $('#first_id, #second_id').select2({
            placeholder: 'Select a name',
            allowClear: true,
            width: '100%',
            minimumInputLength: 1,
            ajax: {
                url: '{{ route('admin.translations.get-names') }}',
                dataType: 'json',
                cache: true,
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1,
                    }
                },
                processResults: function (data, params) {
                    params.page = params.page || 1

                    return {
                        results: $.map(data.results, function (val, key) {
                            return {
                                text: val,
                                id: key
                            }
                        }),
                        pagination: {
                            more: data.hasMorePages
                        },
                    }
                },
            },
        })
    </script>
@endpush
