<?php include_once('Layouts/header.php'); ?> 
<?php include_once('Layouts/navbar.php'); ?>

<section class="section section-top section-full">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-7 order-md-2"> 
                <label for="">Administrador con ID </label>
                <input type="text" id="usuario_registrado" value="<?php echo $_GET['id']; ?>">
            </div>
        </div>
    </div>
</section>

<?php include_once('Layouts/footer.php'); ?>