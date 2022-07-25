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
    
    <!-- Form Add Modal Subsi -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Subsi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subsi.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Subsi Code</label>
                            <input type="text" class="form-control @error('subsi_code') is-invalid @enderror" name="subsi_code" id="subsi_code" aria-describedby="helpId" placeholder="Type subsi code...">
                            @error('subsi_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Section</label>
                            <input type="text" class="form-control @error('section') is-invalid @enderror" name="section" id="section" aria-describedby="helpId" placeholder="Type section...">
                            @error('section')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" aria-describedby="helpId" placeholder="Description section..."></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Subsi</button>
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
                <div class="col-4 title-subsi">Subsi Overview</div>
                <div class="col-4 subtitle-subsi">Manage Your Subsi</div>
            </div>

            <div class="total-add-box">
                @if (Auth::guard('admin')->check())
                <div class="add-box">
                    <p class="col-8 title-ab">Add Subsi</p>
                    <a class="col-2 plus-tab" href="#addModal" data-bs-toggle="modal" data-bs-target="#addModal">+</a>
                </div>
                @endif
            </div>

            <div class="card border-secondary mt-md-4">
                <div class="table-responsive">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>Subsi Code</th>
                                <th>Section</th>
                                <th>Description</th>
                                @if(Auth::guard('admin')->check())
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        @foreach($subsi as $no => $row)
                        <tbody>
                            <tr>
                                <th scope="row">{{ ++$no }}</th>
                                <td>{{ $row->subsi_code }}</td>
                                <td>{{ $row->section }}</td>
                                <td>{{ $row->description }}</td>
                                @if(Auth::guard('admin')->check())
                                <td>
                                    <a href="{{ url('/edit/subsi',$row->subsi_code)}}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('/delete/subsi',$row->subsi_code)}}" class="btn btn-danger">Delete</a>
                                </td>
                                @endif
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