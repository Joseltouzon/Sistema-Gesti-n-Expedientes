<?php 
	class PERMISO{
	
		// read
		public function read($link){
			$sql = "SELECT *, Permiso.idPermiso as id, Tipo.idTipo as idTipo, Tipo.descripcionTipo as tipo, Etiqueta.idEtiqueta as idEtiqueta, Etiqueta.descripcionEtiqueta as etiqueta, Nivel.idNivel as idNivel, Nivel.descripcionNivel as nivel, Colegio.idColegio as idColegio, Colegio.descripcionColegio as colegio FROM Permiso 
			INNER JOIN Tipo ON Tipo.idTipo = Permiso.idTipo 
			INNER JOIN Etiqueta ON Etiqueta.idEtiqueta = Permiso.idEtiqueta
			INNER JOIN Nivel ON Nivel.idNivel = Permiso.idNivel 
			INNER JOIN Colegio ON Colegio.idColegio = Permiso.idColegio 
			ORDER BY Permiso.idPermiso LIMIT 20"; //echo $sql;
			$sq = mysqli_query($link, $sql);
			return $sq;
			
		}


		// delete
		public function delete($link, $idPermiso){
			$sql = "DELETE FROM Permiso WHERE idPermiso = '$idPermiso'";
    		$sq = mysqli_query($link, $sql);
		}
        
        //create
		public function create($link, $idEtiqueta, $idColegio, $idTipo, $idNivel, $Acceso){
			$sql = "INSERT INTO Permiso (idEtiqueta, idColegio, idTipo, idNivel, Acceso) VALUES ('$idEtiqueta', '$idColegio', '$idTipo', '$idNivel', '$Acceso')";  //echo $sql; 
			
            $sq = mysqli_query($link, $sql); 
            $id = mysqli_insert_id($link);
			
		}

        //editar
		public function update($link, $idEtiqueta, $idColegio, $idTipo, $idNivel, $Acceso, $idPermiso){
			$sql = "UPDATE Permiso SET idEtiqueta = '$idEtiqueta', idColegio = '$idColegio', idTipo = '$idTipo', idNivel = '$idNivel', Acceso = '$Acceso' WHERE idPermiso = '$idPermiso'";  //echo $sql;
			if(mysqli_query($link, $sql)){return true;}else{return false;}
		}

		// find
		public function find($link, $idPermiso){
			$sql = "SELECT * FROM Permiso WHERE idPermiso = '$idPermiso' "; //echo $sql; 
			$sq = mysqli_query($link , $sql);
			$s = mysqli_fetch_array($sq);
			return $s;
		}
	
	}
?>