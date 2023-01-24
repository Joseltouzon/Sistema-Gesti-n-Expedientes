<?php 
	class PERSONA{
	
		// read
		public function read($link){
			$sql = "SELECT *, Persona.idPersona as id FROM Persona ORDER BY Persona.idPersona LIMIT 20";
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idPersona){
			$sql = "DELETE FROM Persona WHERE idPersona = '$idPersona'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $nyaPersona, $dniPersona){
			$sql = "INSERT INTO Persona (nyaPersona, dniPersona) VALUES ('$nyaPersona', '$dniPersona')"; // sql 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $nyaPersona, $dniPersona, $idPersona){
			$sql = "UPDATE Persona SET nyaPersona = '$nyaPersona', dniPersona = '$dniPersona' WHERE idPersona = '$idPersona'"; // echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idPersona){
			$sql = "SELECT * FROM Persona WHERE idPersona = '$idPersona' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>