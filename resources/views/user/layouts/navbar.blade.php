<!-- header section strats -->
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span>
                    {{ env('APP_NAME') }}
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">{{translate('messages.home')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#about_us_Section">{{translate('messages.about')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contactus_Section">{{translate('messages.contact_us')}}</a>
                    </li>
                    @if (!auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sign-up') }}">{{translate('messages.signup')}}</a>
                    </li>
                    @endif
                    @if (auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prescription.index') }}">{{translate('messages.my_quotations')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger font-weight-bold"
                         href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{translate('messages.log_out')}}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link text-dark font-weight-bold" target="_blank" href="{{ route('pharmacy.auth.login') }}">{{translate('messages.phramacy_login')}}</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- end header section -->