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
    <link rel="stylesheet" href="{{url('css/admin/adminShowMaterials.css')}}">
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
        <li><a href="{{route('admin.adminShowMaterials')}}" class="nav-item nav-link">LEARNING MATERIAL</a></li>
        <li><a href="{{ route('admin.adminShowNotes') }}" class="nav-item nav-link">Note</a></li>
        <li><a href="{{route('admin.adminShowQuizzes')}}" class="nav-item nav-link active">QUIZ</a></li>
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
        <li class="breadcrumb-item"><a href="{{ route('admin.adminShowQuizzes') }}">Quiz</a></li>
        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;>> &nbsp;&nbsp;&nbsp;&nbsp;{{$quiz->quizname}}</li>
    </ol>
</div>
        <h2 style="text-align:center;">{{$quiz->quizname}} - Manage Question</h2>
        <div class="button-container">
        <a style="text-decoration:none;" class="btn btn-outline-blue" href="{{route('admin.addQuestionView', $quiz->id)}}">
                <i class="fas fa-plus-circle"></i> Add New Question
            </a>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <table class="mx-auto">
        <thead>
            <tr>
            <th>No</th>
            <th>Question</th>
            <th>Image</th>
            <th>Answer</th>
            <th>ACTIONS</th> <!-- Add a new table header for actions -->
            </tr>
        </thead>
  <tbody>
    
    @foreach($questions as $index => $question)
      <tr>
          <td style="width:10%">{{$index+1}}</td>
          <td style="width:35%">{{$question->question}}</td>
          @if($question->imageURL)
          <td style="width:30%"><img src="{{ asset('questionImage/' . $question->imageURL) }}" alt="Current Image" style="max-width:300px;max-height:300px;"></td>
          @endif
          @if (!$question->imageURL)
          <td style="width:30%">No Image</td>
          @endif
          <td style="width:10%">{{$question->answer}}</td>
          <td style="width:15%">
          <div class="d-flex justify-content-between p-2">
            <a style="text-decoration:none;" class="btn btn-outline-info" href="{{route('admin.editQuestionsView',$question->id)}}">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a style="text-decoration:none;" class="btn btn-outline-danger" href="{{route('admin.deleteQuestion',$question->id)}}" onclick="return confirm('Are you sure you want to delete this question?')">
                <i class="fas fa-trash-alt"></i> Delete
            </a>
          </div>
          </td>
      </tr>
    @endforeach
  
  </tbody>
</table>

</body>
</html>