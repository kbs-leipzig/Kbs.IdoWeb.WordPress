<?php

require_once("01_kbs_theme_options/bodentier_options.php");
include('01_kbs_theme_options/bodentier_pages_functions.php');

add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

//dsgvo plugin
add_filter('autoptimize_filter_js_minify_excluded','__return_false');

add_filter( 'allowed_http_origins', 'add_allowed_origins' );
add_filter( 'allowed_https_origins', 'add_allowed_origins' );
function add_allowed_origins( $origins ) {
    $origins[] = 'https://api.edaphobase.org';
    return $origins;
}

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');


/** isApproved calls from/to API **/
/** TODO: move to theme_options **/
function get_isApproved_corenetById ($att_id) {
	$corenet_url = "https://idoweb.bodentierhochvier.de/api/images/getImageApprovedById/";
	$corenet_url .= $att_id;
	try {
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);
		$response = file_get_contents($corenet_url, false, stream_context_create($arrContextOptions));
		return json_decode($response);	
	} catch (Exception $e) {
		return null;
	}
}

function set_isApproved_corenetById($att_id, $isApproved)  {
	if(!is_null($isApproved)) {
    	$corenet_url = "https://idoweb.bodentierhochvier.de/api/images/setImageApprovedById";
		
		$data = array("CmsId" => urlencode($att_id), "IsApprovedState" => $isApproved); // data to send 
    	$data_string = json_encode($data);
		wp_remote_post($corenet_url,
			array(
				'headers'     => [
					'Content-Type' => 'application/json',
				],
				'timeout'     => 300,
				'sslverify'   => false,
				'method' => 'POST',
				'body' => $data_string
			)
		);
	}
}

function nb_html_excerpt($text) {
    global $post;
    if ( $text == '' ) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace('\]\]\>', ']]&gt;', $text);
		$allowed_tags = array("html", "body", "b", "br", "em", "hr", "i", "li", "ol", "p", "s", "span", "table", "tr", "td", "u", "ul");
        $text = strip_tags($text, $allowed_tags);
        $excerpt_length = 120;
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words)> $excerpt_length) {
            array_pop($words);
            array_push($words, '[...]');
            $text = implode(' ', $words);
        }
    }
    return $text;
}
add_filter('get_the_excerpt', 'nb_html_excerpt');

// Add custom checkbox attachment field
function add_custom_checkbox_field_to_attachment_fields_to_edit($form_fields, $post) {
    //$checkbox_field = (bool) get_post_meta($post->ID, 'is_approved', true);
	//$imagePath = (bool) get_post_meta($post->ID, 'guid', true);
	$imagePath = wp_get_attachment_url($post->ID);
	
	//$checkbox_field = get_isApproved_corenet($imagePath);
	$checkbox_field = get_isApproved_corenetById($post->ID);
	
	if(!is_null($checkbox_field)) {
		$form_fields['is_approved'] = array(
			'label' => 'Bild freigeben?',
			'input' => 'html',
			'html' => '<input type="checkbox" data-response="'.$checkbox_field.'" id="attachments-'.$post->ID.'-is_approved" name="attachments['.$post->ID.'][is_approved]" value="1"'.($checkbox_field ? ' checked="checked"' : '').' /> ',
			'value' => $checkbox_field,
			'helps' => 'Bild für die Öffentlichkeit freigeben?'
		);
	} else {
		//echo "<p>Keine Bild-Infos in der Datenbank</p>";		
	}
    return $form_fields;
}
add_filter('attachment_fields_to_edit', 'add_custom_checkbox_field_to_attachment_fields_to_edit', null, 2);
 
// Save custom checkbox attachment field
function save_custom_checkbox_attachment_field($post, $attachment) {  
	$imagePath = wp_get_attachment_url($post['ID']);
	$isApproved = null;
    if(isset($attachment['is_approved'])){
		$isApproved = true;
    }else{
		$isApproved = false;
    }
	//set_isApproved_corenet($imagePath, $isApproved);
	set_isApproved_corenetById($post['ID'], $isApproved);
    return $post;
}
add_filter('attachment_fields_to_save', 'save_custom_checkbox_attachment_field', null, 2);

/** bodentier options **/
/** connect bodentier settings js -> php **
**/
add_action('wp_ajax_init_page_generation', 'init_page_generation');
add_action('wp_ajax_delete_generated_pages', 'delete_generated_pages');
add_action('wp_ajax_search_page_by_title', 'search_page_by_title');
add_action('wp_ajax_nopriv_search_page_by_title', 'search_page_by_title');
add_action('wp_ajax_create_page', 'createNewPages');
add_action('wp_ajax_nopriv_image_upload_move', 'image_upload_rename');
add_action('wp_ajax_image_upload_move', 'image_upload_rename');
add_action('wp_ajax_nopriv_call_edapho', 'call_edapho');
add_action('wp_ajax_call_edapho', 'call_edapho');
add_action('wp_ajax_nopriv_call_edapho_debug', 'call_edapho_debug');
add_action('wp_ajax_call_edapho_debug', 'call_edapho_debug');


