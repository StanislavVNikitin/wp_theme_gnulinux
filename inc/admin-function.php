<?php

add_action('admin_menu', 'gnulinux_add_admin_page');

function gnulinux_add_admin_page() {
	$hook_suffix = add_menu_page(__('GNULinux Theme Options','gnulinux'), __('GNULinux','gnulinux'), 'manage_options', 'gnulinux-options','gnulinux_create_page',get_template_directory_uri() . '/assets/img/moon.png');
	add_action("admin_print_scripts-{$hook_suffix}", 'gnulinux_admin_scripts');
	add_action('admin_init','gnulinux_custom_settings');
}

function gnulinux_custom_settings(){
	//Register settings
	register_setting('gnulinux_general_group', 'main_post');
	register_setting('gnulinux_general_group', 'main_post_cnt', function ($input){
		$input = abs((int)$input);
		return ($input < 5) ? $input : 4;
	});
	register_setting('gnulinux_general_group', 'author_avatar');
	register_setting('gnulinux_general_group', 'main_vk');
	register_setting('gnulinux_general_group', 'main_tg');
	register_setting('gnulinux_general_group', 'main_whathapp');

	//Register sections
	add_settings_section('gnulinux_general_section', __('Home page settings', 'gnulinux'),'','gnulinux-options');
	add_settings_section('gnulinux_general_section2', __('Social network', 'gnulinux'),'','gnulinux-options');


	//Add fields
	add_settings_field('main_post', __('Home article', 'gnulinux'),'gnulinux_general_main_post','gnulinux-options','gnulinux_general_section');
	add_settings_field('main_post_cnt', __('Number of feateured posts', 'gnulinux'),'gnulinux_general_main_post_cnt','gnulinux-options','gnulinux_general_section', array('label_for' => 'main_post_cnt'));
	add_settings_field('author_avatar', __('Author avatar', 'gnulinux'),'gnulinux_general_author_avatar','gnulinux-options','gnulinux_general_section');
	add_settings_field('main_vk', __('VK', 'gnulinux'),'gnulinux_general_main_vk','gnulinux-options','gnulinux_general_section2');
	add_settings_field('main_tg', __('TG', 'gnulinux'),'gnulinux_general_main_tg','gnulinux-options','gnulinux_general_section2');
	add_settings_field('main_whathapp', __('Whathapp', 'gnulinux'),'gnulinux_general_main_whathapp','gnulinux-options','gnulinux_general_section2');

}

function gnulinux_general_main_vk(){
	$main_vk = esc_attr(get_option('main_vk'));
	echo '<input type="text" name="main_vk" value="' . $main_vk . '" class="regular-text" id="main_vk">';
}

function gnulinux_general_main_tg(){
	$main_tg = esc_attr(get_option('main_tg'));
	echo '<input type="text" name="main_tg" value="' . $main_tg . '" class="regular-text" id="main_tg">';
}

function gnulinux_general_main_whathapp(){
	$main_whathapp = esc_attr(get_option('main_whathapp'));
	echo '<input type="text" name="main_whathapp" value="' . $main_whathapp . '" class="regular-text" id="main_whathapp">';
}

function gnulinux_general_author_avatar(){
	$image_id = get_option( 'author_avatar' );

	if( $image = wp_get_attachment_image_src( $image_id ) ) {

		echo '<a href="#" class="gnulinux-upl"><img src="' . $image[0] . '" /></a>
	      <a href="#" class="gnulinux-rmv">Remove image</a>
	      <input type="hidden" name="author_avatar" value="' . $image_id . '">';

	} else {

		echo '<a href="#" class="gnulinux-upl">Upload image</a>
	      <a href="#" class="gnulinux-rmv" style="display:none">Remove image</a>
	      <input type="hidden" name="author_avatar" value="">';

	}

}

function gnulinux_general_main_post_cnt(){
	$main_post_cnt = abs((int)get_option('main_post_cnt'));
	echo '<input type="number" min=0 max=4 name="main_post_cnt" class="regular-text" id="main_post_cnt" value="' . $main_post_cnt .'">';
}
function gnulinux_general_main_post(){
	$main_post_id = esc_attr(get_option('main_post'));
    if ($main_post_id) {
	    $main_post= get_post ($main_post_id);
    }
    $main_post_title = ! empty($main_post) ? $main_post->post_title : '';
    echo '<input type="text" id="main_post" class="regular-text">';
    echo '<p class="description" id="main_post_title">';
    if ($main_post_title) {
        echo '<strong>' . __( 'Post selected: ','gnulinux') .'</strong>' . $main_post_title . ' <button class="button delete-main-post"><span class="dashicons dashicons-trash"></span></button>';
    }
    echo '</p>';
	echo '<input type="hidden" id="main_post_id" name="main_post" value="' . $main_post_id . '">';

}

function gnulinux_create_page(){
	require get_template_directory() . '/inc/templates/gnulinux-options.php';
}

function gnulinux_admin_scripts(){
	wp_enqueue_style('gnulinux-jquery-ui-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.css');
	wp_enqueue_style('gnulinux-main-style', get_template_directory_uri() . '/assets/css/admin-main.css');

	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

	wp_register_script('gnulinux-main-js', get_template_directory_uri() . '/assets/js/admin-main.js', array('jquery','jquery-ui-autocomplete'),false,  ['in_footer'=> true]);
    wp_localize_script('gnulinux-main-js', 'gnulinuxObject', array(
            'nonce' => wp_create_nonce('gnulinux-nonce'),
            'post_selected'=>__('Post selected: ','gnulinux')
    ) );
    wp_enqueue_script('gnulinux-main-js');
}
/**
 *
 */
add_action('wp_ajax_main_post_action', function (){
    check_ajax_referer('gnulinux-nonce');

    $main_post_s = $_GET['term'];

	$main_posts = get_posts(
		array(
			's' => $main_post_s,
			'posts_per_page' => 10,
		)
	);
	$result =[];
	if ($main_posts){
		foreach ($main_posts as $main_post){
			$res['label'] = $main_post->post_title;
			$res['id'] = $main_post->ID;
			$result[] = $res;
		}
	}
    echo json_encode($result);
    wp_die();

});
