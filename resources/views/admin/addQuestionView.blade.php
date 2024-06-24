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
        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;>> &nbsp;&nbsp;&nbsp;&nbsp;Add Question</li>
    </ol>
</div>
<br/>
<form method="POST" action="{{ route('admin.addQuestion') }}" enctype="multipart/form-data" class="form-container">
            <h2 style="margin-top:15px;margin-bottom:15px;text-align:center;">Add Question</h2>
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @csrf <!-- CSRF protection -->
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" id="question" name="question" required>
            </div>
            <div class="form-group">
                <label for="imageURL">Image (Optional):</label>
                <input type="file" id="imageURL" name="imageURL">
            </div>
            <div class="form-group">
                <label for="selection1">Selection 1:</label>
                <input type="text" id="selection1" name="selection1" required>
            </div>

            <div class="form-group">
                <label for="selection2">Selection 2:</label>
                <input type="text" id="selection2" name="selection2" required>
            </div>

            <div class="form-group">
                <label for="selection3">Selection 3:</label>
                <input type="text" id="selection3" name="selection3" required>
            </div>

            <div class="form-group">
                <label for="selection4">Selection 4:</label>
                <input type="text" id="selection4" name="selection4" required>
            </div>
            <div class="form-group">
                <label for="answer">Answer</label>
                <input type="text" id="answer" name="answer" required>
            </div>  
            <input type="number" id="quizid" name="quizid" value="{{$quizId}}" hidden>       
            <div class="button-container">
                <button class="btn-submit">Save</button>
            </div>
        </form>
        <br/><br/>

</body>
</html>
