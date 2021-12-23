<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

</head>

<body class="antialiased" style="padding: 5%;">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-success" data-bs-toggle="modal" data-bs-target="#createteam">
        Add new Team
    </button>
    <table class="table table-hover table-striped ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" colspan="2">Id</th>
                <th scope="col" colspan="2">Doctors</th>
                <th scope="col" colspan="2">Nurses</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $index => $team)
            <tr>
                <th scope="row">{{$index + 1}}</th>
                <td colspan="2">{{$team->Id}}</td>
                <td colspan="2">
                    @foreach ( $teamDocs as $teamDoc)
                    @if ($teamDoc[1] == $team->Id)
                    {{$teamDoc[0]->name}}<br>
                    @endif
                    @endforeach
                </td>
                <td colspan="2">
                    @foreach ( $teamNurs as $teamNur)
                    @if ($teamNur[1] == $team->Id)
                    {{$teamNur[0]->name}}<br>
                    @endif
                    @endforeach
                </td>
                <td><button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#deleteteam{{ $team->Id }}">
                        Delete </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateteam{{ $team->Id }}">
                        Edit </button>
                </td>
            </tr>


            <!-- update team Modal -->
            <div class="modal fade" id="updateteam{{ $team->Id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('teams.update',$team->Id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Doctors</label>


                                    <select name="doctorSelector[]" class="selectpicker" multiple data-live-search="true">

                                        @foreach ($doctors as $index => $doctor)
                                        <option>{{$doctor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Doctors</label>


                                    <select name="nurseSelector[]" class="selectpicker" multiple data-live-search="true">

                                        @foreach ($nurses as $index => $nurse)
                                        <option>{{$nurse->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- delete team Modal -->
            <div class="modal fade" id="deleteteam{{ $team->Id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('teams.destroy',$team->Id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Are you sure ou want to delete this Team?</label>
                                </div>


                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </tbody>
    </table>



    <!-- create team Modal -->
    <div class="modal fade" id="createteam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('teams.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Doctors</label>


                            <select name="doctorSelector[]" class="selectpicker" multiple data-live-search="true">

                                @foreach ($doctors as $index => $doctor)
                                <option>{{$doctor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nurses</label>

                            <select name="nurseSelector[]" class="selectpicker" multiple data-live-search="true">

                                @foreach ($nurses as $index => $nurses)
                                <option>{{$nurses->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Teams</button>
                    </div>
                </form>
            </div>
        </div>
    </div>







    <div class="container">
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ( $errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{Session::get('success')}}</p>
        </div>

        @endif
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>