<?php
/*
 * Plugin Name: Obfuscate Class Links
 * Plugin URL: https://github.com/syllod/Obfuscate-Class-Links_wp-plugin
 * Description: This plugin obfuscates links within elements with the class "ob-link" using Base64 encoding.
 * Version: 1.0.0
 * Author: Sylvain L - Syllod
*/

function obfuscate_class_links() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.ob-link a').each(function() {
            var originalLink = $(this).attr('href');
            var obfuscatedLink = 'data:text/html;base64,' + btoa(originalLink);
            $(this).attr('href', obfuscatedLink);
        });

        $(document).on('click', '.ob-link a', function(e) {
            e.preventDefault();
            var obfuscatedLink = $(this).attr('href');
            var decodedLink = obfuscatedLink.replace('data:text/html;base64,', '');
            var originalLink = atob(decodedLink);
            window.location.href = originalLink;
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'obfuscate_class_links');
