<?php 
	class CARPETA{
	
		// read
		public function read($link){
			$sql = "SELECT *, Carpeta.idCarpeta as id, Tipo.idTipo as idTipo, Tipo.descripcionTipo as tipo FROM Carpeta INNER JOIN Tipo ON Carpeta.idTipo = Tipo.idTipo ORDER BY Carpeta.idCarpeta LIMIT 20";
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idCarpeta){
			$sql = "DELETE FROM Carpeta WHERE idCarpeta = '$idCarpeta'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $descripcionCarpeta, $idTipo){
			$sql = "INSERT INTO Carpeta (descripcionCarpeta, idTipo) VALUES ('$descripcionCarpeta', '$idTipo')"; // sql 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $descripcionCarpeta, $idTipo, $idCarpeta){
			$sql = "UPDATE Carpeta SET descripcionCarpeta = '$descripcionCarpeta', idTipo = '$idTipo' WHERE idCarpeta = '$idCarpeta'"; // echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idCarpeta){
			$sql = "SELECT * FROM Carpeta WHERE idCarpeta = '$idCarpeta' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>