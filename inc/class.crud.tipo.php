<?php 
	class TIPO{
		
		
		// read
		public function read($link){
			$sql = "SELECT *, Tipo.idTipo as id FROM Tipo ORDER BY Tipo.idTipo LIMIT 20";
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idTipo){
			$sql = "DELETE FROM Tipo WHERE idTipo = '$idTipo'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $descripcionTipo){
			$sql = "INSERT INTO Tipo (descripcionTipo) VALUES ('$descripcionTipo')"; // sql 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $descripcionTipo, $idTipo){
			$sql = "UPDATE Tipo SET descripcionTipo = '$descripcionTipo' WHERE idTipo = '$idTipo'"; //echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idTipo){
			$sql = "SELECT * FROM Tipo WHERE idTipo = '$idTipo' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>