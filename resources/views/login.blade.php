@include('template.main1')
<title>{{ $title }}</title>

<body class="login">

  <div class="wrapper">
    <div class="sidebar">
      <div class="logo">
        <img src="{{ asset('asset/img/logo/logo_type.svg')}}" alt="">
      </div>
      <h1 class="login-header">Login</h1>

      @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 400px;height:55px;left:40px;top:10px">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Check your username or password!</strong>
      </div>
      @endif

      <form action="{{ route('postLogin')}}" method="post">
        @csrf
        <div class="group-login">
          <div class="mb-3">
            <label class="mt-1">Username</label><br>
            <input type="text" class="@error('name') is-invalid @enderror form-control" name="username" id="username" aria-describedby="helpId" placeholder="" required>
              @error('name')
              <div class="alert alert-danger">
                {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" class="@error('password') is-invalid @enderror form-control" name="password" id="password" aria-describedby="helpId" placeholder="" required>
              @error('password')
              <div class="alert alert-danger">
                {{ $message }}
              </div>
              @enderror
          </div>
          <button type="submit" class="btn">Login</button>
        </div>
      </form>
    </div>

    <div class="label">
      <div class="title-label">
        <h1>Hello, Rupbasan Kelas 1 <br>Bandung</h1>
      </div>
      <div class="label-img">
        <img src="{{ asset('asset/img/ilustration/ilustration1.svg')}}" alt="">
      </div>
    </div>

    <div class="logo-smk">
      <img src="{{ asset('asset/img/logo/logo_smk.svg')}}" alt="">
    </div>

    <div class="logo-rb">
      <img src="{{ asset('asset/img/logo/logo_rupbasan.svg')}}" alt="">
    </div>

  </div>

  <!-- Javascript -->
  @include('template.main2')
</body>