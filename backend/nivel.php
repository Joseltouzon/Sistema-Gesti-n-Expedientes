<?  

  include_once('inc/class.crud.nivel.php');
  

  $nivel = new NIVEL();
  

  // create nivel
  if($_POST['action']=='add'){

      $nivel->create($link, $_POST['descripcionNivel']);
    }

  // editar nivel
  if($_POST['action']=='update'){
      $nivelDetails = $nivel->update($link, $_POST['descripcionNivel'], $_POST['idNivel']);
  }

  // traer datos de nivel existente

  if($_POST['action']=='find' || $_POST['action']=='update'){
    $nivelDetails = $nivel->find($link, $_POST['idNivel']);
    
  }

  // eliminar nivel
  if($_POST['action']=='delete'){
    $nivel->delete($link, $_POST['idNivel']);
  }
?>

  <div class="col-lg-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
          <h4>Modificar Nivel</h4>
        <?}else{?>
          <h4>Nuevo Nivel</h4>
        <?}?>
        <form method="post" enctype="multipart/form-data">
          <?=$estado?>
          <br>
          <input type="text" value="<?=$nivelDetails['descripcionNivel']?>" name="descripcionNivel" class="form-control" placeholder="Descripción del Nivel" /><br>
          
          <?if($_POST['action']=='find' || $_POST['action']=='update'){?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idNivel" value="<?=$nivelDetails['idNivel']?>">
            <button class="btn btn-warning btn-block" type="submit">Actualizar</button>
            <a class="btn btn-primary btn-block" href="?a=nivel">Nuevo</a>

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
      <h4>Niveles</h4>
      <table class="table">
        <tr>
          <td><b>IdNivel</b></td>
          <td><b>Descripción</b></td>
          <td><b>Acciones</b></td>
        </tr>
      
        <?
          $sq = $nivel->read($link);
        
        while($resultado = mysqli_fetch_array($sq)){
        ?>
          <tr>
            <td><?=$resultado['id']?></td>
            <td><?=$resultado['descripcionNivel']?></td>
            <td>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="find">
                  <input type="hidden" name="idNivel" value="<?=$resultado['idNivel']?>">
                  <button class="btn btn-warning btn-sm" type="submit">
                    <span class="fas fa-pen"></span>
                  </button>
                </form>
                <form method="post" class="float-left ml-2">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="idNivel" value="<?=$resultado['idNivel']?>">
                  <button class="btn btn-danger btn-sm" type="submit"><span class="fas fa-trash"></span></button>
                </form>
              <?}?>
            </td>
          </tr>
      </table>
    </div>
  </div>
</div> 

 