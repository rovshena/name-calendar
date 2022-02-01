<?php

$request = request()->query();

?>

<header class="navbar-light navbar-sticky header-static">
    <div class="navbar-top navbar-dark bg-light py-2 mx-2 mx-md-4 rounded-bottom-4">
        <div class="container">
            Names by letter
            @foreach(range('A', 'Z') as $letter)
                <a class="d-inline-flex px-2 nav-link" href="{{ route('names', ['letter' => $letter]) }}">
                    {{ $letter }}
                </a>
            @endforeach
        </div>
    </div>
    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img class="light-mode-item navbar-brand-item me-2" src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                <img class="dark-mode-item navbar-brand-item me-2" src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                <b class="d-none d-sm-inline-block">
                    Name Calendar
                </b>
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
            </button>
            <div class="navbar-collapse w-100 collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll mx-auto">
                    <li class="nav-item dropdown">
                        <a id="gender-names" class="nav-link dropdown-toggle {{ isset($request['gender']) ? 'active' : '' }}" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gender
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="gender-names">
                            @foreach(['Female', 'Male'] as $gender)
                                <li>
                                    <a class="dropdown-item {{ isset($request['gender']) && $request['gender'] === $gender ? 'active' : '' }}" href="{{ route('names', ['gender' => $gender]) }}">{{ $gender }} Names</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ isset($request['nationality']) ? 'active' : '' }}" href="javascript:void(0);" id="nationality-names" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Nationality
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="nationality-names">
                            @foreach(['American', 'English', 'Arabic', 'Kazakh', 'Italian', 'Spanish', 'French', 'Hebrew', 'Armenian', 'Greek', 'German', 'Russian', 'Tatar', 'Ukrainian', 'Ossetian', 'Slavic', 'Japanese'] as $nationality)
                                <li>
                                    <a class="dropdown-item {{ isset($request['nationality']) && $request['nationality'] === $nationality ? 'active' : '' }}" href="{{ route('names', ['nationality' => $nationality]) }}">{{ $nationality }} Names</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ isset($request['religion']) ? 'active' : '' }}" href="javascript:void(0);" id="religion-names" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Religion
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="religion-names">
                            @foreach(['Orthodox', 'Catholic', 'Muslim', 'Jewish'] as $religion)
                                <li>
                                    <a class="dropdown-item {{ isset($request['religion']) && $request['religion'] === $religion ? 'active' : '' }}" href="{{ route('names', ['religion' => $religion]) }}">{{ $religion }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
                    <div class="nav-item w-100">
                        <form action="{{ route('name.search') }}" method="get" class="position-relative">
                            <input name="search" class="form-control pe-5 bg-transparent" type="search" placeholder="Search" aria-label="Search" value="{{ isset($request['search']) ? $request['search'] : '' }}">
                            <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit">
                                <i class="fas fa-search fs-6 "></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="navbar-nav ms-2">
                <div class="modeswitch-wrap" id="darkModeSwitch">
                    <div class="modeswitch-item">
                        <div class="modeswitch-icon"></div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
