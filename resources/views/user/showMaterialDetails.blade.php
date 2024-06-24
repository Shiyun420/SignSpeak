<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
   <meta charset="UTF-8">
   <title>Sign Speak</title>
 <link rel="stylesheet" href="style.css">
  <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{url('css/nav-style.css')}}"/>
    <link rel="stylesheet" href="{{url('css/user/showMaterialDetails.css')}}"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <nav>
    <div class="navbar">
      <div class="logo"><a href="{{route('redirect')}}"><i class="fa fa-book me-3"></i> SignSpeak</a></div>
      <ul class="menu">
        <li><a href="{{route('redirect')}}">HOME</a></li>
        <li><a href="{{route('user.userShowMaterials')}}" class="nav-item nav-link active">LEARNING MATERIAL</a></li>
        <li><a href="{{route('user.userShowNotes')}}" class="nav-item nav-link">NOTE</a></li>
        <li><a href="{{route('user.userShowQuizzes')}}" class="nav-item nav-link">QUIZ</a></li>
        <li><a href="{{ route('realtime-detection') }}" class="nav-item nav-link">REAL TIME DETECTION</a></li>
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
  
  br/><br/><br/><br/>

<div aria-label="breadcrumb" style="margin-top:20px;margin-bottom:20px; margin-left:20px;">
<ol class="breadcrumb">
    @if($material->category == "alphabet")
      <li class="breadcrumb-item"><a href="{{ route('user.userShowMaterials') }}">Learning Materials</a></li>
    @endif
    @if($material->category == "number")
      <li class="breadcrumb-item"><a href="{{ route('user.userShowNumber') }}">Learning Materials</a></li>
    @endif
    @if($material->category == "others")
      <li class="breadcrumb-item"><a href="{{ route('user.userShowOther') }}">Learning Materials</a></li>
    @endif
    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;>> &nbsp;&nbsp;&nbsp;&nbsp;{{$material->title}}</li>
</ol>
</div>

    <div class="container">
        <h1 class="word">{{$material->title}}</h1>
        <h4 class="word">{{$material->description}}</h4>
        <br/>
        <div class="audio-container">
            <audio src="{{ asset('materialsAudio/' . $material->audioURL) }}" controls></audio>
        </div>
        <br/>
        <div class="img-video-container">
            <img src="{{ route('admin.getImage', $material->id) }}" alt="Current Image">
        </div>
        <br/>
        <div class="img-video-container">
            <video src="{{ asset('materialsVideo/' . $material->videoURL) }}" controls></video>
        </div>
        <br/><br/>
    </div>
    <br/><br/><br/><br/>
</body>
</html>

