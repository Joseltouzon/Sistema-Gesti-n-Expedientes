<?  

  include_once('inc/class.crud.adjunto.php');
  include_once('inc/class.crud.expediente.php');
  

  $adjunto = new ADJUNTO();
  $expediente = new EXPEDIENTE();
  

  // create adjunto
  if($_POST['action']=='add'){
      $archivoAdjunto = $_FILES['archivoAdjunto']['name'];
      $adjunto->create($link, $_POST['idExp'], $archivoAdjunto);
    }

  // editar adjunto
  if($_POST['action']=='update'){
      $archivoAdjunto = $_FILES['archivoAdjunto']['name'];
      $adjuntoDetails = $adjunto->update($link, $_POST['idExp'], $archivoAdjunto, $_POST['idAdjunto']);
  }

  // traer datos de adjunto existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $adjuntoDetails = $adjunto->find($link, $_POST['idAdjunto']);
    
  }

  // eliminar adjunto
  if($_POST['action']=='delete'){
    $adjunto->delete($link, $_POST['idAdjunto']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Adjunto</h4>
        <?}else{?>
          <h4>Nuevo Adjunto</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <select name="idExp" class="form-control">
              <option value="">Seleccione Expediente</option>

              <?
              $sq = $expediente->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idExp = $s['idExp'];
                $titleExp = $s['asuntoExp'];
              ?>
              <option value="<?=$idExp?>" <?if($idExp == $adjuntoDetails['idExp']){echo "selected";}?>><?=$idExp?> - <?=$titleExp?></option>
              <?}?>
            </select><br>
            Archivo Adjunto
            <input class="form-control" name="archivoAdjunto" type="file"><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idAdjunto" value="<?=$adjuntoDetails['idAdjunto']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=adjunto">Nuevo</a>

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
      <h4>Adjuntos</h4>
      <table class="table">
        <tr>
          <td><b>IdAdjunto</b></td>
          <td><b>IdExpediente</b></td>
          <td><b>Archivo Adjunto</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $adjunto->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['idExp']?> - <?=$resultado['asunto']?></td>
            <td><?=$resultado['archivoAdjunto']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idAdjunto" value="<?=$resultado['idAdjunto']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idAdjunto" value="<?=$resultado['idAdjunto']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 