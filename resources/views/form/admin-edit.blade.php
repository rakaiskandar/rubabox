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
                <div class="col-4 title-uf">Edit Admin</div>
            </div>

            <div class="form-edit">
                <form action="{{ url('/edit/admin') }}" method="post">
                    @csrf
                    <div class="mb-3" hidden>
                      <label for="" class="form-label">ID</label>
                      <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="" value="{{ $admin[0]->id }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Type admin username..." value="{{ $admin[0]->username }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Level</label>
                        <select name="level" class="form-select" aria-label="Default select example" required>
                            <option selected>Choose Level</option>
                            <option value="Adpel" {{ $admin[0]->level == 'Adpel' ? 'selected' : ''}}>Adpel</option>
                            <option value="Pamlola" {{ $admin[0]->level == 'Pamlola' ? 'selected' : ''}}>Pamlola</option>
                            <option value="TU" {{ $admin[0]->level == 'TU' ? 'selected' : ''}}>Tata Usaha</option>
                            <option value="Humas" {{ $admin[0]->level == 'Humas' ? 'selected' : ''}}>Humas</option>
                        </select>
                    </div>
                    <div class="mb-2 col-md-12">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Type admin email..." value="{{ $admin[0]->email }}">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder="Filled this password that you might changed..." required>
                    </div>
                    <div class="d-flex">
                        <a href="/dashboard/admin" class="btn btn-danger ms-auto">Back</a>
                        <button type="submit" class="btn btn-warning ms-2">Edit Admin</button>
                    </div>
                </form>
            </div>
            <br>
        </div>
    </div>

    @include('template.main2')
</body>