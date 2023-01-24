<?  

  include_once('inc/class.crud.persona.php');
  

  $persona = new PERSONA();
  

  // create persona
  if($_POST['action']=='add'){

      $persona->create($link, $_POST['nyaPersona'], $_POST['dniPersona']);
    }

  // editar persona
  if($_POST['action']=='update'){
      $personaDetails = $persona->update($link, $_POST['nyaPersona'], $_POST['dniPersona'], $_POST['idPersona']);
  }

  // traer datos de persona existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $personaDetails = $persona->find($link, $_POST['idPersona']);
    
  }

  // eliminar persona
  if($_POST['action']=='delete'){
    $persona->delete($link, $_POST['idPersona']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Persona</h4>
        <?}else{?>
          <h4>Nuevo Persona</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <input type="text" name="nyaPersona" class="form-control" value="<?=$personaDetails['nyaPersona']?>" placeholder="Nombre y Apellido" /><br>
          <input type="text" name="dniPersona" class="form-control" value="<?=$personaDetails['dniPersona']?>" placeholder="DNI" /><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idPersona" value="<?=$personaDetails['idPersona']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=persona">Nuevo</a>

          <?}else{?>
            <input type="hidden" name="action" value="add">
            <button class="btn btn-success btn-block" type="submit">Cargar</button>
          <?}?>
        </form>
      </div>
    </div>
  </div>


<div class="col-lg-12 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <h4>Personas</h4>
      <table class="table">
        <tr>
          <td><b>IdPersona</b></td>
          <td><b>Nombre y Apellido</b></td>
          <td><b>DNI</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $persona->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['nyaPersona']?></td>
            <td><?=$resultado['dniPersona']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idPersona" value="<?=$resultado['idPersona']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idPersona" value="<?=$resultado['idPersona']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 