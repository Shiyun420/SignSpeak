<!DOCTYPE html>
<html lang="en">

@include ('header')

<head>
    <link rel="stylesheet" href="{{url('css/admin/addMaterialsView.css')}}">
</head>

    <body>
        @include ('admin.admin-navigation')
        <div>
        <nav aria-label="breadcrumb" style="margin-top:20px;margin-bottom:20px; margin-left:20px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.adminShowQuizzes') }}">Quiz</a> &nbsp;&nbsp;&nbsp;&nbsp;>> </li>
            <li class="breadcrumb-item active" aria-current="page">Add Quiz</li>
        </ol>
        </nav>
        </div>

        <form method="POST" action="{{ route('admin.addQuizzes') }}" enctype="multipart/form-data" class="form-container">
            <h2 style="margin-top:15px;margin-bottom:15px;text-align:center;">Add Quiz</h2>
            @csrf <!-- CSRF protection -->

            <div class="form-group">
                <label for="quizname">Quiz Name:</label>
                <input type="text" id="quizname" name="quizname" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status" value="Open" readonly required>
            </div>        
            <div class="button-container">
                <button class="btn-submit">Next</button>
            </div>
        </form>
        <br/><br/>
    </body>
</html>