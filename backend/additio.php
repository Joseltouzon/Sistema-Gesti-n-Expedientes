<!DOCTYPE html >
<html>
<head>
  <title>Additio Ejemplo</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

<?php


  $curl = curl_init();
  $httpHeader = ['Content-Type: application/json', 'x-api-key: cacd5b46-ae4d-49da-c72d-14da33a8b4f2'];

  $url = "https://demos-api-partners.additioapp.com/";

  $action = $_GET['a'];
  // $action = "v1/groups";
  $url = $url.$action;

  // guid 
  if($_GET['guid']!=""){
    $guid = "/".$_GET['guid'];
    $url = $url.$guid;
  }
  
  // tabs 
  if($_GET['tabs']=="1"){
    $url = $url."/tabs";
  }  

  // tabs 
  if($_GET['expand']!=""){
    $url = $url."?expand=".$_GET['expand'];
  }  

  echo $url."<br><br><hr>";

  

  curl_setopt($curl, CURLOPT_URL, $url);

  // default = get 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  // envia header
  curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeader);

  $result = curl_exec($curl);

  curl_close($curl);

  // json_decode($result);


  $array = json_decode($result, true);

?>

<div class="container">

  <div class="row">
    <div class="col-2">
      <a href="?a=v1/group-bases" class="btn btn-primary form-control">Grupos Base</a>
      
    </div>

    <div class="col-2">
      <a href="?a=v1/group-bases?expand=studentGroupBases" class="btn btn-success form-control">Grupos Base (expandir)</a>
      
    </div>

    <div class="col-2">
      <a href="?a=v1/groups" class="btn btn-danger form-control">Grupos</a>
    </div>
  </div>
  <hr>
<?


if($_GET['a']=="v1/group-bases" && $_GET['guid']==""){
  foreach ($array as $v1) {
    //var_dump($v1);
    $body .= "Titulo: ".$v1['title']."<br>";
    $body .= "Color: ".$v1['color']."<br>";
    $body .= "Guid: <a href='?a=v1/groups&guid=".$v1['guid']."'>".$v1['guid']."</a><br>";
    $body .= "<hr>";


  }
}

if($_GET['a']=="v1/groups" && $_GET['guid']==""){
  foreach ($array as $v1) {
    //var_dump($v1);
    $body .= "Classroom: ".$v1['classroom']."<br>";
    $body .= "Color: ".$v1['color']."<br>";
    $body .= "Guid: <a href='?a=v1/groups&guid=".$v1['guid']."'>".$v1['guid']."</a><br>";
    $body .= "Subtitulo: ".$v1['subtitle']."<br>";
    $body .= "Titulo: ".$v1['title']."<br>";


  }
}

if($_GET['a']!="" && $_GET['guid']!=""){
  foreach ($array as $v1) {
    $body .= "Titulo: ".$v1['title']."<br>";
    $body .= "Subtitulo: ".$v1['subtitle']."<br>";
    $body .= "<hr>";

  }
}



if($_GET['expand']!="" && $_GET['a']=="v1/group-bases"){

  $body = "
    <table>
      <thead>
        <tr>
          <td>Ver</td>
          <td>Grupo</td>
          <td>DNI</td>
          <td>Apellido</td>
          <td>Nombre</td>
          <td>Fecha</td>
          <td>Apoderado</td>
          <td>Email</td>
        </tr>
      </thead>
      <tbody>
        ";
    

    foreach ($array as $v1) {
      $body .= "<tr>";
      foreach ($v1 as $v2) {
        
       
        foreach ($v2 as $v3) {
          $body .= "<tr>";
          $body .= "<td><a href='?guid=".$v1['guid']."'>Ver</a></td>";
          $body .= "<td>".$v1['title']."</td>";
          $body .= "<td>".$v3['ident']."</td>";
          $body .= "<td>".$v3['surname']."</td>";
          $body .= "<td>".$v3['name']."</td>";
          $body .= "<td>".$v3['updated_at']."</td>";
          $body .= "<td>".$v3['responsible1_name']."</td>";
          $body .= "<td>".$v3['responsible1_email']."</td>";
          
          
                
               
                }
          $body .= "</tr>";  
        }
      $body .= "</tr>"; 

     
    }
        
            
        
  $body .= "
        
      </tbody>
  </table>

  </body>
  </html>";
            

  
}

if($_GET['guid']!="" && $_GET['a']=="" && $_GET['expand']==""){
  $body = $_GET['guid'];

  foreach ($array as $v1) {
    var_dump($v1);
  }
}





echo $body;


?>


</div>
</body>
</html>