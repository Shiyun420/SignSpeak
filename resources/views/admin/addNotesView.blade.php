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
            <li class="breadcrumb-item"><a href="{{ route('admin.adminShowNotes') }}">Notes</a> &nbsp;&nbsp;&nbsp;&nbsp;>> </li>
            <li class="breadcrumb-item active" aria-current="page">Add Notes</li>
        </ol>
        </nav>
        </div>

        <form method="POST" action="{{ route('admin.addNotes') }}" enctype="multipart/form-data" class="form-container">
            <h2 style="margin-top:15px;margin-bottom:15px;text-align:center;">Add Notes</h2>
            @csrf <!-- CSRF protection -->

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>        
            <div class="form-group">
                <label for="noteURL">Note:</label>
                <input type="file" id="noteURL" name="noteURL" required>
            </div>
            <div class="button-container">
                <button class="btn-submit" type="submit">Save</button>
            </div>
        </form>
        <br/><br/>
    </body>
</html>