<?php
namespace TwwcProtein\Setup;

use TwwcProtein\Options\TwwcOptions;
class TwwcInstallFood_ItemsSchema {
    public static function install() {
        foreach (self::$foodItemsCalcData as $foodItem) {
            if (!self::food_item_exists($foodItem['key'])) {
                wp_insert_post([
                    'post_title' => $foodItem['title'],
                    'post_name' => $foodItem['key'],
                    'post_type' => 'twwc_food_items',
                    'post_status' => 'publish',
                    'meta_input' => [
                        'unitType' => $foodItem['unitType'],
                        'unitPer40grams' => $foodItem['unitPer40grams']
                    ]
                ]);
            }
        }

        return true;
    }

    private static function food_item_exists($key) {
        $query = new \WP_Query([
            'post_type' => 'twwc_food_items',
            'name' => $key,
            'post_status' => 'publish',
            'fields' => 'ids'
        ]);
        
        return $query->have_posts();
    }

    private static $foodItemsCalcData = [
        [
            'id' => 1,
            'title' => 'Grass-Fed Ground Beef',
            'key' => 'grass-fed-ground-beef',
            'unitType' => 'oz',
            'unitPer40grams' => '6'
        ],
        [
            'id' => 2,
            'title' => 'Grass-Fed Beef Liver',
            'key' => 'grass-fed-beef-liver',
            'unitType' => 'oz',
            'unitPer40grams' => '6.5'
        ],
        [
            'id' => 3,
            'title' => 'Grass-Fed Lamb',
            'key' => 'grass-fed-lamb',
            'unitType' => 'oz',
            'unitPer40grams' => '5.5'
        ],
        [
            'id' => 4,
            'title' => 'Pasture Raised Chicken Eggs',
            'key' => 'pasture-raised-chicken-eggs',
            'unitType' => 'eggs',
            'unitPer40grams' => '6'
        ],
        [
            'id' => 5,
            'title' => 'Chickpeas',
            'key' => 'chickpeas',
            'unitType' => 'cups',
            'unitPer40grams' => '3'
        ],
        [
            'id' => 6,
            'title' => 'Grass-Fed Whole Milk Kefir',
            'key' => 'grass-fed-whole-milk-kefir',
            'unitType' => 'cups',
            'unitPer40grams' => '4'
        ],
        [
            'id' => 7,
            'title' => 'Fermented Cow Cheeses',
            'key' => 'fermented-cow-cheeses',
            'unitType' => 'cups',
            'unitPer40grams' => '2.75'
        ],
        [
            'id' => 8,
            'title' => 'Pasture-Raised Chicken Breast',
            'key' => 'pasture-raised-chicken-breast',
            'unitType' => 'oz',
            'unitPer40grams' => '4.5'
        ],
        [
            'id' => 9,
            'title' => 'Wild-Caught Salmon',
            'key' => 'wild-caught-salmon',
            'unitType' => 'oz',
            'unitPer40grams' => '5.5'
        ],
        [
            'id' => 10,
            'title' => 'Pasture-Raised Turkey',
            'key' => 'pasture-raised-turkey',
            'unitType' => 'oz',
            'unitPer40grams' => '5.5'
        ],
        [
            'id' => 11,
            'title' => 'Duck Eggs',
            'key' => 'duck-eggs',
            'unitType' => 'eggs',
            'unitPer40grams' => '4.5'
        ],
        [
            'id' => 12,
            'title' => 'Black Beans',
            'key' => 'black-beans',
            'unitType' => 'cups',
            'unitPer40grams' => '2.5'
        ],
        [
            'id' => 13,
            'title' => 'Plain Goat Milk Yogurt',
            'key' => 'plain-goat-milk-yogurt',
            'unitType' => 'cups',
            'unitPer40grams' => '5'
        ],
        [
            'id' => 14,
            'title' => 'Goat Cheese',
            'key' => 'goat-cheese',
            'unitType' => 'oz',
            'unitPer40grams' => '8'
        ],
        [
            'id' => 15,
            'title' => 'Grass-Fed Steak',
            'key' => 'grass-fed-steak',
            'unitType' => 'oz',
            'unitPer40grams' => '5.5'
        ],
        [
            'id' => 16,
            'title' => 'Grass-Fed Venison',
            'key' => 'grass-fed-venison',
            'unitType' => 'oz',
            'unitPer40grams' => '4.5'
        ],
        [
            'id' => 17,
            'title' => 'TWW Bone Broth Protein Powder',
            'key' => 'tww-bone-broth-protein-powder',
            'unitType' => 'scoops',
            'unitPer40grams' => '2'
        ],
        [
            'id' => 18,
            'title' => 'Lentils',
            'key' => 'lentils',
            'unitType' => 'cups',
            'unitPer40grams' => '2.5'
        ],
        [
            'id' => 19,
            'title' => 'Pinto Beans',
            'key' => 'pinto-beans',
            'unitType' => 'cups',
            'unitPer40grams' => '2.5'
        ],
        [
            'id' => 20,
            'title' => 'Grass-Fed Whole Milk Yogurt',
            'key' => 'grass-fed-whole-milk-yogurt',
            'unitType' => 'cups',
            'unitPer40grams' => '4.5'
        ],
        [
            'id' => 21,
            'title' => 'Sheep Cheese (Manchengo)',
            'key' => 'sheep-cheese-manchengo',
            'unitType' => 'cups',
            'unitPer40grams' => '2.5'
        ]
    ];
}