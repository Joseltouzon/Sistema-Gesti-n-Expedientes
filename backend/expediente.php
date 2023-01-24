<?  

  include_once('inc/class.crud.expediente.php');
  include_once('inc/class.crud.etiqueta.php');
  include_once('inc/class.crud.carpeta.php');
  

  $expediente = new EXPEDIENTE();
  $etiqueta = new ETIQUETA();
  $carpeta = new CARPETA();
  

  // create expediente
  if($_POST['action']=='add'){

      $expediente->create($link, $_POST['asuntoExp'], $_POST['detalleExp'], $_POST['fechaExp'], $_POST['vigenciaExp'], $_POST['idCarpeta'], $_POST['idEtiqueta'], $_POST['adjuntoExp'], $_POST['idCreadorExp'], $_POST['idEditorExp']);
    }

  // editar expediente
  if($_POST['action']=='update'){
      $expedienteDetails = $expediente->update($link, $_POST['asuntoExp'], $_POST['detalleExp'], $_POST['fechaExp'], $_POST['vigenciaExp'], $_POST['idCarpeta'], $_POST['idEtiqueta'], $_POST['adjuntoExp'], $_POST['idCreadorExp'], $_POST['idEditorExp'], $_POST['idExp']);
  }

  // traer datos de expediente existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $expedienteDetails = $expediente->find($link, $_POST['idExp']);
    
  }

  // eliminar expediente
  if($_POST['action']=='delete'){
    $expediente->delete($link, $_POST['idExp']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Expediente</h4>
        <?}else{?>
          <h4>Nuevo Expediente</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <input type="text" value="<?=$expedienteDetails['asuntoExp']?>" name="asuntoExp" class="form-control" placeholder="Asunto Exp" /><br>
          <input type="text" value="<?=$expedienteDetails['detalleExp']?>" name="detalleExp" class="form-control" placeholder="Detalle Exp" /><br>
          <input type="text" value="<?=$expedienteDetails['fechaExp']?>" name="fechaExp" class="form-control" placeholder="Fecha Exp" /><br>
          <input type="text" value="<?=$expedienteDetails['vigenciaExp']?>" name="vigenciaExp" class="form-control" placeholder="Vigencia Exp" /><br>
          <select name="idCarpeta" class="form-control">
              <option value="">Seleccione Carpeta</option>

              <?
              $sq = $carpeta->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idCarpeta = $s['idCarpeta'];
                $titleCarpeta = $s['descripcionCarpeta'];
              ?>
              <option value="<?=$idCarpeta?>" <?if($idCarpeta == $expedienteDetails['idCarpeta']){echo "selected";}?>><?=$idCarpeta?> - <?=$titleCarpeta?></option>
              <?}?>
          </select><br>          
          <select name="idEtiqueta" class="form-control">
              <option value="">Seleccione Etiqueta</option>

              <?
              $sq = $etiqueta->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idEtiqueta = $s['idEtiqueta'];
                $titleEtiqueta = $s['descripcionEtiqueta'];
              ?>
              <option value="<?=$idEtiqueta?>" <?if($idEtiqueta == $expedienteDetails['idEtiqueta']){echo "selected";}?>><?=$idEtiqueta?> - <?=$titleEtiqueta?></option>
              <?}?>
          </select><br>
          <input type="text" value="<?=$expedienteDetails['adjuntoExp']?>" name="adjuntoExp" class="form-control" placeholder="Adjunto Exp" /><br>
          <input type="text" value="<?=$expedienteDetails['idCreadorExp']?>" name="idCreadorExp" class="form-control" placeholder="Id Creador Exp" /><br>
          <input type="text" value="<?=$expedienteDetails['idEditorExp']?>" name="idEditorExp" class="form-control" placeholder="Id Editor Exp" /><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idExp" value="<?=$expedienteDetails['idExp']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=expediente">Nuevo</a>

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
      <h4>Expedientes</h4>
      <table class="table">
        <tr>
          <td><b>IdExp</b></td>
          <td><b>Asunto Exp</b></td>
          <td><b>Detalle Exp</b></td>
          <td><b>Fecha Exp</b></td>
          <td><b>Vigencia Exp</b></td>
          <td><b>idCarpeta</b></td>
          <td><b>idEtiqueta</b></td>
          <td><b>Adjunto Exp</b></td>
          <td><b>Id Creador</b></td>
          <td><b>Id Editor</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $expediente->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['asuntoExp']?></td>
            <td><?=$resultado['detalleExp']?></td>
            <td><?=$resultado['fechaExp']?></td>
            <td><?=$resultado['vigenciaExp']?></td>
            <td><?=$resultado['idCarpeta']?> - <?=$resultado['carpeta']?></td>
            <td><?=$resultado['idEtiqueta']?> - <?=$resultado['etiqueta']?></td>
            <td><?=$resultado['adjuntoExp']?></td>
            <td><?=$resultado['idCreadorExp']?></td>
            <td><?=$resultado['idEditorExp']?></td>
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

 