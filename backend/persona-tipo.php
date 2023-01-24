<?  

  include_once('inc/class.crud.persona-tipo.php');
  include_once('inc/class.crud.tipo.php');
  include_once('inc/class.crud.nivel.php');
  include_once('inc/class.crud.persona.php');
  include_once('inc/class.crud.colegio.php');
  

  $personaTipo = new PERSONATIPO();
  $tipo = new TIPO();
  $nivel = new NIVEL();
  $persona = new PERSONA();
  $colegio = new COLEGIO();
  

  // create personaTipo
  if($_POST['action']=='add'){

      $personaTipo->create($link, $_POST['idPersona'], $_POST['idColegio'], $_POST['idTipo'], $_POST['idNivel']);
    }

  // editar personaTipo
  if($_POST['action']=='update'){
      $personaTipoDetails = $personaTipo->update($link, $_POST['idPersona'], $_POST['idColegio'], $_POST['idTipo'], $_POST['idNivel'], $_POST['idPT']);
  }

  // traer datos de personaTipo existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $personaTipoDetails = $personaTipo->find($link, $_POST['idPT']);
    
  }

  // eliminar personaTipo
  if($_POST['action']=='delete'){
    $personaTipo->delete($link, $_POST['idPT']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Persona Tipo</h4>
        <?}else{?>
          <h4>Nuevo Persona Tipo</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <select name="idTipo" class="form-control">
              <option value="">Seleccione Tipo</option>

              <?
              $sq = $tipo->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idTipo = $s['idTipo'];
                $titleTipo = $s['descripcionTipo'];
              ?>
              <option value="<?=$idTipo?>" <?if($idTipo == $personaTipoDetails['idTipo']){echo "selected";}?>><?=$idTipo?> - <?=$titleTipo?></option>
              <?}?>
          </select><br>
          <select name="idNivel" class="form-control">
              <option value="">Seleccione Nivel</option>

              <?
              $sq = $nivel->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idNivel = $s['idNivel'];
                $titleNivel = $s['descripcionNivel'];
              ?>
              <option value="<?=$idNivel?>" <?if($idNivel == $personaTipoDetails['idNivel']){echo "selected";}?>><?=$idNivel?> - <?=$titleNivel?></option>
              <?}?>
          </select><br>
          <select name="idPersona" class="form-control">
              <option value="">Seleccione Persona</option>

              <?
              $sq = $persona->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idPersona = $s['idPersona'];
                $titlePersona = $s['nyaPersona'];
              ?>
              <option value="<?=$idPersona?>" <?if($idPersona == $personaTipoDetails['idPersona']){echo "selected";}?>><?=$idPersona?> - <?=$titlePersona?></option>
              <?}?>
          </select><br>
          <select name="idColegio" class="form-control">
              <option value="">Seleccione Colegio</option>

              <?
              $sq = $colegio->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idColegio = $s['idColegio'];
                $titleColegio = $s['descripcionColegio'];
              ?>
              <option value="<?=$idColegio?>" <?if($idColegio == $personaTipoDetails['idColegio']){echo "selected";}?>><?=$idColegio?> - <?=$titleColegio?></option>
              <?}?>
          </select><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idPT" value="<?=$personaTipoDetails['idPT']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=persona-tipo">Nuevo</a>

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
      <h4>Tipos Persona</h4>
      <table class="table">
        <tr>
          <td><b>IdPT</b></td>
          <td><b>idPersona</b></td>
          <td><b>IdTipo</b></td>
          <td><b>idNivel</b></td>
          <td><b>idColegio</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $personaTipo->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['idPersona']?> - <?=$resultado['nombre']?></td>
            <td><?=$resultado['idTipo']?> - <?=$resultado['tipo']?></td>
            <td><?=$resultado['idNivel']?> - <?=$resultado['nivel']?></td>
            <td><?=$resultado['idColegio']?> - <?=$resultado['colegio']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idPT" value="<?=$resultado['idPT']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idPT" value="<?=$resultado['idPT']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 