<?php
/*
Plugin Name: Filtr8 Magazine
Plugin URI: http://wordpress.org/plugins/filtr8_magazine/
Description: Filtr8 Magazine for WordPress is a simple way to display content curated with Filtr8
Version: 1.0
Author: Filtr8
Author URI: http://filtr8.com/
License: GPLv3
*/

if ( !function_exists( 'filtr8_embed_shortcode' )) :

	function filtr8_enqueue() 
    {
		wp_enqueue_script( 'jquery' );
	}
	
	function filtr8_embed_shortcode( $atts, $content = null ) 
    {
        $html = '<script>
            jQuery(function($)
            {
                var target_height = $(document).height();
                $("iframe.filtr8_iframe").height(target_height);
                $("iframe.filtr8_iframe").css("max-width", "none");
                $("iframe.filtr8_iframe").css("margin", "30px 0 30px 0");
            });
            </script>';
            
        $html .= "\n".'<!-- filtr8_magazine plugin v.1.0 wordpress.org/plugins/filtr8_magazine/ -->'."\n";
		$html .= '<iframe class="filtr8_iframe" width="100%" scrolling="no" frameborder="0" ';
        $html .= ' src="' . $atts['src'] . '" ';
		$html .= '></iframe>'."\n";
        
		return $html;
	}

	function filtr8_plugin_meta( $links, $file ) 
    {
		if ( strpos( $file, 'filtr8_magazine.php' ) !== false ) 
			$links = array_merge( $links, array( '<a href="http://filtr8.com/" title="Filtr8 Home Page">Learn more about Filtr8</a>' ));
            
		return $links;
	}
    
    add_action( 'wp_enqueue_scripts', 'filtr8_enqueue' );
	add_shortcode( 'filtr8_mag', 'filtr8_embed_shortcode' );
	add_filter( 'plugin_row_meta', 'filtr8_plugin_meta', 10, 2 );
	
endif;