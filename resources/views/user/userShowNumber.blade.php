<!DOCTYPE html>
<html lang="en">

@include ('header')

<head>
    <link rel="stylesheet" href="{{ url('css/user/userShowMaterials.css') }}"> 
</head>

<body>
    @include ('navigation-bar')

    <div class="button-container">
        <h3 style="margin-bottom:20px;">CATEGORY</h3>
        <a href="{{route('user.userShowMaterials')}}" class="btn btn-outline-darkBlue">Alphabet</a>
        <a href="{{route('user.userShowNumber')}}" class="btn btn-outline-darkBlue active">Number</a>
        <a href="{{route('user.userShowOther')}}" class="btn btn-outline-darkBlue">Basic Words</a>
    </div>

    <div class="card-container">
        @foreach($materials as $index => $material)
            <div class="card">
                <a href="{{route('user.showMaterialDetails', $material->id)}}"><img src="{{ route('admin.getImage', $material->id) }}" alt="Image"></a>
                <a href="{{route('user.showMaterialDetails', $material->id)}}"><h5>{{ $material->title }}</h5></a>
            </div>
        @endforeach
    </div>
    <br/><br/>
</body>
</html>