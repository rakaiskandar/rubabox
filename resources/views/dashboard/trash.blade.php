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

    <div class="wrapper">
        <!-- Sidebar -->
        @include ('layout.sidebar')

        <div class="dashboard-content">
            <div class="row justify-content-between">
                <div class="col-4 title-dashboard">Trash File</div>
                <div class="col-md-3 title-user justify-content-center">{{ auth()->user()->username }}</div>
            </div>
            <div class="line"></div>

            <div class="content-header">
                <div class="col-4 title-hf">Check Trash File</div>
                <div class="col-10 subtitle-hf">Check Your Temporary Deleted File So You Can Manage Easily</div>
            </div>

            <!-- Use Form Input Same in Subsi View -->
            <p class="title-sb">Search Your File</p>
            <form action="{{ url('/search/trash')}}" method="get">
                <div class="input-group mb-4">
                    <input type="text" name="search_trash" class="form-control" placeholder="Type your search..." aria-label="Type your search..." aria-describedby="button-addon2">
                    <button class="btn btn-dark pt-2" type="submit" id="button-addon2"><span class="iconify" data-icon="ant-design:search-outlined" data-width="25" data-height="25" style="display: inline;position:static"></span></button>
                </div>
            </form>

            <div class="d-flex">
                <a href="{{ url('/trash/restore-all') }}" class="btn btn-primary">Restore All</a>
                <a href="{{ url('/trash/delete-all') }}" class="btn btn-danger ms-2">Force Delete All</a>
            </div>

            <div class="card border-secondary mt-md-4">
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
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        @foreach($trash as $no => $row)
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
                                    <a href="{{ url('/trash/restore',$row->file_code)}}" class="btn btn-primary">Restore</a>
                                    <a href="{{ url('/trash/force-delete',$row->file_code)}}" class="btn btn-danger">Force Delete</a>
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