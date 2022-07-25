@include('template.main1')
<title>{{ $title }}</title>

<body id="home">
  <!-- Navbar -->
  @include('layout.navbar')
  <!-- End Navbar -->

  <!-- Hero -->
  <section>
    <p class="text1">Manage all file and document in one website</p>
    <p class="text2">File management system Rupbasan Kelas 1 Bandung</p>
    <div class="flatline position-absolute top-50 start-50 translate-middle">
      <img src="{{ asset('asset/img/ilustration/home.svg')}}" alt="" width="500" height="721" />
    </div>
    <a href="{{ asset('Manual Book.pdf')}}" target="_blank" class="docs">Download Manual Book</a>
  </section>
  <!-- End Hero -->

  <!-- Footer -->
  @include('layout.footer')
  <!-- End Footer -->

  <!-- Javascript -->
  @include('template.main2')
</body>