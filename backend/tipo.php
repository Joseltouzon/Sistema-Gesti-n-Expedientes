<?  

  include_once('inc/class.crud.tipo.php');
  

  $tipo = new TIPO();
  

  // create tipo
  if($_POST['action']=='add'){

      $tipo->create($link, $_POST['descripcionTipo']);
    }

  // editar tipo
  if($_POST['action']=='update'){
      $tipoDetails = $tipo->update($link, $_POST['descripcionTipo'], $_POST['idTipo']);
  }

  // traer datos de tipo existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $tipoDetails = $tipo->find($link, $_POST['idTipo']);
    
  }

  // eliminar tipo
  if($_POST['action']=='delete'){
    $tipo->delete($link, $_POST['idTipo']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Tipo</h4>
        <?}else{?>
          <h4>Nuevo Tipo</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <input type="text" value="<?=$tipoDetails['descripcionTipo']?>" name="descripcionTipo" class="form-control" placeholder="Descripción del Tipo" /><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idTipo" value="<?=$tipoDetails['idTipo']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=tipo">Nuevo</a>

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
      <h4>Tipos</h4>
      <table class="table">
        <tr>
          <td><b>IdTipo</b></td>
          <td><b>Descripción</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $tipo->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['descripcionTipo']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idTipo" value="<?=$resultado['idTipo']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idTipo" value="<?=$resultado['idTipo']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 