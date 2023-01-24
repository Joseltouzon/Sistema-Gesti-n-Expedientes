<?php 
	class ETIQUETA{
	
		// read
		public function read($link){
			$sql = "SELECT *, Etiqueta.idEtiqueta as id, Tipo.idTipo as idTipo, Tipo.descripcionTipo as tipo, Carpeta.idCarpeta as idCarpeta, Carpeta.descripcionCarpeta as carpeta FROM Etiqueta INNER JOIN Tipo ON Tipo.idTipo = Etiqueta.idTipo INNER JOIN Carpeta ON Carpeta.idCarpeta = Etiqueta.idCarpeta ORDER BY Etiqueta.idEtiqueta LIMIT 20";
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idEtiqueta){
			$sql = "DELETE FROM Etiqueta WHERE idEtiqueta = '$idEtiqueta'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $descripcionEtiqueta, $idCarpeta, $idTipo, $vigenciaEtiq, $sugerenciaEtiq){
			$sql = "INSERT INTO Etiqueta (descripcionEtiqueta, idCarpeta, idTipo, vigenciaEtiq, sugerenciaEtiq) VALUES ('$descripcionEtiqueta', '$idCarpeta', '$idTipo', '$vigenciaEtiq', '$sugerenciaEtiq')"; // sql 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $descripcionEtiqueta, $idCarpeta, $idTipo, $vigenciaEtiq, $sugerenciaEtiq, $idEtiqueta){
			$sql = "UPDATE Etiqueta SET descripcionEtiqueta = '$descripcionEtiqueta', idCarpeta = '$idCarpeta', idTipo = '$idTipo', vigenciaEtiq = '$vigenciaEtiq', sugerenciaEtiq = '$sugerenciaEtiq' WHERE idEtiqueta = '$idEtiqueta'"; // echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idEtiqueta){
			$sql = "SELECT * FROM Etiqueta WHERE idEtiqueta = '$idEtiqueta' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>