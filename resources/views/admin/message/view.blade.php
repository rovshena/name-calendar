@extends('layouts.admin.app')

@section('title', __('View Message'))

@php
    $breadcrumbs[] = ['label' => __('Home'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Messages'), 'url' => route('admin.messages')];
    $breadcrumbs[] = ['label' => $message->id];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="far fa-envelope-open fa-fw mr-2 text-muted"></i>
            {{ __('Message ID:') . " " . $message->id }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <tbody>
                            <tr>
                                <th style="min-width: 150px;"> ID </th>
                                <td> {{ $message->id }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Name') }} </th>
                                <td> {{ $message->name }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Phone') }} </th>
                                <td> {{ $message->phone }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Email') }} </th>
                                <td> {{ $message->email }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Send at') }} </th>
                                <td> {{ optional($message->created_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Updated at') }} </th>
                                <td> {{ optional($message->updated_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                            <tr>
                                <td colspan="2"> {{ $message->content }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
