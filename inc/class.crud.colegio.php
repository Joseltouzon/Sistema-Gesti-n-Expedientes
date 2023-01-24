<?php 
	class COLEGIO{
		
		
		// read
		public function read($link){
			$sql = "SELECT *, Colegio.idColegio as id FROM Colegio ORDER BY Colegio.idColegio LIMIT 20";
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idColegio){
			$sql = "DELETE FROM Colegio WHERE idColegio = '$idColegio'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $descripcionColegio){
			$sql = "INSERT INTO Colegio (descripcionColegio) VALUES ('$descripcionColegio')"; // sql 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $descripcionColegio, $idColegio){
			$sql = "UPDATE Colegio SET descripcionColegio = '$descripcionColegio' WHERE idColegio = '$idColegio'"; // echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idColegio){
			$sql = "SELECT * FROM Colegio WHERE idColegio = '$idColegio' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>