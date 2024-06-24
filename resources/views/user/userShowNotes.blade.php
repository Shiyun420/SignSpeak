<!DOCTYPE html>
<html lang="en">

@include ('header')

<head>
    <link rel="stylesheet" href="{{ url('css/user/userShowMaterials.css') }}">
</head>

<body>
    @include ('navigation-bar')
    <br/><br/>
    <h1 style="margin: 0 auto;text-align:center;">Notes</h1>
    <br/>
    <div class="card-container">
        @foreach($notes as $note)
            <div class="card" style="padding:20px;background-color:whitesmoke;">
                <h3 style="color:black;">Title: {{ $note->title }}</h3>
                <a href="{{ url('notesFiles/' . $note->noteURL) }}" download> <i class="fas fa-file"></i> {{ $note->noteURL }}</a>
            </div>
        @endforeach
    </div>
</body>
</html>
