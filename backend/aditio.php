<?php


      function simple_curl($url){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        $content = curl_exec ($ch);
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close ($ch);
        return $contentType;
      }

      $url = " https://demos-centers.additioapp.com/";
      
      // deberíamos levantarlo desde mi cuenta
      $usuario = "info+northfield@additioapp.com";  
      $password = 'cDv$gESwGr9#gqa$2*0O';
      $key = "cacd5b46-ae4d-49da-c72d-14da33a8b4f2";

      // DETALLE DE UN GRUPO 
      if($_GET['m']=="listarGrupos"){
        $metodo = $url."v1/groups";

      }

      if($_GET['m']=="listarGrupos2"){
        $metodo = $url."v1/groups";


        $response = get_web_page("http://socialmention.com/search?q=iphone+apps&f=json&t=microblogs&lang=fr");
        $resArr = array();
        $resArr = json_decode($response);
        echo "<pre>"; print_r($resArr); echo "</pre>";

        function get_web_page($url) {
            $options = array(
                CURLOPT_RETURNTRANSFER => true,   // return web page
                CURLOPT_HEADER         => false,  // don't return headers
                CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                CURLOPT_ENCODING       => "",     // handle compressed
                CURLOPT_USERAGENT      => "test", // name of client
                CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                CURLOPT_TIMEOUT        => 120,    // time-out on response
            ); 

            $ch = curl_init($url);
            curl_setopt_array($ch, $options);

            $content  = curl_exec($ch);

            curl_close($ch);

            return $content;
        }



      }



?>


<div class="col-lg-12 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      




    </div>
  </div>
</div> 

 