<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="{{route('redirect')}}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>SignSpeak</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            @if(Route::has('login'))
            @auth
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{route('redirect')}}" class="nav-item nav-link">HOME</a>
                <a href="{{route('user.userShowMaterials')}}" class="nav-item nav-link">LEARNING MATERIAL</a>
                <a href="{{route('user.userShowNotes')}}" class="nav-item nav-link">NOTE</a>
                <a href="{{route('user.userShowQuizzes')}}" class="nav-item nav-link">QUIZ</a>
                <a href="{{ route('realtime-detection') }}" class="nav-item nav-link" id="realtime-detection-btn">REAL TIME DETECTION</a>
            </div>
            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
            {{ Auth::user()->email }}
                </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout<i class="fa fa-sign-out-alt ms-3"></i></button>
            </form>
            @else
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{route('redirect')}}" class="nav-item nav-link active">Home</a>
            </div>
            <a href="{{route('register')}}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Sign Up<i class="fa fa-arrow-right ms-3"></i></a>
            @endauth
            @endif
        </div>
    </nav>
    <!-- Navbar End -->