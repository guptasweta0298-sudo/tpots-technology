<?php
function statistics_meta_box() {

    add_meta_box(
        'statistics_meta',
        'Statistic Details',
        'statistics_meta_callback',
        'statistics',
        'normal',
        'high'
    );

}

add_action('add_meta_boxes', 'statistics_meta_box');


function statistics_meta_callback($post){

    wp_nonce_field(
        'statistics_nonce',
        'statistics_nonce_field'
    );

    $number = get_post_meta($post->ID,'statistics_number',true);
    $label  = get_post_meta($post->ID,'statistics_label',true);

?>

<p>

<label><strong>Statistic Number</strong></label>

<input
type="text"
class="widefat"
name="statistics_number"
value="<?php echo esc_attr($number); ?>">

</p>

<p>

<label><strong>Statistic Label</strong></label>

<input
type="text"
class="widefat"
name="statistics_label"
value="<?php echo esc_attr($label); ?>">

</p>


<?php

}

function save_statistics_meta($post_id){

    if(
        !isset($_POST['statistics_nonce_field'])
    ){
        return;
    }

    if(
        !wp_verify_nonce(
            $_POST['statistics_nonce_field'],
            'statistics_nonce'
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
        'statistics_number',
        sanitize_text_field($_POST['statistics_number'])
    );

    update_post_meta(
        $post_id,
        'statistics_label',
        sanitize_text_field($_POST['statistics_label'])
    );

}

add_action(
    'save_post_statistics',
    'save_statistics_meta'
);