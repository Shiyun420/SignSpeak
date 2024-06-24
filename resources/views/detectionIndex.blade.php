<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
   <meta charset="UTF-8">
   <title>Sign Speak</title>
 <link rel="stylesheet" href="style.css">
  <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{url('css/nav-style.css')}}"/>
    <link rel="stylesheet" href="{{url('css/admin/adminShowMaterials.css')}}">
    <link rel="stylesheet" href="{{url('css/user/showMaterialDetails.css')}}"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <nav>
    <div class="navbar">
      <div class="logo"><a href="{{route('redirect')}}"><i class="fa fa-book me-3"></i> SignSpeak</a></div>
      <ul class="menu">
        <li><a href="{{route('redirect')}}">HOME</a></li>
        <li><a href="{{route('user.userShowMaterials')}}" class="nav-item nav-link">LEARNING MATERIAL</a></li>
        <li><a href="{{route('user.userShowNotes')}}" class="nav-item nav-link">NOTE</a></li>
        <li><a href="{{route('user.userShowQuizzes')}}" class="nav-item nav-link">QUIZ</a></li>
        <li><a href="{{ route('realtime-detection') }}" class="nav-item nav-link active">REAL TIME DETECTION</a></li>
        <li><a href="{{ route('profile.show') }}"  class="nav-item nav-link active" id="user-email">
            {{ Auth::user()->email }}
                <a></li>
            <li><a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout <i class="fa fa-sign-out-alt ms-3"></i></button>
              </form></a>
            </li>
      </ul>
    </div>
  </nav>
  
  <br/><br/>
  <div style="text-align:center;">
    @if(session()->has('message'))
      <div class="alert alert-error alert-dismissible fade show" role="alert">
          {{ session()->get('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endif
  </div>
  <br/><br/>
<div class="button-container">
    <p style="font-size:20px;">**Press the 'Esc' key on your keyboard to stop the real time detection**</p>
    <br/>
    <a class="btn btn-outline-blue" href="{{route('realtimeDetection')}}" 
        style="width:350px;height:180px;background-color:darkblue;color:white;font-size:35px;text-decoration: none;padding:20px;">
        <i class="far fa-play-circle"></i> <br>Start Real <br>Time Detection
    </a>
</div>

