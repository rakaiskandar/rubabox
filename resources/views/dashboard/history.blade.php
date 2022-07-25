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
    
    <div class="wrapper">
        <!-- Sidebar -->
        @include ('layout.sidebar')

        <div class="dashboard-content">
            <div class="row justify-content-between">
                <div class="col-4 title-dashboard">History</div>
                <div class="col-md-3 title-user justify-content-center">{{ auth()->user()->username }}</div>
            </div>
            <div class="line"></div>

            <div class="content-header">
                <div class="col-8 title-hf">Check History Activity</div>
                <div class="col-8 subtitle-hf">Check Activity So You Can Manage Easily</div>
            </div>

            <div class="d-flex mt-3">
                <a href="/delete/history" class="btn btn-danger">Delete All</a>
            </div>

            <div class="card border-secondary mt-md-4">
                <div class="table-responsive">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Section</th>
                                <th>Activity</th>
                                <th>Location Activity</th>
                                <th>Timestamps</th>
                            </tr>
                        </thead>
                        @foreach($history as $no => $row)
                        <tbody>
                            <tr>
                                <th scope="row">{{ ++$no }}</th>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->position }}</td>
                                <td>{{ $row->section }}</td>
                                <td><strong>{{ $row->activity }}</strong></td>
                                <td><strong>{{ $row->location_activity }}</strong></td>
                                <td>{{ $row->created_at }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-start mt-3">
                {{ $history->links('pagination::bootstrap-4')}}
            </div>
            <br>
        </div>
    </div>

    <!-- Javascript -->
    @include('template.main2')
</body>