<div class="login-page" style="min-height: 512.391px; background: #FE730C;">
    <div class="login-box">
        <div class="login-logo">
            <img src="https://pbs.twimg.com/profile_images/1002942670233145345/EgCJ-JK1_400x400.jpg" alt="Logo" width="100px" class="rounded-circle shadow-lg">
        </div>
        <div class="card shadow">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Regístrese para iniciar sesión</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="correo" value="freilinjb@gmail.com" placeholder="correo" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="clave" value="1423" placeholder="clave" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 float-right">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Recuérdame
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesion</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php 
                        $login = new UsuarioController();
                        $login->iniciarSecion();
                    ?>
                </form>
                <p class="mb-1 mt-1">
                    <a href="forgot-password.html">Olvidé mi contraseña</a>
                </p>
            </div>
        </div>
    </div>
</div>