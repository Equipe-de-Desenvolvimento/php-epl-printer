 
<?php   

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: content-type");
$json_post = json_decode(file_get_contents("php://input"));
  
$teste =  $json_post->data->etiquetaEPL;

// $label = $obj->compile($data ,1);  
$formatada = str_replace("&quot;",'"',$teste);
$formatada = str_replace("\n@","\r\n",$formatada);

$file = tempnam('C:/impressao', 'lbl');

// Open the file for writing
$handle = fopen($file, "w");  

fwrite($handle, $formatada);
fclose($handle); // Close the file  
 
exec("COPY /B ".$file." \\\desktop-i1ea37j\\ZDesigner 2>&1", $out, $retval);
 
print_r(json_encode($out));
unlink($file);    

?>
