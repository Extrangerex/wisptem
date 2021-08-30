  
              <?php






              $carpeta="../../backups/";
function orden($a,$b){  
global $carpeta;
$directorio='directorio/';
return strcmp(strtolower($b), strtolower($a));
}
$carpeta=opendir($carpeta);
while($archivos=readdir($carpeta)){
$archivo[]=$archivos;  
usort($archivo, "orden");  
}
foreach($archivo as $file){


?>
    
    	  <p class="page-header"><?php echo $file; ?></p>
        <a href="Ajax/download.php?file=<?php echo $file; ?>" target="_blank" >
        <img src="../../images/database.png" class="img-rounded" width="100px" height="100px"  /></a>
        <p class="page-header">
        <span>

<?php
}
closedir($carpeta);
 ?>
 