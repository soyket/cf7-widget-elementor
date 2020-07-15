<?php

function void_cf7_elementor_js_load(){
    wp_enqueue_script( 'void-cf7-elementor-js', plugins_url('assets/js/void-cf7-elementor-editor.js', __FILE__ ), array('jquery'), '1.0.0', true );
    wp_localize_script('void-cf7-elementor-js', 'voidCf7Admin', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ), 'url' => get_admin_url()));
}

add_action( 'elementor/frontend/before_enqueue_scripts', 'void_cf7_elementor_js_load');

function void_cf7_elementor_css_load(){
    wp_enqueue_style( 'void-cf7-elementor-css', plugins_url('assets/css/void-cf7-elementor-editor.css', __FILE__ ), [], '1.0.0' );
}

add_action( 'elementor/frontend/before_enqueue_styles', 'void_cf7_elementor_css_load');

function load_custom_editor_modal(){
    ?>
    <div class="void-cf7-custom-editor-modal">
        <?php include 'modal-editor.php'; ?>
    </div>
    <?php
}

add_action('elementor/editor/after_enqueue_styles', 'load_custom_editor_modal' );