function image_upload_rename() {
	if(!empty($_POST['data'])) {
		$cmsIds = json_decode($_POST['data']);
		foreach($cmsIds as $cms_key => $cms_val) {
			rename_attachment($cms_val);
		}
	}
	die();
}

function rename_attachment($att_id) {
	if($att_id != null) {
		//$att_url = wp_get_attachment_url($att_id);
		//$att_file = wp_get_attachment_image($att_id);
		$new_title = ltrim(get_the_title($att_id), "temp_");
		$new_post_title = array("ID" => $att_id, "post_title" => $new_title, 'post_name' => $new_title);
		wp_update_post($new_post_title);
	}	
}

function kbs_the_content() {
    $text = _x( 'Continue reading “%s”', 's = post title');
    $more = sprintf( $text, esc_html( get_the_title() ) );
    the_content( $more );
}
/**
* Registers the menu
*/
function kbs_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'user-menu' => __('User Menu'),
        )
    );
}

add_action( 'init', 'kbs_menus' );

// KH: Suchfunktion
function search_form_shortcode( ) {
    get_search_form( );
}

add_shortcode('search_form', 'search_form_shortcode');

// KH: hier umbedingt Class ersetzen!!! */
function new_submenu_class($menu) {    
    $menu = preg_replace('/class="sub-menu"/','/class="rd-navbar-dropdown" /',$menu);        
    return $menu;      
}

add_filter('wp_nav_menu','new_submenu_class'); 

/**
function fb_add_search_box ( $items, $args ) {
	
	// only on primary menu
	//if( 'primary' === $args -> theme_location )
		$items .= '<li class="menu-item menu-item-search">' . get_search_form( FALSE ) . '</li>';
	
	return $items;
}
add_filter( 'wp_nav_menu_items', 'fb_add_search_box', 10, 2 );
**/
/** automatisch ein Suchfeld zum wp-nav-menu hinzufügen. 

function add_search_box($items, $args) {

        ob_start();
        get_search_form();
        $searchform = ob_get_contents();
        ob_end_clean();

        $items .= '<li>' . $searchform . '</li>';

    return $items;
}
add_filter('wp_nav_menu_items','add_search_box', 10, 2);
*/

/**
* Add the endpoint
* TODO: move to theme_options when tested
*/
add_action( 'wp_loaded', 'wpse156943_internal_rewrites' );
function wpse156943_internal_rewrites(){
    add_rewrite_rule( 'image-api', 'index.php?image-api=1', 'top' );
}

add_filter( 'query_vars', 'wpse156943_internal_query_vars' );
function wpse156943_internal_query_vars( $query_vars ){
    $query_vars[] = 'image-upload';
    $query_vars[] = 'image-delete';
    return $query_vars;
}

add_action( 'parse_request', 'wpse156943_internal_rewrites_parse_request' );
function wpse156943_internal_rewrites_parse_request( &$wp ){
	if(is_php_user_logged_in()) {
		if (array_key_exists( 'image-upload', $wp->query_vars ) ) {
			if(!empty($_FILES) && !empty($_POST)) {
				if(!empty($_FILES['files'])) {
					$result = image_upload_function($_FILES['files'], $_POST);
					if($result != 0) {
						echo json_encode($result);
					} else {
						echo "error";
					}
					die();
				}
			}
		} else if(array_key_exists( 'image-delete', $wp->query_vars )) {
			if(isset($_GET['att_id'])) {
				image_delete_function_byId($_GET['att_id']);
				echo "";
				die();
			}
			/** TODO: fallback if no attachment id can be found? **/
			/*
			else if(isset($_GET['fileNames'])) {
				image_delete_function($_GET['fileNames']);
				die();
			}
			**/
		}
	}	
    return;
}

function image_delete_function_byId ($att_id) {
	if(!empty($att_id)) {
		if($att_id != 0) {
			$post_data = get_post($att_id, ARRAY_A);
			//$author_id = $post_data['post_author'];
			//if($author_id == get_current_user_id()) {
			wp_delete_attachment($att_id);
			//}
		}	
	}
	return;
}

