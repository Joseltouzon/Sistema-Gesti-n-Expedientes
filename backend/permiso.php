<?  

  include_once('inc/class.crud.permiso.php');
  include_once('inc/class.crud.tipo.php');
  include_once('inc/class.crud.nivel.php');
  include_once('inc/class.crud.etiqueta.php');
  include_once('inc/class.crud.colegio.php');
  

  $permiso = new PERMISO();
  $tipo = new TIPO();
  $nivel = new NIVEL();
  $etiqueta = new ETIQUETA();
  $colegio = new COLEGIO();
  

  // create permiso
  if($_POST['action']=='add'){

      $permiso->create($link, $_POST['idEtiqueta'], $_POST['idColegio'], $_POST['idTipo'], $_POST['idNivel'], $_POST['Acceso']);
    }

  // editar permiso
  if($_POST['action']=='update'){
      $permisoDetails = $permiso->update($link, $_POST['idEtiqueta'], $_POST['idColegio'], $_POST['idTipo'], $_POST['idNivel'], $_POST['Acceso'], $_POST['idPermiso']);
  }

  // traer datos de permiso existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $permisoDetails = $permiso->find($link, $_POST['idPermiso']);
    
  }

  // eliminar permiso
  if($_POST['action']=='delete'){
    $permiso->delete($link, $_POST['idPermiso']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Permiso</h4>
        <?}else{?>
          <h4>Nuevo Permiso</h4>
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
              <option value="<?=$idTipo?>" <?if($idTipo == $permisoDetails['idTipo']){echo "selected";}?>><?=$idTipo?> - <?=$titleTipo?></option>
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
              <option value="<?=$idNivel?>" <?if($idNivel == $permisoDetails['idNivel']){echo "selected";}?>><?=$idNivel?> - <?=$titleNivel?></option>
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
              <option value="<?=$idEtiqueta?>" <?if($idEtiqueta == $permisoDetails['idEtiqueta']){echo "selected";}?>><?=$idEtiqueta?> - <?=$titleEtiqueta?></option>
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
              <option value="<?=$idColegio?>" <?if($idColegio == $permisoDetails['idColegio']){echo "selected";}?>><?=$idColegio?> - <?=$titleColegio?></option>
              <?}?>
          </select><br>
          <input type="text" value="<?=$permisoDetails['Acceso']?>" name="Acceso" class="form-control" placeholder="Acceso" /><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idPermiso" value="<?=$permisoDetails['idPermiso']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=permiso">Nuevo</a>

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
      <h4>Permisos</h4>
      <table class="table">
        <tr>
          <td><b>IdPermiso</b></td>
          <td><b>idEtiqueta</b></td>
          <td><b>IdTipo</b></td>
          <td><b>idNivel</b></td>
          <td><b>idColegio</b></td>
          <td><b>Acceso</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $permiso->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['idEtiqueta']?> - <?=$resultado['etiqueta']?></td>
            <td><?=$resultado['idTipo']?> - <?=$resultado['tipo']?></td>
            <td><?=$resultado['idNivel']?> - <?=$resultado['nivel']?></td>
            <td><?=$resultado['idColegio']?> - <?=$resultado['colegio']?></td>
            <td><?=$resultado['Acceso']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idPermiso" value="<?=$resultado['idPermiso']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idPermiso" value="<?=$resultado['idPermiso']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 