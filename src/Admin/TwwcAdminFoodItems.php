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
        $this->prefix = TwwcOptions::PREFIX;

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
            __('Food Items', 'twwc-protein') .' | TWW Calculator',
            __('Food Items', 'twwc-protein'),
            $manage_capability,
            self::FOOD_ITEMS_SETTINGS_PAGE,
            [$this, 'show_page'],
            3
        );
    }
    
    public function register_food_items_settings() {
        add_settings_section(
            'twwc-food-items',
            '',
            [$this, 'food_items_callback'],
            self::FOOD_ITEMS_SETTINGS_PAGE,
            []
        );

        register_setting('twwc-food-items-options', $this->option_group_food_items, [$this, 'update_fitems']);
    }

    public function update_fitems($input) {
        foreach ($input as $index => $post) {
            if ($post['ID'] && $post['post_title']) {
                $post_name = sanitize_title($post['post_title']);
    
                wp_update_post(
                    [
                        'ID'         => $post['ID'],
                        'post_title' => $post['post_title'],
                        'post_name'  => $post_name,
                    ]
                );
    
                if ($post['unitType'] && $post['unitPer40grams']) {
                    update_post_meta($post['ID'], 'unitType', $post['unitType']);
                    update_post_meta($post['ID'], 'unitPer40grams', $post['unitPer40grams']);
                }
            }
        }
    }
    
    public function food_items_callback($args) {
        $this->render_section_head();

		$cols = "
			<!--<th class='thumb column-thumb left-cell'>Image</th>-->
			<th class='left-cell'>Food Item Name</th>
			<th class='center-cell'>Unit Type</th>
			<th class='enable-stock center-cell'>Units per 40 grams</th>
		";

		echo "
		<table class='pscaff-table pscaff-table--rounded widefat striped'>
			<thead>
				<tr class='header-row'>
					".$cols."
				<tr>
			</thead>
		";

		$this->render_table_body();

		echo "
			<tfoot>
				<tr class='footer-row'>
					".$cols."
				<tr>
			</tfoot>
		</table>
		";
    }

    public function render_section_head() {
        require TWWC_PROTEIN_PLUGIN_PATH . 'templates/admin/admin-section-head.php';
    }

    public function render_table_body() {
		require TWWC_PROTEIN_PLUGIN_PATH . 'templates/admin/admin-food-items.php';
	}

    /**
	 * Output all the input fields for the client variables
	 *
	 * @param $item
	 * @param $key
	 * @param $option_name
	 * @return void
	 */
	public function add_text_inputs($food_item, $key) {
		$disabled = '';

		require TWWC_PROTEIN_PLUGIN_PATH . 'templates/admin/partials/admin-rows-text-inputs.php';
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
