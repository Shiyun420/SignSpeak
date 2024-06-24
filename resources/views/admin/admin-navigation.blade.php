<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="{{route('redirect')}}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>SignSpeak</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{route('redirect')}}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('admin.adminShowMaterials') }}" class="nav-item nav-link">Learning Materials</a>
                <a href="{{ route('admin.adminShowNotes') }}" class="nav-item nav-link">Note</a>
                <a href="{{ route('admin.adminShowQuizzes') }}" class="nav-item nav-link">Quiz</a>
            </div>
            @if(Route::has('login'))
            @auth
            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
            {{ Auth::user()->email }}
                </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout<i class="fa fa-sign-out-alt ms-3"></i></button>
            </form>
            @else
            <a href="{{route('register')}}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Sign Up<i class="fa fa-arrow-right ms-3"></i></a>
            @endauth
            @endif
        </div>
    </nav>
    <!-- Navbar End -->