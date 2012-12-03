<?php 
/*-------------------------------------
// Created by: Harrison aka CalciumKid
---------------------------------------
// Released Exclusively for the RAthena
// development boards. Please do not
// redistribute my work without
// permission and leave all credits in
// tact.
---------------------------------------
// !!!THIS WORK IS COPYRIGHTED!!!
// Contact: calciumkid@live.com.au
-------------------------------------*/
if (!defined('FLUX_ROOT')) exit;
?>  
<div id="news">       

<?php if($news): ?>
<div class="newsDiv">
	<?php foreach($news as $nrow):?>
		
		<div class="newsCont">
		<h4><?php echo $nrow->title ?></h4>
			<span class="newsDate"><small>by <?php echo $nrow->author ?> on <?php echo date('m-d-y',strtotime($nrow->created))?></small></span>
			<p><?php echo $nrow->body ?></p>
			<?php if($nrow->created != $nrow->modified):?>
				<small><?php echo htmlspecialchars(Flux::message('ModifiedLabel')) ?> : <?php echo date('m-d-y',strtotime($nrow->modified))?></small>
			<?php endif; ?>
			<?php if($nrow->link): ?>
				<a class="news_link" href="<?php echo $nrow->link ?>"><small><?php echo htmlspecialchars(Flux::message('NewsLink')) ?></small></a>
				<div class="clear"></div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?> 
</div>
<?php else: ?>
	<p>
		<?php echo htmlspecialchars(Flux::message('NewsEmpty')) ?><br/><br/>
	</p>
<?php endif ?>
</div>  