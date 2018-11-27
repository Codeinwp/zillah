<?php
/**
 * Inform a theme user of plugins that will extend their theme's functionality.
 *
 * @link https://github.com/Automattic/theme-tools/
 *
 * @package zillah
 */

/**
 * Class Zillah_Theme_Plugin_Enhancements
 */
class Zillah_Theme_Plugin_Enhancements {

	/**
	 * Holds the information of the plugins declared as enhancements
	 *
	 * @var array
	 */
	public $plugins;

	/**
	 * Whether to display an admin notice or not.
	 *
	 * @var boolean
	 */
	public $display_notice = false;

	/**
	 * Init function.
	 */
	static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new Zillah_Theme_Plugin_Enhancements;
		}

		return $instance;
	}

	/**
	 * Determine the plugin enhancements declared by the theme.
	 *
	 * Themes must declare the plugins on which they depend by using
	 * add_theme_support( 'plugin-enhancements' ).
	 *
	 * If there are plugin enhancements and any of the enhancements are
	 * either not installed or not activated, alert the user.
	 */
	function __construct() {

		// We only want to display the notice on the Dashboard, Themes, and Plugins pages.
		// Return early if we are on a different screen.
		$screen = get_current_screen();
		if ( ! in_array( $screen->base, array( 'dashboard', 'themes', 'plugins' ) ) ) {
			return;
		}

		// Get the plugin enhancements information declared by the theme.
		$this->dependencies = $this->get_theme_dependencies();

		// Return early if we have no plugin dependencies.
		if ( empty( $this->dependencies ) ) {
			return;
		}

		// Otherwise, build an array to list all the required dependencies and modules.
		$dependency_list = '';
		$this->modules   = array();

		// Create a list of dependencies.
		foreach ( $this->dependencies as $dependency ) :

			// Add to our list of recommended modules.
			if ( 'none' !== $dependency['module'] ) :
				$this->modules[ $dependency['name'] ] = $dependency['module'];
			endif;

			// Build human-readable list.
			$dependency_list .= $dependency['name'] . ' (' . $this->get_module_name( $dependency['module'] ) . '), ';
		endforeach;

		// Define our Jetpack plugin as a required plugin.
		$this->plugins = array(
			array(
				'slug'    => 'themeisle-companion',
				'name'    => 'Orbit Fox',
				'message' => sprintf(
					/* translators:  'Orbit Fox plugin' */
					esc_html__( 'The %1$s is recommended to get built-in analytics, place sharing icons, get notified when your site is down, re-design pages with modern templates, add new Elementor and Beaver Builder widgets.', 'zillah' ),
					'<strong>' . esc_html__( 'Orbit Fox plugin', 'zillah' ) . '</strong>'
				),
			),
			array(
				'slug'    => 'jetpack',
				'name'    => 'Jetpack by WordPress.com',
				'message' => sprintf(
					/* translators:  'Jetpack plugin' */
					esc_html__( 'The %1$s is recommended to use some of this theme&rsquo;s features, including: ', 'zillah' ),
					'<strong>' . esc_html__( 'Jetpack plugin', 'zillah' ) . '</strong>'
				),
				'modules' => rtrim( $dependency_list, ', ' ) . '.',
			),
			array(
				'slug'    => 'pirate-forms',
				'name'    => 'Free & Simple Contact Form Plugin - Pirateforms',
				'message' => sprintf(
					/* translators:  'Simple Contact Form Plugin - PirateForms plugin' */
					esc_html__( 'The %1$s is recommended to use some of this theme&rsquo;s features.', 'zillah' ),
					'<strong>' . esc_html__( 'Simple Contact Form Plugin - PirateForms plugin', 'zillah' ) . '</strong>'
				),
			),
		);

		// Set the status of each of these enhancements and determine if a notice is needed.
		$this->set_plugin_status();
		$this->set_module_status();

		// Output the corresponding notices in the admin.
		if ( $this->display_notice && current_user_can( 'install_plugins' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );
		}
	}

	/**
	 * Let's see which modules (if any!) this theme relies on.
	 */
	function get_theme_dependencies() {
		$dependencies = array();

		if ( current_theme_supports( 'site-logo' ) ) :
			$dependencies['logo'] = array(
				'name'   => __( 'Site Logo', 'zillah' ),
				'slug'   => 'site-logo',
				'url'    => '',
				'module' => 'none',
			);
		endif;

		if ( current_theme_supports( 'featured-content' ) ) :
			$dependencies['featured-content'] = array(
				'name'   => __( 'Featured Content', 'zillah' ),
				'slug'   => 'featured-content',
				'url'    => '',
				'module' => 'none',
			);
		endif;

		if ( current_theme_supports( 'jetpack-social-menu' ) ) :
			$dependencies['social-menu'] = array(
				'name'   => __( 'Social Menu', 'zillah' ),
				'slug'   => 'jetpack-social-menu',
				'url'    => '',
				'module' => 'none',
			);
		endif;

		if ( current_theme_supports( 'nova_menu_item' ) ) :
			$dependencies['menus'] = array(
				'name'   => __( 'Menus', 'zillah' ),
				'slug'   => 'nova_menu_item',
				'url'    => '',
				'module' => 'custom-content-types',
			);
		endif;

		if ( current_theme_supports( 'jetpack-comic' ) ) :
			$dependencies['comics'] = array(
				'name'   => __( 'Comics', 'zillah' ),
				'slug'   => 'jetpack-comic',
				'url'    => '',
				'module' => 'custom-content-types',
			);
		endif;

		if ( current_theme_supports( 'jetpack-testimonial' ) ) :
			$dependencies['testimonials'] = array(
				'name'   => __( 'Testimonials', 'zillah' ),
				'slug'   => 'jetpack-testimonial',
				'url'    => '',
				'module' => 'custom-content-types',
			);
		endif;

		if ( current_theme_supports( 'jetpack-portfolio' ) ) :
			$dependencies['portfolios'] = array(
				'name'   => __( 'Portfolios', 'zillah' ),
				'slug'   => 'jetpack-portfolio',
				'url'    => '',
				'module' => 'custom-content-types',
			);
		endif;

		if ( current_theme_supports( 'jetpack-related-posts' ) ) :
			$dependencies['related-posts'] = array(
				'name'   => __( 'Related Posts', 'zillah' ),
				'slug'   => 'jetpack-related-posts',
				'url'    => '',
				'module' => 'none',
			);
		endif;

		if ( current_theme_supports( 'social-links' ) ) :
			$dependencies['social-links'] = array(
				'name'   => __( 'Social Links', 'zillah' ),
				'slug'   => 'social-links',
				'url'    => '',
				'module' => 'none',
			);
		endif;

		return $dependencies;
	}

	/**
	 * Set the name of our modules. This is just so we can easily refer to them in
	 * a nice, consistent, human-readable way.
	 *
	 * @param string $module The slug of the Jetpack module in question.
	 */
	function get_module_name( $module ) {
		$module_names = array(
			'none'                 => esc_html__( 'no specific module needed', 'zillah' ),
			'custom-content-types' => esc_html__( 'Custom Content Types module', 'zillah' ),
		);
		return $module_names[ $module ];
	}

	/**
	 * Determine the status of each of the plugins declared as a dependency
	 * by the theme and whether an admin notice is needed or not.
	 */
	function set_plugin_status() {
		// Get the names of the installed plugins.
		$installed_plugin_names = wp_list_pluck( get_plugins(), 'Name' );

		foreach ( $this->plugins as $key => $plugin ) {

			// Determine whether a plugin is installed.
			if ( in_array( $plugin['name'], $installed_plugin_names ) ) {

				// Determine whether the plugin is active. If yes, remove if from
				// the array containing the plugin enhancements.
				if ( is_plugin_active( array_search( $plugin['name'], $installed_plugin_names ) ) ) {
					unset( $this->plugins[ $key ] );
				} else {
					$this->plugins[ $key ]['status'] = 'to-activate';
					$this->display_notice            = true;
				}
			} else {
				$this->plugins[ $key ]['status'] = 'to-install';
				$this->display_notice            = true;
			}
		}
	}

	/**
	 * For Jetpack modules, we want to check and see if those modules are actually activated.
	 */
	function set_module_status() {
		$this->unactivated_modules = array();
		// Loop through each module to check if it's active.
		foreach ( $this->modules as $feature => $module ) :
			if ( class_exists( 'Jetpack' ) && ! Jetpack::is_module_active( $module ) ) :
				// Add this feature to our array.
				$this->unactivated_modules[ $module ][] = $feature;
				$this->display_notice                   = true;
			endif;
		endforeach;

	}
	/**
	 * Display the admin notice for the plugin enhancements.
	 */
	function admin_notices() {
		$notice = '';

		// Loop through the plugins and print the message and the download or active links.
		foreach ( $this->plugins as $key => $plugin ) {
			$notice .= '<p>';

			// Custom message provided by the theme.
			if ( isset( $plugin['message'] ) ) {
				$notice .= $plugin['message'];
				if ( ! empty( $plugin['modules'] ) ) {
					$notice .= esc_html( $plugin['modules'] );
				}
			}

			// Activation message.
			if ( 'to-activate' === $plugin['status'] ) {
				$activate_url = $this->plugin_activate_url( $plugin['slug'] );
				$notice      .= sprintf(
					/* translators: 1: plugin name 2: activation link */
					esc_html__( ' Please activate %1$s. %2$s', 'zillah' ),
					esc_html( $plugin['name'] ),
					( $activate_url ) ? '<a href="' . $activate_url . '">' . esc_html__( 'Activate', 'zillah' ) . '</a>' : ''
				);
			}

			// Download message.
			if ( 'to-install' === $plugin['status'] ) {
				$install_url = $this->plugin_install_url( $plugin['slug'] );
				$notice     .= sprintf(
					/* translators: 1: plugin name 2: install link */
					esc_html__( ' Please install %1$s. %2$s', 'zillah' ),
					esc_html( $plugin['name'] ),
					( $install_url ) ? '<a href="' . $install_url . '">' . esc_html__( 'Install', 'zillah' ) . '</a>' : ''
				);
			}

			$notice .= '</p>';
		}

		// Output a notice if we're missing a module.
		foreach ( $this->unactivated_modules as $module => $features ) :
			$featurelist = array();
			foreach ( $features as $feature ) {
				$featurelist[] = $feature;
			}

			if ( 2 === count( $featurelist ) ) {
				$featurelist = implode( ' or ', $featurelist );
			} elseif ( 1 < count( $featurelist ) ) {
				$last_feature = array_pop( $featurelist );
				$featurelist  = implode( ', ', $featurelist ) . ', or ' . $last_feature;
			} else {
				$featurelist = implode( ', ', $featurelist );
			}

			$notice .= '<p>';
			$notice .= sprintf(
				/* translators: 1: feature name 2: Jetpack module name */
				esc_html__( 'To use %1$s, please activate the Jetpack plugin&rsquo;s %2$s.', 'zillah' ),
				esc_html( $featurelist ),
				'<strong>' . esc_html( $this->get_module_name( $module ) ) . '</strong>'
			);
			$notice .= '</p>';
		endforeach;

		// Output notice HTML.
		$allowed = array(
			'p'      => array(),
			'strong' => array(),
			'em'     => array(),
			'b'      => array(),
			'i'      => array(),
			'a'      => array(
				'href' => array(),
			),
		);
		printf(
			'<div id="message" class="notice notice-warning is-dismissible">%s</div>',
			wp_kses( $notice, $allowed )
		);
	}

	/**
	 * Helper function to return the URL for activating a plugin.
	 *
	 * @param string $slug Plugin slug; determines which plugin to activate.
	 */
	function plugin_activate_url( $slug ) {
		// Find the path to the plugin.
		$plugin_paths = array_keys( get_plugins() );
		$plugin_path  = false;

		foreach ( $plugin_paths as $path ) {
			if ( preg_match( '|^' . $slug . '|', $path ) ) {
				$plugin_path = $path;
			}
		}

		if ( ! $plugin_path ) {
			return false;
		} else {
			return wp_nonce_url(
				self_admin_url( 'plugins.php?action=activate&plugin=' . $plugin_path ),
				'activate-plugin_' . $plugin_path
			);
		}
	}

	/**
	 * Helper function to return the URL for installing a plugin.
	 *
	 * @param string $slug Plugin slug; determines which plugin to install.
	 */
	function plugin_install_url( $slug ) {
		/*
		 * Include Plugin Install Administration API to get access to the
		 * plugins_api() function
		 */
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

		$plugin_information = plugins_api(
			'plugin_information',
			array(
				'slug' => $slug,
			)
		);

		if ( is_wp_error( $plugin_information ) ) {
			return false;
		} else {
			return wp_nonce_url(
				self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ),
				'install-plugin_' . $slug
			);
		}
	}
}
add_action( 'admin_head', array( 'Zillah_Theme_Plugin_Enhancements', 'init' ) );
