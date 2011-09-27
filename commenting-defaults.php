<?PHP
/**
Plugin Name:        Commenting Defaults
Description:        Currently only disables Commenting and Ping Backs from New Page -form.

License:            Public Domain
Version:            0.1
Author:             Jari Pennanen <ciantic@oksidi.com>
Author URI:         http://www.oksidi.com/
Plugin URI:         http://wordpress.org/extend/plugins/commenting-defaults/

@package commenting-defaults
**/

// Only in admin
if (!is_admin())
    return;

// This is valid hack as long as "wp-admin/includes/post.php"
// `get_default_post_to_edit()` keeps calling `apply_filter()` for
// `default_content` *after* `comment_status` and `ping_status` setting.
function ownskit_disable_pages_default_commenting($content, $post) {
    if ($post->post_type == 'page') {
        $post->comment_status = "closed";
        $post->ping_status = "closed";
    }

    return $content;
}
add_filter('default_content', 'ownskit_disable_pages_default_commenting', 1, 2);
