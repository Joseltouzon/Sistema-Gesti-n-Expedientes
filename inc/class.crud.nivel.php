<?php 
	class NIVEL{
	
		// read
		public function read($link){
			$sql = "SELECT *, Nivel.idNivel as id FROM Nivel ORDER BY Nivel.idNivel LIMIT 20";
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idNivel){
			$sql = "DELETE FROM Nivel WHERE idNivel = '$idNivel'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $descripcionNivel){
			$sql = "INSERT INTO Nivel (descripcionNivel) VALUES ('$descripcionNivel')"; // sql 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $descripcionNivel, $idNivel){
			$sql = "UPDATE Nivel SET descripcionNivel = '$descripcionNivel' WHERE idNivel = '$idNivel'"; //echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idNivel){
			$sql = "SELECT * FROM Nivel WHERE idNivel = '$idNivel' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>