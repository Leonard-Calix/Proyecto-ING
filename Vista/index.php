
<?php include_once ('Layouts/header.php'); ?>
<?php include_once ('Layouts/navbar.php'); ?>
    <!-- SLIDERS
 nb nb      ================================================== -->
      <section class="section section-top section-full">
        <!-- Slider -->
        <div class="bg-slider">
          <div class="slider slider-no-controls slider-no-draggable slider-fade" id="hero-slider-bg">
            <div class="slider-item">
              <!-- Cover -->
              <div class="bg-cover" style="background-image: url(../Public/img/f-1.jpg)"></div>
            </div>
            <div class="slider-item">
              <!-- Cover -->
              <div class="bg-cover" style="background-image: url(../Public/img/f-2.jpg)"></div>
            </div>
            <div class="slider-item">
              <!-- Cover -->
              <div class="bg-cover" style="background-image: url(../Public/img/f-3.jpg)"></div>
            </div>
          </div>
        </div>

        <!-- Overlay -->
        <div class="bg-overlay"></div>

        <!-- Triangles -->
        <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
        <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div>

        <!-- Content -->
        <div class="container">
          <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-7 order-md-2">

              <!-- Slider -->
              <div id="hero-slider" class="slider slider-no-controls slider-no-draggable slider-fade mb-5 mb-md-0" data-bind="slider" data-target="#hero-slider-bg">
                <div class="slider-item">

                  <!-- Preheading -->
                  <p class="font-weight-medium text-center text-xs text-uppercase text-white text-muted">
                    IngenieriaSoftware
                  </p>

                  <!-- Heading -->
                  <h1 class="text-white text-center mb-4">
                    Tours India
                  </h1>

                  <!-- Subheading -->
                  <p class="lead text-white text-muted text-center mb-5">
                  India is an astonishing land of diverse traditions and cultures. 
                  its varied landscapes from Kashmir to Kanyakumari and from Gujarat to Arunachal Pradesh, the different
                  cuisines and so on! India is also a place for Ayurveda, Yoga, learning, amazing arts & crafts,
                  mountains, backwaters, nature, rivers, deserts, wildlife enthusiasts . 
                  India is a jigsaw of people - of every faith and religion, living together to create a unique and colorful
                  mosaic. 
                  </p>

                  <!-- Button -->
                  <p class="text-center mb-0">
                    <a href="sign-up.php" class="btn btn-outline-primary text-white">
                      Sign UP
                    </a>
                  </p>
                </div>

                <div class="slider-item">
                  <!-- Preheading -->
                  <p class="font-weight-medium text-center text-xs text-uppercase text-white text-muted">
                  IngenieriaSoftware
                  </p>
                  <!-- Heading -->
                  <h1 class="text-white text-center mb-4">
                  Tours India
                  </h1>

                  <!-- Subheading -->
                  <p class="lead text-white text-muted text-center mb-5">
                  There is a festival for every reason and every season.Incredible India tourism enchants 
                  you with culture and festivals of India, forts and palaces, Beaches and Backwaters, Hill stations, 
                  Rejuvenation with Ayurveda and Spa, thrilling wildlife and adventure and holy pilgrimage.
                  </p>
                </div>

                <div class="slider-item">

                  <!-- Preheading -->
                  <p class="font-weight-medium text-center text-xs text-uppercase text-white text-muted">
                  IngenieriaSoftware
                  </p>

                  <!-- Heading -->
                  <h1 class="text-white text-center mb-4">
                  Tours India
                  </h1>

                  <!-- Subheading -->
                  <p class="lead text-white text-muted text-center mb-5">
                  If I were asked under what sky the human mind has most fully developed  some of its choicest gifts,
                  has most deeply pondered on the greatest problems  of life, and has found solutions, I should point to India
                  </p>

                </div>
              </div>

            </div>
            <div class="col-6 col-md-2 order-md-1">
              <!-- Controls -->
              <div class="text-left">
                <a href="#hero-slider" class="slider-control" data-slide="previous">
                  <i class="fas fa-chevron-left"></i>
                </a>
              </div>

            </div>
            <div class="col-6 col-md-2 order-md-3">
              <!-- Controls -->
              <div class="text-right">
                <a href="#hero-slider" class="slider-control" data-slide="next">
                  <i class="fas fa-chevron-right"></i>
                </a>
              </div>
            </div>
          </div> <!-- / .row -->
        </div> <!-- / .container -->
      </section>

    <!-- SECTIONS
      ================================================== -->
    <!-- SELECT DE ESTADOS Y LOS MAS POPULARES
      ================================================== -->
      <section class="section" id="pages">
        <!-- SELECT DE ESTADOS -->
        <div class="container">
         <select class="form-control" id="estados">
        </select>
        <br><br>
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6">
            <!-- Heading -->
            <h2 class="text-center mb-4">
              Most popular tours
            </h2>
            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
            INDIA, as the world knows, is much more than what it seems.. One of the oldest civilizations in the world,
            it offers rich cultural heritage at the outset. Although, it is cumbersome to give a thorough description 
            of this vast, complex, and colourful land especially when it comes to India travels, we are one of those 
            few India tour organizers that have mastered the heart and soul of India.
            </p>

          </div>
        </div> <!-- / .row -->
        <div  class="row" id="respuesta">

        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>
    <?php include_once ('Layouts/footer.php'); ?>

