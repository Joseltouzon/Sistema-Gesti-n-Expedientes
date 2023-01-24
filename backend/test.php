<?
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=api.xls");
?>
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

  

  curl_setopt($curl, CURLOPT_URL, $url);

  // default = get 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  // envia header
  curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeader);

  $result = curl_exec($curl);

  curl_close($curl);

  // json_decode($result);


  $array = json_decode($result, true);

$body = "
  <table>
    <thead>
      <tr>
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
        $body .= "<tr>
        <td>".$v1['title']."</td>";
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
          

echo $body;



?>

