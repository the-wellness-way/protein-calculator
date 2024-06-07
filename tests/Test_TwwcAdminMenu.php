<?php
namespace TwwcProtein\Tests;

use TwwcProtein\Admin\TwwcAdminMenu;
use WP_UnitTestCase;

class Test_TwwcAdminMenu extends WP_UnitTestCase {
    private $int_keys = [
        'one_key' => '',
        'two_key' => '7'
    ];

    /**
     * @covers TwwcProtein\Admin\TwwcAdminMenu::generate_value_string
     * @group adminMenu
     */
    public function test_generate_value_string_returns_string() {
        $admin_menu = new TwwcAdminMenu();
        $this->assertEquals('test', $admin_menu->generate_value_string('test',''));
    }

    /**
     * @covers TwwcProtein\Admin\TwwcAdminMenu::generate_value_int
     * @group adminMenu
     */
    public function test_generate_value_int_returns_defaults_with_missing_keys() {
        $valid_input = [];
        $input = [
            'wrongkey' => '',
            'wrongkeyagain' => ''
        ];

        $twwcAdminMenu = new TwwcAdminMenu();

        foreach($this->int_keys as $key => $default) {
            $valid_input[$key] = isset($input[$key]) ? $twwcAdminMenu->generate_value_int($input[$key], $default) : $default;
        }

        $this->assertEquals($this->int_keys, $valid_input);
    }

    /**
     * @covers TwwcProtein\Admin\TwwcAdminMenu::generate_value_int
     * @group adminMenu
     */
    public function test_generate_value_int_returns_defaults_with_zero() {
        $valid_input = [];

        $input = [
            'one_key' => 0,
            'two_key' => 0
        ];

        $twwcAdminMenu = new TwwcAdminMenu();

        foreach($this->int_keys as $key => $default) {
            $valid_input[$key] = isset($input[$key]) ? $twwcAdminMenu->generate_value_int($input[$key], $default) : $default;
        }

        $this->assertEquals($this->int_keys, $valid_input);
    }

    /**
     * @covers TwwcProtein\Admin\TwwcAdminMenu::generate_value_array
     * @group adminMenu
     */
    public function test_generate_array_int_returns_array() {
        $array = [
            'one_key' => 0,
            'two_key' => 0
        ];

        $twwcAdminMenu = new TwwcAdminMenu();

        $this->assertEquals($array, $twwcAdminMenu->generate_value_array($array));
    }

    /**
     *@covers TwwcProtein\Admin\TwwcAdminMenu::convert_multiplier_to_lbs_value
     * @group adminMenu
     */
    public function test_convert_multiplier_to_lbs_value() {
        $multiplier_weight_kg = 1.2;

        $twwcAdminMenu = new TwwcAdminMenu();

        $this->assertEquals('.54', $twwcAdminMenu->convert_multiplier_to_lbs_value($multiplier_weight_kg));
    }

    /**
     *@covers TwwcProtein\Admin\TwwcAdminMenu::convert_multiplier_to_lbs_value
     * @group adminMenu
     */
    public function test_convert_multiplier_to_kg_value() {
        $multiplier_weight_lbs = .54;

        $twwcAdminMenu = new TwwcAdminMenu();

        $this->assertEquals('1.19', $twwcAdminMenu->convert_multiplier_to_kg_value($multiplier_weight_lbs));
    }
}