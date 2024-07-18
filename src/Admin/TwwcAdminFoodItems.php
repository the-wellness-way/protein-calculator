<?php
namespace TwwcProtein\Admin;

use TwwcProtein\Options\TwwcOptions;
use TwwcProtein\Admin\TwwcBeans;

class TwwcAdminFoodItems {
    const PAGE_IDENTIFIER = 'twwc-protein';

    const PAGE_TEMPLATE = 'dashboard';

    const FOOD_ITEMS_SETTINGS_PAGE = 'twwc-food-items-settings';

    private $option_group_food_items = 'food_items_settings';

    private $option_name_food_items = 'food_items_settings';

    private $prefix;

    private $food_items_settings = [];

    private $food_items_settings_input = [];

    public function __construct() {
        $food_items_settings = TwwcOptions::get_option($this->option_name_food_items, []);
        $this->food_items_settings = $food_items_settings ?? [];

        $this->option_group_food_items = $this->prefix . $this->option_group_food_items;
        $this->option_name_food_items  = $this->prefix . $this->option_name_food_items;
    }

    public function register_hooks(): void {
        add_action('admin_menu', [$this, 'register_pages']);
        add_action('admin_init', [$this, 'register_food_items_settings']);
    }

    public function register_pages(): void {
        $manage_capability = $this->get_manage_capability();
        $page_identifier = $this->get_page_identifier();

        $foodItemsSubmenu = add_submenu_page(
            $page_identifier,
            'TWW Calculator: ' . __('', 'twwc-protein'),
            __('Food Items', 'twwc-protein'),
            $manage_capability,
            self::FOOD_ITEMS_SETTINGS_PAGE,
            [$this, 'show_page'],
            3
        );

        add_action( 'load-' . $foodItemsSubmenu, [$this, 'do_admin_enqueue'] );
    }

    public function do_admin_enqueue(): void {
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_scripts'] );
    }

    public function enqueue_admin_scripts(): void {
        wp_enqueue_style('wp-color-picker');

        $version = '1.32.5';

        wp_enqueue_style('twwc-admin-js', TWWC_PROTEIN_PLUGIN_URL . 'resources/css/twwc-admin.css', [], $version, 'all' );
        wp_enqueue_script('twwc-admin-js', TWWC_PROTEIN_PLUGIN_URL . 'resources/js/twwc-admin.js', array( 'wp-color-picker' ), $version, true );

        wp_localize_script('twwc-admin-js', 'twwc_admin_object', [
            'settings' => $this->settings,
            'protein_settings' => $this->protein_settings,
        ]);
    }

    public function register_food_items_settings() {
        add_settings_field(
            'twwc-food-items',
            '<span class="required">*</span> '. __('Activity Level', 'twwc-protein'),
            [$this, 'food_item_callback'],
            self::FOOD_ITEMS_SETTINGS_PAGE,
            'twwc-food-items-settings-section',
            ['max' => 32]
        );

        register_setting('twwc-common-settings-options', $this->option_group_food_items);
    }

    public function food_item_callback() {
        echo '
            <div class="food-items__data">
                <div class="food-items__data-inner">
                    <div class="food-items__item">
                        <label>Food Item</label>
                        <input type="text" name="food_item">
                    </div>
                    <div class="food-items__item">
                        <label>Grams per 40 oz</label>
                        <input type="text" name="food_item">
                    </div>
                    <div class="food-items__item">
                        <label>Unit Type</label>
                        <input type="text" name="food_item">
                    </div>
                </div>
            </div>
        ';
    }

    public function get_manage_capability(): string
    {
        return 'manage_options';
    }

    public function get_page_identifier(): string
    {
        return self::PAGE_IDENTIFIER;
    }

    public function show_page(): void
    {
        require_once TWWC_PROTEIN_PLUGIN_PATH . 'pages/' . self::PAGE_TEMPLATE . '.php';
    }
}