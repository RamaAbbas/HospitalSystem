<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body class="antialiased" style="padding: 5%;">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-success" data-bs-toggle="modal" data-bs-target="#createPatient">
        Add new Patient
    </button>
    <table class="table table-hover table-striped ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" colspan="2">Name</th>
                <th scope="col" colspan="2">Age</th>
                <th scope="col" colspan="2">Gender</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $index => $patient)
            <tr>
                <th scope="row">{{$index +1}}</th>
                <td colspan="2">{{$patient->name}}</td>
                <td colspan="2">{{$patient->age}}</td>
                <td colspan="2">{{$patient->gender}}</td>
                <td><button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#deletePatient{{ $patient->Id }}">
                        Delete </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePatient{{ $patient->Id }}">
                        Edit </button>
                </td>
            </tr>
            <!-- update patient Modal -->
            <div class="modal fade" id="updatePatient{{ $patient->Id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('patients.update',$patient->Id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Patient's name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Age</label>
                                    <input type="text" name="age" class="form-control" placeholder="Patient's age">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <input type="text" name="gender" class="form-control" placeholder="Patient's gender">
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


            <!-- delete patient Modal -->
            <div class="modal fade" id="deletePatient{{ $patient->Id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('patients.destroy',$patient->Id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Are you sure ou want to delete this Patient?</label>
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



    <!-- create patient Modal -->
    <div class="modal fade" id="createPatient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Patient's name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="text" name="age" class="form-control" placeholder="Patient's age">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <input type="text" name="gender" class="form-control" placeholder="Patient's gender">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>