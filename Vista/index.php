<?php include_once ('Layouts/header.php'); ?>
<?php include_once ('Layouts/navbar.php'); ?>
    <!-- HERO
      ================================================== -->
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
                    by Simpleqode
                  </p>

                  <!-- Heading -->
                  <h1 class="text-white text-center mb-4">
                    Nombre
                  </h1>

                  <!-- Subheading -->
                  <p class="lead text-white text-muted text-center mb-5">
                    Incline is set of landing and support pages aimed at helping companies promote new products and business launches.
                  </p>

                  <!-- Button -->
                  <p class="text-center mb-0">
                    <a href="sign-up.php" class="btn btn-outline-primary text-white">
                      SIGN UP 
                    </a>
                  </p>
                </div>

                <div class="slider-item">
                  <!-- Preheading -->
                  <p class="font-weight-medium text-center text-xs text-uppercase text-white text-muted">
                    by Simpleqode
                  </p>
                  <!-- Heading -->
                  <h1 class="text-white text-center mb-4">
                    Powerful design tool 
                  </h1>

                  <!-- Subheading -->
                  <p class="lead text-white text-muted text-center mb-5">
                    Create beautiful websites from scratch with multiple pre-built pages and styled components.
                  </p>
                </div>

                <div class="slider-item">

                  <!-- Preheading -->
                  <p class="font-weight-medium text-center text-xs text-uppercase text-white text-muted">
                    by Simpleqode
                  </p>

                  <!-- Heading -->
                  <h1 class="text-white text-center mb-4">
                    Build anything with Incline
                  </h1>

                  <!-- Subheading -->
                  <p class="lead text-white text-muted text-center mb-5">
                    Create beautiful websites from scratch with multiple pre-built pages and styled components.
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
              Incline comes with several professionally designed landing pages that can be easily adapted for any project.
            </p>

          </div>
        </div> <!-- / .row -->
        <div  class="row" id="respuesta">

        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>
    <?php include_once ('Layouts/footer.php'); ?>

