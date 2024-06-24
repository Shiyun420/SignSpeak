<!DOCTYPE html>
<html lang="en">

@include ('header')

<head>
    <link rel="stylesheet" href="{{url('css/admin/adminShowMaterials.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

    <body>
        @include ('navigation-bar')

        <br/><br/>
        <h2 style="text-align:center;">Quiz</h2>
        <div class="button-container">
        <a class="btn btn-outline-blue" href="{{route('user.showQuizzesRecord')}}">
                <i class="fas fa-eye"></i> View History
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
            <th>Quiz Name</th>
            <th>Total Questions</th>
            <th>Status</th>
            <th>ACTIONS</th> <!-- Add a new table header for actions -->
            </tr>
        </thead>
  <tbody>
    
    @foreach($quizzes as $index => $quiz)
      <tr>
          <td style="width:10%">{{$index+1}}</td>
          <td style="width:30%">{{$quiz->quizname}}</td>
          <td style="width:20%">{{$quiz->totalquestions}}</td>
          <td style="width:20%">{{$quiz->status}}</td>
          <td style="width:20%">
          <div class="d-flex justify-content-between p-2">
          <a class="btn btn-outline-info" href="{{route('user.userQuizDetails',$quiz->id)}}">
                <i class="fas fa-pen-fancy"></i> Start
            </a>
          </div>
          </td>
      </tr>
    @endforeach
  
  </tbody>
</table>
    </body>
</html>