function image_upload_function($filedata, $postdata ) {
	if(!empty($filedata) && !empty($postdata)) {
		try {
			$upload_dir = wp_upload_dir();
			$upload_dir['path'] .= "/user_uploads"; 
			$upload_dir['url'] .= "/user_uploads"; 
			
			$image_data = file_get_contents( $filedata['tmp_name'] );
			
			if(!empty($postdata['taxonName']) && !empty($postdata['authorName'])) {
				$taxonName = sanitize_file_name($postdata['taxonName']);
				$authorName = sanitize_file_name($postdata['authorName']);
				$dateString = $postdata['dateString'];
				$dateClean = new DateTime($dateString);
				$filetype = explode(".", $filedata['name']);
				$filename = $taxonName ."_" . $authorName . "_" . $dateClean->format('Y-m-d');
				$filecount = str_pad(count_filename($upload_dir['path'], $filename), 3, '0', STR_PAD_LEFT); 
				$filename .= "_". $filecount . ".".$filetype[1];
			} else {
				$filename = basename( $filedata['name'] );			
			}

			if ( wp_mkdir_p( $upload_dir['path'] ) ) {
			  $file = $upload_dir['path'] . '/' . $filename;
			}
			else {
			  $file = $upload_dir['basedir'] . '/' . $filename;
			}
			file_put_contents( $file, $image_data );
			$wp_filetype = wp_check_filetype( basename($filename), null);
			$attachment = array(
				'guid' => $file,
			  	'post_mime_type' => $wp_filetype['type'],
			  	'post_title' => sanitize_file_name( "temp_".basename($filename)),
			  	'post_content' => '',
			  	'post_status' => 'inherit',
			);
			$attach_id = wp_insert_attachment( $attachment, $file );
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			
			// Generate the metadata for the attachment, and update the database record.
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file);
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
			//$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			//wp_update_attachment_metadata( $attach_id, $attach_data );
			//update_post_meta( $attach_id, 'originalFilename', $filedata['name'] );
			if($attach_id != 0) {
				return array("attach_id"=>$attach_id, "filename"=> $filename);
			}
		} catch (Exception $e) {
			echo "error: ". $e ." please try again";
		}
	}
	return false;
}

add_action('wp_ajax_image_upload_error_cleanup', 'image_upload_error_cleanup');
function image_upload_error_cleanup () {
	if(is_php_user_logged_in()) {
		//login as regular image-upload user
		//$userId = wpdocs_custom_login();
		if(isset($_POST['data']) && $userId) {
			$filename = $_POST['data'];
			global $wpdb;
			$query = "
				SELECT p.*, pm.*
				FROM $wpdb->posts p
				JOIN $wpdb->postmeta pm ON pm.post_id = p.ID
				WHERE p.post_type = \"attachment\" 
				AND pm.meta_value = \"".$filename."\"
				AND pm.meta_key = \"originalFilename\"
				AND p.post_author = ".get_current_user_id()."
				AND pm._wp_attached_file LIKE 'user_uploads/%'
				ORDER BY p.post_date ASC
			";
			$attachments = $wpdb->get_results($query);
			if(sizeof($attachments) == 1) {
				wp_delete_attachment($attachments[0]->ID, true);
				echo $attachments[0]->ID;
			}
		}
	}
	//wp_logout();
	die();
}

/**
* Helper to login to wordpress
* TODO: password plaintext no bueno
**/
function wpdocs_custom_login() {
	//TODO: replace through valid creds
	$creds = array(
       	'user_login'    => '',
       	'user_password' => '',
       	'remember'      => false
   	);
 
	$user = wp_signon( $creds, false );
 
	if ( is_wp_error( $user ) ) {
  		//echo $user->get_error_message();
    	return false;
	}
	return $user->ID;
}


/**
* HELPER TO COUNT FILENAMES
**/
function count_filename($directory, $filename) {
	$completepath = $directory.'/'.$filename;
	$regx = '/(\-\d{2,4}x\d{2,4})+\.(jpg|jpeg|JPG|png|gif)/';
	$re = '/(\-\d{2,4}x\d{2,4})+\.(jpg|jpeg|JPG|png|gif)/gmi';

	$files = glob($directory ."/". $filename."*");
	if ($files !== false ) {
		foreach($files as $file_k => $file_v) {
			if(preg_match($regx, $file_v)) {
				unset($files[$file_k]);
			}
		}
    	$filecount = count( $files );
    	return $filecount;
	}
   	return 0;
}

/**
 * AUTHOR: KBS ST 
 * ITERATE PARENT POSTS
 * RETURN: ARRAY WITH ALL PARENT POSTS INCL PAGE TITLE
 **/
function get_breadcrumbs() {

	global $post;

	$trail = '';
	$page_title = get_the_title($post->ID);
	$page_permalink = get_permalink($post->ID);
	$breadcrumbs = null;

	if($post->post_parent) {
		$parent_id = $post->post_parent;

		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[get_the_title($page->ID)] = get_permalink($page->ID);
			$parent_id = $page->post_parent;
		}

		$breadcrumbs = array_reverse($breadcrumbs);
		$breadcrumbs[$page_title] = $page_permalink;
		//array_push($breadcrumbs, $page_title);
		//foreach($breadcrumbs as $crumb) $trail .= $crumb;
	}

	//$trail .= $page_title;
	//$trail .= '';

	return $breadcrumbs;	
}

function redirect_if_logged_out(){
	If(!is_php_user_logged_in())
	{
		header('Location: \anmeldung');
	}
}
function redirect_if_not_admin(){
	If(get_php_user_role()!="Admin")
	{
		header('Location: ..\401');
	}
}

function is_php_user_logged_in(){
	require_once('wp_auth.php');
	return (auth());
}
function get_php_user_role(){
	require_once('wp_auth.php');
	return (role());
}