<?php
namespace TwwcProtein\Includes;

class TwwcView {
    const TEMPLATES_PATH = 'templates/';
    const TEMPLATES_ADMIN_PATH = 'templates/admin/';

    public static function render(string $slug = null, array $vars = [], string $path = null) {
        $view = self::get_string($slug, $vars, $path);

       
        if($view) {
            echo $view;

            return $view;
        }

        return null;
      }

      public static function get_string(string $slug = null, array $vars = [], string $path = null) {
        if($slug) {
            $path = $path ?? self::TEMPLATES_PATH;
            $path = TWWC_PROTEIN_PLUGIN_PATH . trailingslashit($path) . $slug . '.php';

            if(file_exists($path)) {
                extract($vars, EXTR_SKIP);

                ob_start();
                require($path);
                $view = ob_get_clean();

                return $view;
            }
        }
    
        return null;
      }
}