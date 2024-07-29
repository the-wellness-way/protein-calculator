<?php
namespace TwwcProtein\Includes;

class TwwcFoodItemsModel {
    const POST_TYPE = 'twwc_food_items';

    private $items_per_page = 40;

    private $total_items = null;
    private $total_pages = null;

    public function __construct() {
        $this->register_post_types();

        $this->set_total_items();
        $this->set_total_pages();
    }

    public function register_post_types() {
        register_post_type(self::POST_TYPE, [
            'labels' => [
                'name' => __('Food Items', 'textdomain'),
                'singular_name' => __('Food Item', 'textdomain'),
            ],
            'public' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_ui' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => false,
            'show_in_admin_bar' => false,
            'query_var' => false,
            'rewrite' => false,
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => ['title', 'custom-fields'],
            'taxonomies' => [],
        ]);
    }

    public function get_fitems() {
        $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;

        $query = new \WP_Query([
            'post_type' => self::POST_TYPE,
            'paged' => $current_page,
            'posts_per_page' => $this->items_per_page,
            'orderby' => 'title',
            'order' => 'ASC'
        ]);

        $this->total_pages = $query->max_num_pages;

        return $query->posts;
    }

    public function get_fitems_js_data() {
        $query = new \WP_Query([
            'post_type' => self::POST_TYPE,
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        ]);

        $posts = $query->posts;
        $js_data = [];
    
        foreach ($posts as $post) {
            $js_data[] = [
                'id' => $post->ID,
                'title' => get_the_title($post->ID),
                'key' => sanitize_title(get_the_title($post->ID)),
                'unitType' => get_post_meta($post->ID, 'unitType', true),
                'unitPer40grams' => get_post_meta($post->ID, 'unitPer40grams', true)
            ];
        }
    
        return $js_data;
    }

    public function get_total_fitems() {
        return wp_count_posts(self::POST_TYPE)->publish;
    }

    public function set_total_items() {
        $this->total_items = $this->get_total_fitems();
    }

    public function set_total_pages() {
        $this->total_pages = ceil($this->total_items / $this->items_per_page);;
    }

    public function pagination_links() {
        $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;

        $pagination_args = array(
            'base'    => add_query_arg('paged', '%#%'),
            'format'  => '',
            'current' => $current_page,
            'total'   => $this->total_pages,
            'prev_text' => __('« Previous'),
            'next_text' => __('Next »'),
        );

        return paginate_links($pagination_args);
    }
}