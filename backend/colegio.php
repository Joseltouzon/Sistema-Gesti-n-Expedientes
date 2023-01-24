<?  

  include_once('inc/class.crud.colegio.php');
  

  $colegio = new COLEGIO();
  

  // create colegio
  if($_POST['action']=='add'){

      $colegio->create($link, $_POST['descripcionColegio']);
    }

  // editar colegio
  if($_POST['action']=='update'){
      $colegioDetails = $colegio->update($link, $_POST['descripcionColegio'], $_POST['idColegio']);
  }

  // traer datos de colegio existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $colegioDetails = $colegio->find($link, $_POST['idColegio']);
    
  }

  // eliminar colegio
  if($_POST['action']=='delete'){
    $colegio->delete($link, $_POST['idColegio']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Colegio</h4>
        <?}else{?>
          <h4>Nuevo Colegio</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <input type="text" value="<?=$colegioDetails['descripcionColegio']?>" name="descripcionColegio" class="form-control" placeholder="Descripción del Colegio" /><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idColegio" value="<?=$colegioDetails['idColegio']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=colegio">Nuevo</a>

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
      <h4>Colegios</h4>
      <table class="table">
        <tr>
          <td><b>IdColegio</b></td>
          <td><b>Descripción</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $colegio->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['descripcionColegio']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idColegio" value="<?=$resultado['idColegio']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idColegio" value="<?=$resultado['idColegio']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 