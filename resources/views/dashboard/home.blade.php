<!-- Bootstrap, Icon and CSS -->
@include ('template.main1')

<title>{{ $title }}</title>

<body class="dashboard">

    @if(session('success'))
    <div class="position-fixed alert alert-success alert-dismissible fade show fw-bold flex justify-content-center align-items-center text-center" role="alert" style="width: 200px;height:55px;top:10px;left:600px">
        <strong>{{ session('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="wrapper">
        <!-- Sidebar -->
        @include ('layout.sidebar')

        <div class="dashboard-content">
            <div class="row justify-content-between">
                <div class="col-4 title-dashboard">Dashboard</div>
                <div class="col-md-3 title-user justify-content-center">{{ auth()->user()->username }}</div>
            </div>
            <div class="line"></div>

            <div class="quick-access">
                <div class="col-4 title-qa">Quick access</div>
                <div class="qa-icon-box">
                    <a href="/dashboard/subsi" class="qa-icon"><img src="{{ asset('asset/img/icon/subsi.svg')}}" alt=""><br>Subsi</a>
                    <a href="/dashboard/employee" class="qa-icon"><img src="{{ asset('asset/img/icon/employee.svg')}}" alt=""><br>Employee</a>
                    <a href="/dashboard/upload" class="qa-icon"><img src="{{ asset('asset/img/icon/upload.svg')}}" alt=""><br>Upload</a>
                    @if(Auth::guard('admin')->check())
                    <a href="/dashboard/history" class="qa-icon"><img src="{{ asset('asset/img/icon/history.svg')}}" alt=""><br>History</a>
                    @endif
                    <a href="/dashboard/trash" class="qa-icon" id="trash"><img src="{{ asset('asset/img/icon/trash.svg')}}" alt=""><br>Trash</a>
                </div>
            </div>

            <div class="row recent-activity mt-md-5">
                <div class="col recent-upload">
                    <div class="header-ru">
                        <div class="col-4 title-ru-1">Recent Upload</div>
                        <a class="title-ru-2 mt-1" href="/dashboard/upload">See Detail</a>
                    </div>
                    <div class="card border-secondary">
                        <div class="table-responsive">
                            <table class="table table-hover table-light mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th>File Code</th>
                                        <th>File Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Section</th>
                                    </tr>
                                </thead>
                                @foreach($files as $no => $row)
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $row->file_code }}</td>
                                        <td>
                                            <a href="{{ asset('file')}}/{{$row->file}}" target="_blank">{{ $row->file_name}}</a>
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($row->created_at))}}</td>
                                        <td>{{ date('H:i', strtotime($row->created_at))}}</td>
                                        <td>{{ $row->section }}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>

    <!-- Javascript -->
    @include('template.main2')
</body>