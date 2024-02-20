@extends('layouts.app')

@section('content')
    <main>
      <section class="container mt-5" style="margin-bottom: 70px">
        <div class="col-12 col-md">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a class="title-alt" href="{{ route('home') }}">Home</a>
              </li>
              <li class="breadcrumb-item main-color">Paket Detail</li>
            </ol>
          </nav>
        </div>

        <div class="col-12 col-md text-center">
          <h1 class="main-color">{{ $travelPackage->name }}</h1>
          <span class="title-alt">{{ $travelPackage->location }}</span>
        </div>
      </section>

      <!--=============== Package Travel ===============-->
      <section class="container detail">
        <div class="swiper mySwiper detail-container">
          <div class="swiper-wrapper">

            @foreach($travelPackage->galleries as $gallery)
                <div class="detail-card swiper-slide">
                    <img
                        src="{{ Storage::url($gallery->path) }}"
                        alt=""
                        class="detail-img"
                    />
                </div>
            @endforeach

          </div>
        </div>

        <div class="row" style="margin-top: 120px">
          <div class="col-12 col-md-12 col-lg-7 mb-5">
            <div class="card border-0 p-2">
              <h3 class="fw-bolder title mb-4">Tentang Paket Wisata</h3>
              {!! $travelPackage->description !!}
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-5">
            <div class="card bordered card-form" style="padding: 30px 40px">
              <h4 class="text-center">Start Booking</h4>
              <div
                class="alert alert-secondary"
                style="background-color: #f5f5f5; border: 1px solid #f5f5f5"
                role="alert"
              >
                Duration: {{ $travelPackage->duration }}
              </div>
              <div
                class="alert alert-secondary"
                style="background-color: #f5f5f5; border: 1px solid #f5f5f5"
                role="alert"
              >
                Harga :
                <span class="text-gray-500 font-weight-light"
                  >IDR.{{ number_format($travelPackage->price) }}</span
                >
              </div>

            <div class="card-bank d-flex align-items-center justify-content-around">
                <img height="40" width="80" src="https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Forms.max-2800x2800.png" alt="">
                <div class="card-bank-content d-flex flex-column">

                </div>
                <!-- Form for inputting name, address, email, and phone -->
                <form action="/invoice/{{ $travelPackage->id }}" method="get">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="car">Select Car:</label>
                        <br>
                        <?php foreach($cars as $car): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="car" id="car<?= $car->id ?>" value="<?= $car->id ?>">
                                <label class="form-check-label" for="car<?= $car->id ?>">
                                    <?= $car->name ?> - Price: <?= $car->price ?> - Duration: <?= $car->duration ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <br>

             </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                     </form>

            </div>
          </div>
        </div>
      </section>
    </main>
@endsection

@push('style-alt')
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swipper/css/style.css') }}">
    <style>
        .swiper-container-3d .swiper-slide-shadow-left,
        .swiper-container-3d .swiper-slide-shadow-right {
        background-image: none;
      }
      figure{
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
      figure table {
        --bs-table-bg: transparent;
        --bs-table-accent-bg: transparent;
        --bs-table-striped-color: #212529;
        --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
        --bs-table-active-color: #212529;
        --bs-table-active-bg: rgba(0, 0, 0, 0.1);
        --bs-table-hover-color: #212529;
        --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        vertical-align: top;
        border-color: #dee2e6;
      }

      tbody, td, tfoot, th, thead, tr {
        border-color: inherit;
        border-style: solid;
      }
      table>:not(caption)>*>*{
        border: 1px solid #dee2e6;
      }
      table>:not(caption)>*>* {
        padding: 0.5rem 0.5rem;
        background-color: transparent;
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px transparent;
      }
    </style>
@endpush

@push('script-alt')
    <script src="{{ asset('frontend/assets/libraries/swipper/js/app.js') }}"></script>
     <script>
      var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        loop: true,
        spaceBetween: 32,
        coverflowEffect: {
          rotate: 0,
        },
      });
    </script>
@endpush
