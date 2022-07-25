@include('template.main1')
<title>{{ $title }}</title>

<body>
  <!-- Navbar -->
  @include('layout.navbar')
  <!-- End Navbar -->

  <!-- FAQ Accordion -->
  <section id="FAQ">
    <p class="text1">FAQ</p>
    <p class="text2">Frequently Question Asked</p>
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">1. What is RUBABOX ?</button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body"><strong>RUBABOX</strong> is an application that is used to make it easier for us to manage files.</div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">2. What features are in RUBABOX ?</button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Our <strong>features</strong> are Multiple Authentication(Admin, User), Management Files (Upload, History(Admin), Add), 
            and Management Employee include CRUD(Create, Read, Update, Delete) operation for Admin. 
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">3. How to login RUBABOX ?</button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ol>
              <li>Hover over the top right corner of the navigation bar</li>
              <li>then click login button</li>
              <li>Fill in the username and password</li>
              <li>click enter</li>
              <li>and, welcome to <strong>RUBABOX</strong></li>
            </ol>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">4. Why this RUBABOX application was created ?</button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
          <div class="accordion-body">Because we see in <strong>Rupbasan Kelas 1 Bandung</strong> does not have a system that regulates the many of files of each division.</div>
        </div>
      </div>
    </div>
  </section>
  <!-- End FAQ Accordion -->

  <!-- Footer -->
  @include('layout.footer')
 <!-- End Footer -->

  <!-- Javascript -->
  @include('template.main2')
</body>