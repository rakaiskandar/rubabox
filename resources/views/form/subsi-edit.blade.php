@include ('template.main1')

<title>{{ $title }}</title>
<body class="dashboard">
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
                <div class="col-4 title-uf">Edit Subsi</div>
            </div>
            <div class="form-edit">
                <form action="{{ url('/edit/subsi' )}}" method="post">
                    @csrf
                    <div class="mb-3">
                            <label for="" class="form-label">Subsi Code</label>
                            <input type="text" class="form-control" name="subsi_code" id="" aria-describedby="helpId" placeholder="Type subsi code..." value="{{ $subsi[0]->subsi_code }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Section</label>
                            <input type="text" class="form-control" name="section" id="" aria-describedby="helpId" placeholder="Type section..." value="{{ $subsi[0]->section }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="" aria-describedby="helpId" placeholder="Description section..." required>{{ $subsi[0]->description}}</textarea>
                        </div>
                    <div class="d-flex">
                        <a href="/dashboard/subsi" class="btn btn-danger ms-auto">Back</a>
                        <button type="submit" class="btn btn-warning ms-2">Edit Subsi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('template.main2')
</body>