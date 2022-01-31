<footer class="bg-blue p-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <a href="{{ url('/') }}" class="d-inline-flex align-items-center text-white">
                    <img class="h-20px me-2" src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                    Name Calendar
                </a>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="text-center text-white">
                    @if(Arr::exists($shared_settings, 'author'))
                    {{ $shared_settings['author'] }}
                    @endif
                    &copy; 2021 - {{ date('Y') }}
                    All rights reserved.
                </div>
            </div>
            <div class="col-md-4">
                <ul class="list-inline mb-0 text-center text-md-end">
                    <li class="list-inline-item ms-2">
                        <a href="javascript:void(0);"><i class="text-white fab fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item ms-2">
                        <a href="javascript:void(0);"><i class="text-white fab fa-instagram"></i></a>
                    </li>
                    <li class="list-inline-item ms-2">
                        <a href="javascript:void(0);"><i class="text-white fab fa-linkedin-in"></i></a>
                    </li>
                    <li class="list-inline-item ms-2">
                        <a href="javascript:void(0);"><i class="text-white fab fa-twitter"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
