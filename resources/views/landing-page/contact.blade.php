@include('template.main1')
<title>{{ $title }}</title>

<body>
  <!-- Navbar -->
  @include('layout.navbar')
  <!-- End Navbar -->

  <!-- Contact -->
  <section id="contact">
    <p class="text1">Contact Us</p>
    <p class="text2">Have a question, message or feedback? go to link below here</p>
    <div class="ig">
      <img src="{{ asset('asset/img/icon/icon-instagram.svg')}}" alt="" />
      <a href="https://www.instagram.com/rupbasanbandung/" target="_blank">rupbasanbandung</a>
    </div>
    <div class="yahoo">
      <img src="{{ asset('asset/img/icon/icon-yahoo.svg')}}" alt="" />
      <a href="mailto:rupbasanbandung@yahoo.com" target="_blank">rupbasanbandung@yahoo.com</a>
    </div>
    <div class="fb">
      <img src="{{ asset('asset/img/icon/icon-facebook.svg')}}" alt="" />
      <a href="https://www.facebook.com/rupbasanbandung" target="_blank">rupbasanbandung</a>
    </div>
  </section>
  <!-- End Contact -->

  <!-- Footer -->
  @include('layout.footer')
  <!-- End Footer -->

  <!-- Javascript -->
  @include ('template.main2')
</body>