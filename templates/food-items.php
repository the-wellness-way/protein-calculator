<?php
// Query for food items from the custom post type
$foodItemsQuery = new WP_Query([
    'post_type' => 'twwc_food_items',
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
    'posts_per_page' => -1
]);

$foodItemsCalcData = [];

if ($foodItemsQuery->have_posts()) {
    while ($foodItemsQuery->have_posts()) {
        $foodItemsQuery->the_post();
        $foodItemsCalcData[] = [
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'key' => get_post_field('post_name', get_the_ID()),
            'unitType' => get_post_meta(get_the_ID(), 'unitType', true),
            'unitPer40grams' => get_post_meta(get_the_ID(), 'unitPer40grams', true)
        ];
    }
    
    wp_reset_postdata();
}
?>

<div class="food-items-container food-items-container--<?php echo $shortcode_counter; ?>">
    <div class="food-items">
        <form class="food-items__form">
            <div class="food-items__form-inner">
                <div class="food-items__input first">
                    <select class="food-items__items">
                        <?php 
                            $count = 0;
                            foreach ($foodItemsCalcData as $foodItem) : 
                                if (0 === $count) {
                                    $foodItemAmount = ($foodItem['unitPer40grams']*100)/40;
                                }
                                $count++;
                        ?>
                            <option value="<?php echo esc_attr($foodItem['key']); ?>"><?php echo esc_html($foodItem['title']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="food-items__input">
                    <div class="food-items__amount food-items__input-inner">
                        <input type="number" value="<?php echo esc_attr($foodItemAmount); ?>">
                        <span class="food-items__unit-type-text"><?php echo esc_html($foodItemsCalcData[0]['unitType']); ?></span>
                    </div>
                </div>
                <span class="food-items__equals "><img src="https://www.thewellnessway.com/wp-content/uploads/2024/07/equals.png"></span>
                <div class="food-items__input last">
                    <div class="food-items__grams food-items__input-inner">
                        <input type="number" value="100">
                        <span class="food-items__grams-text">grams</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
