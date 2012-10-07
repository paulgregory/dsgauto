<?php
/*
Plugin Name: Post-to-Facebook
Version: 1.0.6
Plugin URI: http://blog.yeticode.co.uk/post-to-facebook
Description: Provides the ability to quickly post a blog item to your facebook mini feed.
Author: John Tindell
Author URI: http://blog.yeticode.co.uk/
*/

$url = get_bloginfo('wpurl').'/wp-content/plugins/post-to-facebook/'; 
wp_register_script( 'post-to-facebook',$url. 'post-to-facebook.js',array( 'jquery' ), '');

function post_to_facebook_gui()
{
  $options  = get_option('P2FB_Options',"");
  if($options != '')
  {
    ?>
<script type="text/javascript">
  jQuery(document).ready(function(){
  p2fb_init("<?php print $options ?>");
  });
</script>
<?php
    // clear the session value that was 
    update_option('P2FB_Options','');
  }
?>
<div id="publishing-action">
  <input type="submit" value="Post to Facebook" id="post-to-facebook" class="button-primary" name="post-to-facebok"/>
</div>
<?php
}
function post_to_facebook($post_id) {
  if($_POST['post-to-facebok']){
    $permalink = get_permalink($post_id);
    // is there a better way to do this? what about multiple posting?
    update_option('P2FB_Options',$permalink);
  }
}
function p2fb_css() {
  wp_enqueue_script( 'post-to-facebook' ); 
  echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') .'/wp-content/plugins/post-to-facebook/post-to-facebook.css" />' . "\n";
}
function p2fb_scripts(){
    wp_enqueue_script( 'post-to-facebook' ); 
}
add_action('admin_print_scripts','p2fb_scripts');
add_action('post_submitbox_start','post_to_facebook_gui');
add_action('save_post','post_to_facebook',10,2);
add_action('admin_head', 'p2fb_css',11);

