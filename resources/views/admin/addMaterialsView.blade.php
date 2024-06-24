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
            <li class="breadcrumb-item"><a href="{{ route('admin.adminShowMaterials') }}">Learning Materials</a> &nbsp;&nbsp;&nbsp;&nbsp;>> </li>
            <li class="breadcrumb-item active" aria-current="page">Add Materials</li>
        </ol>
        </nav>
        </div>

        <form method="POST" action="{{ route('admin.addMaterials') }}" enctype="multipart/form-data" class="form-container">
            <h2 style="margin-top:15px;margin-bottom:15px;text-align:center;">Add Learning Materials</h2>
            @csrf <!-- CSRF protection -->

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" required>
            </div>        
            <div class="form-group">
                <label for="videoURL">Video:</label>
                <input type="file" id="videoURL" name="videoURL" required>
            </div>
            <div class="form-group">
                <label for="audioURL">Audio:</label>
                <input type="file" id="audioURL" name="audioURL" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">-- Select Category --</option>
                    <option value="number">Number</option>
                    <option value="alphabet">Alphabet</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="button-container">
                <button class="btn-submit" type="submit">Save</button>
            </div>
        </form>
        <br/><br/>
    </body>
</html>