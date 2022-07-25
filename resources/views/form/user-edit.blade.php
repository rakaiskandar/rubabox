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
                <div class="col-4 title-uf">Edit User</div>
            </div>
            <div class="form-edit">
                <form action="{{ url('/edit/user' )}}" method="post">
                    @csrf
                    <div class="mb-3" hidden>
                      <label for="" class="form-label">ID</label>
                      <input type="text" class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="{{ $user[0]->id }}">
                    </div>
                    <div class="mb-3">
                          <label for="" class="form-label">NIP</label>
                          <input type="text" class="form-control" name="nip" id="nip" aria-describedby="helpId" placeholder="Type user nip..." value="{{ $user[0]->nip }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Type user name..." value="{{ $user[0]->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Type username..." value="{{ $user[0]->username }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Level</label>
                        <select name="level" class="form-select" aria-label="Default select example" required>
                            <option selected>Choose Level</option>
                            <option value="Adpel" {{ $user[0]->level == 'Adpel' ? 'selected' : ''}}>Adpel</option>
                            <option value="Pamlola" {{ $user[0]->level == 'Pamlola' ? 'selected' : ''}}>Pamlola</option>
                            <option value="TU" {{ $user[0]->level == 'TU' ? 'selected' : ''}}>Tata Usaha</option>
                            <option value="Humas" {{ $user[0]->level == 'Humas' ? 'selected' : ''}}>Humas</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Type user email..." value="{{ $user[0]->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Filled this password that you might changed..." value="" required>
                    </div>
                    <div class="d-flex">
                        <a href="/dashboard/user" class="btn btn-danger ms-auto">Back</a>
                        <button type="submit" class="btn btn-warning ms-2">Edit User</button>
                    </div>
                </form>
            </div>
            <br>
        </div>
    </div>
    @include('template.main2')
</body>