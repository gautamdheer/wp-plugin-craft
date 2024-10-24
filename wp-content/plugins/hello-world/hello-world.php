<?php
/**
 * Hello World
 *
 * @package     HelloWorld
 * @author      Bernhard Kau
 * @license     GPLv3
 *
 * @wordpress-plugin
 * Plugin Name: Hello World
 * Version: 2.2.0
 * Description: In tribute to the famous "Hello Dolly" plugin by Matt Mullenweg comes this new plugin. And how could someone possible name a new default plugin other than "Hello World", as it's THE definition for a default example :)
 * Author: Bernhard Kau
 * Author URI: http://kau-boys.de
 * Plugin URI: https://github.com/2ndkauboy/hello-world
 * Text Domain: hello-world
 * Domain Path: /languages
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 */

/**
 * Load the translation file
 */
function hello_world_load_plugin_textdomain() {
	load_plugin_textdomain( 'hello-world' );
}
add_action( 'plugins_loaded', 'hello_world_load_plugin_textdomain' );

/**
 * Get the random lyric
 *
 * @return string
 */
function hello_world_lyric() {
	// Get the chosen lyrics file for the user.
	$lyrics = hello_world_get_chosen_lyrics_file_content();

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ wp_rand( 0, count( $lyrics ) - 1 ) ] );
}

/**
 * This just echoes the chosen line, we'll position it later
 */
function hello_world_admin_notice() {
	$chosen = hello_world_lyric();

	if ( ! empty( $chosen ) ) {
		printf(
			'<p id="hello_world"><span class="screen-reader-text">%s </span><span dir="ltr">%s</span></p>',
			esc_html__( 'Quote from the Hello World plugin:', 'hello-world' ),
			esc_html( $chosen )
		);
	}
}
add_action( 'admin_notices', 'hello_world_admin_notice' );

/**
 * We need some CSS to position the paragraph
 */
function hello_world_css() {
	?>
	<style>
		#hello_world {
			float: right;
			padding: 5px 10px;
			margin: 0;
			font-size: 12px;
			line-height: 1.6666;
		}
		.rtl #hello_world {
			float: left;
		}
		.block-editor-page #hello_world {
			display: none;
		}
		@media screen and (max-width: 782px) {
			#hello_world,
			.rtl #hello_world {
				float: none;
				padding-left: 0;
				padding-right: 0;
			}
		}
	</style>
	<?php
}
add_action( 'admin_head', 'hello_world_css' );

/**
 * Add the settings page to the menu
 */
function hello_world_menu() {
	add_options_page( __( 'Hello World Lyrics', 'hello-world' ), __( 'Hello World', 'hello-world' ), 'read', 'hello-world', 'hello_world_options' );
}
add_action( 'admin_menu', 'hello_world_menu' );

/**
 * The plugin options page
 */
function hello_world_options() {
	$settings_saved = false;

	$available_lyrics = hello_world_get_available_lyrics();

	if ( isset( $_POST['save'] ) && check_admin_referer( 'hello_world_options', 'hello_world_options_nonce' ) ) {
		// Prevent any arbitrary path to be used.
		$chosen_lyric = isset( $_POST['hello_world_lyrics'] ) ? basename( sanitize_file_name( wp_unslash( $_POST['hello_world_lyrics'] ) ) ) : '';
		// Only allow saving file paths that exist.
		if ( '' === $chosen_lyric || isset( $available_lyrics[ $chosen_lyric ] ) ) {
			update_user_option( get_current_user_id(), 'hello_world_lyrics', $chosen_lyric );
		}
		$settings_saved = true;
	}

	$current_lyric = get_user_option( 'hello_world_lyrics', get_current_user_id() );

	?>
	<div class="wrap">
		<h1><?php echo esc_html__( 'Hello World Lyrics', 'hello-world' ); ?></h1>
		<?php if ( $settings_saved ) : ?>
			<div id="message" class="updated fade">
				<p><strong><?php echo esc_html__( 'Options saved.', 'hello-world' ); ?></strong></p>
			</div>
		<?php endif ?>
		<h2>
			<?php echo esc_html__( 'Choose the lyrics you want to be shown in the Dashboard.', 'hello-world' ); ?>
		</h2>
		<form method="post" action="">
			<div>
				<?php wp_nonce_field( 'hello_world_options', 'hello_world_options_nonce' ); ?>
				<p>
					<label for="hello_world_lyrics"><?php echo esc_html__( 'Available lyrics files:', 'hello-world' ); ?></label>
				</p>
				<select id="hello_world_lyrics" name="hello_world_lyrics">
					<option value=""><?php echo esc_html__( 'none (hide lyrics)', 'hello-world' ); ?></option>
					<?php foreach ( $available_lyrics as $lyrics_file ) : ?>
						<option value="<?php echo esc_attr( basename( $lyrics_file ) ); ?>" <?php selected( basename( $lyrics_file ), basename( $current_lyric ) ); ?>>
							<?php echo esc_html( basename( $lyrics_file ) ); ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>
			<p class="submit">
				<input class="button-primary" name="save" type="submit" value="<?php echo esc_html__( 'Save Changes', 'hello-world' ); ?>"/>
			</p>
		</form>
	</div>
	<?php
}

/**
 * Load the paths of all available lyrics
 *
 * @return array
 */
function hello_world_get_available_lyrics() {
	// Load lyrics bundles with the plugin.
	$plugin_lyrics = glob( plugin_dir_path( __FILE__ ) . 'lyrics/*.txt' );
	// Load lyrics from the uploads dir.
	$upload_dir    = wp_get_upload_dir();
	$custom_lyrics = glob( $upload_dir['basedir'] . '/hello-world-lyrics/*.txt' );

	$lyrics_files = array_merge( $plugin_lyrics, $custom_lyrics );

	$available_lyrics = array();
	foreach ( $lyrics_files as $lyrics_file ) {
		$available_lyrics[ basename( $lyrics_file ) ] = $lyrics_file;
	}

	return $available_lyrics;
}

/**
 * Load the chosen lyrics file.
 *
 * @return string
 */
function hello_world_get_chosen_lyrics_file_content() {
	$lyrics_file = get_user_option( 'hello_world_lyrics', get_current_user_id() );

	// Fallback for full path values stored in the option.
	if ( sanitize_file_name( $lyrics_file ) !== $lyrics_file ) {
		if ( preg_match( '#(plugins)?/?hello-world/?lyrics/?(.*)#', $lyrics_file, $matches ) ) {
			$lyrics_file = $matches[2];
		}
	}

	$available_lyrics = hello_world_get_available_lyrics();

	// Check if file exists.
	if ( empty( $lyrics_file ) || ! file_exists( $available_lyrics[ $lyrics_file ] ) ) {
		return false;
	}

	// These are the lyrics to show.
	$lyrics = file_get_contents( $available_lyrics[ $lyrics_file ] ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

	return $lyrics;
}
