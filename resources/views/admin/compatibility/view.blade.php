@extends('layouts.admin.app')

@section('title', __('View Compatibility'))

@php
    $breadcrumbs[] = ['label' => __('Home'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Compatibilities'), 'url' => route('admin.compatibilities.index')];
    $breadcrumbs[] = ['label' => $compatibility->first_name . ' and ' . $compatibility->second_name];
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
                <a href="{{ route('admin.compatibilities.edit', [$compatibility->first_id, $compatibility->second_id]) }}" class="btn btn-primary mr-auto">{{ __('Update') }}</a>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <tbody>
                            <tr>
                                <th> {{ __('First Name') }} </th>
                                <td> {{ $compatibility->first_name }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Second Name') }} </th>
                                <td> {{ $compatibility->second_name }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Compatibility') }} </th>
                                <td> {{ $compatibility->compatibility_percentage }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Created at') }} </th>
                                <td> {{ optional($compatibility->created_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Updated at') }} </th>
                                <td> {{ optional($compatibility->updated_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                            <tr>
                                <td colspan="2"> {!! $compatibility->content ?? '<i>No content</i>' !!} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
