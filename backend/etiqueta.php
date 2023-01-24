<?  

  include_once('inc/class.crud.etiqueta.php');
  include_once('inc/class.crud.carpeta.php');
  include_once('inc/class.crud.tipo.php');
  
  $etiqueta = new ETIQUETA;
  $carpeta = new CARPETA();
  $tipo = new TIPO();
  

  // create etiqueta
  if($_POST['action']=='add'){

      $etiqueta->create($link, $_POST['descripcionEtiqueta'], $_POST['idCarpeta'], $_POST['idTipo'], $_POST['vigenciaEtiq'], $_POST['sugerenciaEtiq']);
    }

  // editar etiqueta
  if($_POST['action']=='update'){
      $etiquetaDetails = $etiqueta->update($link, $_POST['descripcionEtiqueta'], $_POST['idCarpeta'], $_POST['idTipo'], $_POST['vigenciaEtiq'], $_POST['sugerenciaEtiq'], $_POST['idEtiqueta']);
  }

  // traer datos de etiqueta existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $etiquetaDetails = $etiqueta->find($link, $_POST['idEtiqueta']);
    
  }

  // eliminar etiqueta
  if($_POST['action']=='delete'){
    $etiqueta->delete($link, $_POST['idEtiqueta']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Etiqueta</h4>
        <?}else{?>
          <h4>Nuevo Etiqueta</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <input type="text" name="descripcionEtiqueta" value="<?=$etiquetaDetails['descripcionEtiqueta']?>" class="form-control" placeholder="Descripción de la Etiqueta" /><br>
          <select name="idCarpeta" class="form-control">
              <option value="">Seleccione Carpeta</option>

              <?
              $sq = $carpeta->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idCarpeta = $s['idCarpeta'];
                $titleCarpeta = $s['descripcionCarpeta'];
              ?>
              <option value="<?=$idCarpeta?>" <?if($idCarpeta == $etiquetaDetails['idCarpeta']){echo "selected";}?>><?=$idCarpeta?> - <?=$titleCarpeta?></option>
              <?}?>
          </select><br>
          <select name="idTipo" class="form-control">
              <option value="">Seleccione Tipo</option>

              <?
              $sq = $tipo->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idTipo = $s['idTipo'];
                $titleTipo = $s['descripcionTipo'];
              ?>
              <option value="<?=$idTipo?>" <?if($idTipo == $etiquetaDetails['idTipo']){echo "selected";}?>><?=$idTipo?> - <?=$titleTipo?></option>
              <?}?>
          </select><br>
          <input type="text" name="vigenciaEtiq" value="<?=$etiquetaDetails['vigenciaEtiq']?>" class="form-control" placeholder="Vigencia de la Etiqueta" /><br>
          <input type="text" name="sugerenciaEtiq" value="<?=$etiquetaDetails['sugerenciaEtiq']?>" class="form-control" placeholder="Sugerencia de la Etiqueta" /><br>
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idEtiqueta" value="<?=$etiquetaDetails['idEtiqueta']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=etiqueta">Nuevo</a>

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
      <h4>Etiquetas</h4>
      <table class="table">
        <tr>
          <td><b>IdEtiqueta</b></td>
          <td><b>Descripción</b></td>
          <td><b>idCarpeta</b></td>
          <td><b>idTipo</b></td>
          <td><b>Vigencia</b></td>
          <td><b>Sugerencia</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $etiqueta->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['descripcionEtiqueta']?></td>
            <td><?=$resultado['idCarpeta']?> - <?=$resultado['carpeta']?></td>
            <td><?=$resultado['idTipo']?> - <?=$resultado['tipo']?></td>
            <td><?=$resultado['vigenciaEtiq']?></td>
            <td><?=$resultado['sugerenciaEtiq']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idEtiqueta" value="<?=$resultado['idEtiqueta']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idEtiqueta" value="<?=$resultado['idEtiqueta']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 