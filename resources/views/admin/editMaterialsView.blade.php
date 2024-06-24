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
        <li><a href="{{route('admin.adminShowMaterials')}}" class="nav-item nav-link active">LEARNING MATERIAL</a></li>
        <li><a href="{{route('admin.adminShowNotes')}}" class="nav-item nav-link active">NOTE</a></li>
        <li><a href="{{route('admin.adminShowQuizzes')}}" class="nav-item nav-link">QUIZ</a></li>
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
        <li class="breadcrumb-item"><a href="{{ route('admin.adminShowMaterials') }}">Learning Materials</a></li>
        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;>> &nbsp;&nbsp;&nbsp;&nbsp;Edit Materials</li>
    </ol>
</div>
<br/>
    <form method="POST" action="{{ route('admin.editMaterials', $material->id) }}" enctype="multipart/form-data" class="form-container">
        <h2 style="margin-top:15px;margin-bottom:15px;text-align:center;">Edit Learning Materials</h2>
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
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $material->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="{{ $material->description }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            <label>The current image:</label>
            <img src="{{ route('admin.getImage', $material->id) }}" alt="Current Image" style="max-width: 200px; max-height: 200px;">
        </div>
        <div class="form-group">
            <label for="videoURL">Video:</label>
            <input type="file" id="videoURL" name="videoURL">
            <label>The current video:</label>
            <video src="{{ asset('materialsVideo/' . $material->videoURL) }}" controls style="max-width: 400px; max-height: 400px;"></video>
        </div>
        <div class="form-group">
            <label for="audioURL">Audio:</label>
            <input type="file" id="audioURL" name="audioURL">
            <label>The current audio:</label>
            <audio src="{{ asset('materialsAudio/' . $material->audioURL) }}" controls style="max-width: 400px;"></audio>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">-- Select Category --</option>
                <option value="number" {{ $material->category == 'number' ? 'selected' : '' }}>Number</option>
                <option value="alphabet" {{ $material->category == 'alphabet' ? 'selected' : '' }}>Alphabet</option>
                <option value="others" {{ $material->category == 'others' ? 'selected' : '' }}>Others</option>
            </select>
        </div>
        <div class="button-container">
            <button class="btn-submit" type="submit">Save</button>
        </div>
    </form>
    <br /><br />

</body>
</html>