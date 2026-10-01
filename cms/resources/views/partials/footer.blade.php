  <footer class="footer style-1">
    <div class="footer-wrapper background-black">
      <div class="footer-sec">
        <!-- Subscribe / Newsletter Section -->
        <div class="footer-top-area">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="subscribe-footer-widget">
                  <div class="subscribe-widget">
                    <div class="subscribe-form-title">
                      <h3 class="title">
                        Stay updated with the latest from <br />
                        GBASE Technologies
                      </h3>
                    </div>
                    <div class="subscribe-form-widget">
                      <p class="description">
                        Join our mailing list for updates on horticulture
                        engineering, products, and services.
                      </p>
                      <form action="javascript:void(0)">
                        <div class="mc4wp-form-fields">
                          <div class="single-field">
                            <input type="email" placeholder="Enter your email" required />
                          </div>
                          <button class="submit-btn" type="submit">
                            Subscribe Now
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr />
          </div>
        </div>

        <!-- Footer Main Content -->
        <div class="container">
          <div class="row">
            <!-- About Company -->
            <div class="col-xl-3 col-lg-3 col-md-6">
              <div class="footer-widget">
                <div class="footer-widget-info">
                  <div class="footer-logo">
                    <a href="javascript:void(0)">
                      <img style="background-color: #fff; border-radius: 10px" src="{{ $settings->logoUrl() ?? '/images/logo/logo.png' }}"
                        alt="GBASE Technologies Logo" />
                    </a>
                  </div>
                  <p>
                    {{ $settings->footer_about_text }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Contact Info -->
            <div class="col-xl-6 col-lg-6">
              <div class="row justify-content-lg-center widget-menu-wrapper">

                <!-- Column 1: Equipment -->
                <div class="col-lg-6 col-md-6">
                  <div class="footer-widget widget_nav_menu">
                    <h2 class="footer-widget-title">Quick Links</h2>
                    <ul>

                      <li><a href="/equipments.html">New Equipment</a></li>

                      <li><a href="/process/used-equipments.html">Used Equipment</a></li>

                      <li><a href="/spare_parts.html">Spares</a></li>

                      <li>
                        <a href="/service.html">Services</a>
                        <ul class="sub-menu">
                          <li><a href="/service/online-support.html">Online Support / Troubleshooting</a></li>
                          <li><a href="/service/onsite-support.html">Onsite Support / Site Visit</a></li>
                          <li><a href="/service/equipment-audits.html">Equipment Audits</a></li>
                        </ul>
                      </li>

                      <li><a href="/consulting.html">Consulting</a></li>
                      <li><a href="/knowledge-videos.html">Knowledge Transfer</a></li>
                      <li><a href="/contact.html">Contact Us</a></li>

                    </ul>
                  </div>
                </div>

                <!-- Column 2: Service & Support -->
                <div class="col-lg-6 col-md-6">
                  <div class="footer-widget widget_nav_menu">
                    <h2 class="footer-widget-title">Service & Support</h2>
                    <ul>
                      <li><a href="/consulting.html">Project Consulting</a></li>
                      <li><a href="/consulting.html">Design and Implementation</a></li>

                      <li><a href="/consulting.html">Supply</a></li>

                      <li><a href="/consulting.html">Installation</a></li>
                      <li><a href="/consulting.html">Commissioning</a></li>
                      <li><a href="/consulting.html">Technical services</a></li>
                      <li><a href="/consulting.html">Training and performance audits</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>


            <!-- Social Links (ACTIVE as requested) -->
            <div class="col-xl-3 col-lg-3 col-md-6">
              <div class="footer-widget widget_nav_menu">
                <h2 class="footer-widget-title">Follow Us</h2>
                <ul>
                  <li>
                    <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener">Facebook</a>
                  </li>
                  <li>
                    <a href="{{ $settings->linkedin_url }}"
                      target="_blank" rel="noopener">LinkedIn</a>
                  </li>
                  <li>
                    <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener">YouTube</a>
                  </li>
                  <li><a target="_blank" href="{{ $settings->instagram_url }}">Instagram</a></li>
                </ul>
              </div>
            </div>
          </div>
          <hr />
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom-area">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="footer-bottom-wrapper">
                <div class="footer-bottom-menu-wrapper">
                  <div class="copyright-text">
                    <p>
                      © <span id="currentYear">2025</span>
                      <strong>GBASE Technologies</strong>. All Rights
                      Reserved. <br />Import-Export License (DGFT) | GST
                      Registered (India)
                    </p>
                  </div>
                  <div class="footer-bottom-menu">
                    <ul>
                      <li><a href="javascript:void(0)">Contact</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer End -->

  <!--- End Footer !-->
  <script>
    document.querySelectorAll('.gbase-mobile-menu-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelector('.gbase-mobile-drawer').classList.add('active');
        document.querySelector('.gbase-mobile-overlay').classList.add('active');
      });
    });

    document.querySelector('.gbase-mobile-close').addEventListener('click', () => {
      document.querySelector('.gbase-mobile-drawer').classList.remove('active');
      document.querySelector('.gbase-mobile-overlay').classList.remove('active');
    });

    document.querySelector('.gbase-mobile-overlay').addEventListener('click', () => {
      document.querySelector('.gbase-mobile-drawer').classList.remove('active');
      document.querySelector('.gbase-mobile-overlay').classList.remove('active');
    });

    document.querySelectorAll('.gbase-mobile-dropdown').forEach(drop => {
      drop.addEventListener('click', () => {
        drop.classList.toggle('open');
      });
    });
  </script>
  <script>
    function horizontalNav() {
      return {
        wrapper: document.querySelector(".header__menu"),
        navigation: document.querySelector(".main__menu"),
        item: document.querySelectorAll(".menu__item__group"),
        arrows: document.querySelector(".menuBtn__wrapper"),
        scrollStep: 0,
        totalStep: 0,

        // Count the actual number of rows based on offsetTop
        countRows: function () {
          const items = Array.from(
            this.navigation.querySelectorAll(".menuItem__link")
          );
          const rowTops = new Set(items.map((item) => item.offsetTop));
          return rowTops.size;
        },

        // Maximum number of scroll steps (not negative)
        onCalcNavOverView: function () {
          const totalRows = this.countRows();

          // Number of rows displayed (usually 1)
          let wrapper = document.querySelector(".menu__horizontal__wrapper");
          let rowHeight = wrapper.offsetHeight;
          let visibleRows = Math.floor(wrapper.offsetHeight / rowHeight);

          // Maximum scroll steps (not negative)
          return Math.max(totalRows - visibleRows, 0);
        },

        transform: function () {
          let wrapper = document.querySelector(".menu__horizontal__wrapper");
          let rowHeight = wrapper.offsetHeight;
          return `translateY(-${this.scrollStep * rowHeight}px)`;
        },

        handleArrowClick: function (e) {
          this.totalStep = this.onCalcNavOverView();

          if (e.currentTarget.classList.contains("menu__prev")) {
            this.scrollStep = this.scrollStep - 1;
          } else {
            this.scrollStep = this.scrollStep + 1;
          }

          this.handleScroll();
        },

        handleScroll: function () {
          // Remove disabled class from all buttons
          if (!this.arrows) return;
          const buttons = this.arrows.querySelectorAll("button");
          buttons.forEach((btn) => btn.classList.remove("disabled"));

          // Check if reached end
          if (this.scrollStep >= this.totalStep) {
            const nextBtn = this.arrows.querySelector(".menu__next");
            if (nextBtn) nextBtn.classList.add("disabled");
            this.scrollStep = this.totalStep;
          }

          // Check if at beginning
          if (this.scrollStep <= 0) {
            const prevBtn = this.arrows.querySelector(".menu__prev");
            if (prevBtn) prevBtn.classList.add("disabled");
            this.scrollStep = 0;
          }

          // Determine the current row
          let wrapper = document.querySelector(".menu__horizontal__wrapper");
          if (!wrapper) return;
          let rowHeight = wrapper.offsetHeight;
          let currentRow = this.scrollStep;
          let items = Array.from(
            this.navigation.querySelectorAll(".menuItem__link")
          );

          // Find offsetTop of each row
          let rowTops = [...new Set(items.map((item) => item.offsetTop))];
          let visibleTop = rowTops[currentRow];

          // Handle display
          this.item.forEach((item) => {
            const menuLink = item.querySelector(".menuItem__link");
            if (menuLink) {
              // Transform as before
              menuLink.style.transform = this.transform();

              // Show/hide item based on row
              if (menuLink.offsetTop === visibleTop) {
                item.classList.add("visible-row");
              } else {
                item.classList.remove("visible-row");
              }
            }
          });
        },

        init: function () {
          // Check if required elements exist
          if (
            !this.wrapper ||
            !this.navigation ||
            !this.arrows ||
            this.item.length === 0
          ) {
            return;
          }

          this.totalStep = this.onCalcNavOverView();

          if (this.totalStep > 0) {
            this.wrapper.classList.add("overflow");
          }

          this.handleScroll();

          // Add event listeners to arrow buttons
          const buttons = this.arrows.querySelectorAll("button");
          buttons.forEach((button) => {
            button.addEventListener("click", (e) => this.handleArrowClick(e));
          });
        }
      };
    }

    let navInstance = null;

    // --- Globally Scoped Variables & Toggle Function ---
    let overlays, body, menuBtn, menuItems;

    function toggle() {
      if (body && overlays && menuBtn && menuItems) {
        body.classList.toggle("overflow");
        overlays.classList.toggle("overlay--active");
        menuBtn.classList.toggle("open");
        menuItems.classList.toggle("open");
      }
    }

    function handleResizeAndLoad() {
      const isDesktop = window.innerWidth > 768;
      const arrowContainer = document.querySelector(".menu__horizontal__btn");

      // --- Logic for Horizontal Nav (Desktop) ---
      if (isDesktop) {
        if (arrowContainer) arrowContainer.style.display = "";

        if (!navInstance) {
          navInstance = horizontalNav();
          navInstance.init();
        } else {
          // Recalculate on resize
          navInstance.totalStep = navInstance.onCalcNavOverView();
          navInstance.scrollStep = 0;
          navInstance.handleScroll();
        }
      }
      // --- Logic for Mobile View ---
      else {
        if (arrowContainer) arrowContainer.style.display = "none";

        if (navInstance) {
          // "Destroy" the instance by resetting its visual effects
          if (navInstance.wrapper) navInstance.wrapper.classList.remove("overflow");
          if (navInstance.item) {
            navInstance.item.forEach((item) => {
              const menuLink = item.querySelector(".menuItem__link");
              if (menuLink) menuLink.style.transform = "";
            });
          }
          navInstance = null;
        }
      }

      // --- Cleanup Mobile Menu state when switching to Desktop ---
      if (isDesktop) {
        // Close the main off-canvas menu if it's open
        if (menuBtn && menuBtn.classList.contains("open")) {
          toggle();
        }

        // Reset all sub-menus that were opened on mobile
        const dropdownMenu = document.querySelectorAll(".main__menu .sub__menu");
        for (let i = 0; i < dropdownMenu.length; i++) {
          dropdownMenu[i].style.display = ""; // Reset display from slide functions
          const parentLi = dropdownMenu[i].closest("li");
          if (parentLi && parentLi.classList.contains("open")) {
            parentLi.classList.remove("open");
            const expandBtn = parentLi.querySelector(".expand-btn");
            if (expandBtn) expandBtn.classList.remove("open");
          }
        }
      }
    }

    /* --- Pure JavaScript slideToggle, slideUp, slideDown --- */
    function slideUp(element, duration = 300) {
      return new Promise((resolve) => {
        element.style.height = element.offsetHeight + "px";
        element.style.transitionProperty = "height, margin, padding";
        element.style.transitionDuration = duration + "ms";
        element.offsetHeight; // Force reflow
        element.style.overflow = "hidden";
        element.style.height = "0";
        element.style.paddingTop = "0";
        element.style.paddingBottom = "0";
        element.style.marginTop = "0";
        element.style.marginBottom = "0";
        window.setTimeout(() => {
          element.style.display = "none";
          element.style.removeProperty("height");
          element.style.removeProperty("padding-top");
          element.style.removeProperty("padding-bottom");
          element.style.removeProperty("margin-top");
          element.style.removeProperty("margin-bottom");
          element.style.removeProperty("overflow");
          element.style.removeProperty("transition-duration");
          element.style.removeProperty("transition-property");
          resolve(true);
        }, duration);
      });
    }

    function slideDown(element, duration = 300) {
      return new Promise((resolve) => {
        element.style.removeProperty("display");
        let display = window.getComputedStyle(element).display;
        if (display === "none") display = "block";
        element.style.display = display;
        let height = element.offsetHeight;
        element.style.overflow = "hidden";
        element.style.height = "0";
        element.style.paddingTop = "0";
        element.style.paddingBottom = "0";
        element.style.marginTop = "0";
        element.style.marginBottom = "0";
        element.offsetHeight; // Force reflow
        element.style.transitionProperty = "height, margin, padding";
        element.style.transitionDuration = duration + "ms";
        element.style.height = height + "px";
        element.style.removeProperty("padding-top");
        element.style.removeProperty("padding-bottom");
        element.style.removeProperty("margin-top");
        element.style.removeProperty("margin-bottom");
        window.setTimeout(() => {
          element.style.removeProperty("height");
          element.style.removeProperty("overflow");
          element.style.removeProperty("transition-duration");
          element.style.removeProperty("transition-property");
          resolve(true);
        }, duration);
      });
    }

    function slideToggle(element, duration = 300) {
      if (window.getComputedStyle(element).display === "none") {
        return slideDown(element, duration);
      } else {
        return slideUp(element, duration);
      }
    }
    // --- End of slide functions ---

    // --- Main Event Listeners Setup ---
    document.addEventListener("DOMContentLoaded", () => {
      // --- Initialize Globally Scoped Variables ---
      overlays = document.querySelector(".overlay");
      body = document.querySelector("body");
      menuBtn = document.querySelector(".menu__btn");
      menuItems = document.querySelector(".main__menu");

      // Add .expand-btn class
      const liElems = document.querySelectorAll(".main__menu li");
      liElems.forEach((elem) => {
        const childrenElems = elem.querySelectorAll(".sub__menu");
        if (childrenElems.length > 0) {
          const firstChild = elem.firstElementChild;
          if (firstChild) firstChild.classList.add("expand-btn");
        }
      });

      // --- Attach Event Listeners ---
      if (menuBtn) {
        menuBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          toggle();
        });
      }

      window.onkeydown = function (event) {
        if (!menuItems) return;
        const key = event.key;
        const active = menuItems.classList.contains("open");
        if (key === "Escape" && active) {
          toggle();
        }
      };

      if (document) {
        document.addEventListener("click", (e) => {
          if (!menuItems || !menuBtn) return;
          let target = e.target,
            its_menu = target === menuItems || menuItems.contains(target),
            its_hamburger = target === menuBtn,
            menu_is_active = menuItems.classList.contains("open");
          if (!its_menu && !its_hamburger && menu_is_active) {
            toggle();
          }
        });
      }

      const expandBtn = document.querySelectorAll(".expand-btn");
      expandBtn.forEach((btn) => {
        btn.addEventListener("click", (e) => {
          if (window.innerWidth <= 768) {
            e.preventDefault();

            const parentLi = btn.parentElement;
            if (!parentLi) return;
            const submenu = parentLi.querySelector(".sub__menu");
            if (!submenu) return;

            const parentUl = parentLi.parentElement;
            if (!parentUl) return;

            parentUl.querySelectorAll(":scope > li.open").forEach((siblingLi) => {
              if (siblingLi !== parentLi) {
                const siblingSubmenu = siblingLi.querySelector(".sub__menu");
                if (siblingSubmenu) {
                  slideUp(siblingSubmenu);
                  siblingLi.classList.remove("open");
                  siblingLi.querySelector(".expand-btn")?.classList.remove("open");
                }
              }
            });

            parentLi.classList.toggle("open");
            btn.classList.toggle("open");
            slideToggle(submenu);
          }
        });
      });

      // --- Load and Resize Handlers ---
      handleResizeAndLoad();
      window.addEventListener("resize", handleResizeAndLoad);
    });

  </script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/swiper-bundle.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.js"></script>
  <script src="js/jquery.meanmenu.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/inview.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/tilt.jquery.min.js"></script>
  <script src="js/custom-slider.js"></script>
  <script src="/js/custom.js?v=5"></script>
  <script src="js/translation.js"></script>
  <!-- Search Overlay -->
  <div id="gbase-search-overlay" class="gbase-search-overlay">
    <div class="gbase-search-container">
      <button id="gbase-search-close" class="gbase-search-close" aria-label="Close search">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <div class="gbase-search-header">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="gbase-search-input" placeholder="Search this page..." autocomplete="off" />
      </div>
      <div id="gbase-search-results" class="gbase-search-results"></div>
    </div>
  </div>

  <script src="js/page-search.js"></script>
