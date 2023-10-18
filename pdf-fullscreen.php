<?php
/*
Plugin Name: PDF Fullscreen
Description: PDF in fullscreen mode
Version: 1.1
Author: Lemeh_UA
*/

function pdf_fullscreen_enqueue_scripts() {
    // Conect script
    wp_enqueue_style('pdf-fullscreen-style', plugins_url('pdf-fullscreen.css', __FILE__));
    wp_enqueue_script('pdf-fullscreen-script', plugins_url('pdf-fullscreen.js', __FILE__), array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'pdf_fullscreen_enqueue_scripts');

function pdf_fullscreen_shortcode($atts) {
    // Insert shortcode [pdf_fullscreen src="URL_к_PDF"]
    $atts = shortcode_atts(array(
        'src' => '',
    ), $atts);

    if (empty($atts['src'])) {
        return '<p>Lost URL</p>';
    }

    ob_start(); ?>

    <div class="pdf-fullscreen-container">
        <object data="<?php echo esc_url($atts['src']); ?>" type="application/pdf" class="pdf-fullscreen-object">
            <embed src="<?php echo esc_url($atts['src']); ?>" type="application/pdf" />
        </object>
       
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('pdf_fullscreen', 'pdf_fullscreen_shortcode');