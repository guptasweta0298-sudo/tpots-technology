<?php
/**
 * Register Alumni Meta Box
 */

function alumni_admin_scripts($hook) {

    global $post;

    // Only load on page edit screens
    if (($hook == 'post.php' || $hook == 'post-new.php') && isset($post) && $post->post_type == 'page') {

        wp_enqueue_media();

        wp_enqueue_script(
            'alumni-admin',
            get_template_directory_uri() . '/js/alumni-admin.js',
            array('jquery'),
            '1.0',
            true
        );
    }
}
add_action('admin_enqueue_scripts', 'alumni_admin_scripts');

function alumni_banner_meta_box() {

    add_meta_box(
        'alumni_banner',
        'Alumni Banner',
        'alumni_banner_callback',
        'page',          // Change to your CPT if needed
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'alumni_banner_meta_box');


function alumni_banner_callback($post){

    wp_nonce_field('alumni_banner_nonce','alumni_banner_nonce');

    $image_id = get_post_meta($post->ID, 'banner_image', true);
    $image = '';

    if ($image_id) {
        $image = wp_get_attachment_image_url($image_id, 'large');
    }
    $banner_title = get_post_meta($post->ID,'banner_title',true);
    $description = get_post_meta($post->ID,'description',true);

?>

<p>
    <label>Banner Image URL</label><br>
    <img
    id="banner-preview"
    src="<?php echo esc_url($image); ?>"
    style="max-width:300px;display:block;margin-bottom:10px;"
>

<input
    type="hidden"
    id="banner_image"
    name="banner_image"
    value="<?php echo esc_attr($image_id); ?>"
>

<button
    type="button"
    class="button"
    id="upload_banner"
>
    Upload Image
</button>

<button
    type="button"
    class="button"
    id="remove_banner"
>
    Remove Image
</button>
</p>

<p>
    <label>Banner Title</label><br>
    <input type="text" name="banner_title" value="<?php echo esc_attr($banner_title); ?>" style="width:100%;">
</p>

<p>
    <label>Description</label><br>
    <textarea name="description" style="width:100%;height:150px;"><?php echo esc_textarea($description); ?></textarea>
</p>

<?php
}
//Save Meta
function save_alumni_meta_box($post_id){

    if(!isset($_POST['alumni_banner_nonce'])){
        return;
    }

    if(!wp_verify_nonce($_POST['alumni_banner_nonce'],'alumni_banner_nonce')){
        return;
    }

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }
    
    if (isset($_POST['banner_image'])) {

        update_post_meta(
            $post_id,
            'banner_image',
            intval($_POST['banner_image'])
        );

    }

    update_post_meta($post_id,'banner_title',wp_kses_post($_POST['banner_title']));
    update_post_meta($post_id,'description',wp_kses_post($_POST['description']));

}
add_action('save_post','save_alumni_meta_box');



/**
 * Register Intro Meta Box
 */
