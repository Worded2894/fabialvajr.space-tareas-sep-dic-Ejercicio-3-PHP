<?php /*
Diseñe una aplicación web que emule las funciones básicas del bloc de notas 
del menú Archivo (nuevo, abrir, leer, guardar) tantos archivos de tipos TXT 
como la crear carpetas, leer carpetas,etc.

Subir el código a GitHub, subir el proyecto terminado a un hosting 
y enviar ambos enlaces al correo juan.medina@urbe.edu.ve

--Fecha de entrega el 12-10-2023 a las 08:30pm.--

*/

$msg = null;

if (isset($_POST['create']) &&  isset($_POST['folder'])) {


    $name = $_POST['folder'];
    $directorio = "files/$name";

    try {

        if (!(is_dir($directorio))) {

            mkdir($directorio);
            $msg = 'Nuevo directorio agregado';
        } else {
            $msg = 'Ya existe un directorio con ese nombre.';
        }
    } catch (Exception $e) {
        echo 'Error: ',  $e->getMessage(), "\n\n";
    }
}

unset($_POST['create']);
unset($_POST['folder']);

function borrar_directorio($dirname) {
  if (is_dir($dirname)) {
      $dir_handle = opendir($dirname);
  } else {
      return false;  // Asegúrate de que $dir_handle se define en todos los casos
  }
  while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
          if (!is_dir($dirname."/".$file)) unlink($dirname."/".$file);
          else borrar_directorio($dirname.'/'.$file);
      }
  }
  closedir($dir_handle);
  rmdir($dirname);
  return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['delete'])) {
      $folder_to_delete = $_POST['folder_to_delete'];
      borrar_directorio('files/' . $folder_to_delete);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio3
    </title>

         <!--Import Google Icon Font-->
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body class="#f5f5f5 grey lighten-4">
<!-- Barra de herramientas-->
<div>
  <nav>
    <div class="nav-wrapper #006064 cyan darken-4">
      <a href="#" class="brand-logo right">Bloc de Notas</a>
      <div class="container">
      <ul id="nav-mobile" class="left hide-on-med-and-down">
       <li> 
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <div class="input-group mb-3">
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                  <li>
                    <input autocomplete="off" type="text" name="folder" class="form-control #00897b teal darken-1" placeholder="Ej: Tareas" aria-describedby="button-addon2">
                  </li>
                  <li>
                    <button type="submit" name="create" class="btn btn-outline-secondary" type="button" id="button-addon2">Crear Directorio</button>
                  </li>
                  </ul>
                </div>
          </form>
        </li>
      </ul>
      </div>
    </div>
  </nav>
</div>

<div class="container">
<h3>Selecciona una carpeta o crea una nueva</h3>
</div>

<div class="container row row-cols-4 w-75 mx-auto">
        <strong id="negrita"><?php echo $msg ?></strong><br>
        <table class="highlight #e0f2f1 teal lighten-5">
            <caption style="color: aliceblue;">Directorios</caption>
            <thead>
                <tr>
                    <th scope="col">Nombre de la carpeta</th>
                    <th scope="col">Ultima Actualizacion</th>
                    <th scope="col">Clase</th>
                </tr>
            </thead>
            <tbody>
              <?php
              try {
                  $dir = 'files';
                  $dirs  = scandir($dir);

                  foreach ($dirs as $direc) {
                      if ('.' !== $direc && '..' !== $direc) {
              ?>
                          <tr>
                              <td><i class="material-icons">folder</i> <a href="directorio.php?dir=<?php echo $direc ?>" class="card-link"><?php echo $direc ?></a></td>
                              <td><?php date_default_timezone_set('America/Caracas'); echo date("d-m-Y H:i:s", filemtime($dir)); ?></td>
                              <td>Carpeta</td>
                              <!-- Botón de borrar -->
                              <td>
                                  <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                      <input type="hidden" name="folder_to_delete" value="<?php echo $direc ?>">
                                      <button type="submit" name="delete"><i class="material-icons">delete_forever</i></button>
                                  </form>
                              </td>
                          </tr>

              <?php
                      }
                  }
              } catch (Exception $e) {
                  echo 'Se ha encontrado un error: ',  $e->getMessage(), "\n\n";
              }
              ?>
          </tbody>

        </table>
    </div>



    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
	
    <br><br>
</body>

<footer class="page-footer #4db6ac teal lighten-2">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">FABIAN ALVAREZ</h5>
                <p class="grey-text text-lighten-4">Programación Web N-1013.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="http://fabialvajr.space/tareas-sep-dic/Ejercicio%201/">Ejercicio 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="http://fabialvajr.space/tareas-sep-dic/Ejercicio%202/">Ejercicio 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="http://fabialvajr.space/tareas-sep-dic/Ejercicio%203/">Ejercicio 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="http://fabialvajr.space/tareas-sep-dic/Ejercicio%204/">Ejercicio 4</a></li>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2023 Fabian Alvarez. All rights reserved.
            <a class="grey-text text-lighten-4 right" href="https://youtu.be/KTbynh5cRcQ?si=7uUJ0u55pMxph2QO">zzz</a>
            </div>
          </div>
</footer>
</html>