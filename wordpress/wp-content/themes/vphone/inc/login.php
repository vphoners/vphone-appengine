<?php function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'vphone';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
add_action( 'admin_enqueue_scripts', 'my_login_stylesheet' );

add_filter("login_redirect", "custom_login_redirect", 10, 3);

function custom_login_redirect($redirect_to, $request, $user){
      //is there a user to check?
     if(is_array($user->roles)){
           //check for admins
           if(in_array("administrator", $user->roles)){
                return home_url("/wp-admin/");
            }else{
                 return home_url();
            }
     }
}

add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
  $wp_admin_bar->remove_node( 'site-name' );
}



function remove_dashboard_meta() {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'remove_dashboard_meta' );


function remove_footer_admin ()
{
    echo '<span id="footer-thankyou"></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function change_register_page_msg($message)
{
	if(strpos($message,"Register For This Site") == true)
	{
		$message = '<p class="message">Sign up for vphone</p>';
	}

	return $message;
}
add_filter('login_message','change_register_page_msg');
