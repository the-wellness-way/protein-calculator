<?php
use TwwcProtein\Admin\TwwcAdminFoodItems;
$TwwcAdminFoodItems = new TwwcAdminFoodItems(); ?>
<tr>
    <td style="display:none;" class=\'left-cell\'>
        <input style="min-width: 350px;" type="text" name="twwc__food_items_settings[<?php echo $key; ?>][ID]" value="<?php echo $food_item->ID; ?>">
    </td>
    <td class=\'left-cell\'>
        <input style="min-width: 350px;" type="text" name="twwc__food_items_settings[<?php echo $key; ?>][post_title]" value="<?php echo $food_item->post_title; ?>">
        <div class="row-actions">
            <span style="display: none;" class="id">ID: <?php echo $food_item->ID; ?></span>
            </span>
        </div>
    </td>

    <td class=\'center-cell\'>
        <input type="text" name="twwc__food_items_settings[<?php echo $key; ?>][unitType]" value="<?php echo get_post_meta($food_item->ID, 'unitType', true); ?>">
    </td>

    <td class="right-cell" style="min-width: 175px;">
        <input step=".01" style="min-width: 105px;" id="" min="0" type="number" name="twwc__food_items_settings[<?php echo $key; ?>][unitPer40grams]" name="food_item_unitPer40grams" placeholder="" value="<?php echo get_post_meta($food_item->ID, 'unitPer40grams', true); ?>">
    </td>
</tr>