<!-- Bootstrap, Icon and CSS -->
@include ('template.main1')

<title>{{ $title }}</title>

<body class="dashboard">
    
    @if(session('success'))
    <div class="position-fixed alert alert-success alert-dismissible fade show fw-bold flex justify-content-center align-items-center text-center" role="alert" style="width: 270px;height:55px;top:10px;left:600px">
        <strong>{{ session('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="position-fixed  m-2 alert-danger fw-bold flex justify-content-center align-items-center p-2 w-10 text-center rounded" style="top:10px; right:20px;">
        <p class="mb-0 ">{{session('error')}}</p>
    </div>
    @endif

    <!-- Form Add Modal Employee -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" aria-describedby="helpId" placeholder="Type employee NIP...">
                            @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" placeholder="Type employee name...">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Subsi Code</label>
                            <select name="subsi_code" class="form-select @error('subsi_code') is-invalid @enderror" aria-label="Default select example">
                                <option value="">Choose Subsi Code</option>
                                @foreach ($subsi as $value)
                                <option>{{ $value->subsi_code }}</option>
                                @endforeach
                            </select>
                            @error('subsi_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Section</label>
                          <select class="form-select @error('section') is-invalid @enderror" name="section" id="section" aria-label="Default select example">
                            <option value="">Section</option>
                            @foreach ($subsi as $value)
                            <option>{{ $value->section }}</option>
                            @endforeach
                          </select>
                          @error('section')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Employee</button>
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
                <div class="col-4 title-employee">Employee Overview</div>
                <div class="col-4 subtitle-employee">Manage Your Employee</div>
            </div>

            <div class="total-add-box">
                <div class="total-box-e">
                    <p class="col-8 title-te">Total Employee</p>
                    <h2 class="col-2 total-te">{{ $total->count() }}</h2>
                </div>
                @if (Auth::guard('admin')->check())
                <div class="add-box-e">
                    <p class="col-8 title-ae">Add Employee</p>
                    <a class="col-2 plus-ae" href="#addModal" data-bs-toggle="modal" data-bs-target="#addModal">+</a>
                </div>
                @endif
            </div>

            <!-- Search Bar -->
            <form action="{{ url('/search/employee')}}" method="get">
                <div class="input-group mb-3 mt-4">
                    <input type="text" name="term" class="form-control" placeholder="Type your search..." aria-label="Type your search..." aria-describedby="button-addon2">
                    <button class="btn btn-dark pt-2" type="submit" id="button-addon2"><span class="iconify" data-icon="ant-design:search-outlined" data-width="25" data-height="25" style="display: inline;position:static"></span></button>
                </div>
            </form>

            <div class="card border-secondary mt-md-4">
                <div class="table-responsive">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>NIP</th>
                                <th>Name</th>
                                <th>Subsi Code</th>
                                <th>Section</th>
                                @if(Auth::guard('admin')->check())
                                <th colspan="2">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @foreach($employee as $no => $row)
                        <tbody>
                            <tr>
                                <th scope="row">{{ ++$no }}</th>
                                <td>{{ $row->nip }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->subsi_code }}</td>
                                <td>{{ $row->section }}</td>
                                @if(Auth::guard('admin')->check())
                                <td>
                                    <a href="{{ url('/edit/employee',$row->nip)}}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('/delete/employee',$row->nip)}}" class="btn btn-danger">Delete</a>
                                </td>
                                @endif
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-start mt-3">
                {{$employee->links('pagination::bootstrap-4')}}
            </div>

            <br>
        </div>
    </div>

    <!-- Javascript -->
    @include('template.main2')
</body>