<?php
/**
 *  Pvp Rankings
 *  Author: "Gerome" John Gerome Baldonado 
 *  Required: pvpladder Script
 */


if (!defined('FLUX_ROOT')) exit;

$pvpladder	= Flux::config('FluxTables.pvpladder'); 
$title    = 'Pvp Ranking';
$classes  = Flux::config('JobClasses')->toArray();
$jobClass = $params->get('jobclass');
$bind     = array((int)Flux::config('RankingHideLevel'));


if (trim($jobClass) === '') {
	$jobClass = null;
}

if (!is_null($jobClass) && !array_key_exists($jobClass, $classes)) {
	$this->deny();
}

$col  = "ch.char_id, ch.name AS char_name, ch.class AS char_class, ch.base_level, $pvpladder.`deaths`, ch.job_level, $pvpladder.`kills`, ";
$col .= "ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len";

$sql  = "SELECT $col FROM {$server->charMapDatabase}.`char` AS ch ";
$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
$sql .= "LEFT JOIN {$server->loginDatabase}.$pvpladder ON $pvpladder.char_id = ch.char_id ";
$sql .= "WHERE 1=1 ";

if (Flux::config('HidePermBannedCharRank')) {
	$sql .= "AND login.state != 5 ";
}
if (Flux::config('HideTempBannedCharRank')) {
	$sql .= "AND (login.unban_time IS NULL OR login.unban_time = 0) ";
}

$sql .= "AND login.group_id < ? ";

if ($days=Flux::config('CharRankingThreshold')) {
	$sql    .= 'AND TIMESTAMPDIFF(DAY, login.lastlogin, NOW()) <= ? ';
	$bind[]  = $days * 24 * 60 * 60;
}

if (!is_null($jobClass)) {
	$sql .= "AND ch.class = ? ";
	$bind[] = $jobClass;
}

$sql .= "ORDER BY `kills` DESC, ch.char_id ASC ";
$sql .= "LIMIT ".(int)Flux::config('CharRankingLimit');
$sth  = $server->connection->getStatement($sql);

$sth->execute($bind);

$chars = $sth->fetchAll();
?>