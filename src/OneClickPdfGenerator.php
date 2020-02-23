<?php
class OneClickPdfGenerator {
    private static $instance;

    private function __construct() {
        $this->plugin_slug = 'custom_pdf_export';
        $this->menu_slug = 'custom-pdf-export';
        $this->capability = 'manage_options';
        add_action( 'admin_menu', [ $this, 'plugin_menu' ] );
        add_action( 'init', [$this, 'check_pdf']);
        add_action( 'wp_footer', [$this, 'check_pdf_after'], 99);
        add_shortcode( 'oneclickgenerator', [$this, 'shortcode'] );
    }

    function plugin_menu() {
        $hook = add_submenu_page( 
            'tools.php', 
            __( 'One Click Pdf Generator', $this->plugin_slug), 
            __( 'One Click Pdf Generator', $this->plugin_slug), 
            $this->capability, 
            $this->menu_slug, 
            [$this, 'page']
        );			
    }


    function shortcode( $atts ) {
        wp_enqueue_script("oneclickgenerator", plugin_dir_url( __FILE__ ) .  "redirect.js", false, '1.0.0', true);

        $a = shortcode_atts( array(
            'class' => '',
            'text' => 'Generate Pdf'
        ), $atts );


        return "<a class='{$a['class']}' href='#' onClick='OneClickPdfGeneratorLink()'>{$a['text']}</a>";
    }

    function check_pdf(){
        if(isset($_REQUEST['oneclickpdfgenerator'])) {
            ob_start();
        }
    }

    function check_pdf_after(){
        if(isset($_REQUEST['oneclickpdfgenerator'])) {
            require_once(plugin_dir_path( __FILE__ ) . "../lib/vendor/autoload.php");
            $html = ob_get_contents();

            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            
            $mpdf->Output('test.pdf', 'D');
        }
    }

    function page() {
        ?>
            <h1>One Click Pdf Generator</h1>
            <div>
                Feel free to contact florinmunteanu96@gmail.com
            </div>
        <?php
    }

    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}