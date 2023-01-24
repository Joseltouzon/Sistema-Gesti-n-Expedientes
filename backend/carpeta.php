<?  

  include_once('inc/class.crud.carpeta.php');
  include_once('inc/class.crud.tipo.php');
  

  $carpeta = new CARPETA();
  $tipo = new TIPO();
  

  // create carpeta
  if($_POST['action']=='add'){

      $carpeta->create($link, $_POST['descripcionCarpeta'], $_POST['idTipo']);
    }

  // editar carpeta
  if($_POST['action']=='update'){
      $carpetaDetails = $carpeta->update($link, $_POST['descripcionCarpeta'], $_POST['idTipo'], $_POST['idCarpeta']);
  }

  // traer datos de carpeta existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $carpetaDetails = $carpeta->find($link, $_POST['idCarpeta']);
    
  }

  // eliminar carpeta
  if($_POST['action']=='delete'){
    $carpeta->delete($link, $_POST['idCarpeta']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Carpeta</h4>
        <?}else{?>
          <h4>Nuevo Carpeta</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <input type="text" name="descripcionCarpeta" value="<?=$carpetaDetails['descripcionCarpeta']?>" class="form-control" placeholder="Descripción de la Carpeta" /><br>
          <select name="idTipo" class="form-control">
              <option value="">Seleccione Tipo</option>

              <?
              $sq = $tipo->read($link);
              while($s = mysqli_fetch_array($sq)){
                $idTipo = $s['idTipo'];
                $titleTipo = $s['descripcionTipo'];
              ?>
              <option value="<?=$idTipo?>" <?if($idTipo == $carpetaDetails['idTipo']){echo "selected";}?>><?=$idTipo?> - <?=$titleTipo?></option>
              <?}?>
            </select><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idCarpeta" value="<?=$carpetaDetails['idCarpeta']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=carpeta">Nuevo</a>

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
      <h4>Carpetas</h4>
      <table class="table">
        <tr>
          <td><b>IdCarpeta</b></td>
          <td><b>Descripción</b></td>
          <td><b>idTipo</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $carpeta->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['descripcionCarpeta']?></td>
            <td><?=$resultado['idTipo']?> - <?=$resultado['tipo']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idCarpeta" value="<?=$resultado['idCarpeta']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idCarpeta" value="<?=$resultado['idCarpeta']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 