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
        @include ('admin.admin-navigation')

        <br/><br/>
        <h2 style="text-align:center;">Manage Learning Materials</h2>
        <div class="button-container">
        <a class="btn btn-outline-blue" href="{{route('admin.addMaterialsView')}}">
                <i class="fas fa-plus-circle"></i> Add Learning Materials
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
            <th>Title</th>
            <th>Description</th>
            <th>ACTIONS</th> <!-- Add a new table header for actions -->
            </tr>
        </thead>
  <tbody>
    
    @foreach($materials as $index => $material)
      <tr>
          <td>{{$index+1}}</td>
          <td>{{$material->title}}</td>
          <td>{{$material->description}}</td>
          <td>
            <!-- Button group with icons for view, edit, delete -->
          <div class="d-flex justify-content-between p-2">
            <a class="btn btn-outline-info" href="{{route('admin.editMaterialsView',$material->id)}}">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a class="btn btn-outline-danger" href="{{route('admin.deleteMaterials',$material->id)}}" onclick="return confirm('Are you sure you want to delete this material?')">
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
