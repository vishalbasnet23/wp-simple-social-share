<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://git.toptal.com/Bishal-Basnet/bishal-basnet
 * @since      1.0.0
 *
 * @package    Social_Share
 * @subpackage Social_Share/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Social_Share
 * @subpackage Social_Share/admin
 * @author     Bishal Basnet <vishalbasnet23@gmail.com>
 */
class Social_Share_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param string $plugin_name	The name of this plugin.
	 * @param string $version	The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Social_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Social_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/social-share-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Social_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Social_Share_Loader will then create the relationship
		 * between the defined hooks and the functionsdefined in this
		 * class.
		 */

		 wp_enqueue_script( 'jquery-ui-sortable' );
		 wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/social-share-admin.js', array( 'jquery', 'jquery-ui-sortable' ), $this->version, false );

	}

	/**
	 * Add admin menu
	 *
	 * @return	void
	 */
	public  function social_share_admin_menu() {
		add_menu_page(
			__( 'Social Share Options', 'social-share' ),
			__( 'Social Share', 'social-share' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'social_share_options_page' ),
			'',
			6
		);
	}

	/**
	 * Callback function of admin_menu
	 *
	 * @return void
	 */
	function social_share_options_page() {
		include_once 'partials/social-share-admin-display.php';
	}

	/**
	 * Settings register on admin init
	 *
	 * @return void
	 */
	function social_share_settings_register() {
		register_setting( $this->plugin_name, 'toptal_social_share_options' );

		add_settings_section(
			'toptal_social_share_social_media_selection_section',
			__( 'Social Media Selection', 'social-share' ),
			array( $this, 'toptal_social_share_social_media_selection_section_callback' ),
			$this->plugin_name
		);

		add_settings_field(
			'activate_social_share',
			__( 'Enable social share', 'social-share' ),
			array( $this, 'toptal_social_share_activate_callback' ),
			$this->plugin_name,
			'toptal_social_share_social_media_selection_section'
		);

		add_settings_field(
			'social_media_show_on',
			__( 'Social Share Show on', 'social-share' ),
			array( $this, 'social_media_show_on_callback' ),
			$this->plugin_name,
			'toptal_social_share_social_media_selection_section'
		);

		add_settings_field(
			'social_media_buttons',
			__( 'Social Share Buttons', 'social-share' ),
			array( $this, 'social_media_buttons_callback' ),
			$this->plugin_name,
			'toptal_social_share_social_media_selection_section'
		);

		add_settings_field(
			'social_share_button_size',
			__( 'Social Share Button Size', 'social-share' ),
			array( $this, 'social_share_button_size_callback' ),
			$this->plugin_name,
			'toptal_social_share_social_media_selection_section'
		);
		add_settings_field(
			'social_share_button_style',
			__( 'Social Share Button Style', 'social-share' ),
			array( $this, 'social_share_button_style_callback' ),
			$this->plugin_name,
			'toptal_social_share_social_media_selection_section'
		);

		add_settings_field(
			'social_icon_display_position',
			__( 'Social Media Display Position', 'social-share' ),
			array( $this, 'social_share_media_position_callback' ),
			$this->plugin_name,
			'toptal_social_share_social_media_selection_section'
		);
	}

	/**
	 * Callback for toptal_social_share_social_media_selection_section
	 *
	 * @return void
	 */
	function toptal_social_share_social_media_selection_section_callback() {
		echo __( 'Social Media Selection Section', 'social-share' );
	}

	/**
	 * Callback to activate social share settings  description]
	 *
	 * @return void
	 */
	function toptal_social_share_activate_callback() {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$activation_option = '<td>';
		$activation_option .= '<input type="checkbox" id="activated" name="toptal_social_share_options[activated]"' . checked( $toptal_social_share_options['activated'], 'yes', false ) . ' value="yes"/>';
		$activation_option .= '<label for="activated">' . __( 'Activate', 'social-share' ) . '</label>';
		$activation_option .= '</td>';
		echo $activation_option;
	}

	/**
	 * Callback for show on setting
	 *
	 * @return void
	 */
	function social_media_show_on_callback() {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$public_post_types = get_post_types(
			array(
				'public' => true,
			),
			'objects'
		);
		$social_media_show_on_options = '<td>';
		foreach ( $public_post_types as $post_type ) {
			$checked = in_array( $post_type->name, (array) $toptal_social_share_options['social_media_show_on'] ) ? 'checked="checked"' : '';
			$social_media_show_on_options .= '<input type="checkbox" id="' . $post_type->name . '" name="toptal_social_share_options[social_media_show_on][]"' . $checked . 'value="' . $post_type->name . '" />';
			$social_media_show_on_options .= '<label for="' . $post_type->name . '">' . $post_type->label . '</label> ';
		}
		$social_media_show_on_options .= '</td>';
		echo $social_media_show_on_options;
	}

	/**
	 * Social Media Button Settings Callback
	 *
	 * @return void
	 */
	function social_media_buttons_callback() {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$social_media_choices = $this->prepare_sorted_social_media_choices();
		$icon_size = $toptal_social_share_options['button_size'];
		$icon_style = $toptal_social_share_options['button_style'];
		switch ( $icon_size ) {
			case 'small':
				$label_class = 'social-share-icon small-icon';
				break;
			case 'medium':
				$label_class = 'social-share-icon medium-icon';
				break;
			case 'large':
				$label_class = 'social-share-icon large-icon';
				break;
			default:
				$label_class = 'social-share-icon small-icon';
				break;
		}
		$label_class .= ' ' . $icon_style;
		$social_media_choices_options = '<td id="social-share-sortable">';
		foreach ( $social_media_choices as $social_media_key ) {
			$social_media_value = str_replace( '_', ' ', ucfirst( $social_media_key ) );
			$social_media_choices_options .= '<div class="ui-state-default">';
			$checked = in_array( $social_media_key, (array) $toptal_social_share_options['social_media_selection'] ) ? 'checked="checked"' : '';
			$social_media_choices_options .= '<input type="checkbox" id="' . $social_media_key . '" name="toptal_social_share_options[social_media_selection][]"' . $checked . 'value="' . $social_media_key . '" />';
			$social_media_choices_options .= '<label for="' . $social_media_key . '" class="' . $label_class . ' ' . $social_media_key . '">&nbsp;</label> ';
			$social_media_choices_options .= '</div>';
		}
		$social_media_choices_options .= '<p>' . __( 'Drag the social icons to change the order', 'social-share' ) . '</p>';
		$social_media_choices_options .= '</td>';
		echo $social_media_choices_options;
	}

	/**
	 * Callback for button size setting
	 *
	 * @return void
	 */
	function social_share_button_size_callback() {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$selected_button_size = empty( $toptal_social_share_options['button_size'] ) ? 'small' : $toptal_social_share_options['button_size'];
		$social_share_button_size_choices = array(
			'small' => __( 'Small', 'social-share' ),
			'medium' => __( 'Medium', 'social-share' ),
			'large' => __( 'Large', 'social-share' ),
		);
		$social_share_button_size_option = '<td>';
		foreach ( $social_share_button_size_choices as $button_size_key => $button_size_val ) {
			$social_share_button_size_option .= '<input type="radio" id="' . $button_size_key . '" name="toptal_social_share_options[button_size]" value="' . $button_size_key . '" ' . checked( $selected_button_size, $button_size_key, false ) . ' />';
			$social_share_button_size_option .= '<label for="' . $button_size_key . '">' . $button_size_val . '</label> ';
		}
		$social_share_button_size_option .= '</td>';
		echo $social_share_button_size_option;
	}

	/**
	 * Callback for button style setting
	 *
	 * @return void
	 */
	function social_share_button_style_callback() {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$selected_button_style = empty( $toptal_social_share_options['button_style'] ) ? 'colored' : $toptal_social_share_options['button_style'];
		$social_share_button_style_choices = array(
			'colored' => __( 'Colored', 'social-share' ),
			'grayscale' => __( 'Gray Scale', 'social-share' ),
		);
		$social_share_button_style_option = '<td>';
		foreach ( $social_share_button_style_choices as $button_style_key => $button_style_val ) {
			$social_share_button_style_option .= '<input type="radio" name="toptal_social_share_options[button_style]" id="' . $button_style_key . '" value="' . $button_style_key . '" ' . checked( $selected_button_style, $button_style_key, false ) . '/>';
			$social_share_button_style_option .= '<label for="' . $button_style_key . '">' . $button_style_val . '</label> ';
		}
		$social_share_button_style_option .= '</td>';
		echo $social_share_button_style_option;
	}

	/**
	 * Callback for social media position
	 *
	 * @return void
	 */
	function social_share_media_position_callback() {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$social_media_position_choices = array(
			'below_post_title' => __( 'Below Post Title', 'social-share' ),
			'floating_on_the_left_area' => __( 'Floating on the left area', 'social-share' ),
			'after_the_post_content' => __( 'After the post content', 'social-share' ),
			'inside_the_featured_image' => __( 'Inside the featured image', 'social-share' ),
		);
		$social_media_postion_options = '<td>';
		foreach ( $social_media_position_choices as $position_key => $position_val ) {
			$checked = in_array( $position_key, (array) $toptal_social_share_options['social_media_display_position'] ) ? 'checked="checked"' : '';
			$social_media_postion_options .= '<input type="checkbox" id="' . $position_key . '" name="toptal_social_share_options[social_media_display_position][]"' . $checked . 'value="' . $position_key . '" />';
			$social_media_postion_options .= '<label for="' . $position_key . '">' . $position_val . '</label> ';
		}
		$social_media_postion_options .= '<p>' . __( 'Or you can use this shortcode [toptal-social-share]', 'social-share' ) . '</p>';
		$social_media_postion_options .= '</td>';
		echo $social_media_postion_options;
	}

	/**
	 * Outputs array of sorted social media buttons
	 *
	 * @return array $sorted_social_media sorted social media buttons.
	 */
	function prepare_sorted_social_media_choices() {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$selected_social_media = $toptal_social_share_options['social_media_selection'];
		$social_media_choices = array(
			'facebook',
			'twitter',
			'google_plus',
			'pinterest',
			'linkedin',
			'whatsapp',
		);
		if ( empty( $selected_social_media ) ) {
			return $social_media_choices;
		} else {
			$sorted_social_media = array_merge( $selected_social_media, array_diff( $social_media_choices, $selected_social_media ) );
			return $sorted_social_media;
		}
	}
}
