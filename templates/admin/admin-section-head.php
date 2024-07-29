<?php 
use TwwcProtein\Includes\TwwcFoodItemsModel;
$twwcFoodItemsModel = new TwwcFoodItemsModel();

$paginated_links = $twwcFoodItemsModel->pagination_links();
?>

<div class='tablenav top'>
    <div class='tablenav-pages'>
            <span class="displaying-num"><?php echo $paginated_links; ?></span>
    </div>
</div> 