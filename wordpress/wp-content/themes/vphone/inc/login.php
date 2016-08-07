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
