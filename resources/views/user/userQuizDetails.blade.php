<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
   <meta charset="UTF-8">
   <title>Sign Speak</title>
 <link rel="stylesheet" href="style.css">
  <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{url('css/nav-style.css')}}"/>
    <link rel="stylesheet" href="{{url('css/admin/editMaterialsView.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;>> &nbsp;&nbsp;&nbsp;&nbsp;{{$quiz->quizname}}</li>
    </ol>
</div>
<br/>
    <form class="form-container" action="{{ route('user.submitQuiz', ['quizId' => $quiz->id]) }}" method="POST">
        @csrf
        <h2 style="margin-top:15px;margin-bottom:15px;text-align:center;">{{$quiz->quizname}}</h2>
        <div class="form-group">
            <p><strong>Total Question:</strong> {{ $totalquestion }}</p>
        </div>
        <div class="form-group">
            <p><strong>Status:</strong> {{ $quiz->status }}</p>
        </div>
        <br/><hr/><br/>
        @foreach ($questions as $index => $question)
        <div style="margin-top:15px;margin-bottom:15px;text-align:center;">
            <div class="form-group">
            <h2 style="margin-top:15px;margin-bottom:15px;text-align:center;">Question {{$index+1}}</h2>
                @if($question->imageURL)
                <img src="{{ asset('questionImage/' . $question->imageURL) }}" alt="Current Image" style="max-width: 500px; max-height: 400px;">
                @endif
                <label>Question {{ $index + 1 }}: {{ $question->question }}</label>
            </div>
            <br/>
            @if (isset($groupedSelections[$question->id]))
                <h3 style="margin-bottom:10px;">Selections:</h3>
                @foreach ($groupedSelections[$question->id] as $selectionIndex => $selection)
                    <div class="form-group">
                        <label>
                            <input type="radio" name="selection_{{ $question->id }}" value="{{ $selection->selection }}" >
                            {{ $selection->selection }}
                        </label>
                    </div>
                @endforeach
            @endif
            <br/><hr/><br/>
        </div>
        @endforeach
        <div class="button-container">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
    <br /><br />

</body>
</html>