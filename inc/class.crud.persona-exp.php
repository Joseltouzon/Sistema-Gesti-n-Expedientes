<?php 
	class PERSONAEXP{
	
		// read
		public function read($link){
			$sql = "SELECT *, PersonaExp.idExp as id, PersonaTipo.idPT as idPT, Persona.nyaPersona as nombre FROM PersonaExp INNER JOIN PersonaTipo ON PersonaTipo.idPT = PersonaExp.idPT LEFT JOIN Persona ON Persona.IdPersona = PersonaTipo.IdPersona ORDER BY PersonaExp.idExp LIMIT 20";
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idExp){
			$sql = "DELETE FROM PersonaExp WHERE idExp = '$idExp'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $idPT){
			$sql = "INSERT INTO PersonaExp (idPT) VALUES ('$idPT')"; //echo $sql; 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $idPT ,$idExp){
			$sql = "UPDATE PersonaExp SET idPT = '$idPT' WHERE idExp = '$idExp'"; // echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idExp){
			$sql = "SELECT * FROM PersonaExp WHERE idExp = '$idExp' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>