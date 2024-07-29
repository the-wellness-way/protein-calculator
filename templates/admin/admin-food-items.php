<?php
use TwwcProtein\Admin\TwwcAdminFoodItems;
$twwcAdminFoodItems = new TwwcAdminFoodItems();

use TwwcProtein\Includes\TwwcFoodItemsModel;
$twwcFoodItemsModel = new TwwcFoodItemsModel();
$food_items = $twwcFoodItemsModel->get_fitems();
?>

<tbody>
<?php if($food_items) { array_walk($food_items, [$twwcAdminFoodItems, 'add_text_inputs']); } ?>
</tbody>