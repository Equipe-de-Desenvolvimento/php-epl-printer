 
<?php   
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: content-type");
$json_post = json_decode(file_get_contents("php://input"));

$url = "http://localhost/stg";
$empresa_id = "1";

$link_sistema =  $url."/autocomplete/imprimirEtiqueta/".$empresa_id;
$curl = curl_init(); 
curl_setopt_array($curl, array(
   CURLOPT_URL => $link_sistema,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS =>'{
    "token":"jw3G8LtPe4rs;q_T"
    }',
   CURLOPT_SSL_VERIFYPEER => false,
   CURLOPT_HTTPHEADER => array(
     'Content-Type: application/json',
     'Cookie: ci_session=a%3A4%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22792a5ae44d0df488616ae6347f604e86%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A7%3A%220.0.0.0%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A21%3A%22PostmanRuntime%2F7.28.4%22%3Bs%3A13%3A%22last_activity%22%3Bs%3A10%3A%221637263252%22%3B%7D6f072ded66055c4a12059cda4c137b17'
   ),
 )); 

 $response = curl_exec($curl);  
 curl_close($curl); 
//  echo $response;   
if(strlen($response) == 62){ 
  echo $response; 
} else{  
  print_r($response); 

  $formatada = $response;   
  $file = tempnam('C:/impressao', 'lbl'); 
  // Open the file for writing
  $handle = fopen($file, "w");   
  fwrite($handle, $formatada);
  fclose($handle); // Close the file   
  exec("COPY /B ".$file." \\\desktop-i1ea37j\\ZDesigner 2>&1", $out, $retval); 
  print_r(json_encode($out));
  unlink($file); 

}
?>

<script> 

setTimeout(function(){
   window.location.reload(1);
}, 300);

</script>
