<?php

/*
Plugin Name: One Click Pdf Generator
Description: Export any page with a simple button click
Version: 0.1
Author: Florin Munteanu
*/

require_once("src/OneClickPdfGenerator.php");
add_action("plugins_loaded", function () {
    OneClickPdfGenerator::get_instance();
});

?>