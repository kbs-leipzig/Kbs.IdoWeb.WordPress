<?php
/**
 * Create A Simple Theme Options Panel
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Bodentier_Theme_Options' ) ) {

	class Bodentier_Theme_Options {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'Bodentier_Theme_Options', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'Bodentier_Theme_Options', 'register_settings' ) );
			}

		}

		/**
		 * Returns all theme options
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Bodentier Settings', 'text-domain' ),
				esc_html__( 'Bodentier Settings', 'text-domain' ),
				'manage_options',
				'theme-settings',
				array( 'Bodentier_Theme_Options', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'Bodentier_Theme_Options', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Checkbox
				if ( ! empty( $options['checkbox_example'] ) ) {
					$options['checkbox_example'] = 'on';
				} else {
					unset( $options['checkbox_example'] ); // Remove from options if not checked
				}

				// Input
				if ( ! empty( $options['input_example'] ) ) {
					$options['input_example'] = sanitize_text_field( $options['input_example'] );
				} else {
					unset( $options['input_example'] ); // Remove from options if empty
				}

				// Select
				if ( ! empty( $options['select_example'] ) ) {
					$options['select_example'] = sanitize_text_field( $options['select_example'] );
				}

			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap">
				<?php 
					wp_enqueue_script( 'script', get_template_directory_uri() . '/01_kbs_theme_options//theme_options.js', array ( 'jquery' ), 1.1, true);
				?>


				<h1><?php esc_html_e( 'Theme Options', 'text-domain' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>

					<table class="form-table wpex-custom-admin-login-table">

						<!-- For more options see: https://www.wpexplorer.com/wordpress-theme-options/ -->
						<tr>
							<th scope="row"><?php esc_html_e( 'Aktionen', 'text-domain' ); ?></th>
						</tr>
						<tr>
							<td><input class="btn btn-default btn-info" id="do_update_btn" type="button" value="Infos aktualisieren"/></td>
							<td><input class="btn btn-default btn-success" id="do_init_btn" type="button" value="Steckbriefe erstellen"/></td>
							<td><input class="btn btn-default btn-warning" id="do_delete_btn" type="button"  value="Alle Steckbriefe entfernen"/></td>
							<!-- td><input id="do_lock_btn" type="button"  value="Steckbriefe schützen"/></td -->
						</tr>

					</table>

					<?php //submit_button(); ?>

				</form>
				<div id="loading" class="update-nag" style="display:none;"></div>
			</div><!-- .wrap -->
		<?php }

	}
}
new Bodentier_Theme_Options();