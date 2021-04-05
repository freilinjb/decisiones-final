<section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i>¡UPS! Página no encontrada.</h3>

          <p>
          No pudimos encontrar la página que buscaba. Mientras tanto, <a href="home"> puede volver al panel de control </a> o intentar utilizar el formulario de búsqueda.
          </p>

          <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <?php 
                        $login = new UsuarioController();
                        $login->iniciarSecion();
                    ?>