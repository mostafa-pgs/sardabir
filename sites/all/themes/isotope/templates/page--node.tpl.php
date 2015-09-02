<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
global $base_url;

$nid = arg(1);
if(is_numeric($nid)) {
	$node = node_load($nid);
	if($node) {
		$link = $node->field_blog_post_link['und'][0]['value'];
		if ($link) {
			?>
				<iframe src="<?php print $link; ?>" style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
			<?php
		} else {
			print $node->body['und'][0]['value'];
		}
	}
} else {
	print '<h1>Invalid Request!</h1>';
}