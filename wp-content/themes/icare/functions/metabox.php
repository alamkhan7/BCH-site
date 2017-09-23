<?php
add_action('admin_init', 'icare_init');
function icare_init(){
    add_meta_box('icare_page', 'Layout', 'icare_content_layout_meta', 'page', 'normal', 'high');
    add_meta_box('icare_post', 'Layout', 'icare_content_layout_meta', 'post', 'normal', 'high');
    add_action('save_post', 'icare_meta_save');
}

function icare_content_layout_meta()
{
    global $post;
    $content_layout = sanitize_text_field(get_post_meta(get_the_ID(), 'content_layout', true));
    if (!$content_layout) {
        $content_layout = "r";
    }
    ?>
    
    <label for="radio3" class="icare-layout"  <?php if ($content_layout == "sidebar-l") {
        echo "checked";
    } ?> >
    <input id="radio3" <?php if ($content_layout == "sidebar-l") {
        echo "checked";
    } ?> type="radio" name="content_layout" value="sidebar-l">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/layout/icare-left-sidebar.jpg" alt="<?php _e('icare Image','icare'); ?>">
    </label>
    

    <label for="radio2"  class="icare-layout" <?php if ($content_layout == "sidebar-n") {
        echo "checked";
    } ?> >
    <input id="radio2" <?php if ($content_layout == "sidebar-n") {
        echo "checked";
    } ?> type="radio" name="content_layout" value="sidebar-n">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/layout/icare-full-width.jpg" alt="<?php _e('icare Image','icare'); ?>">
    </label>
    
    <label for="radio1"  class="icare-layout" <?php if ($content_layout == "sidebar-r") {
        echo "checked";
    } ?> ><input id="radio1"    <?php if ($content_layout == "sidebar-r") {
        echo "checked";
    } ?> type="radio" name="content_layout" value="sidebar-r">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/layout/icare-right-sidebar.jpg" alt="<?php _e('icare Image','icare'); ?>">
    </label>
    <style type="text/css">
        label.icare-layout > input{ /* HIDE RADIO */
          visibility: hidden; /* Makes input not-clickable */
          position: absolute; /* Remove input from document flow */
        }
        label.icare-layout > input + img{ /* IMAGE STYLES */
          cursor:pointer;
          border:2px solid transparent;
        }
        label.icare-layout > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
          border:2px solid #f00;
        }
    </style>
<?php
}

function icare_meta_save($post_id)
{
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']))
        return;
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }
    if (isset($_POST['post_ID'])) {
        $post_ID = $_POST['post_ID'];
        $post_type = get_post_type($post_ID);
         if ($post_type == 'page') {
            update_post_meta($post_ID, 'content_layout', sanitize_text_field($_POST['content_layout']));
        } else if ($post_type == 'post') {
            update_post_meta($post_ID, 'content_layout', sanitize_text_field($_POST['content_layout']));
        }
    }
}