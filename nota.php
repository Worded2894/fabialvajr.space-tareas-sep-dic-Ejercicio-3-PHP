<?php
error_reporting(0);
if (isset($_GET['dir']) && isset($_GET['note'])) {
    $dir = $_GET['dir'];
    $note = $_GET['note'];
} else {
    header("Location: index.php");
}

$file = "files/" . $dir . '/' . $note;
$filed = $note . '&dir=' . $dir;

$file_contents = file_get_contents($file);
if (($_POST['save'])) {
    file_put_contents($file, $_POST['valor-nota']);
    header('Location: nota.php?note=' . $filed);
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

<nav>
    <div class="nav-wrapper  #006064 cyan darken-4">
      <a href="directorio.php?dir=<?php echo $dir ?>"><strong>Regresar al directorio: </strong><?php echo $dir ?></a>
      <a href="index.php" class="brand-logo right">Bloc de Notas</a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
      </ul>
    </div>
  </nav>
  <br><br>
<div class="container">
    <form method="post" action="">
        <textarea name="valor-nota" style="height: 500px;" class="form-control bg-dark" id="" cols="30" rows="10"><?php echo $file_contents; ?></textarea>
        <input class="btn btn-secondary" type="submit" name="save" value="Guardar">
    </form>
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