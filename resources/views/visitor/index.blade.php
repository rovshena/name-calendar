@extends('layouts.visitor.app')

@section('title', Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : '')

@section('meta.description', Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '')

@section('meta.keywords', Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : '')

@section('og.title', Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : '')

@section('og.description', Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '')

@section('content')
    <section class="position-relative overflow-hidden pt-3 pt-lg-1">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 col-xl-6 position-relative z-index-1 text-center text-lg-start mb-5 mb-sm-0">
                    <h1 class="mb-0 display-7">
                        The meaning of the name, mystery and fate
                    </h1>
                    <p class="my-4 lead">
                        In the modern world, human names, female and male, have thousands and tens of thousands of variations. Each of these names plays an important role in the lives of more than a dozen people, but few people think about what role the name plays in a person's fate, in his personal life path.
                    </p>
                    <ul class="list-inline position-relative justify-content-center justify-content-lg-start mb-4">
                        <li class="list-inline-item me-2">
                            <i class="bi bi-patch-check-fill h6 me-1"></i>Search by gender
                        </li>
                        <li class="list-inline-item me-2">
                            <i class="bi bi-patch-check-fill h6 me-1"></i>Search by nation
                        </li>
                        <li class="list-inline-item">
                            <i class="bi bi-patch-check-fill h6 me-1"></i>Search by religion
                        </li>
                    </ul>
                    <div class="d-sm-flex align-items-center justify-content-center justify-content-lg-start">
                        <a href="{{ route('names', ['all' => 1]) }}" class="btn btn-lg btn-danger-soft me-2 mb-4 mb-sm-0">
                            List All Names
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-6 text-center position-relative">
                    <div class="position-relative">
                        <img class="rounded" src="{{ asset('assets/images/elements/man-working.gif') }}" alt="" style="max-height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-0 pb-0">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">
                <div class="col-lg-6 position-relative order-2">
                    <img src="{{ asset('assets/images/elements/woman-with-laptop-getting-notifications.gif') }}" class="position-relative" alt="">
                </div>
                <div class="col-lg-6 position-relative order-1 order-lg-2">
                    <h2>Let Us Help You</h2>
                    <ul class="list-group list-group-borderless mb-2">
                        <li class="list-group-item d-flex align-items-center px-0">
                            <p class="mb-0 h6 fw-light">
                                <i class="bi bi-arrow-right text-primary me-2"></i>What role does a human name play in his life?
                            </p>
                        </li>
                        <li class="list-group-item d-flex align-items-center px-0">
                            <p class="mb-0 h6 fw-light">
                                <i class="bi bi-arrow-right text-primary me-2"></i>How does it affect fate and life in general?
                            </p>
                        </li>
                        <li class="list-group-item d-flex align-items-center px-0">
                            <p class="mb-0 h6 fw-light">
                                <i class="bi bi-arrow-right text-primary me-2"></i>Is it able to change the way of life?
                            </p>
                        </li>
                        <li class="list-group-item d-flex align-items-center px-0">
                            <p class="mb-0 h6 fw-light">
                                <i class="bi bi-arrow-right text-primary me-2"></i>And does the meaning of the nameform really affect the character and features of the person named by this or that name?
                            </p>
                        </li>
                    </ul>
                    <p class="mb-2">
                        All this is still far from a complete list of important issues of interest to everyone ...
                        We, the Namedb portal, are a catalog of Russian, foreign, old and forgotten, female and male names. We will hide the veil of secrecy and tell you about the importance of the meaning of your personal name, about its impact on you as an individual, and about what the future may possibly hold for you ahead.
                        Open the veil of the mystery of the name with us.
                    </p>
                    <a href="javascript:void(0);" class="btn btn-primary-soft mb-0">More about us</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-light rounded-3 p-4">
                        <div class="tiny-slider arrow-round arrow-creative arrow-blur arrow-hover py-1">
                            <div class="tiny-slider-inner" data-autoplay="true" data-gutter="80" data-arrow="true" data-dots="false" data-items="4" data-items-lg="3" data-items-md="2" data-items-xs="1">
                                @foreach(['American', 'English', 'Arabic', 'Kazakh', 'Italian', 'Spanish', 'French', 'Hebrew', 'Armenian', 'Greek', 'German', 'Russian', 'Tatar', 'Ukrainian', 'Ossetian', 'Slavic', 'Japanese'] as $nation)
                                    <div>
                                        <div class="d-flex align-items-center justify-content-center bg-body text-center rounded-2 border py-2 px-1 position-relative">
                                            <img src="{{ asset('assets/images/flags/' . $nation . '.png') }}" class="h-40px" alt="">
                                            <a href="{{ route('names', ['nation' => $nation]) }}" class="text-primary-hover stretched-link">
                                                <span class="h6 ms-2"> {{ $nation }} Names </span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('plugins.tiny_slider')
