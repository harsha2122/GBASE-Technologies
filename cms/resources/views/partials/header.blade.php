  <a href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp_number }}" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>
  <a href="tel:{{ $settings->float_call_number }}" class="float1">
    <i class="fa fa-phone my-float"></i>
  </a>
  <!-- ===================== TOP BAR ===================== -->
  <div class="gbase-topbar">
    <div class="gbase-topbar-container">

      <div class="gbase-topbar-left">
        <a style="color: #fff;" href="javascript:void(0)"><i class="fa-solid fa-phone"></i> {{ $settings->topbar_phone }}</a>
        <a style="color: #fff;" href="mailto:{{ $settings->topbar_email }}"><i class="fa-solid fa-envelope"></i> {{ $settings->topbar_email }}</a>
      </div>

      <div class="gbase-topbar-right">
        <select class="gbase-lang-switch">
          <option>English</option>
          <option>Hindi</option>
          <option>Bengali</option>
          <option>Sinhala</option>
          <option>Tamil</option>
          <option>Indonesian</option>
        </select>

        <div class="gbase-topbar-social">
          <a style="background-color: #cff48058; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center;"
            href="{{ $settings->facebook_url }}" target="_blank"><i style="color: #fff;"
              class="fa-brands fa-facebook-f"></i></a>
          <a style="background-color: #cff48058; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center;"
            href="{{ $settings->instagram_url }}" target="_blank"><i style="color: #fff;"
              class="fa-brands fa-instagram"></i></a>
          <a style="background-color: #cff48058; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center;"
            href="{{ $settings->youtube_url }}" target="_blank"><i style="color: #fff;"
              class="fa-brands fa-youtube"></i></a>
          <a style="background-color: #cff48058; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center;"
            href="{{ $settings->linkedin_url }}" target="_blank"><i
              style="color: #fff;" class="fa-brands fa-linkedin-in"></i></a>
        </div>
      </div>

    </div>
  </div>

  <!-- ===================== DESKTOP HEADER ===================== -->
  <header class="header gbase-header-desktop">
    <div class="header-container">

      <!-- LOGO -->
      <a href="/" class="header-logo">
        <img src="/images/logo/logo.png" alt="GBASE Logo">
      </a>

      <!-- NAV -->
      <nav class="header-nav">
        <ul class="nav-list mb-0">

          <!-- NEW EQUIPMENT DROPDOWN -->
          <li class="nav-item dropdown">
            <a class="nav-link" href="/equipments.html">New Equipment</a>

            <div class="mega-menu">
              <div class="mega-inner">

                <div class="mega-col">
                  <h4>Pre-Process</h4>
                  <ul>
                    <li><a href="/process/cutting.html">Cutting</a></li>
                    <li><a href="/process/dicing.html">Dicing</a></li>
                    <li><a href="/process/slicing.html">Slicing</a></li>
                    <li><a href="/process/peeling.html">Peeling</a></li>
                    <li><a href="/process/peeling.html">Washing</a></li>
                    <li><a href="/process/blanching.html">Blanching</a></li>
                    <li><a href="/process/blanching.html">Chilling</a></li>
                    <li><a href="/process/blanching.html">De-watering</a></li>
                    <li><a href="/process/more_machines.html">More Machines</a></li>
                  </ul>
                </div>

                <div class="mega-col">
                  <h4>Freezing</h4>
                  <ul>
                    <li><a href="/freezing/freezing.html">IQF</a></li>
                    <li><a href="/freezing/impingement.html">Impingement Freezer</a></li>
                    <li><a href="/freezing/spiral.html">Spiral Freezer</a></li>
                    <li><a href="/freezing/spiral.html">Plate Contact Freezer</a></li>
                    <li><a href="/freezing/spiral.html">Carton Box Freezer</a></li>
                  </ul>
                </div>

                <div class="mega-col">
                  <h4>Heating</h4>
                  <ul>
                    <li><a href="/heating/grill.html">Contact Grills</a></li>
                    <li><a href="/heating/grill.html">Oil Fryer</a></li>
                    <li><a href="/heating/oven.html">Spiral Ovens</a></li>
                    <li><a href="/heating/oven.html">Linear Ovens</a></li>
                    <li><a href="/heating/filteration.html">Oil Filtration</a></li>
                    <li><a href="/heating/filteration.html">Coating</a></li>
                    <li><a href="/heating/filteration.html">Flattener</a></li>
                  </ul>
                </div>

                <div class="mega-col">
                  <h4>Round Fruit Sorting</h4>
                  <ul>
                    <li><a href="/sorting/sorting.html">Sorting Machines</a></li>
                    <li><a href="/sorting/conveyors.html">Conveyors</a></li>
                    <li><a href="/sorting/others.html">Others</a></li>
                  </ul>
                </div>

              </div>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" href="/process/used-equipments.html">Used Equipment</a>

            <div class="mega-menu gbase-mega-menu-tabbed">
              <div class="gbase-tab-container">
                <!-- Sidebar -->
                <div class="gbase-tab-sidebar">
                  <ul class="gbase-mega-nav">
                    <li><a class="nav-link active" data-target="tab-preprocess" href="/process/used-equipments.html">IQF
                        Freezers</a></li>
                    <li><a class="nav-link" data-target="tab-freezing" href="/sorting/sorting.html">Sorting Lines</a>
                    </li>
                    <li><a class="nav-link" data-target="tab-cutting-dicing" href="javascript:void(0)">Cutting &
                        Dicing</a></li>
                    <li><a class="nav-link" data-target="tab-heating" href="/equipments.html">Others</a></li>
                  </ul>
                  <div style="padding: 24px;">
                    <a href="/equipments.html"
                      style="font-weight: 700; color: #0072ff; text-decoration: none; font-size: 14px;">All Equipment <i
                        class="fa fa-arrow-right" style="margin-left: 6px;"></i></a>
                  </div>
                </div>
                <!-- Content Area -->
                <div class="gbase-tab-content">

                  <!-- Pre-Process Content -->
                  <div id="tab-preprocess" class="gbase-mega-tab active">
                    <div class="row">
                      <div class="col-6 mb-3">
                        <a href="/process/used-equipments.html" class="gbase-menu-product">
                          <img style="width: 230px;" src="/images/product/iqf.jpeg" alt="Cutting">
                          <h6>IQF Freezer</h6>
                          <p class="op">High IQF degree, natural appearance</p>
                        </a>
                      </div>
                      <!-- <div class="col-4 mb-3">
                                  <a href="/process/cutting.html" class="gbase-menu-product">
                                      <img src="images/product/2.png" alt="Washing">
                                      <h6>Washing</h6>
                                      <p>Efficient washing and sanitation systems.</p>
                                  </a>
                              </div>
                              <div class="col-4 mb-3">
                                  <a href="/process/cutting.html" class="gbase-menu-product">
                                      <img src="images/product/3.png" alt="Peeling">
                                      <h6>Peeling</h6>
                                      <p>Minimize waste with advanced peeling.</p>
                                  </a>
                              </div> -->
                    </div>
                    <a href="/process/used-equipments.html" class="theme-btn style-outline btn-sm mt-3"
                      style="padding: 8px 24px; font-size: 14px;">View More</a>
                  </div>

                  <!-- Freezing Content -->
                  <div id="tab-freezing" class="gbase-mega-tab">
                    <div class="row">
                      <div class="col-6 mb-3">
                        <a href="/sorting/sorting.html" class="gbase-menu-product">
                          <img src="/images/product/sor.jpeg" alt="Sorting Machines">
                          <h6>Sorting Machines</h6>
                          <p>Advanced optical sorting.</p>
                        </a>
                      </div>
                      <!-- <div class="col-4 mb-3">
                                  <a href="/product/plate-freezer.html" class="gbase-menu-product">
                                      <img src="images/product/plate freezer.png" alt="Plate Freezer">
                                      <h6>Plate Freezer</h6>
                                      <p>Rapid block freezing efficiency.</p>
                                  </a>
                              </div>
                              <div class="col-4 mb-3">
                                  <a href="/product/carton-box-freezer.html" class="gbase-menu-product">
                                      <img src="images/product/carton-box-freezer.png" alt="Carton Box Freezer">
                                      <h6>Carton Box Freezer</h6>
                                      <p>Ideal for boxed product freezing.</p>
                                  </a>
                              </div> -->
                    </div>
                    <a href="/sorting/sorting.html" class="theme-btn style-outline btn-sm mt-3"
                      style="padding: 8px 24px; font-size: 14px;">View More</a>
                  </div>

                  <!-- Cutting & Dicing Content -->
                  <div class="gbase-mega-tab" id="tab-cutting-dicing">
                    <div class="row">
                      <div class="col-6 mb-3">
                        <a class="gbase-menu-product" href="/process/cutting.html">
                          <img alt="Cutting" src="/images/product/dicing1.png"
                            style="width: 100%; aspect-ratio: 1 / 1; object-fit: cover;" />
                          <h6>Cutting</h6>
                          <p>Precision cutting solutions.</p>
                        </a>
                        <a class="theme-btn style-outline btn-sm mt-2" href="/process/cutting.html"
                          style="padding: 6px 18px; font-size: 13px;">View More</a>
                      </div>
                      <div class="col-6 mb-3">
                        <a class="gbase-menu-product" href="/process/dicing.html">
                          <img alt="Dicing" src="/images/product/dicing2.png"
                            style="width: 100%; aspect-ratio: 1 / 1; object-fit: cover;" />
                          <h6>Dicing</h6>
                          <p>Uniform dicing for consistent quality.</p>
                        </a>
                        <a class="theme-btn style-outline btn-sm mt-2" href="/process/dicing.html"
                          style="padding: 6px 18px; font-size: 13px;">View More</a>
                      </div>
                    </div>
                  </div>

                  <div id="tab-heating" class="gbase-mega-tab">
                    <div class="row">
                      <!-- <div class="col-6 mb-3">
                                  <a href="/heating/oven.html" class="gbase-menu-product">
                                      <img src="/images/product/spiraaloven.png" alt="Spiral Ovens">
                                      <h6>OctoFrost HiTec Spiral Oven</h6>
                                      <p>Perfect for slow-cooked quality.</p>
                                  </a>
                              </div>
                              <div class="col-4 mb-3">
                                  <a href="/heating/oven.html" class="gbase-menu-product">
                                      <img src="images/product/4.png" alt="Linear Ovens">
                                      <h6>Linear Ovens</h6>
                                      <p>Flexible and uniform heating.</p>
                                  </a>
                              </div>
                              <div class="col-4 mb-3">
                                  <a href="/heating/oven.html" class="gbase-menu-product">
                                      <img src="images/product/2.png" alt="Contact Grills">
                                      <h6>Contact Grills</h6>
                                      <p>Authentic grill marks and flavor.</p>
                                  </a>
                              </div> -->
                    </div>
                    <a href="/heating/oven.html" class="theme-btn style-outline btn-sm mt-3"
                      style="padding: 8px 24px; font-size: 14px;">View More</a>
                  </div>

                  <!-- Round Fruit Sorting Content -->
                  <div id="tab-sorting" class="gbase-mega-tab">
                    <div class="row">
                      <div class="col-6 mb-3">
                        <a href="/sorting/sorting.html" class="gbase-menu-product">
                          <img src="/images/product/sor.jpeg" alt="Sorting Machines">
                          <h6>Sorting Machines</h6>
                          <p>Advanced optical sorting.</p>
                        </a>
                      </div>
                      <!-- <div class="col-4 mb-3">
                                  <a href="/sorting/sorting.html" class="gbase-menu-product">
                                      <img src="images/product/1.png" alt="Conveyors">
                                      <h6>Conveyors</h6>
                                      <p>Smart handling solutions.</p>
                                  </a>
                              </div>
                              <div class="col-4 mb-3">
                                  <a href="/sorting/sorting.html" class="gbase-menu-product">
                                      <img src="images/product/sidebar-image.png" alt="Others">
                                      <h6>Others</h6>
                                      <p>Additional sorting accessories.</p>
                                  </a>
                              </div> -->
                    </div>
                    <a href="/sorting/sorting.html" class="theme-btn style-outline btn-sm mt-3"
                      style="padding: 8px 24px; font-size: 14px;">View More</a>
                  </div>

                </div>
              </div>
            </div>
          </li>

          <li class="nav-item dropdown dropdown-sub">
            <a href="/service.html" class="nav-link">Service</a>

            <div class="sub-menu">
              <ul>
                <li><a href="/service/online-support.html">Online Support / Troubleshooting</a></li>
                <li><a href="/service/onsite-support.html">Onsite Support (Site Visit)</a></li>
                <li><a href="/service/equipment-audits.html">Equipment Audits</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item"><a href="/spare_parts.html" class="nav-link">Spare Parts</a></li>
          <li class="nav-item dropdown">
            <a href="/consulting.html" class="nav-link">Consulting</a>
            <div class="mega-menu">
              <div class="mega-inner">

                <div class="mega-col">
                  <h4>Pre-Process</h4>
                  <ul>
                    <li><a href="/process/cutting.html">Cutting</a></li>
                    <li><a href="/process/dicing.html">Dicing</a></li>
                    <li><a href="/process/slicing.html">Slicing</a></li>
                    <li><a href="/process/washing.html">Washing</a></li>
                    <li><a href="/process/blanching.html">Blanching</a></li>
                    <li><a href="/process/blanching.html">Chilling</a></li>
                    <li><a href="/process/blanching.html">De-watering</a></li>
                    <li><a href="/process/more_machines.html">More Machines</a></li>
                    <li><a href="/process/peeling.html">Peeling</a></li>
                  </ul>
                </div>

                <div class="mega-col">
                  <h4>Freezing</h4>
                  <ul>
                    <li><a href="/freezing/freezing.html">IQF</a></li>
                    <li><a href="/freezing/impingement.html">Impingement Freezer</a></li>
                    <li><a href="/equipments.html">Spiral Freezer</a></li>
                    <li><a href="/equipments.html">Plate Freezer</a></li>
                    <li><a href="/equipments.html">Carton Box Freezer</a></li>
                  </ul>
                </div>

                <div class="mega-col">
                  <h4>Heating</h4>
                  <ul>
                    <li><a href="/heating/grill.html">Contact Grills</a></li>
                    <li><a href="/heating/grill.html">Oil Fryer</a></li>
                    <li><a href="/heating/oven.html">Spiral Ovens</a></li>
                    <li><a href="/heating/oven.html">Linear Ovens</a></li>
                    <li><a href="/heating/filteration.html">Oil Filtration</a></li>
                  </ul>
                </div>

                <div class="mega-col">
                  <h4>Round Fruit Sorting</h4>
                  <ul>
                    <li><a href="/sorting/sorting.html">Sorting Machines</a></li>
                    <li><a href="/sorting/conveyors.html">Conveyors</a></li>
                    <li><a href="/sorting/others.html">Others</a></li>
                  </ul>
                </div>

              </div>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-sub">
            <a href="#" class="nav-link">Knowledge Centre</a>
            <div class="sub-menu">
              <ul>
                <li><a href="/knowledge-videos.html">Videos</a></li>
                <li><a href="/knowledge-articles.html">Articles</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </nav>
      <div class="header-actions">
        <a class="theme-btn" href="/contact.html" style="padding: 10px 15px; font-size: 18px;">Contact <i
            class="fa-regular fa-arrow-right" style="margin-left: 6px;"></i></a>
        <button id="gbase-search-btn" class="gbase-search-toggle" aria-label="Search"><i
            class="fa-solid fa-magnifying-glass"></i></button>
      </div>


    </div>
  </header>

  <!-- ===================== MOBILE HEADER ===================== -->
  <div class="gbase-header-mobile">
    <div class="gbase-mobile-inner">
      <a class="gbase-logo" href="/">
        <img src="images/logo/logo.png">
      </a>
      <div class="gbase-mobile-menu-btn"><i class="fa-solid fa-bars"></i></div>
    </div>
  </div>


  <div class="gbase-mobile-drawer">
    <div class="gbase-mobile-content">

      <div class="d-flex justify-content-between align-items-center mb-4"
        style="padding-bottom: 20px; border-bottom: 1px solid #eee;">
        <a href="/">
          <img src="images/logo/logo.png" alt="GBASE" style="max-width: 120px;">
        </a>
        <div class="gbase-mobile-close" style="padding-bottom: 0;">
          <i class="fa-solid fa-xmark"></i>
        </div>
      </div>

      <ul class="gbase-mobile-nav">

        <li><a href="/">Home</a></li>

        <li class="gbase-mobile-dropdown">
          <span>Products</span>
          <ul>
            <li><a href="/product/plate-freezer.html">Plate Freezer</a></li>

            <li><a href="/product/carton-box-freezer.html">Carton Box Freezer</a></li>
            <li><a href="/product/spiral-freezer.html">Spiral Freezer</a></li>
          </ul>
        </li>

        <li class="gbase-mobile-dropdown">
          <span>Equipment</span>
          <ul>
            <!-- Pre-Process -->
            <li>
              <span>Pre-Process</span>
              <ul>
                <li><a href="/process/cutting.html">Cutting</a></li>
                <li><a href="/process/washing.html">Washing</a></li>
                <li><a href="/process/peeling.html">Peeling</a></li>
                <li><a href="/process/cutting.html" style="font-weight: 700;">View More <i
                      class="fa fa-arrow-right"></i></a></li>
              </ul>
            </li>

            <!-- Freezing -->
            <li>
              <span>Freezing</span>
              <ul>
                <li><a href="/product/spiral-freezer.html">Spiral Freezer</a></li>
                <li><a href="/product/plate-freezer.html">Plate Freezer</a></li>
                <li><a href="/product/carton-box-freezer.html">Carton Box Freezer</a></li>
                <li><a href="/freezing/freezing.html" style="font-weight: 700;">View More <i
                      class="fa fa-arrow-right"></i></a>
                </li>
              </ul>
            </li>

            <!-- Heating -->
            <li>
              <span>Heating</span>
              <ul>
                <li><a href="/heating/oven.html">Spiral Ovens</a></li>
                <li><a href="/heating/oven.html">Linear Ovens</a></li>
                <li><a href="/heating/grill.html">Contact Grills</a></li>
                <li><a href="/heating/oven.html" style="font-weight: 700;">View More <i
                      class="fa fa-arrow-right"></i></a>
                </li>
              </ul>
            </li>

            <!-- Sorting -->
            <li>
              <span>Sorting</span>
              <ul>
                <li><a href="/sorting/sorting.html">Sorting Machines</a></li>
                <li><a href="/sorting/conveyors.html">Conveyors</a></li>
                <li><a href="/sorting/others.html">Others</a></li>
                <li><a href="/sorting/sorting.html" style="font-weight: 700;">View More <i
                      class="fa fa-arrow-right"></i></a>
                </li>
              </ul>
            </li>

          </ul>
        </li>

                <li class="gbase-mobile-dropdown">
          <span>Service</span>
          <ul>
            <li><a href="/service.html">Service Overview</a></li>
            <li><a href="/service/online-support.html">Online Support / Troubleshooting</a></li>
            <li><a href="/service/onsite-support.html">Onsite Support (Site Visit)</a></li>
            <li><a href="/service/equipment-audits.html">Equipment Audits</a></li>
          </ul>
        </li>
        <li><a href="/process/used-equipments.html">Used Equipment</a></li>
        <li><a href="/spare_parts.html">Spare Parts</a></li>
        <li><a href="/consulting.html">Consulting</a></li>
        <li><a href="/knowledge-videos.html">Knowledge Centre</a></li>
        <li><a href="/contact.html">Contact</a></li>

      </ul>

    </div>
  </div>

  <!-- Backdrop -->
  <div class="gbase-mobile-overlay"></div>


  <!-- Menu Sidebar Section Start -->
  <div class="menu-sidebar-area">
    <div class="menu-sidebar-wrapper">
      <div class="menu-sidebar-close">
        <button class="menu-sidebar-close-btn" id="menu_sidebar_close_btn">
          <i class="fal fa-times"></i>
        </button>
      </div>
      <div class="menu-sidebar-content">
        <div class="menu-sidebar-logo">
          <a href="javascript:void(0)">
            <img src="/images/logo/logo.png" style="background-color: #fff; border-radius: 10px" alt="logo" />
          </a>
        </div>
        <div class="mobile-nav-menu"></div>
        <div class="menu-sidebar-content">
          <div class="menu-sidebar-single-widget">
            <div class="header-contact-info">
              <p>
                {{ $settings->footer_about_text }}
              </p>
            </div>
          </div>
          <div class="menu-sidebar-single-widget">
            <h5 class="menu-sidebar-title">Contact Info</h5>
            <div class="header-contact-info">
              <span>
                <a href="mailto:{{ $settings->topbar_email }}"><i class="fa-regular fa-envelope"></i>{{ $settings->topbar_email }}</a>
              </span>
              <span>
                <a href="javascript:void(0)"><i class="fa-regular fa-phone"></i> {{ $settings->topbar_phone }}</a>
              </span>
            </div>
            <div class="social-profile">
              <a href="{{ $settings->facebook_url }}" target="_blank"><i
                  class="fa-brands fa-facebook-f"></i></a>
              <a href="{{ $settings->linkedin_url }}" target="_blank"><i
                  class="fa-brands fa-linkedin-in"></i></a>
              <a href="{{ $settings->youtube_url }}" target="_blank"><i
                  class="fa-brands fa-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Menu Sidebar Section End -->
  <div class="body-overlay"></div>