function alumni_intro_meta_box() {

    add_meta_box(
        'alumni_intro',
        'Alumni Intro Section',
        'alumni_intro_callback',
        'page',
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'alumni_intro_meta_box');


function alumni_intro_callback($post){

    wp_nonce_field('alumni_intro_nonce','alumni_intro_nonce_field');

    $intro_title       = get_post_meta($post->ID,'intro_title',true);
    $intro_subtitle    = get_post_meta($post->ID,'intro_subtitle',true);
    $intro_description = get_post_meta($post->ID,'intro_description',true);
    $intro_image       = get_post_meta($post->ID,'intro_image',true);
    $intro_btn_text    = get_post_meta($post->ID,'intro_btn_text',true);
    $intro_btn_url     = get_post_meta($post->ID,'intro_btn_url',true);
    $intro_btn_target  = get_post_meta($post->ID,'intro_btn_target',true);
        $bg_color = get_post_meta($post->ID, 'intro_bg_color', true);

?>

<table class="form-table">

<tr>
    <th><label>Title</label></th>
    <td>
        <input type="text"
               name="intro_title"
               value="<?php echo esc_attr($intro_title); ?>" style="width:100%;">
    </td>
</tr>

<tr>
    <th><label>Subtitle</label></th>
    <td>
        <input type="text"
               name="intro_subtitle"
               value="<?php echo esc_attr($intro_subtitle); ?>" style="width:100%;">
    </td>
</tr>

<tr>
    <th><label>Description</label></th>
    <td>
        <textarea
            name="intro_description"
            rows="6"
            style="width:100%;"><?php echo esc_textarea($intro_description); ?></textarea>
    </td>
</tr>

<tr>
    <th><label>Image</label></th>
    <td>

        <input
            type="hidden"
            id="intro_image"
            name="intro_image"
            value="<?php echo esc_attr($intro_image); ?>">

        <button
            type="button"
            class="button"
            id="upload_intro_image">

            Upload Image

        </button>

        <button
            type="button"
            class="button"
            id="remove_intro_image">

            Remove Image

        </button>

        <div id="intro_preview" style="margin-top:15px;">

            <?php

            if($intro_image){

                echo wp_get_attachment_image($intro_image,'medium');

            }

            ?>

        </div>

    </td>
</tr>

<tr>
    <th><label>CTA Button Text</label></th>
    <td>
        <input type="text"
               name="intro_btn_text"
               value="<?php echo esc_attr($intro_btn_text); ?>"
               class="regular-text">
    </td>
</tr>

<tr>
    <th><label>CTA Button URL</label></th>
    <td>
        <input type="url"
               name="intro_btn_url"
               value="<?php echo esc_attr($intro_btn_url); ?>"
               class="regular-text">
    </td>
</tr>

<tr>
    <th><label>Open in New Tab</label></th>
    <td>

        <label>

            <input
                type="checkbox"
                name="intro_btn_target"
                value="1"
                <?php checked($intro_btn_target,1); ?>>

            Yes

        </label>

    </td>
</tr>
  <p>
    <label><strong>Intro Section Background Color</strong></label><br>

    <?php
    $bg_color = get_post_meta($post->ID, 'intro_bg_color', true);
    ?>

    <input
        type="text"
        id="intro_bg_color"
        name="intro_bg_color"
        value="<?php echo esc_attr($bg_color); ?>"
        class="color-picker"
        data-default-color="#f5f3ef">
</p>


</table>

<?php
}

/*Save Meta Box*/
function alumni_intro_save_meta($post_id){

    if(!isset($_POST['alumni_intro_nonce_field']))
        return;

    if(!wp_verify_nonce($_POST['alumni_intro_nonce_field'],'alumni_intro_nonce'))
        return;

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    update_post_meta($post_id,'intro_title',sanitize_text_field($_POST['intro_title']));

    update_post_meta($post_id,'intro_subtitle',sanitize_text_field($_POST['intro_subtitle']));

    update_post_meta($post_id,'intro_description',wp_kses_post($_POST['intro_description']));

    update_post_meta($post_id,'intro_image',intval($_POST['intro_image']));

    update_post_meta($post_id,'intro_btn_text',sanitize_text_field($_POST['intro_btn_text']));

    update_post_meta($post_id,'intro_btn_url',esc_url_raw($_POST['intro_btn_url']));

    update_post_meta($post_id,'intro_btn_target',isset($_POST['intro_btn_target']) ? 1 : 0);

    if(isset($_POST['intro_bg_color'])){

        update_post_meta(
            $post_id,
            'intro_bg_color',
            sanitize_hex_color($_POST['intro_bg_color'])
        );

    }
}
add_action('save_post','alumni_intro_save_meta');



/**
 * Benefits Meta Box
 */

function alumni_benefits_meta_box() {

    add_meta_box(
        'alumni_benefits',
        'Benefits & Services',
        'alumni_benefits_callback',
        'page',
        'normal',
        'high'
    );

}

add_action('add_meta_boxes', 'alumni_benefits_meta_box');


function alumni_benefits_callback($post){

    wp_nonce_field(
        'alumni_benefits_nonce',
        'alumni_benefits_nonce_field'
    );

    $section_title = get_post_meta(
        $post->ID,
        'benefits_title',
        true
    );

    $section_description = get_post_meta(
        $post->ID,
        'benefits_description',
        true
    );

?>

<p>

<label><strong>Section Title</strong></label>

<input
type="text"
name="benefits_title"
value="<?php echo esc_attr($section_title); ?>"
class="widefat">

</p>

<p>

<label><strong>Section Description</strong></label>

<textarea
name="benefits_description"
rows="5"
class="widefat"><?php echo esc_textarea($section_description); ?></textarea>

</p>

<hr>

<h3>Benefit Items</h3>

<?php

$benefits = get_post_meta($post->ID, 'benefits_items', true);

if (!is_array($benefits) || empty($benefits)) {
    $benefits = array(
        array(
            'icon'        => '',
            'title'       => '',
            'details'     => '',
            'button_text' => '',
            'button_url'  => '',
            'target'      => 0,
        )
    );
}

?>

<div id="benefits-wrapper">

<?php foreach ($benefits as $index => $item) : ?>

<div class="benefit-item" style="border:1px solid #ddd;padding:20px;margin-bottom:20px;">

<h3>Benefit Item</h3>

<!-- Icon -->

<p>

<label><strong>Icon</strong></label><br>

<img
class="benefit-preview"
src="<?php echo !empty($item['icon']) ? esc_url(wp_get_attachment_url($item['icon'])) : ''; ?>"
style="max-width:120px;display:block;margin-bottom:10px;">

<input
type="hidden"
class="benefit-icon"
name="benefits_items[<?php echo $index; ?>][icon]"
value="<?php echo esc_attr($item['icon']); ?>">

<button
type="button"
class="button upload-benefit">

Upload Icon

</button>

<button
type="button"
class="button remove-benefit-image">

Remove Image

</button>

</p>

<!-- Title -->

<p>

<label><strong>Title</strong></label>

<input
type="text"
class="widefat"
name="benefits_items[<?php echo $index; ?>][title]"
value="<?php echo esc_attr($item['title']); ?>">

</p>

<!-- Details -->

<p>

<label><strong>Details</strong></label>

<textarea
rows="5"
class="widefat"
name="benefits_items[<?php echo $index; ?>][details]"><?php echo esc_textarea($item['details']); ?></textarea>

</p>

<!-- Button URL -->

<p>

<label><strong>Button URL</strong></label>

<input
type="url"
class="widefat"
name="benefits_items[<?php echo $index; ?>][button_url]"
value="<?php echo esc_attr($item['button_url']); ?>">

</p>

<!-- Target -->

<p>

<label>

<input
type="checkbox"
name="benefits_items[<?php echo $index; ?>][target]"
value="1"
<?php checked($item['target'],1); ?>>

Open in New Tab

</label>

</p>

<p>

<button
type="button"
class="button remove-benefit">

Remove Benefit

</button>

</p>

</div>

<?php endforeach; ?>

</div>

<button
type="button"
class="button button-primary"
id="add-benefit">

+ Add Benefit

</button>

<script type="text/html" id="benefit-template">

<div class="benefit-item" style="border:1px solid #ddd;padding:20px;margin-bottom:20px;">

<h3>Benefit Item</h3>

<p>

<label><strong>Icon</strong></label><br>

<img
class="benefit-preview"
src=""
style="max-width:120px;display:none;margin-bottom:10px;">

<input
type="hidden"
class="benefit-icon"
name="benefits_items[{{INDEX}}][icon]"
value="">

<button
type="button"
class="button upload-benefit">

Upload Icon

</button>

<button
type="button"
class="button remove-benefit-image">

Remove Image

</button>

</p>

<p>

<label><strong>Title</strong></label>

<input
type="text"
class="widefat"
name="benefits_items[{{INDEX}}][title]">

</p>

<p>

<label><strong>Details</strong></label>

<textarea
rows="5"
class="widefat"
name="benefits_items[{{INDEX}}][details]"></textarea>

</p>

<!-- <p>

<label><strong>Button Text</strong></label>

<input
type="text"
class="widefat"
name="benefits_items[{{INDEX}}][button_text]">

</p> -->

<p>

<label><strong>Button URL</strong></label>

<input
type="url"
class="widefat"
name="benefits_items[{{INDEX}}][button_url]">

</p>

<p>

<label>

<input
type="checkbox"
name="benefits_items[{{INDEX}}][target]"
value="1">

Open in New Tab

</label>

</p>

<p>

<button
type="button"
class="button remove-benefit">

Remove Benefit

</button>

</p>

</div>

</script>

<?php

}
//save benefits
function alumni_benefits_save($post_id){

    if(
        !isset($_POST['alumni_benefits_nonce_field'])
    ){
        return;
    }

    if(
        !wp_verify_nonce(
            $_POST['alumni_benefits_nonce_field'],
            'alumni_benefits_nonce'
        )
    ){
        return;
    }

    if(
        defined('DOING_AUTOSAVE')
        && DOING_AUTOSAVE
    ){
        return;
    }

    update_post_meta(
        $post_id,
        'benefits_title',
        sanitize_text_field(
            $_POST['benefits_title']
        )
    );

    update_post_meta(
        $post_id,
        'benefits_description',
        wp_kses_post(
            $_POST['benefits_description']
        )
    );
    if (isset($_POST['benefits_items'])) {

    $benefits = array();

    foreach ($_POST['benefits_items'] as $item) {

        $benefits[] = array(
            'icon'        => intval($item['icon']),
            'title'       => sanitize_text_field($item['title']),
            'details'     => sanitize_textarea_field($item['details']),
            'button_text' => sanitize_text_field($item['button_text']),
            'button_url'  => esc_url_raw($item['button_url']),
            'target'      => isset($item['target']) ? 1 : 0,
        );

    }

    update_post_meta($post_id, 'benefits_items', $benefits);

} else {

    delete_post_meta($post_id, 'benefits_items');

}

}

add_action(
    'save_post',
    'alumni_benefits_save'
);


function alumni_cta_selector_meta_box() {

    add_meta_box(
        'alumni_cta_selector',
        'Select CTA',
        'alumni_cta_selector_callback',
        'page',
        'normal',
        'high'
    );

}

add_action('add_meta_boxes','alumni_cta_selector_meta_box');




function alumni_cta_selector_callback($post){

    wp_nonce_field('alumni_cta_selector_nonce', 'alumni_cta_selector_nonce_field');

    $selected_ctas = get_post_meta($post->ID, 'selected_cta', true);
    if (!is_array($selected_ctas)) {
        $selected_ctas = array();
    }

    $ctas = get_posts(array(
        'post_type'      => 'cta',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
    ));
    ?>

    <style>
        .cta-wrapper{width:100%;display:flex;gap:20px;margin-top:10px;}
        .cta-left{width:35%;}
        .cta-right{width:60%;}
        #available-cta-list{border:1px solid #ddd;border-radius:6px;margin-top:8px;max-height:300px;overflow-y:auto;}
        .cta-row{padding:8px 10px;border-bottom:1px solid #eee;}
        .cta-row:last-child{border-bottom:none;}
        .cta-row.selected{background:#eaf7ea;}
        .cta-row label{display:flex;align-items:center;gap:8px;cursor:pointer;margin:0;}
        #cta-count{font-weight:600;background:#2271b1;color:#fff;border-radius:12px;padding:2px 10px;font-size:12px;margin-left:6px;}
        #selected-cta-list{list-style:none;margin:8px 0 0;padding:0;border:1px solid #ddd;border-radius:6px;min-height:40px;}
        #selected-cta-list li{display:flex;align-items:center;gap:10px;padding:8px 10px;border-bottom:1px solid #eee;background:#fff;}
        #selected-cta-list li:last-child{border-bottom:none;}
        #selected-cta-list li:hover{background:#fafafa;}
        .cta-num{display:inline-flex;align-items:center;justify-content:center;width:20px;height:20px;background:#2271b1;color:#fff;border-radius:50%;font-size:11px;flex-shrink:0;}
        .dashicons.dashicons-menu{cursor:move;color:#999;}
        .cta-title{flex:1;}
        .remove-cta{cursor:pointer;color:#b32d2e;font-weight:bold;padding:0 4px;}
        .remove-cta:hover{color:#dc3232;}
        .ui-sortable-placeholder{border:1px dashed #2271b1;visibility:visible !important;height:36px;background:#f0f6fc;}
    </style>

    <div class="cta-wrapper">

        <!-- LEFT -->
        <div class="cta-left">
            <h3>Available CTA</h3>

            <input type="text" id="search-cta" class="widefat" placeholder="Search CTA...">

            <div id="available-cta-list">
                <?php foreach ($ctas as $cta) :
                    $is_selected = in_array($cta->ID, $selected_ctas);
                ?>
                    <div class="cta-row<?php echo $is_selected ? ' selected' : ''; ?>"
                         data-id="<?php echo $cta->ID; ?>"
                         data-title="<?php echo esc_attr($cta->post_title); ?>">
                        <label>
                            <input type="checkbox" class="cta-check" <?php checked($is_selected); ?>>
                            <?php echo esc_html($cta->post_title); ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="cta-right">
            <h3>Selected CTA <span id="cta-count"><?php echo count($selected_ctas); ?>/10</span></h3>

            <ul id="selected-cta-list">
                <?php foreach ($selected_ctas as $id) : ?>
                    <li data-id="<?php echo $id; ?>">
                        <span class="dashicons dashicons-menu"></span>
                        <span class="cta-num"></span>
                        <span class="cta-title"><?php echo esc_html(get_the_title($id)); ?></span>
                        <span class="remove-cta">✕</span>
                        <input type="hidden" name="selected_cta[]" value="<?php echo $id; ?>">
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
    <?php
}

function alumni_cta_selector_save($post_id){

    if (!isset($_POST['alumni_cta_selector_nonce_field'])) return;

    if (!wp_verify_nonce($_POST['alumni_cta_selector_nonce_field'], 'alumni_cta_selector_nonce')) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_page', $post_id)) return;

    if (isset($_POST['selected_cta']) && is_array($_POST['selected_cta'])) {
        $clean_ids = array_map('absint', $_POST['selected_cta']);
        update_post_meta($post_id, 'selected_cta', $clean_ids);
    } else {
        delete_post_meta($post_id, 'selected_cta');
    }
}

add_action('save_post_page', 'alumni_cta_selector_save');



function statistics_selector_meta_box() {

    add_meta_box(
        'statistics_selector',
        'Statistics',
        'statistics_selector_callback',
        'page',
        'normal',
        'high'
    );

}

add_action('add_meta_boxes','statistics_selector_meta_box');


function statistics_selector_callback($post){

    wp_nonce_field(
        'statistics_selector_nonce',
        'statistics_selector_nonce_field'
    );


    $selected = get_post_meta($post->ID, 'selected_statistics', true);

    if (!is_array($selected)) {
        $selected = array();
    }

    $statistics = get_posts(array(
        'post_type'      => 'statistics',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
    ));

    $max_selection = 4;
    ?>

    <style>
        .statistics-field-row{margin-bottom:15px;}
        .statistics-field-row label{display:block;font-weight:600;margin-bottom:4px;}
        .statistics-field-row input[type="text"]{width:100%;max-width:500px;}
        .statistics-field-row .description{color:#666;font-size:12px;margin-top:3px;}

        .statistics-wrapper{width:100%;display:flex;gap:20px;margin-top:10px;}
        .statistics-left{width:35%;}
        .statistics-right{width:60%;}

        #statistics-list{border:1px solid #ddd;border-radius:6px;margin-top:8px;max-height:300px;overflow-y:auto;}
        .statistics-item{padding:8px 10px;border-bottom:1px solid #eee;}
        .statistics-item:last-child{border-bottom:none;}
        .statistics-item.selected{background:#eaf7ea;}
        .statistics-item label{display:flex;align-items:center;gap:8px;cursor:pointer;margin:0;}

        #statistics-count{font-weight:600;background:#2271b1;color:#fff;border-radius:12px;padding:2px 10px;font-size:12px;margin-left:6px;}

        #selected-statistics{list-style:none;margin:8px 0 0;padding:0;border:1px solid #ddd;border-radius:6px;min-height:40px;}
        #selected-statistics li{display:flex;align-items:center;gap:10px;padding:8px 10px;border-bottom:1px solid #eee;background:#fff;}
        #selected-statistics li:last-child{border-bottom:none;}
        #selected-statistics li:hover{background:#fafafa;}

        .stat-num{display:inline-flex;align-items:center;justify-content:center;width:20px;height:20px;background:#2271b1;color:#fff;border-radius:50%;font-size:11px;flex-shrink:0;}
        .dashicons.dashicons-menu{cursor:move;color:#999;}
        .stat-title{flex:1;}
        .remove-statistics{cursor:pointer;color:#b32d2e;font-weight:bold;padding:0 4px;}
        .remove-statistics:hover{color:#dc3232;}
        .ui-sortable-placeholder{border:1px dashed #2271b1;visibility:visible !important;height:36px;background:#f0f6fc;}
    </style>


    <div class="statistics-wrapper">

        <div class="statistics-left">

            <h3>Available Statistics <span style="background:#2271b1;color:#fff;border-radius:50%;padding:1px 8px;font-size:12px;"><?php echo count($statistics); ?></span></h3>

            <input type="text" id="statistics-search" class="widefat" placeholder="Search Statistics...">

            <div id="statistics-list">
                <?php foreach ($statistics as $item) :
                    $is_selected = in_array($item->ID, $selected);
                ?>
                    <div class="statistics-item<?php echo $is_selected ? ' selected' : ''; ?>"
                         data-id="<?php echo $item->ID; ?>"
                         data-title="<?php echo esc_attr($item->post_title); ?>">
                        <label>
                            <input type="checkbox" class="statistics-check" <?php checked($is_selected); ?>>
                            <?php echo esc_html($item->post_title); ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <div class="statistics-right">

            <h3>
                Selected Statistics (Drag to Reorder) - Max <?php echo $max_selection; ?>
                <span id="statistics-count"><?php echo count($selected); ?>/<?php echo $max_selection; ?></span>
            </h3>

            <ul id="selected-statistics">
                <?php foreach ($selected as $id) : ?>
                    <li data-id="<?php echo $id; ?>">
                        <span class="dashicons dashicons-menu"></span>
                        <span class="stat-num"></span>
                        <span class="stat-title"><?php echo esc_html(get_the_title($id)); ?></span>
                        <span class="remove-statistics">✕</span>
                        <input type="hidden" name="selected_statistics[]" value="<?php echo $id; ?>">
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

    </div>

    <?php
}


function save_statistics_selector($post_id){

    if (!isset($_POST['statistics_selector_nonce_field'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['statistics_selector_nonce_field'], 'statistics_selector_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_page', $post_id)) {
        return;
    }


    // Selected Statistics
    if (isset($_POST['selected_statistics']) && is_array($_POST['selected_statistics'])) {

        $selected = array_map('absint', $_POST['selected_statistics']);
        $selected = array_slice($selected, 0, 4); // enforce max 4 server-side too

        update_post_meta($post_id, 'selected_statistics', $selected);

    } else {
        delete_post_meta($post_id, 'selected_statistics');
    }

}

add_action('save_post_page', 'save_statistics_selector');






/**
 * Academic Excellence Meta Box
 */

function alumni_academic_meta_box() {

    add_meta_box(
        'alumni_academic',
        'Academic Excellence',
        'alumni_academic_callback',
        'page',
        'normal',
        'high'
    );

}

add_action('add_meta_boxes', 'alumni_academic_meta_box');


function alumni_academic_callback($post){

    wp_nonce_field(
        'alumni_academic_nonce',
        'alumni_academic_nonce_field'
    );

    $section_image = get_post_meta(
        $post->ID,
        'academic_image',
        true
    );

    $section_title = get_post_meta(
        $post->ID,
        'academic_title',
        true
    );

    $section_description = get_post_meta(
        $post->ID,
        'academic_description',
        true
    );

    $button_text = get_post_meta(
        $post->ID,
        'academic_button_text',
        true
    );

    $button_url = get_post_meta(
        $post->ID,
        'academic_button_url',
        true
    );

    $button_target = get_post_meta(
        $post->ID,
        'academic_button_target',
        true
    );

    $items = get_post_meta(
        $post->ID,
        'academic_items',
        true
    );

    if(!is_array($items) || empty($items)){

        $items = array(

            array(

                'title'=>'',
                'content'=>''

            )

        );

    }

?>

<table class="form-table">

<tr>

<th>Image</th>

<td>

<input
type="hidden"
id="academic_image"
name="academic_image"
value="<?php echo esc_attr($section_image); ?>">

<button
type="button"
class="button"
id="upload_academic_image">

Upload Image

</button>

<button
type="button"
class="button"
id="remove_academic_image">

Remove Image

</button>

<div id="academic_preview" style="margin-top:15px;">

<?php

if($section_image){

    echo wp_get_attachment_image(
        $section_image,
        'medium'
    );

}

?>

</div>

</td>

</tr>

<tr>

<th>Title</th>

<td>

<input
type="text"
class="widefat"
name="academic_title"
value="<?php echo esc_attr($section_title); ?>">

</td>

</tr>

<tr>

<th>Description</th>

<td>

<textarea
rows="5"
class="widefat"
name="academic_description"><?php echo esc_textarea($section_description); ?></textarea>

</td>

</tr>

<tr>

<th>Button Text</th>

<td>

<input
type="text"
class="widefat"
name="academic_button_text"
value="<?php echo esc_attr($button_text); ?>">

</td>

</tr>

<tr>

<th>Button URL</th>

<td>

<input
type="url"
class="widefat"
name="academic_button_url"
value="<?php echo esc_url($button_url); ?>">

</td>

</tr>

<tr>

<th>Open in New Tab</th>

<td>

<label>

<input
type="checkbox"
name="academic_button_target"
value="1"
<?php checked($button_target,1); ?>>

Open in New Tab

</label>

</td>

</tr>

</table>

<hr>

<h2>Repeater Items</h2>

<div id="academic-wrapper">

<?php foreach($items as $index=>$item): ?>

<div class="academic-item" style="border:1px solid #ddd;padding:20px;margin-bottom:20px;">

<p>

<label><strong>Title</strong></label>

<input
type="text"
class="widefat"
name="academic_items[<?php echo $index;?>][title]"
value="<?php echo esc_attr($item['title']);?>">

</p>

<p>

<label><strong>Content</strong></label>

<textarea
rows="4"
class="widefat"
name="academic_items[<?php echo $index;?>][content]"><?php echo esc_textarea($item['content']);?></textarea>

</p>

<p>

<button
type="button"
class="button remove-academic">

Remove

</button>

</p>

</div>

<?php endforeach; ?>

</div>

<button
type="button"
class="button button-primary"
id="add-academic">

+ Add Item

</button>

<script type="text/html" id="academic-template">

<div class="academic-item" style="border:1px solid #ddd;padding:20px;margin-bottom:20px;">

<p>

<label><strong>Title</strong></label>

<input
type="text"
class="widefat"
name="academic_items[{{INDEX}}][title]">

</p>

<p>

<label><strong>Content</strong></label>

<textarea
rows="4"
class="widefat"
name="academic_items[{{INDEX}}][content]"></textarea>

</p>

<p>

<button
type="button"
class="button remove-academic">

Remove

</button>

</p>

</div>

</script>

<?php

}


/**
 * Save Academic Excellence Meta Box
 */

function alumni_academic_save($post_id){

    if (
        !isset($_POST['alumni_academic_nonce_field'])
    ) {
        return;
    }

    if (
        !wp_verify_nonce(
            $_POST['alumni_academic_nonce_field'],
            'alumni_academic_nonce'
        )
    ) {
        return;
    }

    if (
        defined('DOING_AUTOSAVE') &&
        DOING_AUTOSAVE
    ) {
        return;
    }

    if (
        !current_user_can('edit_page', $post_id)
    ) {
        return;
    }

    // Image
    update_post_meta(
        $post_id,
        'academic_image',
        absint($_POST['academic_image'])
    );

    // Title
    update_post_meta(
        $post_id,
        'academic_title',
        sanitize_text_field($_POST['academic_title'])
    );

    // Description
    update_post_meta(
        $post_id,
        'academic_description',
        wp_kses_post($_POST['academic_description'])
    );

    // Button Text
    update_post_meta(
        $post_id,
        'academic_button_text',
        sanitize_text_field($_POST['academic_button_text'])
    );

    // Button URL
    update_post_meta(
        $post_id,
        'academic_button_url',
        esc_url_raw($_POST['academic_button_url'])
    );

    // Button Target
    update_post_meta(
        $post_id,
        'academic_button_target',
        isset($_POST['academic_button_target']) ? 1 : 0
    );

    // Repeater

    $items = array();

    if (
        isset($_POST['academic_items']) &&
        is_array($_POST['academic_items'])
    ) {

        foreach ($_POST['academic_items'] as $item) {

            $items[] = array(

                'title' => sanitize_text_field($item['title']),

                'content' => wp_kses_post($item['content'])

            );

        }

    }

    update_post_meta(
        $post_id,
        'academic_items',
        $items
    );

}

add_action(
    'save_post',
    'alumni_academic_save'
);


function alumni_news_meta_box() {

    add_meta_box(
        'alumni_news',
        'Latest News Section',
        'alumni_news_callback',
        'page',
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'alumni_news_meta_box');


function alumni_news_callback($post){

    wp_nonce_field(
        'alumni_news_nonce',
        'alumni_news_nonce_field'
    );

    $title = get_post_meta($post->ID,'news_title',true);

    $bg_color = get_post_meta($post->ID,'news_bg_color',true);

    ?>

    <table class="form-table">

        <tr>

            <th>
                <label>News Section Title</label>
            </th>

            <td>

                <input
                    type="text"
                    name="news_title"
                    class="widefat"
                    value="<?php echo esc_attr($title); ?>">

            </td>

        </tr>

        <p>
    <label><strong>News Section Background Color</strong></label><br>

    <?php
    $bg_color = get_post_meta($post->ID, 'news_bg_color', true);
    ?>

    <input
        type="text"
        id="news_bg_color"
        name="news_bg_color"
        value="<?php echo esc_attr($bg_color); ?>"
        class="color-picker"
        data-default-color="#f5f3ef">
</p>

    </table>

    <?php

}

function alumni_news_save($post_id){

    if(
        !isset($_POST['alumni_news_nonce_field'])
    ){
        return;
    }

    if(
        !wp_verify_nonce(
            $_POST['alumni_news_nonce_field'],
            'alumni_news_nonce'
        )
    ){
        return;
    }

    if(
        defined('DOING_AUTOSAVE') && DOING_AUTOSAVE
    ){
        return;
    }

    if(isset($_POST['news_title'])){

        update_post_meta(
            $post_id,
            'news_title',
            sanitize_text_field($_POST['news_title'])
        );

    }

    if(isset($_POST['news_bg_color'])){

        update_post_meta(
            $post_id,
            'news_bg_color',
            sanitize_hex_color($_POST['news_bg_color'])
        );

    }
    

}
add_action('save_post','alumni_news_save');