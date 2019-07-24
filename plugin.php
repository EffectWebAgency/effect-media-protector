<?php
/*
Plugin Name: Effect Media Protector
Plugin URI: https://github.com/danloughmiller/effect-media-protector
Description: 
Version: 0.1.0
Author: Daniel Loughmiller
Author URI: https://github.com/danloughmiller/
Text Domain: effect-media-protector
Domain Path: /languages
*/

add_action('acf/init', function() {
if(function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5d37c18ce5e92',
        'title' => 'Media Protector',
        'fields' => array(
            array(
                'key' => 'field_5d37c1a85bcd1',
                'label' => 'Protect Media',
                'name' => 'protect_media',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'attachment',
                    'operator' => '==',
                    'value' => 'all',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
endif;
});


add_action('init', function() {
    if (!empty($_GET['action']) && $_GET['action']=='load_attachment') {
        $file = $_GET['file'];
        global $wpdb;
        $res = $wpdb->get_var('SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid LIKE \'%' . $file . '\'');
        
        if ($res) {
            
            $dir = wp_upload_dir();
            $path = $dir['basedir']. $file;
            
            if (file_exists($path)) {
                
                
                $protect = get_field('board_access_only', $res);
                
                
                if (!$protect) {
                    header("Content-type:application/pdf");
                    readfile($path);
                } else {
                    
                    if (is_user_logged_in()==true) {
                        header("Content-type:application/pdf");
                        readfile($path);
                    } else {
                        header('HTTP/1.0 403 Forbidden');
                        echo '<html><body><h1>Forbidden</h1><p>You do not have permission to access this document</p></body></html>';
                        //header('Location: /wp-login.php');
                    }
                }
                exit;
                
            }
        }
    }
})