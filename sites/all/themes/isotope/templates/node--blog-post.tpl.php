<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
global $base_url;
$tid = $node->field_weblog['und'][0]['tid'];
$term = taxonomy_term_load($tid);
$pid = $term->field_blog_subject['und'][0]['tid'];
$subject = taxonomy_term_load($pid);
$node_subject = '<a href="'.url('taxonomy/term/'.$pid,array('absolute'=>true)).'">'.$subject->name.'</a>';
$body_text = ($node->body['und'][0]['summary'] != '')? $node->body['und'][0]['summary'] : $node->body['und'][0]['value'];
// if(strlen($body_text)>180)
//     $body_text = substr($body_text, 0,180).'...';
$path = $node->field_image['und'][0]['uri'];
if($path)
{
  $img_url = file_create_url($path);
  $img_url = str_replace('public://',$base_url.'/sites/default/files/',$img_url);
}
else {
  $img_url = $node->field_post_imageurl['und'][0]['value'];
}

$node_time = isotope_persian_digits(format_interval((time() - $node->created) , 2,'fa')) .' قبل';
?>
<?php if($view_mode == 'renews'): ?>

  <?php $renewser = user_load($node->renewser); ?>

  <div class="renews-item node-<?php print $node->nid; ?>">

    <div class="renews-content">
      <span class="triangle right"></span>
      <div class="item-subject">
        <?php print $node_subject; ?>
      </div>

      <div class="item-title">
        <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
      </div>

      <?php if($img_url != ''): ?>
        <a href="<?php print $node_url; ?>"><img class="item-img" src="<?php print $img_url ?>" /></a>
      <?php endif; ?>      

      <p class="item-details"><?php print $node_time; ?> از <span class="item-src"><?php print $term->name; ?></span></p>

      <div class="item-body"><?php print $body_text ?></div>  
      
      <ul class="inline-list">
        <li class="fav"><?php print flag_create_link('bookmarks', $node->nid); ?></li>
        <li class="share"><a href="#share"></a></li>
        <li class="sendtt"><?php print flag_create_link('renews', $node->nid); ?></li>
      </ul>      
    </div>  

    <?php print theme('user_picture', array('account' => $renewser)); ?>        
  </div>

<?php else: ?>
  <div class="mag-item node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    
    <div class="item-subject">
      <?php print $node_subject; ?>
      <a href="#" class="axtag">خانه</a>
      <a href="#" class="axtag">مجلس</a>
    </div>

    <?php if($img_url != ''): ?>
      <a href="<?php print $node_url; ?>"><img class="item-img" src="<?php print $img_url ?>" /></a>
    <?php endif; ?>

    <div class="item-title">
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </div>

    <p class="item-details"><?php print $node_time; ?> از <span class="item-src"><?php print $term->name; ?></span></p>

    <div class="item-body"><?php print $body_text ?></div>

    <ul class="inline-list item-buttons">
      <li class="fav"><?php print flag_create_link('bookmarks', $node->nid); ?></li>
      <li class="share"><a href="#share"></a></li>
      <li class="sendtt"><?php print flag_create_link('renews', $node->nid); ?></li>
    </ul>

  </div>
<?php endif; ?>
<style type="text/css">
.item-title a{
  color : #000;
}
</style>