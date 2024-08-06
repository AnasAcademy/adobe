<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Sidebar Styles */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40; /* Dark background color */
            color: #ffffff; /* Text color */
            padding-top: 20px;
        }

        #sidebar h5 {
            padding: 20px 20px 10px;
            color: #17a2b8; /* Title color */
        }

        #sidebar .nav-link {
            color: #ffffff;
            transition: color 0.3s; /* Smooth color transition */
        }

        /* Change link color to black when hovered */
        #sidebar .nav-link:hover {
            color: #000000; /* Black color on hover */
        }

        /* Change the active link background color */
        #sidebar .nav-item.active .nav-link {
            background-color: #292b2c; /* Darker background for active link */
        }

        /* Change the text color of active links */
        #sidebar .nav-item.active .nav-link {
            color: #000000; /* Black text color for active links */
        }

        /* Main Content Styles (adjust as needed) */
        .main-content {
            margin-left: 250px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <h5 class="nav-link">Dashboard</h5>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="codes">
                                Codes
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="emails">
                                Emails
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('add_email') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail">Add new Email</label>
                                    <input type="text" name="email_address" class="form-control" id="exampleInputEmail" placeholder="Enter Email">
                                </div>
                                @if ($errors->has('email_address'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('email_address') }}
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('emailExcel') }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Choose Excel file:</label>
                                    <input type="file" name="file" class="form-control" accept=".xlsx, .csv">
                                </div>
                                <button type="submit" class="btn btn-success">Import</button>
                            </form>
                        </div>
                    </div>
                </div>
                <h1> <b>Emails</b></h1>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Emails</th>
                        <th scope="col">Code Count</th>
                        <th scope="col"> Verification Code </th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(!empty($emails))
                        @foreach ($emails as $email)
                            <tr>
                                <td>{{ $email->email_address }}</td>
                                <td>{{ $email->code_count }}</td>
                                <td>
                                @if ($email->verification_code)
                                    {{ $email->verification_code }}
                                @else
                                 No verification code sent.
                                @endif
                                </td>
                                 <td>
                                    <div style="display: inline-block; margin-right: 10px;">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$email->id}}">Edit</button>
                                    </div>
                                    <div style="display: inline-block;">
                                    <form action="{{ route('emails.destroy', $email->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </div>
                                </td>
                              </tr>
                        @endforeach
                        @endif
                    </tbody>
                  </table>
                  {{-- editmodel --}}
                  @foreach ($emails as $email)
                    <div class="modal fade" id="editModal{{$email->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$email->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('emails.update', $email->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{$email->id}}">Edit Email</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="email{{$email->id}}">Email</label>
                                            <input type="text" class="form-control" id="email{{$email->id}}" name="email_address" value="{{$email->email_address}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </main>
        </div>
    </div>


</body>
</html>
