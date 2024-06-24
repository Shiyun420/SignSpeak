<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Sign Speak</title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{url('css/nav-style.css')}}"/>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
<nav>
    <div class="navbar">
        <div class="logo"><a href="{{ route('redirect') }}"><i class="fa fa-book me-3"></i> SignSpeak</a></div>
        <ul class="menu">
            @if (Auth::user()->usertype == "admin")
                <li><a href="{{ route('redirect') }}">HOME</a></li>
                <li><a href="{{ route('admin.adminShowMaterials') }}" class="nav-item nav-link">LEARNING MATERIAL</a></li>
                <li><a href="{{ route('admin.adminShowQuizzes') }}" class="nav-item nav-link">QUIZ</a></li>
                <li><a href="{{ route('profile.show') }}" class="nav-item nav-link" id="user-email">{{ Auth::user()->email }}</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout <i class="fa fa-sign-out-alt ms-3"></i></button>
                    </form>
                </li>
            @elseif (Auth::user()->usertype == "student")
                <li><a href="{{ route('redirect') }}">HOME</a></li>
                <li><a href="{{ route('user.userShowMaterials') }}" class="nav-item nav-link">LEARNING MATERIAL</a></li>
                <li><a href="{{ route('user.userShowQuizzes') }}" class="nav-item nav-link">QUIZ</a></li>
                <li><a href="{{ route('realtime-detection') }}" class="nav-item nav-link">REAL TIME DETECTION</a></li>
                <li><a href="{{ route('profile.show') }}" class="nav-item nav-link active" id="user-email">{{ Auth::user()->email }}</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout <i class="fa fa-sign-out-alt ms-3"></i></button>
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>

<br/><br/><br/><br/>


<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
</body>
</html>