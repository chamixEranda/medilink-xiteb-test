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
                        <a class="nav-link" href="{{ route('about-us') }}">{{translate('messages.about')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">{{translate('messages.contact_us')}}</a>
                    </li>
                    @if (!auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sign-up') }}">{{translate('messages.signup')}}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="doctors.html">Doctors</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- end header section -->