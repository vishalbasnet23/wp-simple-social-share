<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://git.toptal.com/Bishal-Basnet/bishal-basnet
 * @since      1.0.0
 *
 * @package    Social_Share
 * @subpackage Social_Share/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Social_Share
 * @subpackage Social_Share/public
 * @author     Bishal Basnet <vishalbasnet23@gmail.com>
 */
class Social_Share_Public {

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
	 *
	 * @param	string $plugin_name       The name of the plugin.
	 * @param	string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode( 'toptal-social-share', array( $this, 'prepare_social_media_output' ) );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/social-share-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/social-share-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Outputs Share button after title
	 *
	 * @param  string $content original content.
	 * @return string  $content manipulated content.
	 */
	function social_share_before_content_display( $content ) {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$social_media_display_position = $toptal_social_share_options['social_media_display_position'];
		$social_media_output = $this->prepare_social_media_output( 'below-post-title' );
		if ( in_array( 'below_post_title', $social_media_display_position ) ) {
			return $social_media_output . $content;
		} else {
			return $content;
		}
	}


	/**
	 * Outputs Share button after content
	 *
	 * @param  string $content original content.
	 * @return string $content manipulated content.
	 */
	function social_share_after_content_display( $content ) {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$social_media_display_position = $toptal_social_share_options['social_media_display_position'];
		$social_media_output = $this->prepare_social_media_output( 'after-post-content' );
		if ( in_array( 'after_the_post_content', $social_media_display_position ) ) {
			return $content . $social_media_output;
		} else {
			return $content;
		}
	}

	/**
	 * Adds extra class to image
	 *
	 * @param  array $attr attributes of images.
	 * @return array  array with class manipulated.
	 */
	function social_share_featured_image_extra_class( $attr ) {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$social_media_display_position = $toptal_social_share_options['social_media_display_position'];
		if ( in_array( 'inside_the_featured_image', $social_media_display_position ) ) {
			$attr['class']	.= ' has-social-share';
		}
		return $attr;
	}

	/**
	 * Outputs Social Share buttons inside featured Image
	 *
	 * @param 	string $html original image wrapper HTML.
	 * @return	string	$html manipulated image wrapper.
	 */
	function social_share_inside_featured_image( $html ) {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$social_media_display_position = $toptal_social_share_options['social_media_display_position'];
		$social_media_output = $this->prepare_social_media_output( 'inside-image' );
		if ( in_array( 'inside_the_featured_image', $social_media_display_position ) ) {
			$html .= $social_media_output;
		}
		return $html;
	}

	/**
	 * Outputs Social Share button floating on left handside.
	 *
	 * @return void
	 */
	function social_share_floating_button() {
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$social_media_display_position = $toptal_social_share_options['social_media_display_position'];
		$social_media_output = $this->prepare_social_media_output( 'floating-left' );
		if ( in_array( 'floating_on_the_left_area', $social_media_display_position ) ) {
			echo $social_media_output;
		}
	}

	/**
	 * Outputs Social share buttons.
	 *
	 * @param string $where display position of share buttons.
	 * @return string $social_media_output share buttons html.
	 */
	function prepare_social_media_output( $where = 'shortcode' ) {
		$url = rawurlencode( get_permalink() );
		$toptal_social_share_options = get_option( 'toptal_social_share_options' );
		$activated = $toptal_social_share_options['activated'];
		$social_media_show_on = $toptal_social_share_options['social_media_show_on'];
		$button_size = $toptal_social_share_options['button_size'];
		$button_style = $toptal_social_share_options['button_style'];
		$selected_social_media = $toptal_social_share_options['social_media_selection'];
		$social_media_display_position = $toptal_social_share_options['social_media_display_position'];
		if ( ( 'yes' === $activated ) &&  is_singular( $social_media_show_on ) ) {
			switch ( $button_size ) {
				case 'medium' :
					$display_class = 'medium-icon';
					break;
				case 'large' :
					$display_class = 'large-icon';
					break;
				default :
					$display_class = 'small-icon';
			}
			$display_class .= ' ' . $button_style . ' ' . $where;

			ob_start();
			$social_media_html = '<div class="toptal-social-share ' . $display_class . '">';
			foreach ( $selected_social_media as $social_media ) {
				switch ( $social_media ) {
					case 'facebook':
						$share_url = "https://www.facebook.com/sharer/sharer.php?u={$url}";
						$social_media_html .= '<a href="javascript:void(0)" class="social-share-pop-up-button facebook-ico" data-url="' . $share_url . '" data-servicename="Facebook">&nbsp;</a>';
						break;
					case 'twitter':
						$share_url = "https://twitter.com/home?status={$url}";
						$social_media_html .= '<a href="javascript:void(0)" class="social-share-pop-up-button twitter-ico" data-url="' . $share_url . '" data-servicename="Twitter">&nbsp;</a>';
						break;
					case 'google_plus':
						$share_url = "https://plus.google.com/share?url={$url}";
						$social_media_html .= '<a href="javascript:void(0)" class="social-share-pop-up-button g-plus-ico" data-url="' . $share_url . '" data-servicename="Google Plus">&nbsp;</a>';
						break;
					case 'linkedin':
						$share_url = "https://www.linkedin.com/shareArticle?mini=true&url={$url}";
						$social_media_html .= '<a href="javascript:void(0)" class="social-share-pop-up-button linkedin-ico" data-url="' . $share_url . '" data-servicename="Linkedin">&nbsp;</a>';
						break;
					case 'pinterest':
						$featured_media_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						$share_url = "https://pinterest.com/pin/create/button/?url={$url}&media={$featured_media_url}";
						$social_media_html .= '<a href="javascript:void(0)" class="social-share-pop-up-button pinterest-ico" data-url="' . $share_url . '" data-servicename="Pinterest">&nbsp;</a>';
						break;
					case 'whatsapp':
						$share_url = "whatsapp://send?text={$url}";
						$social_media_html .= '<a href="javascript:void(0)" class="social-share-pop-up-button whatsapp-mobile-only whatsapp-ico" data-url="' . $share_url . '" data-servicename="WhatsApp">&nbsp;</a>';
						break;

					default:
						$social_media_html .= '<a>' . $social_media . '</a>';
						break;
				}
			}
			$social_media_html .= '</div>';
			$social_media_html .= ob_get_contents();
			ob_end_clean();
		} // End if().
		return $social_media_html;
	}

}
