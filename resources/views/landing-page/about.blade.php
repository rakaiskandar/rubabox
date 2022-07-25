@include('template.main1')
<title>{{ $title }}</title>

<body>
  <!-- Navbar -->
  @include('layout.navbar')
  <!-- End Navbar -->

  <!-- About -->
  <section id="about">
    <p class="text1">About Us</p>
    <p class="text2">Let’s get acquainted!</p>
    <div class="ilusAbout">
      <img src="{{ asset('asset/img/ilustration/about1.svg')}}" alt="" />
    </div>
    <p class="text3">Benefit</p>
    <p class="text4">This Rubabox application is used to make it easier for you as a Rupbasan Kelas 1 Bandung employee to store important files.</p>
    <p class="text5">Excess</p>
    <p class="text6">This app can know what files you uploaded and how many files you uploaded today.</p>
    <div class="ilusAbout2">
      <img src="{{ asset('asset/img/ilustration/about2.svg')}}" alt="" />
    </div>
  </section>
  <!-- End About -->

  <!-- Footer -->
  @include('layout.footer')
  <!-- End Footer -->

  <!-- Javascript -->
  @include('template.main2')
</body>