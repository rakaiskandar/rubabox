<!-- Bootstrap, Icon and CSS -->
@include ('template.main1')

<title>{{ $title }}</title>

<body class="dashboard">

    @if(session('success'))
    <div class="position-fixed alert alert-success alert-dismissible fade show fw-bold flex justify-content-center align-items-center text-center" role="alert" style="width: 300px;height:55px;top:10px;left:600px">
        <strong>{{ session('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="position-fixed  m-2 alert-danger fw-bold flex justify-content-center align-items-center p-2 w-10 text-center rounded" style="top:10px; right:20px;">
        <p class="mb-0 ">{{session('error')}}</p>
    </div>
    @endif

    <!-- Form Add Modal Upload -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3" hidden>
                            <label for="" class="form-label">File Code</label>
                            <input type="text" class="form-control" name="file_code" id="file_code" aria-describedby="helpId" placeholder="Type your file code..." value="FL">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">File Name</label>
                            <input type="text" class="form-control @error('file_name') is-invalid @enderror" name="file_name" id="file_name" aria-describedby="helpId" placeholder="Type your file name...">
                            @error('file_name')
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
                        <div class="mb-3">
                            <label for="" class="form-label">Upload File</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file" accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip">
                            <small id="helpId" class="form-text" style="color:red;">*10 mb maximum filesize</small>
                            @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{!!$message!!}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add File</button>
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
                <div class="col-4 title-dashboard">Upload File</div>
                <div class="col-md-3 title-user justify-content-center">{{ auth()->user()->username }}</div>
            </div>

            <div class="line"></div>

            <div class="content-header">
                <div class="col-4 title-uf">File Overview</div>
                <div class="col-8 subtitle-uf">Upload Your File So You Can Manage Easily</div>
            </div>

            <div class="total-add-box">
                <div class="total-box-uf">
                    <p class="col-8 title-tf">Total File</p>
                    <h2 class="col-2 total-tf">{{ $total->count() }}</h2>
                </div>
                <div class="add-box-uf">
                    <p class="col-8 title-af">Add File</p>
                    <a class="col-2 plus-af" href="#addModal" data-bs-toggle="modal" data-bs-target="#addModal">+</a>
                </div>
            </div>

            <div class="d-flex bd-highlight">
                <div class="p-2 flex-grow-1 bd-highlight">
                    <form action="{{ url('/search/file') }}" method="get">
                        <div class="input-group mt-4">
                            <input type="text" name="term" class="form-control flex-fill" placeholder="Type your search..." aria-label="Type your search..." aria-describedby="button-addon2">
                            <button class="btn btn-dark pt-2" type="submit" id="button-addon2"><span class="iconify" data-icon="ant-design:search-outlined" data-width="25" data-height="25" style="display: inline;position:static"></span></button>
                        </div>
                    </form>
                </div>
                <div class="p-2 mt-4 bd-highlight">
                    <form action="{{ url('/see-all/file')}}" method="get">
                        <input type="hidden" name="see_all" value="see-all">
                        <button class="btn btn-primary">See All</button>
                    </form>
                </div>
            </div>

            <div class="card border-secondary mt-1">
                <div class="table-responsive">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>File Code</th>
                                <th>File Name</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($files as $no => $row)
                        <tbody>
                            <tr>
                                <th scope="row">{{ ++$no }}</th>
                                <td>{{ $row->file_code }}</td>
                                <td>
                                    <a href="{{ asset('file')}}/{{$row->file}}" target="_blank">{{ $row->file_name}}</a>
                                </td>
                                <td>{{ $row->type }}</td>
                                <td>{{ date('d/m/Y', strtotime($row->created_at))}}</td>
                                <td>{{ date('H:i', strtotime($row->created_at))}}</td>
                                <td>{{ $row->section }}</td>
                                <td>
                                    <a href="{{ url('/edit/file',$row->file_code )}}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('/delete/file',$row->file_code)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>

            @if(url()->current() != 'see-all')
            <div class="d-flex justify-content-start mt-3">
                {{$files->links('pagination::bootstrap-4')}}
            </div>
            @endif

            <br>
        </div>
    </div>

    <!-- Javascript -->
    @include('template.main2')
</body>