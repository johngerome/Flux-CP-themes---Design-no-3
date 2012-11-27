<?php if (!defined('FLUX_ROOT')) exit; ?>
<?php
$files = scandir(dirname(dirname(__FILE__)).'\photos');
$x = 0;
foreach ($files as $file){
    $file_hs = count(explode('.',$file));
	if ($file == '.' || $file == '..' || $file == 'Thumbs.db'){ 
		echo '';
    }
    else{
        if($x == 0){
        $x = 1;    
?>
      <a class="group4" href="<?php echo $this->themePath('photos/'.$file) ?>"><img src="<?php echo $this->themePath('photos/'.$file) ?>" class="active" /></a>
<?php 
        }else{
?>
        <a class="group4" href="<?php echo $this->themePath('photos/'.$file) ?>"><img src="<?php echo $this->themePath('photos/'.$file) ?>" /></a>
<?php
        }
    } 
}

?>
