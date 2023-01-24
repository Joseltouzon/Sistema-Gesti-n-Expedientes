<?php 
	class ADJUNTO{
	
		// read
		public function read($link){
			$sql = "SELECT *, Adjunto.idAdjunto as id, Expediente.idExp as idExp, Expediente.asuntoExp as asunto FROM Adjunto INNER JOIN Expediente ON Expediente.idExp = Adjunto.idExp ORDER BY Adjunto.idAdjunto LIMIT 20";
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idAdjunto){
			$sql = "DELETE FROM Adjunto WHERE idAdjunto = '$idAdjunto'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $idExp, $archivoAdjunto){
			$sql = "INSERT INTO Adjunto (idExp, archivoAdjunto) VALUES ('$idExp', '$archivoAdjunto')"; // echo $sql; 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
            $directorio='adjuntos/'.$idAdjunto;
			 // si no existe la carpeta en el directorio la crea.
		    if (!is_dir($directorio)){
		        mkdir($directorio, 0777);
		        chmod($directorio, 0777);
		    } 
		    if(!empty($archivoAdjunto)){ 
		        $tipo = $_FILES['archivoAdjunto']['type'];
		        $tamano = $_FILES['archivoAdjunto']['size'];
		        move_uploaded_file($_FILES['archivoAdjunto']['tmp_name'],$directorio.'/'.$archivoAdjunto);
		    }
			
		}

        //editar
		public function update($link, $idExp, $archivoAdjunto, $idAdjunto){
			$sql = "UPDATE Adjunto SET idExp = '$idExp'";
			$directorio='adjuntos/'.$idAdjunto;
			 // si no existe la carpeta en el directorio la crea.
		    if (!is_dir($directorio)){
		        mkdir($directorio, 0777);
		        chmod($directorio, 0777);
		    } 
		    if(!empty($archivoAdjunto)){ 
		        $tipo = $_FILES['archivoAdjunto']['type'];
		        $tamano = $_FILES['archivoAdjunto']['size'];
		        move_uploaded_file($_FILES['archivoAdjunto']['tmp_name'],$directorio.'/'.$archivoAdjunto);
		        $sql = $sql." , archivoAdjunto = '$archivoAdjunto' ";
		    }

		    $sql .= " WHERE idAdjunto = '$idAdjunto'"; // echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idAdjunto){
			$sql = "SELECT * FROM Adjunto WHERE idAdjunto = '$idAdjunto' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>