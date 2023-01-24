<?php

include_once('inc/dbconfig.php');



  if($_POST['usuario']=="admin" && $_POST['password']=='123456'){
    $_SESSION['admin']='admin';
  }
  if($_GET['close']=="logout"){
    session_destroy();
    // redirecciona despues de cerrar sesión
    header("Location: backend.php");
  }


  
  
?>

<!DOCTYPE html>
<html>
  <?php //include_once('includes/head.php');
 /*  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> */?>
<head>
  <meta charset="UTF-8">
  <meta charset="ISO-8859-1">
    
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script   src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"   integrity="sha256-xI/qyl9vpwWFOXz7+x/9WkG5j/SVnSw21viy8fWwbeE="   crossorigin="anonymous"></script>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <script src="ckeditor/ckeditor.js"></script>


</head>
    
    <body>
    


    <?
    if($_SESSION['admin']==''){
      ?>
      <div class="container">
        <div class="col-lg-4">
          <div class="well">
            <form method="post">
              <h4>Administrador</h4>
              <input type="text" name="usuario" class="form-control" placeholder='Usuario'><br>
              <input type="password" name="password" class="form-control" placeholder='Clave'><br>
              <button class="form-control btn btn-primary" type="submit">Entrar</button>
            </form>    
          </div>
        </div>
      </div>  
      
    <?}else{?>
      <?include_once('backend/includes/admin_header.php');?><br>
      <div>
      <?
         
          include_once('backend/'.$_GET['a'].'.php'); 
        
      ?>
      </div>  
    <?}?>
   

  <!-- Bootstrap core JavaScript-->
  <script type="text/javascript" >
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor' );
  </script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  


   
  </body>
</html>

<?php mysqli_close($link);?>