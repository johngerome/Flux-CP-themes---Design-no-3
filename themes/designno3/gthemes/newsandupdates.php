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

//Configure variable as part of news table
$news = Flux::config('FluxTables.NewsTable'); 

//SQL. Straight forward.
$sql = "SELECT title, body, link, author, created, modified FROM {$server->loginDatabase}.$news ORDER BY id DESC ";
//Limit to the amount of news articles defined in the config.
$sql .= "LIMIT ".(int)Flux::config('LimitNews');

$sth = $server->connection->getStatement($sql);
$sth->execute();
$c=0;
$news = $sth->fetchAll();
?>

<?php if($news): ?>
<?php foreach($news as $nrow):?>
<ul class="item">
        <li class="title"><?php echo $nrow->title ?></li>
        <li class="postedby"><small>posted by: <?php echo $nrow->author ?></small></li>
        <li class="date"><small>-<?php echo $nrow->created?></small></li>
</ul>
<ul class="itemContentContainer cleanMP">
        <li class="itemContent cleanMP">
                <?php echo $nrow->body ?>
        </li>
        <li class="cleanMP">
        <?php if($nrow->created != $nrow->modified):?>
				<small class="date"><?php echo htmlspecialchars(Flux::message('ModifiedLabel')) ?> : <?php echo $nrow->modified ?></small>
			<?php endif; ?>
			<?php if($nrow->link): ?>
				<a class="news_link" href="<?php echo htmlspecialchars($nrow->link) ?>"><small><?php echo htmlspecialchars(Flux::message('NewsLink')) ?></small></a>
			<?php endif; ?>

		</li>
</ul>
<?php endforeach; ?>
	
<?php else: ?>
	<p><?php echo htmlspecialchars(Flux::message('NewsEmpty')) ?><br/><br/></p>
<?php endif ?>
