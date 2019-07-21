<?php include_once('Layouts/header.php'); ?>
<?php include_once('Layouts/navbar.php'); ?>
    
<!-- REGISTRO DE USUARIOS
  ================================================== -->
<section class="section section-full section-top bg-light">
  <!-- Content -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <!-- Form -->
        <form class="form-styled bg-white">
          <!-- Heading -->
          <h4 class="text-center mb-4">Create an account</h4>
          <!-- Subheading -->
          <p class="text-center text-muted mb-5">Please fill out the form below to sign up.</p>
          <!-- FORMULARIO -->
          <div class="form-group">      
            <!-- Name -->
            <label>Name</label>
            <div class="input-group">
              <input type="text" class="form-control order-1" id="nombre">
              <div class="input-group-append order-0">
                <div class="input-group-text">
                  <svg class="input-group-icon icon-offset icon icon-person" viewBox="0 0 106 106" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path transform="translate(3 3)" d="
                      M0 100 A 50 50 0 0 1 50 60 A 20 20 0 0 1 50 0 A 20 20 0 0 1 50 60 A 50 50 0 0 1 100 100">
                    </path>
                  </svg>
                </div>
              </div>
            </div>
        </div>

        <div class="form-group">     
          <!-- Last Name -->
          <label>Last name</label>
          <div class="input-group">
            <input type="text" class="form-control order-1" id="apellido">
            <div class="input-group-append order-0">
              <div class="input-group-text">
                <svg class="input-group-icon icon-offset icon icon-person" viewBox="0 0 106 106" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <path transform="translate(3 3)" d="
                    M0 100 A 50 50 0 0 1 50 60 A 20 20 0 0 1 50 0 A 20 20 0 0 1 50 60 A 50 50 0 0 1 100 100">
                  </path>
                </svg>
              </div>
            </div>
          </div>
        </div>
        <!-- Email -->
        <div class="form-group">        
          <!-- Email -->
          <label>Email address</label>
          <div class="input-group">
            <input type="email" class="form-control order-1" id="correo">
            <div class="input-group-append order-0">
              <div class="input-group-text">
                <svg class="input-group-icon icon-offset icon icon-envelope" viewBox="0 0 106 106" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <path transform="translate(3 3)" d="
                    M0 30 V 10 H 100 V 90 H 0 V 30 L 50 60 L 100 30">
                  </path>
                </svg>
              </div>
            </div>
          </div>
        </div>

				<!-- Username -->
        <div class="form-group">        
          <!-- User Name -->
          <label>Username</label>
          <div class="input-group">
            <input type="text" class="form-control order-1"  id="usuario">
            <div class="input-group-append order-0">
                <div class="input-group-text">
                  <svg class="input-group-icon icon-offset icon icon-person" viewBox="0 0 106 106" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path transform="translate(3 3)" d="
                      M0 100 A 50 50 0 0 1 50 60 A 20 20 0 0 1 50 0 A 20 20 0 0 1 50 60 A 50 50 0 0 1 100 100">
                    </path>
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <!-- Password -->
          <div class="form-group">      
            <!-- Password -->
            <label>Password</label>
            <div class="input-group">
              <input type="password" class="form-control order-1" id="contrasenia">
              <div class="input-group-append order-0">
                <div class="input-group-text">
                  <svg class="input-group-icon icon-offset icon icon-lock" viewBox="0 0 106 106" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path transform="translate(3 3)" d="
                      M25 50 V 20 A 25 25 0 0 1 50 0 A 25 25 0 0 1 75 20 V 50 H 90 V 100 H 10 V 50 H 75 M50 85 A 5 5 0 0 1 45 80 V 70 A 5 5 0 0 1 50 65 A 5 5 0 0 1 55 70 V 80 A 5 5 0 0 1 50 85">
                    </path>
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <div class="form-row align-items-center">
            <div class="col-md-auto">
              <!-- Checkbox -->
              <div class="custom-control custom-checkbox mb-3 mb-md-0">
                <input type="checkbox" class="custom-control-input" id="sign-in-checkbox">
                <label class="custom-control-label" for="sign-in-checkbox">
                  I agree to <a href="#">terms and conditions</a>
                </label>
              </div>
            </div>
            <div class="col-md">
              <!-- REGISTRARSE -->
              <div class="text-center text-md-right">
                <button type="button" class="btn btn-outline-primary" id="btn-registro">
                  Sign up now
                </button>
              </div>
              <div id="resp"></div>
            </div>
        </div> <!-- / .form-row -->
        <!-- Link -->
        <p class="text-center text-muted mt-5 mb-0">
          <small>
            Already a member? <a href="sign-in.php">Sign in</a>.
          </small>
        </p>
    </form>        
</div>
</div> <!-- / .row -->
</div> <!-- / .container -->      
</section>

<?php include_once('Layouts/footer.php')?>