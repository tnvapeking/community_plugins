<?php
/**
 * Front page for plugin repository
 */

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

//download stats - We had 1,400,000 before the plugin upgrade
//$number_downloaded = (int)$CONFIG->site->plugins_download_count;
//$num_plugins = get_entities("object", "plugin_project", 0, "", 0, 0, true);
//$area1 = elgg_view('plugins/download_count', array(	'plugin_count' => $num_plugins,
//													'download_count' => $number_downloaded));

//list newest
$newest = get_entities('object',"plugin_project");

//Most downloaded
set_context('search');
$popular = get_entities_from_annotation_count("object", "plugin_project", "download");

//Most dugg
$dugg = get_entities_from_annotation_count("object", "plugin_project", "plugin_digg");

//last updated
$updated = elgg_get_entities(array('object' => 'plugin_project', 'order_by' => 'e.time_updated desc'));
set_context('plugin_project');

$welcome = elgg_view('plugins/front/main');
$sidebar = elgg_view('plugins/front/sidebar');
$bottom = elgg_view('plugins/front/bottom', array(	'newest' => $newest,
													'updated' => $updated,
													'popular' => $popular,
													'dugg' => $dugg,));


$body = elgg_view_layout('plugin_frontpage', $welcome, $sidebar, $bottom);

page_draw(elgg_echo("plugins:all"), $body);