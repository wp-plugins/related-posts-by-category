<?php
/*
Plugin Name: Related Posts by Category
Plugin URI: http://playground.ebiene.de/400/related-posts-by-category-the-wordpress-plugin-for-similar-posts/
Description: The WordPress Plugin for Similar Posts. It's small. It's fast. Really.
Author: Sergej M&uuml;ller
Version: 0.3
Author URI: http://www.wpseo.org
*/


function related_posts_by_category($params, $post_id = 0) {
$entries = array();
$output = '';
if (!$post_id) {
$post_id = $GLOBALS['post']->ID;
}
$entries = $GLOBALS['wpdb']->get_results(
sprintf(
"SELECT DISTINCT object_id, post_title FROM {$GLOBALS['wpdb']->term_relationships} r, {$GLOBALS['wpdb']->term_taxonomy} t, {$GLOBALS['wpdb']->posts} p WHERE t.term_id IN (SELECT t.term_id FROM {$GLOBALS['wpdb']->term_relationships} r, {$GLOBALS['wpdb']->term_taxonomy} t WHERE r.term_taxonomy_id = t.term_taxonomy_id AND t.taxonomy = 'category' AND r.object_id = $post_id) AND r.term_taxonomy_id = t.term_taxonomy_id AND p.post_status = 'publish' AND p.ID = r.object_id AND object_id <> $post_id %s %s %s",
(isset($params['type']) === true && empty($params['type']) === false) ? ("AND p.post_type = '" .$params['type']. "'") : '',
(isset($params['orderby']) === true && empty($params['orderby']) === false) ? ('ORDER BY ' .(strtoupper($params['orderby']) == 'RAND' ? 'RAND()' : $params['orderby']. ' ' .(isset($params['order']) ? $params['order'] : ''))) : '',
(isset($params['limit']) === true && empty($params['limit']) === false) ? ('LIMIT ' .$params['limit']) : ''
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
$entry->post_title,
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