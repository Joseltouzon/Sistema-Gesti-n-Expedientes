<?php 
	class PERSONATIPO{
	
		// read
		public function read($link){
			$sql = "SELECT *, PersonaTipo.idPT as id, Tipo.idTipo as idTipo, Tipo.descripcionTipo as tipo, Persona.idPersona as idPersona, Persona.nyaPersona as nombre, Nivel.idNivel as idNivel, Nivel.descripcionNivel as nivel, Colegio.idColegio as idColegio, Colegio.descripcionColegio as colegio FROM PersonaTipo 
			INNER JOIN Tipo ON Tipo.idTipo = PersonaTipo.idTipo 
			INNER JOIN Persona ON Persona.idPersona = PersonaTipo.idPersona 
			INNER JOIN Nivel ON Nivel.idNivel = PersonaTipo.idNivel 
			INNER JOIN Colegio ON Colegio.idColegio = PersonaTipo.idColegio 
			ORDER BY PersonaTipo.idPT LIMIT 20"; //echo $sql;
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idPT){
			$sql = "DELETE FROM PersonaTipo WHERE idPT = '$idPT'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $idPersona, $idColegio, $idTipo, $idNivel){
			$sql = "INSERT INTO PersonaTipo (idPersona, idColegio, idTipo, idNivel) VALUES ('$idPersona', '$idColegio', '$idTipo', '$idNivel')";  //echo $sql; 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $idPersona, $idColegio, $idTipo, $idNivel, $idPT){
			$sql = "UPDATE PersonaTipo SET idPersona = '$idPersona', idColegio = '$idColegio', idTipo = '$idTipo', idNivel = '$idNivel' WHERE idPT = '$idPT'"; // echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idPT){
			$sql = "SELECT * FROM PersonaTipo WHERE idPT = '$idPT' "; // echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>