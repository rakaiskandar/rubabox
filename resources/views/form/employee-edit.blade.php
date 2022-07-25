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
                <div class="col-4 title-uf">Edit Employee</div>
            </div>

            <div class="form-edit">
                <form action="{{ url('/edit/employee')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">NIP</label>
                        <input type="text" class="form-control" name="nip" id="" aria-describedby="helpId" placeholder="Type employee NIP..." value="{{ $employee[0]->nip }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subsi Code</label>
                        <select name="subsi_code" class="form-select" aria-label="Default select example" required>
                            <option value="">Choose Subsi Code</option>
                            <option value="SBS-1" {{ $employee[0]->subsi_code == 'SBS-1' ? 'selected' : ''}}>SBS-1 - Adpel</option>
                            <option value="SBS-2" {{ $employee[0]->subsi_code == 'SBS-2' ? 'selected' : ''}}>SBS-2 - Pamlola</option>
                            <option value="SBS-3" {{ $employee[0]->subsi_code == 'SBS-3' ? 'selected' : ''}}>SBS-3 - Tata Usaha</option>
                            <option value="SBS-4" {{ $employee[0]->subsi_code == 'SBS-4' ? 'selected' : ''}}>SBS-4 - Humas</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Type employee name..." value="{{ $employee[0]->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Section</label>
                        <input type="text" class="form-control" name="section" id="" aria-describedby="helpId" placeholder="Type employee section..." value="{{ $employee[0]->section }}" required>
                    </div>
                    <div class="d-flex">
                        <a href="/dashboard/employee" class="btn btn-danger ms-auto">Back</a>
                        <button type="submit" class="btn btn-warning ms-2">Edit Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include ('template.main2')
</body>