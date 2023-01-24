<?php
	class USER{
		// connection
		public function __construct(){
        	$db = new DB_con();
    	}

    	// read
    	public function read($showall,$rol, $consejera, $nombre, $dni, $cod, $apellido,$mail){
    		$sql = "SELECT * FROM adm2_user WHERE consejera <> '' ";
            if(!empty($nombre)){
                $sql.= " AND nombre like '%$nombre%' ";
            }
            if(!empty($dni)){
                $sql.= " AND dni like '%$dni%' ";
            }
            if(!empty($cod)){
                $sql.= " AND consejera like '%$cod%' ";
            }

            if(!empty($apellido)){
                $sql.= " AND apellido like '%$apellido%' ";
            }

            if(!empty($mail)){
                $sql.= " AND email like '%$mail%' ";
            }

            if($rol!="Administrador"){
                switch ($rol) {
                    case 'Gerente':
                        $sql .= " AND gerente = '$consejera' ";
                        break;
                    case 'Empresaria':
                        $sql .= " AND empresaria = '$consejera' ";
                        break;
                    case 'Consejera':
                        $sql .= " AND consejera = '$consejera' ";
                        break;
                }

            }else{
                if($showall!="ok"){
                    $sql .= " LIMIT 100";
                }
            }




            if($_GET['admin']){
                echo $sql;
            }
			
            //echo $sql;
			$sq = mysql_query($sql);
    		return $sq;
    	}

        public function olvidePass($dni,$mail){
            $sql = "SELECT * FROM adm2_user where email = '$mail' AND dni = '$dni' ";
            
            $sq = mysql_query($sql);
            $s = mysql_fetch_array($sq);
            return $s;

        }

        public function registro($dni,$mail, $clave , $consejera){
            $clave = md5($clave);
            // busco el usuario a ver si tiene o no mail registrado.
            $sql = "SELECT * FROM adm2_user where consejera = '$consejera' AND dni = '$dni' AND email <> '' ";

            $sq = mysql_query($sql);
            if(mysql_num_rows($sq)>0){
                return false;
            }else{
                // si el usuario tiene campo email vacio hace actualización de sus datos según el ingreso.
                $sql = "UPDATE adm2_user SET email = '$mail', clave = '$clave' WHERE dni = '$dni' AND consejera = '$consejera' ";

                $sq = mysql_query($sql);                
                return $sql;
            }
        }

    	// find
    	public function find($id){
    		$sql = "SELECT * FROM adm2_user WHERE id_user = '$id'";

    		$sq = mysql_query($sql);
    		$s = mysql_fetch_array($sq);
    		return $s;
    	}

        public function find_by_consejera($int){
            $sql = "SELECT * FROM adm2_user WHERE consejera = '$int'";
            $sq = mysql_query($sql);
            $s = mysql_fetch_array($sq);
            return $s;
        }
        // find
        public function find_by_dni($dni){
            if($dni != "admin"){
                $sql = "SELECT consejera.id_user as id_user,consejera.gerente as idGerente, consejera.Empresaria as idEmpresaria, consejera.direccion, consejera.partido, consejera.id_prov, consejera.cv, consejera.localidad,  consejera.dni as dniconsejera,consejera.consejera as idConsejera,consejera.nombre as nombreconsejera, consejera.apellido as apellidoconsejera, consejera.telefono,consejera.telefono, consejera.email, consejera.id_zona as zonauser, gerente.nombre as nombregerente, gerente.apellido as apellidogerente,  empresaria.nombre as nombreempresaria, empresaria.apellido as apellidoempresaria FROM adm2_user consejera 
                    left join provincias on provincias.id_prov = consejera.id_prov 
                    left join zonas on zonas.id = consejera.id_zona

                    left join adm2_user gerente on gerente.consejera = consejera.gerente
                    left join adm2_user empresaria on empresaria.consejera = consejera.empresaria


                    WHERE consejera.dni = '$dni' ";

                    
                $sq = mysql_query($sql);
                $s = mysql_fetch_array($sq);
            }
            return $s;

        }

        public function login($dni, $clave){
            if($dni != "admin"){
                $clave = mysql_real_escape_string($clave);
                $clave = md5($clave);
                $dni = mysql_real_escape_string($dni);
                $sql = "SELECT consejera.id_user as id_user,consejera.gerente as idGerente, consejera.Empresaria as idEmpresaria, consejera.direccion, consejera.partido, consejera.id_prov, consejera.cv, consejera.localidad,  consejera.dni as dniconsejera,consejera.consejera as idConsejera,consejera.nombre as nombreconsejera, consejera.apellido as apellidoconsejera, consejera.telefono,consejera.telefono, consejera.email, consejera.id_zona as zonauser, gerente.nombre as nombregerente, gerente.apellido as apellidogerente,  empresaria.nombre as nombreempresaria, empresaria.apellido as apellidoempresaria FROM adm2_user consejera 
                    left join provincias on provincias.id_prov = consejera.id_prov 
                    left join zonas on zonas.id = consejera.id_zona

                    right join adm2_user gerente on gerente.consejera = consejera.gerente
                    right join adm2_user empresaria on empresaria.consejera = consejera.empresaria


                    WHERE consejera.dni = '$dni' AND consejera.clave = '$clave' ";

                    
                
                $sq = mysql_query($sql);
                $s = mysql_fetch_array($sq);
            }
            return $s;

        }




    	public function update($gerente, $empresaria, $email, $telefono, $direccion, $localidad, $partido, $id_prov, $canal_verde, $dni){
    		$sql = "UPDATE adm2_user SET  email = '$email',telefono = '$telefono',direccion = '$direccion',localidad = '$localidad' ,partido = '$partido' ,id_prov = '$id_prov',cv = '$canal_verde' WHERE dni = '$dni'";

            $sq = mysql_query($sql);
    		return $sq;
    	}

        public function updateByConsejera($email, $telefono, $direccion, $localidad, $partido, $id_prov, $canal_verde,$consejera){
            $sql = "UPDATE adm2_user SET  email = '$email',telefono = '$telefono',direccion = '$direccion',localidad = '$localidad' ,partido = '$partido' ,id_prov = '$id_prov',cv = '$canal_verde' WHERE consejera = '$consejera'";

            $sq = mysql_query($sql) or die(mysql_error());
            
            return $sq;
        }

        public function actualizaClave($dni, $email, $nuevaClave){
            $nuevaClave = md5($nuevaClave);
            $sql = "UPDATE adm2_user SET clave = '$nuevaClave' WHERE dni = '$dni' AND email = '$email' ";
            if($_GET['admin']=="ok"){
                echo $sql;
            }
            $sq = mysql_query($sql);
            return $sq;
        }


        public function consejeras($empresaria){
            $sql = "SELECT * FROM adm2_user ";

            if($_SESSION['dni']!="admin"){
                $sql .= " where empresaria = '$empresaria' ";
            }

            $sql .= " ORDER BY consejera ASC ";

            $sq = mysql_query($sql);

            return $sq;
        }

        public function consejerasEmpresarias($id,$desde,$hasta){
            $sql = "SELECT * FROM adm2_user ";
            $sql .= " where consejera <> 0 AND (empresaria = '$id' OR gerente = '$id') ";
            $sql .= " group by adm2_user.dni ORDER BY consejera ASC ";
            
            $sq = mysql_query($sql);

            return $sq;
        }

        public function empresarias($id, $desde, $hasta){
            $sql = "SELECT adm2_user.consejera, adm2_user.nombre, adm2_user.apellido from pedidos 
                    inner join zonas on pedidos.gerente = zonas.bls_ger
                    inner join adm2_user on pedidos.empresaria = adm2_user.empresaria
                    where pedidos.gerente = '1' ";
            if($desde!=""){$sql .= " AND pedidos.fecha > $desde ";}
            if($hasta!=""){$sql .= " AND pedidos.fecha < $hasta ";}
            

            $sql .= " GROUP BY consejera";
            
            $sq = mysql_query($sql);

            return $sq;
        }



        public function consejeraConPedidos($id, $desde,$hasta, $rol){
            $sql = "SELECT pedidos.consejera,adm2_user.nombre, adm2_user.apellido from pedidos inner join adm2_user on adm2_user.consejera = pedidos.consejera ";
            if(!empty($desde) || !empty($hasta)){$sql .= " inner join zonas on zonas.bls_ger = pedidos.gerente ";}



            if(!empty($desde) || !empty($hasta)){$sql .= "and pedidos.fecha > zonas.llg_fecorigen and pedidos.fecha < zonas.llg_fecfin ";}
            
            $sql .= "group by adm2_user.consejera";


            $sq = mysql_query($sql);

            return $sq;
        }

        public function personasConPedidos($rol, $id, $desde,$hasta){
            $sql = "SELECT pedidos.empresaria,pedidos.nombre, pedidos.apellido from pedidos left join adm2_user on adm2_user.consejera = pedidos.consejera ";
            if(!empty($desde) || !empty($hasta)){$sql .= " inner join zonas on zonas.bls_ger = pedidos.gerente ";}



            if(!empty($desde) || !empty($hasta)){$sql .= "and pedidos.fecha > '$desde' and pedidos.fecha < '$hasta' ";}
            if($rol=="Gerente" || $rol=="Administrador"){
                $sql .= " AND pedidos.gerente = '$id' ";
            }
            if($rol=="Empresaria"){
                $sql .= " AND pedidos.empresaria = '$id' ";
            }
            $sql .= "group by adm2_user.empresaria";
            if($_GET['admin']=="ok"){
                echo $sql;
            }
            $sq = mysql_query($sql);

            return $sq;
        }
        public function empresariasConPedidos($rol, $id, $desde,$hasta){
            $sql = "SELECT pedidos.empresaria, adm2_user.nombre, adm2_user.apellido from pedidos inner join adm2_user on adm2_user.consejera = pedidos.empresaria ";
            if(!empty($desde) || !empty($hasta)){$sql .= " inner join zonas on zonas.bls_ger = pedidos.gerente ";}



            if(!empty($desde) || !empty($hasta)){$sql .= " and cast(pedidos.fecha as date) BETWEEN '$desde' and '$hasta' ";}
            if($rol=="Gerente" || $rol=="Administrador"){
                $sql .= " AND pedidos.gerente = '$id' ";
            }
            if($rol=="Empresaria"){
                $sql .= " AND pedidos.empresaria = '$id' ";
            }
            $sql .= "group by pedidos.empresaria";
            if($_GET['admin']=="ok"){
                echo $sql;
            }
            $sq = mysql_query($sql);

            return $sq;
        }

        public function create($gerente, $empresaria, $consejera, $email, $telefono, $direccion, $localidad, $partido, $id_prov, $canal_verde, $dni, $nombre, $apellido){
            
            $nombre = mysql_real_escape_string($nombre);
            $apellido = mysql_real_escape_string($apellido);
            $email = mysql_real_escape_string($email);
            $telefono = mysql_real_escape_string($telefono);
            $direccion = mysql_real_escape_string($direccion);
            $localidad = mysql_real_escape_string($localidad);

            $sql = "INSERT INTO adm2_user (gerente, consejera, empresaria, email, telefono, direccion, localidad, partido, id_prov, dni, nombre, apellido) VALUES ('$gerente', '$consejera', '$empresaria', '$email', '$telefono', '$direccion', '$localidad', '$partido', '$id_prov', '$dni', '$nombre', '$apellido') ";


            $sq = mysql_query($sql);
            $id = mysql_insert_id();
            return $id;
        }


        // METODOS PARA ALTA MASIVA
        public function createMasiva($gerente, $empresaria, $consejera, $email, $telefono, $direccion, $localidad, $partido, $id_prov, $canal_verde, $dni, $nombre, $apellido,$status){

            $nombre = mysql_real_escape_string($nombre);
            $apellido = mysql_real_escape_string($apellido);
            $email = mysql_real_escape_string($email);
            $telefono = mysql_real_escape_string($telefono);
            $direccion = mysql_real_escape_string($direccion);
            $localidad = mysql_real_escape_string($localidad);
            $sql = "INSERT INTO adm2_user (gerente, consejera, empresaria, email, telefono, direccion, localidad, partido, id_prov, dni, nombre, apellido, status) VALUES ('$gerente', '$consejera', '$empresaria', '$email', '$telefono', '$direccion', '$localidad', '$partido', '$id_prov', '$dni', '$nombre', '$apellido','$status') ";

            $sq = mysql_query($sql);
            if($sq!=true){
                echo $dni."<br>";
            }
            $id = mysql_insert_id();
            return $id;
        }

        public function existe($consejera,$empresaria,$gerente){
            $sql = "SELECT consejera FROM adm2_user WHERE  gerente = '$gerente' AND empresaria = '$empresaria' AND consejera = '$consejera' ";
            
            $sq = mysql_query($sql);
            $s = mysql_fetch_array($sq);
            return $s['consejera'];
        }

        // actualiza el id Carga para un usuario que ya existe
        public function actualizaCarga($file_consejera,$file_gerente, $file_empresaria, $file_nombre, $file_apellido, $file_dni, $status){
            $file_nombre = mysql_real_escape_string($file_nombre);
            $file_dni = mysql_real_escape_string($file_dni);
            $file_apellido = mysql_real_escape_string($file_apellido);
            $sql = "UPDATE adm2_user set status = '$status', gerente = '$file_gerente', empresaria = '$file_empresaria', nombre = '$file_nombre', apellido = '$file_apellido',  dni = '$file_dni' WHERE consejera = '$file_consejera' ";
            $sq = mysql_query($sql);
            
        }

        // actualiza el id Carga para un usuario que ya existe
        public function clean(){
            $sq = mysql_query("DELETE from adm2_user WHERE status = 0 ");
        }

        // actualiza el id Carga para un usuario que ya existe
        public function iniciaStatus(){
            $sq = mysql_query("UPDATE adm2_user SET status = 0 ");
        }
    }
?>