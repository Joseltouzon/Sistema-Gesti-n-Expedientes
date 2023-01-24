<?  

  include_once('inc/class.crud.persona-exp.php');
  include_once('inc/class.crud.persona-tipo.php');
  include_once('inc/class.crud.persona.php');
  

  $personaExp = new PERSONAEXP();
  $personaTipo = new PERSONATIPO();
  $persona = new PERSONA();
  

  // create personaExp
  if($_POST['action']=='add'){

      $personaExp->create($link, $_POST['idPT']);
    }

  // editar personaExp
  if($_POST['action']=='update'){
      $personaExpDetails = $personaExp->update($link, $_POST['idPT'], $_POST['idExp']);
  }

  // traer datos de personaExp existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $personaExpDetails = $personaExp->find($link, $_POST['idExp']);
    
  }

  // eliminar personaExp
  if($_POST['action']=='delete'){
    $personaExp->delete($link, $_POST['idExp']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Persona Exp</h4>
        <?}else{?>
          <h4>Nuevo Persona Exp</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          
          <select name="idPT" class="form-control">
              <option value="">Seleccione Persona Tipo</option>

              <?
              $sq = $personaTipo->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idPersonaTipo = $s['id'];
                $titlePT = $s['nombre'];
              ?>
              <option value="<?=$idPersonaTipo?>" <?if($idPersonaTipo == $personaExpDetails['idPT']){echo "selected";}?>><?=$idPersonaTipo?> - <?=$titlePT?></option>
              <?}?>
            </select><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idExp" value="<?=$personaExpDetails['idExp']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=persona-exp">Nuevo</a>

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
      <h4>Persona Exp</h4>
      <table class="table">
        <tr>
          <td><b>IdExp</b></td>
          <td><b>idPT - Nombre</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $personaExp->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['idPT']?> - <?=$resultado['nombre']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idExp" value="<?=$resultado['idExp']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idExp" value="<?=$resultado['idExp']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 