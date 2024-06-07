<?php
/**
 * PHPUnit bootstrap file
 */
// Debugging line to ensure this file is loaded
echo "Bootstrap file loaded\n";
require_once '/app/wp-tests-config.php';

require_once dirname(__DIR__) . '/vendor/autoload.php';




$WP_PHPUNIT_DIR = getenv('WP_PHPUNIT__DIR');

if (!$WP_PHPUNIT_DIR) {
    $WP_PHPUNIT_DIR = '/app/wp-content/plugins/tww-protein/vendor/wp-phpunit/wp-phpunit';
}

// Give access to tests_add_filter() function
require_once $WP_PHPUNIT_DIR . '/includes/functions.php';

tests_add_filter('muplugins_loaded', function() {
    require dirname(__DIR__) . '/tww-protein.php';
});


require $WP_PHPUNIT_DIR . '/includes/bootstrap.php';
