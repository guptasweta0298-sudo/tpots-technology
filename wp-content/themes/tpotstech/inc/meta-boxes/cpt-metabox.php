<?php
function cta_button_meta_box() {

    add_meta_box(
        'cta_button_meta',
        'CTA Button',
        'cta_button_meta_callback',
        'cta',
        'normal',
        'high'
    );

}

add_action('add_meta_boxes', 'cta_button_meta_box');

function cta_button_meta_callback($post) {

    wp_nonce_field(
        'cta_button_nonce',
        'cta_button_nonce_field'
    );

    $button_text = get_post_meta(
        $post->ID,
        'cta_button_text',
        true
    );

    $button_url = get_post_meta(
        $post->ID,
        'cta_button_url',
        true
    );

    $button_target = get_post_meta(
        $post->ID,
        'cta_button_target',
        true
    );

?>

<table class="form-table">

<tr>

<th>

<label>Button Text</label>

</th>

<td>

<input
type="text"
name="cta_button_text"
class="regular-text"
value="<?php echo esc_attr($button_text); ?>">

</td>

</tr>

<tr>

<th>

<label>Button URL</label>

</th>

<td>

<input
type="url"
name="cta_button_url"
class="regular-text"
value="<?php echo esc_url($button_url); ?>">

</td>

</tr>

<tr>

<th>

<label>Open in New Tab</label>

</th>

<td>

<label>

<input
type="checkbox"
name="cta_button_target"
value="1"
<?php checked($button_target,1); ?>>

Open Link in New Tab

</label>

</td>

</tr>

</table>

<?php

}

//save Meta box
function save_cta_button_meta($post_id){

    if(
        !isset($_POST['cta_button_nonce_field'])
    ){
        return;
    }

    if(
        !wp_verify_nonce(
            $_POST['cta_button_nonce_field'],
            'cta_button_nonce'
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
        'cta_button_text',
        sanitize_text_field($_POST['cta_button_text'])
    );

    update_post_meta(
        $post_id,
        'cta_button_url',
        esc_url_raw($_POST['cta_button_url'])
    );

    update_post_meta(
        $post_id,
        'cta_button_target',
        isset($_POST['cta_button_target']) ? 1 : 0
    );

}

add_action(
    'save_post_cta',
    'save_cta_button_meta'
);