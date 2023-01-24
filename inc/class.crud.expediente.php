<?php 
	class EXPEDIENTE{
	
		// read
		public function read($link){
			$sql = "SELECT *, Expediente.idExp as id, Carpeta.idCarpeta as idCarpeta, Carpeta.descripcionCarpeta as carpeta, Etiqueta.idEtiqueta as idEtiqueta, Etiqueta.descripcionEtiqueta as etiqueta FROM Expediente 
			INNER JOIN Carpeta ON Carpeta.idCarpeta = Expediente.idCarpeta 
			INNER JOIN Etiqueta ON Etiqueta.idEtiqueta = Expediente.idEtiqueta 
			ORDER BY Expediente.idExp LIMIT 20"; //echo $sql;
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idExp){
			$sql = "DELETE FROM Expediente WHERE idExp = '$idExp'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $asuntoExp, $detalleExp, $fechaExp, $vigenciaExp, $idCarpeta, $idEtiqueta, $adjuntoExp, $idCreadorExp, $idEditorExp){
			$sql = "INSERT INTO Expediente (asuntoExp, detalleExp, fechaExp, vigenciaExp, idCarpeta, idEtiqueta, adjuntoExp, idCreadorExp, idEditorExp) VALUES ('$asuntoExp', '$detalleExp', '$fechaExp', '$vigenciaExp', '$idCarpeta', '$idEtiqueta', '$adjuntoExp', '$idCreadorExp', '$idEditorExp')";  //echo $sql; 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $asuntoExp, $detalleExp, $fechaExp, $vigenciaExp, $idCarpeta, $idEtiqueta, $adjuntoExp, $idCreadorExp, $idEditorExp, $idExp){
			$sql = "UPDATE Expediente SET asuntoExp = '$asuntoExp', detalleExp = '$detalleExp', fechaExp = '$fechaExp', vigenciaExp = '$vigenciaExp', idCarpeta = '$idCarpeta', idEtiqueta = '$idEtiqueta', adjuntoExp = '$adjuntoExp', idCreadorExp = '$idCreadorExp', idEditorExp = '$idEditorExp' WHERE idExp = '$idExp'";  //echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idExp){
			$sql = "SELECT * FROM Expediente WHERE idExp = '$idExp' "; //echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>