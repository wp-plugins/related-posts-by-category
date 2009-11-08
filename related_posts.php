<?php
/*
Plugin Name: Related Posts by Category
Plugin URI: http://playground.ebiene.de/400/related-posts-by-category-the-wordpress-plugin-for-similar-posts/
Description: The WordPress Plugin for similar posts grouped by category. It's small. It's fast. Really.
Author: Sergej M&uuml;ller
Version: 0.4
Author URI: http://www.wpseo.org
*/


function related_posts_by_category($params, $post_id = 0) {
$entries = array();
$output = '';
$limit = 0;
$type = '';
$order = '';
$orderby = '';
$post_id = intval($post_id);
if (!$post_id) {
$post_id = $GLOBALS['post']->ID;
}
if (isset($params['limit'])) {
$limit = intval($params['limit']);
}
if (isset($params['type']) && !empty($params['type'])) {
$type = ($params['type'] == 'page' ? 'page' : 'post');
}
if (isset($params['order']) && !empty($params['order'])) {
$order = (strtoupper($params['order']) == 'DESC' ? 'DESC' : 'ASC');
}
if (isset($params['orderby']) && !empty($params['orderby']) && preg_match('/^[a-zA-Z_]+$/', $params['orderby'])) {
$orderby = $params['orderby'];
}
$entries = $GLOBALS['wpdb']->get_results(
sprintf(
"SELECT DISTINCT object_id, post_title FROM {$GLOBALS['wpdb']->term_relationships} r, {$GLOBALS['wpdb']->term_taxonomy} t, {$GLOBALS['wpdb']->posts} p WHERE t.term_id IN (SELECT t.term_id FROM {$GLOBALS['wpdb']->term_relationships} r, {$GLOBALS['wpdb']->term_taxonomy} t WHERE r.term_taxonomy_id = t.term_taxonomy_id AND t.taxonomy = 'category' AND r.object_id = $post_id) AND r.term_taxonomy_id = t.term_taxonomy_id AND p.post_status = 'publish' AND p.ID = r.object_id AND object_id <> $post_id %s %s %s",
($type ? ("AND p.post_type = '" .$type. "'") : ''),
($orderby ? ('ORDER BY ' .(strtoupper($params['orderby']) == 'RAND' ? 'RAND()' : $orderby. ' ' .$order)) : ''),
($limit ? ('LIMIT ' .$limit) : '')
),
OBJECT
);
if ($entries) {
foreach ($entries as $entry) {
$output .= sprintf(
'%s<a href="%s" %s title="%s">%s%s%s</a>%s',
isset($params['before']) ? $params['before'] : '',
get_permalink($entry->object_id),
(isset($params['rel']) ? ('rel="' .$params['rel']. '"') : ''),
str_replace('"', '&quot;', $entry->post_title),
isset($params['inside']) ? $params['inside'] : '',
$entry->post_title,
isset($params['outside']) ? $params['outside'] : '',
isset($params['after']) ? $params['after'] : ''
);
}
} else {
$output = $params['message'];
}
if (isset($params['echo']) === true && $params['echo']) {
echo $output;
} else {
return $output;
}
}
?>