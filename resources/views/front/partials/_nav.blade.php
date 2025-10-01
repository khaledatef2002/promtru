<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('front.home') }}">
            <img src="{{ asset('front/imgs/logo.png') }}" alt="وكالة بروموترو" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">@lang('custom.home')</a></li>
                <li class="nav-item"><a class="nav-link" href="/#about-us">@lang('custom.about_us')</a></li>
                <li class="nav-item"><a class="nav-link" href="/#services">@lang('custom.our_services')</a></li>
                <li class="nav-item"><a class="nav-link" href="/#clients">@lang('custom.partners')</a></li>
                <li class="nav-item"><a class="nav-link" href="/#contact">@lang('custom.contact_us')</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.blogs.index') }}">@lang('custom.blog')</a></li>
                <div>
                    @if (LaravelLocalization::getCurrentLocale() == 'ar')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                                EN
                            </a>
                        </li>  
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                                العربية
                            </a>  
                        </li>
                    @endif
                </div>
            </ul>
        </div>
    </div>
</nav>