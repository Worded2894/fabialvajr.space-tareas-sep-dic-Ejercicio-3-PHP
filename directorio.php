<?php

if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
    $msg = null;
    

    if (isset($_POST['createn'])) {

        if (isset($_POST['namen']) && isset($_POST['contentn']) && isset($_POST['dir'])) {
            $name = $_POST['namen'];
            $dir = $_POST['dir'];
            $content = $_POST['contentn'];
            $direct = "files/$dir/$name.txt";
            $msg = '';
            try {

                if (file_exists($direct)) {
                    $msg = "Ya existe un archivo con el nombre nombre <b>$name</b>";
                } else {
                    $nota = fopen($direct, 'a');
                    fputs($nota, $content);
                    fclose($nota);

                    header('Location: directorio.php?dir=' . $dir);
                }
            } catch (Exception $exp) {
                echo 'Excepción capturada: ',  $exp->getMessage(), "\n\n";
            }
        }
    }
    unset($_POST['createn']);
    unset($_POST['namen']);
} else {
    header("Location: index.php");
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

<body>
    <nav class= "nav-wrapper #006064 cyan darken-4">
    <a href="#" class="brand-logo center">Bloc de Notas</a>
        <div class="container">
            <a class="navbar-brand " href="index.php"><i class="material-icons left">arrow_back</i> Inicio</a>
        </div>
    </nav>
    <br>
    <div class="container">

    <div class="row row-cols-4 w-75 mx-auto">
            <table class="highlight #e0f2f1 teal lighten-5">
                <caption style="color: aliceblue;">Notas en este directorio</caption>
                <thead>
                    <tr>
                        <th scope="col">Nombre de archivo</th>
                        <th scope="col">Previzualización</th>
                        <th scope="col">Actualizacion más reciente</th>
                        <th scope="col">Clase</th>
                        <th scope="col">Tamaño</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $directorio = "./files/" . $dir;
                    $direc  = scandir($directorio);

                    if (count($direc) > 2) {
                        foreach ($direc as $valor) {
                            if ('.' !== $valor && '..' !== $valor) {

                                $file = "./files/" . $dir . '/' . $valor;

                                if (filesize($file) > 0) {
                                    $contents = file_get_contents($file, FILE_USE_INCLUDE_PATH);
                                } else {
                                    $contents = 'No hay contenido aun';
                                }

                    ?>
                                <tr>
                                    <td><i class="fa-sharp fa-solid fa-note-sticky"></i> <a href="nota.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="card-link"><?php echo rtrim($valor) ?></a></td>
                                    <td><?php
                                        if (filesize($file) <= 29) {
                                            echo '<p class="card-text"><i>' . substr($contents, 0, 28) . '</i></p>';
                                        } else {
                                            echo '<p class="card-text"><i>' . substr($contents, 0, 28) . '...</i></p>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php date_default_timezone_set('America/Caracas'); echo date("d-m-Y H:i:s", filemtime($file)); ?></td>
                                    <td><?php echo filetype($file) ?></td>
                                    <td><?php echo filesize($file) ?> bytes</td>
                                </tr>

                    <?php


                            }
                        }
                    }

                    ?>

        </div>

        <p><b><a href="index.php"><i class=" tiny material-icons">arrow_back</i>.../</a> <?php echo $dir ?></a></b></p>
        <hr>
        <div>
            <form action="directorio.php?dir=<?php echo $dir ?>" method="post">
                <textarea placeholder="Escribe algo..." name="contentn" style="height: 500px;" class="form-control bg-dark" id="" cols="30" rows="10"></textarea>
                <br>
                <input type="hidden" name="dir" value="<?php echo $dir ?>">
                <div class="input-group mb-3">
                    <input autocomplete="off" type="text" name="namen" class="form-control" placeholder="Ponle un titulo a tu nota" aria-describedby="button-addon2">
                    <button type="submit" name="createn" value="create" class="btn btn-outline-secondary" id="button-addon2">Crear</button>
                </div>
            </form>
            <br>
        </div>

        <p><?php echo $msg ?></p>
        <br>
        
    </div>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
	
    <br><br>
</body>
</html>