<!-- Bootstrap, Icon and CSS -->
@include ('template.main1')

<title>{{ $title }}</title>

<body class="dashboard">

    @if(session('success'))
    <div class="position-fixed alert alert-success alert-dismissible fade show fw-bold flex justify-content-center align-items-center text-center" role="alert" style="width: 250px;height:55px;top:10px;left:600px">
        <strong>{{ session('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="position-fixed  m-2 alert-danger fw-bold flex justify-content-center align-items-center p-2 w-10 text-center rounded" style="top:10px; right:20px;">
        <p class="mb-0 ">{{session('error')}}</p>
    </div>
    @endif

    <!-- Form Modal Add Admin -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" aria-describedby="helpId" placeholder="Type username for admin..,">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Level</label>
                            <select name="level" class="form-select @error('level') is-invalid @enderror" aria-label="Default select example">
                                <option value="">Level</option>
                                @foreach ($subsi as $value)
                                <option>{{ $value->section }}</option>
                                @endforeach
                            </select>
                            @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="helpId" placeholder="Type admin email...">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" aria-describedby="helpId" placeholder="Type admin password...">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <!-- Sidebar -->
        @include ('layout.sidebar')

        <div class="dashboard-content">
            <div class="row justify-content-between">
                <div class="col-4 title-dashboard">Master Data</div>
                <div class="col-md-3 title-user justify-content-center">{{ auth()->user()->username }}</div>
            </div>
            <div class="line"></div>

            <div class="content-header">
                <div class="col-4 title-subsi">Admin Overview</div>
                <div class="col-4 subtitle-subsi">Manage Your Admin</div>
            </div>

            <div class="total-add-box">
                <div class="total-box-ad">
                    <p class="col-12 title-am">Total Admin</p>
                    <h2 class="col-2 total-am">{{ $admin->count() }}</h2>
                </div>
                <div class="add-box">
                    <p class="col-12 title-ad">Add Admin</p>
                    <a class="col-2 plus-tab" href="#addModal" data-bs-toggle="modal" data-bs-target="#addModal">+</a>
                </div>
            </div>

            <div class="card border-secondary mt-md-4">
                <div class="table-responsive">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Email</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        @foreach($admin as $no => $row)
                        <tbody>
                            <tr>
                                <th scope="row">{{++$no}}</th>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->level }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    <a href="{{ url('/edit/admin',$row->id)}}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('/delete/admin',$row->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <br>
        </div>
    </div>

    <!-- Javascript -->
    @include('template.main2')
</body>