@extends('layouts.site')

@section('content')
  <!-- Hero Carousel Start -->
  <!-- Static Hero Section Start -->
  <div class="gbase-static-hero-wrapper">

    @php $hero = $sections['hero']['content'] ?? []; @endphp
    <!-- Item 1: Image Left, Text Right -->
    <div class="gbase-hero-static-item" style="background-color: #fff; padding: 20px 0px 0px 0px;">
      <div class="container">
        <div class="column align-items-center">
          <div class="col-lg-12 mb-2 mb-lg-0 text-center">
            <img src="{{ \App\Models\PageSection::resolveImage($hero['image'] ?? null) }}" alt="{{ $hero['heading'] ?? '' }}" class="img-fluid rounded"
              style="max-width: 70vw; object-fit: cover;">
          </div>
          <div class="col-lg-12 align-items-center justify-content-center">
            <div class="gbase-hero-content ps-lg-5">
              <h2 class="title animate__animated animate__fadeInUp"
                style="color: #000; font-size: 50px; font-weight: 700; margin-bottom: 20px; text-align: center;">
                {{ $hero['heading'] ?? '' }}</h2>
              <p class="desc animate__animated animate__fadeInUp"
                style="color: #222222; font-size: 24px; margin-bottom: 30px; animation-delay: 0.2s; text-align: center;">
                {{ $hero['description'] ?? '' }}
              </p>
              <div class="btn-wrapper animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <a href="{{ $hero['primary_button_link'] ?? '#' }}" target="_blank" class="theme-btn"
                  style="background: #cff480; color: #292929; border:none;">{{ $hero['primary_button_text'] ?? '' }}</a>
                <a href="{{ $hero['secondary_button_link'] ?? '#' }}" class="theme-btn style-outline"
                  style="margin-left: 15px; background: #ffffff; color: #000000; border: none;">{{ $hero['secondary_button_text'] ?? '' }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="gbase-hero-static-item" style="background-color: #fff; padding: 60px 0;">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
              <div class="gbase-hero-content pe-lg-5">
                <h2 class="title animate__animated animate__fadeInUp" style="color: #071b3a; font-size: 50px; font-weight: 700; margin-bottom: 20px;">Global Leaders in IQF Technology</h2>
                <p class="desc animate__animated animate__fadeInUp" style="color: #555; font-size: 18px; margin-bottom: 30px; animation-delay: 0.2s;">
                  OctoFrost™ innovative design for Premium IQF processing
                </p>
                <div class="btn-wrapper animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                  <a href="E-Brochure Final.pdf" target="_blank" class="theme-btn" style="background: #071b3a; color: #fff;">Download Brochure</a>
                  <a href="/contact.html" class="theme-btn style-outline" style="margin-left: 15px; background: #cff480; color: #000000; border: none;">Contact Us</a>
                </div>
              </div>
            </div>
             <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0 text-center">
               <img src="images/product/4.png" alt="IQF Technology" class="img-fluid rounded shadow-lg" style="max-height: 400px; width: auto; max-width: 100%; object-fit: cover;">
            </div>
          </div>
        </div>
      </div>

      <div class="gbase-hero-static-item" style="background-color: #071b3a; padding: 60px 0;">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 text-center">
               <img src="images/product/2.png" alt="Grading Technology" class="img-fluid rounded shadow-lg" style="max-height: 400px; width: auto; max-width: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-12">
              <div class="gbase-hero-content ps-lg-5">
                <h2 class="title animate__animated animate__fadeInUp" style="color: #fff; font-size: 50px; font-weight: 700; margin-bottom: 20px;">Market leader in grading technology</h2>
                <p class="desc animate__animated animate__fadeInUp" style="color: #ecc; font-size: 18px; margin-bottom: 30px; animation-delay: 0.2s;">
                  GREEFA Simple machines for your high quality fruits Receiving, Washing, Sorting, Packing 
                </p>
                <div class="btn-wrapper animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                  <a href="E-Brochure Final.pdf" target="_blank" class="theme-btn" style="background: #cff480; color: #292929; border:none;">Download Brochure</a>
                  <a href="/contact.html" class="theme-btn style-outline" style="margin-left: 15px; background: #ffffff; color: #000000; border: none;">Contact Us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

  </div>
  <!-- Hero Carousel End -->

  <!-- Slider Section Start -->
  <!-- <div class="slider-area style-1">
      <div class="container">
        <div class="section-title">
          <div class="row d-flex justify-content-xl-between">
            <div class="col-lg-7">
              <div
                class="sec-content wow animate__animated animate__fadeInUp animate__fast"
              >
                <h2 class="title">
                  Your trusted partner in Fruits and Vegetable Processing.
                </h2>
              </div>
            </div>
            <div class="col-xxl-4 col-lg-5 px-lg-0 px-xl-2">
              <div
                class="sec-desc wow animate__animated animate__fadeInUp animate__fast"
              >
                <p class="desc">
                  Our team of experienced technicians and designers is equipped
                  to support our customer needs. Import Export license from DGFT
                  , GST registration with government of India and facility for
                  storage of essential spares and tools.
                </p>
                <div class="btn-wrapper">
                  <a href="javascript:void(0)" class="theme-btn">Learn More</a>
                  <a href="javascript:void(0)" class="circle-arrow-btn">
                    <i class="fa-regular fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  <!-- Slider Section End -->

  <!-- Cta Area Start -->
  <!-- <div class="cta-area style-1">
      <div class="container">
        <div class="row gy-4 position-relative">
          <div class="col-xl-8">
            <div class="cta-wrapper">
              <div
                class="section-title wow animated animate__animated animate__fadeInLeft animate__fast"
              >
                <div class="sec-content">
                  <h4 class="title">Global Reach</h4>
                  <h1 class="number">320+</h1>
                </div>
                <div class="btn-inner">
                  <span>Trusted Partners</span>
                </div>
                <div class="service-btn-area">
                  <div class="btn-wrapper">
                    <a href="javascript:void(0)" class="theme-btn"
                      >Our Services</a
                    >
                  </div>
                  <div class="left-sticky-corner">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="35"
                      height="35"
                      viewBox="0 0 35 35"
                      fill="none"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z"
                        fill="#CFF480"
                      />
                    </svg>
                  </div>
                </div>
              </div>

              <div
                class="image-wrapper wow animated animate__animated animate__fadeInRight"
                data-wow-delay=".4s"
                style="background-image: url(images/product/3.png)"
              >
                <div class="rectangle-shape">
                  <div class="top-sticky-corner">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="35"
                      height="35"
                      viewBox="0 0 35 35"
                      fill="none"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z"
                        fill="white"
                      />
                    </svg>
                  </div>
                  <div class="right-sticky-corner">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="35"
                      height="35"
                      viewBox="0 0 35 35"
                      fill="none"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z"
                        fill="white"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-4">
            <div
              class="info-card style-3 wow animate__animated animate__fadeInRight"
              data-wow-delay=".4s"
            >
              <div class="overlay">
                <img src="/images/info-card/info-card-shape.png" alt="shape" />
              </div>
              <div class="info-card-inner">
                <div class="content-wrapper">
                  <div class="title-wrapper">
                    <h3 class="title">Technical Assistance</h3>
                  </div>
                  <div class="content">
                    <p class="desc">
                      Get expert guidance and support from our technical team to
                      ensure efficient project design and smooth operations.
                    </p>
                  </div>
                </div>
                <div class="btn-wrapper">
                  <a href="javascript:void(0)" class="theme-btn">Know More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  <!-- Cta Area End -->

  <!-- Products Area Start Style-1 -->
  <div class="feature-area style-1 py-40">
    <div class="container">
      @php $products = $sections['products']['content'] ?? []; @endphp
      <div class="section-title text-center">
        <div class="short-title-wrapper">
          <span class="short-title only-divider">{{ $products['short_title'] ?? '' }}</span>
        </div>
        <div class="main-content justify-content-center">
          <div class="sec-content">
            <h2 class="title">
              {{ $products['heading'] ?? '' }}
            </h2>
            <p class="mt-3">
              {{ $products['description'] ?? '' }}
            </p>
          </div>
        </div>
      </div>

      <!-- Card Grid -->
      <div class="row justify-content-center mt-50">
        @foreach (($products['items'] ?? []) as $item)
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="gbase-card-scope">
            <section aria-labelledby="title{{ $loop->index }}">
              <header>
                <h1 id="title{{ $loop->index }}">{{ $item['title'] ?? '' }}</h1>
                <h2>{{ $item['subtitle'] ?? '' }}</h2>
              </header>

              <article class="landing-article">
                <figure>
                  <img src="{{ \App\Models\PageSection::resolveImage($item['image'] ?? null) }}" alt="{{ $item['title'] ?? '' }}" />

                  <h5 cite="#">
                    <p>
                      &ldquo;{{ $item['quote'] ?? '' }}&rdquo;
                    </p>
                  </h5>

                  <figcaption>
                    {{ $item['caption'] ?? '' }}
                  </figcaption>
                </figure>

                <a href="{{ $item['link'] ?? '#' }}" class="demo-button">
                  Learn More
                </a>
              </article>
            </section>
          </div>
        </div>
        @endforeach
        <!-- VIEW ALL BUTTON -->
        <div class="btn-wrapper w-100 justify-content-center">
          <a href="{{ $products['view_all_link'] ?? '/equipments.html' }}" class="theme-btn">View All</a>
          <a href="{{ $products['view_all_link'] ?? '/equipments.html' }}" class="circle-arrow-btn">
            <i class="fa-regular fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Products Area End Style-1 -->

  <!-- Client Map Area Start -->
  <style>
    .client-map-area {
      padding: 80px 0;
      background: #f8fafc;
    }

    .client-map-stage {
      position: relative;
      width: 100%;
      min-height: 520px;
      border: 1px solid #dbe3ee;
      border-radius: 14px;
      background: #ffffff;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .client-map-canvas {
      position: relative;
      width: min(100%, 1100px);
      aspect-ratio: 1300 / 850;
    }

    .client-map-canvas img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
    }

    .client-map-placeholder {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6b7280;
      font-size: 18px;
      border: 2px dashed #d1d5db;
      margin: 24px;
      border-radius: 12px;
      text-align: center;
      padding: 16px;
      z-index: 1;
    }

    .client-map-pin {
      animation: pin-bounce 1.8s ease-in-out infinite;
      position: absolute;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background: #e11d48;
      border: 2px solid #ffffff;
      box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.28);
      cursor: pointer;
      z-index: 2;
      transform: translate(-50%, -50%);
    }


    .client-map-pin.pin-green {
      background: #16a34a;
      box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.25);
    }

    .client-map-pin.pin-blue {
      background: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
    }

    .client-map-pin.pin-red {
      background: #ef4444;
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25);
    }

    @keyframes pin-bounce {

      0%,
      100% {
        transform: translate(-50%, -50%);
      }

      50% {
        transform: translate(-50%, -60%);
      }
    }

    .client-map-tooltip {
      position: absolute;
      bottom: 18px;
      left: 50%;
      transform: translateX(-50%);
      background: #111827;
      color: #fff;
      font-size: 12px;
      line-height: 1.1;
      padding: 6px 9px;
      border-radius: 6px;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .client-map-pin:hover .client-map-tooltip {
      opacity: 1;
      transform: translateX(-50%) translateY(-2px);
    }

    .client-map-pin.pin-australia .client-map-tooltip {
      left: -16px;
      bottom: 16px;
      transform: none;
    }

    .client-map-pin.pin-newzealand .client-map-tooltip {
      left: 16px;
      bottom: 16px;
      transform: none;
    }

    .client-map-pin.pin-indonesia .client-map-tooltip {
      bottom: 20px;
    }

    .client-map-pin.pin-srilanka .client-map-tooltip {
      bottom: -30px;
    }

    @media (max-width: 767px) {
      .client-map-stage {
        min-height: 320px;
      }
    }
  </style>
  @php $map = $sections['client_map']['content'] ?? []; @endphp
  <section class="client-map-area">
    <div class="container">
      <div class="section-title text-center mb-4">
        <div class="short-title-wrapper justify-content-center">
          <span class="short-title only-divider">{{ $map['short_title'] ?? '' }}</span>
        </div>
        <h2 class="title">{{ $map['heading'] ?? '' }}</h2>
      </div>

      <div class="client-map-stage" id="client-map-stage">
        <div class="client-map-canvas">
          <img src="{{ \App\Models\PageSection::resolveImage($map['image'] ?? null) }}" alt="Client countries map">
        </div>
      </div>
    </div>
  </section>
  <!-- Client Map Area End -->

  <!-- About Area Start Style-1 -->
  @php $about = $sections['about']['content'] ?? []; @endphp
  <div class="about-us-area style-1">
    <div class="container">
      <div class="row gy-4 gx-2 justify-content-xl-between">
        <div class="col-xxl-6 col-xl-6 wow animate__animated animate__fadeInLeft" data-wow-delay="0.4s">
          <div class="about-info-card style-1">
            <div class="section-title">
              <div class="short-title-wrapper">
                <span class="short-title only-divider">{{ $about['short_title'] ?? '' }}</span>
              </div>
              <div class="main-content">
                <div class="sec-content">
                  <h2 class="title">{{ $about['heading'] ?? '' }}</h2>
                  <p class="description">
                    {{ $about['description'] ?? '' }}
                  </p>
                </div>
              </div>
            </div>

            <div class="info-card-wrapper">
              @foreach (($about['feature_cards'] ?? []) as $card)
              <div class="info-card style-2">
                <div class="info-card-inner">
                  <div class="content-wrapper">
                    <div class="title-wrapper">
                      <div class="icon-wrapper">
                        <div class="icon">
                          <img class="tilt-animate" src="{{ \App\Models\PageSection::resolveImage($card['icon'] ?? null) }}" alt="icon" />
                        </div>
                      </div>
                      <h3 class="title">
                        <a href="javascript:void(0)">{{ $card['title'] ?? '' }}</a>
                      </h3>
                    </div>
                    <div class="content">
                      <p class="desc">
                        {{ $card['description'] ?? '' }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>

        <div
          class="col-xl-6 d-xl-flex align-items-xl-end justify-content-center wow animate__animated animate__fadeInRight"
          data-wow-delay="0.4s">
          <div class="about-image-card style-1">
            <div class="main-img-wrapper">
              <div class="main-img-inner">
                <img class="tilt-animate" src="{{ \App\Models\PageSection::resolveImage($about['image'] ?? null) }}" alt="about card img" />
              </div>
            </div>
            <div class="trusted-user-card">
              <div class="trusted-user-card-wrapper">
                <div class="rectangle-shape">
                  <div class="sticky-corner left-corner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z"
                        fill="white" />
                    </svg>
                  </div>
                  <div class="sticky-corner right-corner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z"
                        fill="white" />
                    </svg>
                  </div>
                </div>
                <div class="trusted-user-card-inner">
                  <div class="user-img-wrapper">
                    <div class="image m-0">
                      <img src="/images/about/v-1/user-1.png" alt="image" />
                    </div>
                    <div class="image">
                      <img src="/images/about/v-1/user-2.png" alt="image" />
                    </div>
                    <div class="image">
                      <img src="/images/about/v-1/user-3.png" alt="image" />
                    </div>
                    <div class="image">
                      <img src="/images/about/v-1/user-4.png" alt="image" />
                    </div>
                  </div>
                  <div class="user-review">
                    <h2 class="title">{{ $about['badge_title'] ?? '' }}</h2>
                    <p class="desc">
                      {{ $about['badge_description'] ?? '' }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- About Area End Style-1 -->

  <!-- Circle Area Start -->

  <!-- Circle Area End -->

  <!-- Latest Posts Area Start style-1 -->
  <!--
  <div class="latest-posts-area style-1 py-140">
    <div class="container">
      <div class="section-title">
        <div class="short-title-wrapper">
          <span class="short-title only-divider">WHATS NEW</span>
        </div>
        <div class="main-content">
          <div class="sec-content">
            <h2 class="title">
              Interesting articles updated <br />
              every daily
            </h2>
          </div>
          <div class="sec-desc">
            <div class="btn-wrapper">
              <a href="blog.html" class="theme-btn">View All</a>
              <a href="blog.html" class="circle-arrow-btn"><i class="fa-regular fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row gy-5">
        <div class="col-xl-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0s">
          <div class="post-card style-1">
            <div class="image">
              <img src="/images/latest-posts/v-1/img-1.jpg" alt="image" />
              <div class="circle-btn-wrapper">
                <a href="#" class="circle-btn">
                  <i class="fa-regular fa-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <div class="tag-wrapper">
                <span class="single-tag">News</span>
                <span class="single-tag">Tach</span>
              </div>
              <h3 class="title">
                <a href="blog-details.html">Inspiring Designs for Inspired Where Innovation Meets</a>
              </h3>
              <div class="post-meta">
                <a class="single-post-meta">
                  <span>Mary Fox</span>
                </a>
                <span class="dots"></span>
                <a class="single-post-meta">
                  <span>07/11/2022</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
          <div class="post-card style-1">
            <div class="image">
              <img src="/images/latest-posts/v-1/img-2.jpg" alt="image" />
              <div class="circle-btn-wrapper">
                <a href="#" class="circle-btn">
                  <i class="fa-regular fa-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <div class="tag-wrapper">
                <span class="single-tag">News</span>
                <span class="single-tag">Tach</span>
              </div>
              <h3 class="title">
                <a href="blog-details.html">The role of medical laboratories in infectious disease
                  testing</a>
              </h3>
              <div class="post-meta">
                <a class="single-post-meta">
                  <span>Mary Fox</span>
                </a>
                <span class="dots"></span>
                <a class="single-post-meta">
                  <span>07/11/2022</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 wow animate__animated animate__fadeInUp" data-wow-delay="0.8s">
          <div class="post-card style-1">
            <div class="image">
              <img src="/images/latest-posts/v-1/img-3.jpg" alt="image" />
              <div class="circle-btn-wrapper">
                <a href="#" class="circle-btn">
                  <i class="fa-regular fa-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <div class="tag-wrapper">
                <span class="single-tag">News</span>
                <span class="single-tag">Tach</span>
              </div>
              <h3 class="title">
                <a href="blog-details.html">The benefits of digital sequence information in biological
                  research</a>
              </h3>
              <div class="post-meta">
                <a class="single-post-meta">
                  <span>Mary Fox</span>
                </a>
                <span class="dots"></span>
                <a class="single-post-meta">
                  <span>07/11/2022</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  -->
  <!-- Latest Posts Area End style-1 -->

  <!-- Contact Form Area Start -->
  <div id="contact-form" class="contact-form-area" style="margin: 80px 0px;">
    <div class="container">
      <div class="shape-overlay-wrapper">
        <div class="shape-overlay">
          <div class="shape-one">
            <div class="sticky-left">
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z"
                  fill="white" />
              </svg>
            </div>
            <div class="sticky-right">
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z"
                  fill="white" />
              </svg>
            </div>
          </div>
        </div>
      </div>
      @php $cta = $sections['contact_cta']['content'] ?? []; @endphp
      <div class="row align-items-stretch">
        <div class="col-lg-6 wow animate__animated animate__fadeInUp animate__fast">
          <div class="image tilt-animate" style="height: 100%;">
            <img src="{{ \App\Models\PageSection::resolveImage($cta['image'] ?? null) }}" alt="contact form image"
              style="width: 100%; height: 100%; object-fit: contain; border-radius: 10px;" />
          </div>
        </div>
        <div class="col-lg-6 wow animate__animated animate__zoomIn animate__faster">
          <div class="comment-respond">
            <div class="post-comments-title">
              <h2>{{ $cta['heading'] ?? '' }}</h2>
            </div>
            <form action="#" method="post" class="comment-form">
              <div class="row gx-2">
                <div class="col-xl-6">
                  <div class="contacts-name">
                    <input name="author" type="text" placeholder="Name" />
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="contacts-email">
                    <input name="email" type="text" placeholder="Your Email" />
                  </div>
                </div>
                <div class="col-xl-12">
                  <div class="contacts-message">
                    <textarea name="comment" cols="20" rows="3" placeholder="Message"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <button class="theme-btn" type="submit">Submit Now</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Contact Form Area End -->


  <!-- Brand Slider Area Start -->
  @include('partials.brand-slider', ['content' => $sections['brand_slider']['content'] ?? []])

  <!-- Search Bar Modal (Unchanged structure, links -> void) -->
  <div class="search-form-wrapper">
    <div class="search-form-inner">
      <div class="search-content-filed">
        <form role="search" method="get" class="search-form" action="javascript:void(0)">
          <input type="hidden" name="post_type" value="post" />
          <div class="search-form-input">
            <div class="search-icon">
              <i class="fa-light fa-magnifying-glass"></i>
            </div>
            <input type="search" placeholder="Search" />
            <button class="theme-btn" type="submit" title="Search" aria-label="Search">
              Search
            </button>
          </div>
        </form>
        <span class="search-close">
          <i class="fa-light fa-xmark"></i>
        </span>
      </div>
    </div>
  </div>
  <!-- Header Search Bar Modal End -->

  <!-- Scroll Up Section Start -->
  <div id="scrollTop" class="scrollup-wrapper">
    <div class="scrollup-btn">
      <i class="fa-regular fa-arrow-up"></i>
    </div>
  </div>
  <!-- Scroll Up Section End -->

  <!-- Footer Start -->
@endsection
