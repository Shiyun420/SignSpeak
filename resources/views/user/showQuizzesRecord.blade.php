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
    <link rel="stylesheet" href="{{url('css/admin/editMaterialsView.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body style="background-color:white;">
  <nav>
    <div class="navbar">
      <div class="logo"><a href="{{route('redirect')}}"><i class="fa fa-book me-3"></i> SignSpeak</a></div>
      <ul class="menu">
        <li><a href="{{route('redirect')}}">HOME</a></li>
        <li><a href="{{route('user.userShowMaterials')}}" class="nav-item nav-link">LEARNING MATERIAL</a></li>
        <li><a href="{{route('user.userShowNotes')}}" class="nav-item nav-link">NOTE</a></li>
        <li><a href="{{route('user.userShowQuizzes')}}" class="nav-item nav-link active">QUIZ</a></li>
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

    <br/><br/><br/>

    <div aria-label="breadcrumb" style="margin-top:20px;margin-bottom:20px; margin-left:20px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.userShowQuizzes') }}">Quiz</a></li>
        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;>> &nbsp;&nbsp;&nbsp;&nbsp; Quiz Record</li>
    </ol>
</div>
<br/>
        <h1 style="text-align:center;">Your Quiz Records</h1>
        <table class="mx-auto">
        <thead>
            <tr>
            <th>No</th>
            <th>Quiz Name</th>
            <th>Marks</th>
            <th>Total Questions</th>
            <th>Date Taken</th>
            </tr>
        </thead>
  <tbody>
    
    @foreach($quizTakens as $index => $quizTaken)
      <tr>
          <td style="width:10%">{{$index+1}}</td>
          <td style="width:40%">{{$quizTaken->quiz->quizname}}</td>
          <td style="width:15%">{{$quizTaken->marks}}</td>
          <td style="width:15%">{{$quizTaken->totalQuestions}}</td>
          <td style="width:20%">{{$quizTaken->updated_at}}</td>
      </tr>
    @endforeach
  
  </tbody>
</table>
      


    <br /><br />

</body>
</html>