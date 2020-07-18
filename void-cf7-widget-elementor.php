<?php
/**
 * Plugin Name: Void Contact Form 7 Widget For Elementor Page Builder
 * Description: Adds Contact Form 7 widget element to Elementor page builder for easy drag & drop the created contact forms with CF7 (contact form 7).
 * Version:     1.1.0
 * Author:      voidCoders
 * Plugin URI:  https://demo.voidcoders.com/plugins/contact-form7-widget-for-elementor/
 * Author URI:  https://voidcoders.com
 * Text Domain: void
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('CF7_WIDGET_E_PLUGIN_URL', trailingslashit(plugin_dir_url( __FILE__ )));
define('CF7_WIDGET_E_PLUGIN_DIR', trailingslashit(plugin_dir_path( __FILE__ )));

function void_cf7_widget() {
	// Load localization file
	load_plugin_textdomain( 'void' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}

	// Check version required
	$elementor_version_required = '2.8.5';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		return;
	}

	// Require the main plugin file
    require( __DIR__ . '/plugin.php' );   //loading the main plugin
    // helper file for this plugin. currently used for gettings all contact form of cf7. also used for ajax request handle
    require __DIR__ . '/helper/helper.php';

}
add_action( 'plugins_loaded', 'void_cf7_widget' ); 

// display activation notice for depended plugin
function void_cf7_widget_notice() { ?>

    <?php if ( !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) || ! did_action( 'elementor/loaded' ) ) : ?>
        <div class="notice notice-warning is-dismissible">

            <?php if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) && ! did_action( 'elementor/loaded' ) ) : ?>
                    <p><?php echo sprintf( __( '<a href="%s" class="button button-primary">Active Now</a> <b>Elementor Page Builder</b> must be activated for <b>"Void Contact Form 7 Widget For Elementor Page Builder"</b> to work' ),  wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php') ); ?></p>
            <?php elseif ( !file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) : ?>
                    <p><?php echo sprintf( __( '<a href="%s" class="button button-primary">Install Now</a> <b>Elementor Page Builder</b> must be installed for <b>"Void Contact Form 7 Widget For Elementor Page Builder"</b> to work' ),  wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' )); ?></p>
            <?php endif; ?>

            <?php if ( file_exists( WP_PLUGIN_DIR . '/contact-form-7/wp-contact-form-7.php' ) && !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) : ?>
                    <p><?php echo sprintf( __( '<a href="%s" class="button button-primary">Active Now</a> <b>Contact Form 7</b> must be activated for <b>"Void Contact Form 7 Widget For Elementor Page Builder"</b> to work' ), wp_nonce_url( 'plugins.php?action=activate&plugin=contact-form-7/wp-contact-form-7.php&plugin_status=all&paged=1', 'activate-plugin_contact-form-7/wp-contact-form-7.php' )); ?></p>
            <?php elseif ( !file_exists( WP_PLUGIN_DIR . '/contact-form-7/wp-contact-form-7.php' ) ) : ?>
                    <p><?php echo sprintf( __( '<a href="%s" class="button button-primary">Install Now</a> <b>Contact Form 7</b>  must be installed for <b>"Void Contact Form 7 Widget For Elementor Page Builder"</b> to work' ), wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=contact-form-7' ), 'install-plugin_contact-form-7' )); ?></p>
            <?php endif; ?>

        </div>
    <?php endif; ?>

<?php }
add_action('admin_notices', 'void_cf7_widget_notice');

function void_cf7_widget_promotional_notice(){
    if ( file_exists( WP_PLUGIN_DIR . '/elementor-pro/elementor-pro.php' ) || did_action( 'elementor_pro/init' ) ) : ?>
        <div class="void-query-promotion-notice notice notice-success is-dismissible">
            <div class="void-query-message-inner">
				<div class="void-query-message-icon">
					<img class="void-query-notice-icon" src="https://elequerybuilder.com/wp-content/uploads/2020/05/EQ-Banner.png" alt="voidCoders promotional banner">
				</div>
				<div class="void-query-message-content">
					<p>We noticed you have <strong>Elementor Pro</strong> on your site. Here is a great news for you.</p>
					<p>Check out our another product <strong>Ele Query Builder !</strong></p>
				</div>
				<div class="void-query-message-action">
					<a class="void-query-button" href="">Purchase Now</a>
				</div>
			</div>
        </div>
    <?php endif;
}
add_action('admin_notices', 'void_cf7_widget_promotional_notice');


// add plugin activation time

function void_cf7_activation_time(){
    $get_installation_time = strtotime("now");
    add_option('void_cf7_elementor_activation_time', $get_installation_time ); 
}
register_activation_hook( __FILE__, 'void_cf7_activation_time' );

//check if review notice should be shown or not

function void_cf7_check_installation_time() {

    $spare_me = get_option('void_cf7_spare_me');
    if( !$spare_me ){
        $install_date = get_option( 'void_cf7_elementor_activation_time' );
        $past_date = strtotime( '-7 days' );
     
        if ( $past_date >= $install_date ) {
     
            add_action( 'admin_notices', 'void_cf7_display_admin_notice' );
     
        }
    }
}
add_action( 'admin_init', 'void_cf7_check_installation_time' );
 
/**
* Display Admin Notice, asking for a review
**/
function void_cf7_display_admin_notice() {
    // wordpress global variable 
    global $pagenow;
    if( $pagenow == 'index.php' ){
 
        $dont_disturb = esc_url( get_admin_url() . '?spare_me2=1' );
        $plugin_info = get_plugin_data( __FILE__ , true, true );       
        $reviewurl = esc_url( 'https://wordpress.org/support/plugin/cf7-widget-elementor/reviews/#new-post' );
        $void_url = esc_url( 'https://voidcoders.com/shop/' );
     
        printf(__('<div class="void-cf7-review wrap">You have been using <b> %s </b> for a while. We hope you liked it ! Please give us a quick rating, it works as a boost for us to keep working on the plugin ! Also you can visit our <a href="%s" target="_blank">site</a> to get more themes & Plugins<div class="void-cf7-review-btn"><a href="%s" class="button button-primary" target=
            "_blank">Rate Now!</a><a href="%s" class="void-cf7-review-done"> Already Done !</a></div></div>', $plugin_info['TextDomain']), $plugin_info['Name'], $void_url, $reviewurl, $dont_disturb );
    }
}
// remove the notice for the user if review already done or if the user does not want to
function void_cf7_spare_me(){    
    if( isset( $_GET['spare_me2'] ) && !empty( $_GET['spare_me2'] ) ){
        $spare_me = $_GET['spare_me2'];
        if( $spare_me == 1 ){
            add_option( 'void_cf7_spare_me' , TRUE );
        }
    }
}
add_action( 'admin_init', 'void_cf7_spare_me', 5 );

//add admin css
function void_cf7_admin_css(){
    //  global $pagenow;
    // if( $pagenow == 'index.php' ){
    //     wp_enqueue_style( 'void-cf7-admin', plugins_url( 'assets/css/void-cf7-admin.css', __FILE__ ) );
    // }
    if(true){
        wp_enqueue_style( 'void-cf7-admin', plugins_url( 'assets/css/void-cf7-admin.css', __FILE__ ) );
        wp_enqueue_script('void-cf7-admin', plugins_url( 'assets/js/void-cf7-admin.js', __FILE__ ), ['jquery'], true);
    }
}
add_action( 'admin_enqueue_scripts', 'void_cf7_admin_css' );

include CF7_WIDGET_E_PLUGIN_DIR.'custom-editor/init.php';