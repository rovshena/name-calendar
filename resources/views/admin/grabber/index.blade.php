@extends('layouts.admin.app')

@section('title', __('Grabbers'))

@php
    $breadcrumbs[] = ['label' => __('Home'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Grabbers')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-broadcast-tower fa-fw mr-2 text-muted"></i>
            {{ __('Grabbers') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th> ID</th>
                        <th> {{ __('Name') }} </th>
                        <th> {{ __('Gender') }} </th>
                        <th> {{ __('Nationality') }} </th>
                        <th> {{ __('Letter') }} </th>
                        <th> {{ __('Religion') }} </th>
                        <th style="width:120px; min-width:120px;">{{ __('Actions') }} </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
    order: [0, 'asc'],
    ajax: "{{ route('admin.grabbers.index') }}",
    columns: [
    {data: 'id'},
    {data: 'name'},
    {data: 'gender'},
    {data: 'nationality'},
    {data: 'letter'},
    {data: 'religion'},
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
    var itemID = datatable.rows(indexes).data()[0].id;
    window.location.href = "{{ url()->current() }}" + "/" + itemID + "/edit";
    });
@endsection

@include('plugins.delete_item')
