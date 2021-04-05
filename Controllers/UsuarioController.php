<?php 

class UsuarioController {

    static public function iniciarSecion() {

        if(isset($_POST["correo"]) && !empty($_POST["correo"])) {

			if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $_POST["correo"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave"])){
                
                $table = "usuario";
                $item = "correo";
                $value = $_POST["correo"];


                $resquest = UsuarioModel::showUsers($table, $item, $value);


                if($resquest["correo"] == $_POST["correo"] && $resquest["clave"] == $_POST["clave"]) {

                    $_SESSION['iniciarSesion'] = true;
                    $_SESSION['idUsuario'] = $resquest["idUsuario"];
                    $_SESSION['nombre'] =  $resquest["nombre"];;
                    $_SESSION['slogan'] =  $resquest["slogan"];;
                    $_SESSION['urlLogo'] =  $resquest["urlLogo"];;
                    $_SESSION['correo'] =  $resquest["correo"];;
                    echo '<script>
								window.location = "home";
						</script>';
                    
                } else {
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
    }

    static public function mostrarUsuarios($item, $value) {
        $table = "usuarios_v";
        $request = UsuarioModel::showUsers($table, $item, $value);

        return $request;
    }
}
