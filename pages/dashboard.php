<?php
if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="protein-calculator-container wrap" id="tww-admin">

<div class="twwc--page-title-wrapper">
    <div class="twwc--page-header">
    <?php
        use TwwcProtein\Admin\TwwcAdminMenu;

        $logo = TWWC_PROTEIN_PLUGIN_URL . 'resources/images/twwlogo70.webp';
        echo '<h1>TWWC- Settings</h1>';
        settings_errors();
    ?>
    </div>
</div>

<div class="bluefield_content_wrapper">
    <?php
        $page_indentifier   = 'twwc-protein';
        $settings_slug      = TwwcAdminMenu::get_settings_page();
        $tab_two            = TwwcAdminMenu::get_tab_two();

        $active_tab = isset( $_GET[ 'page' ] ) ? sanitize_text_field(wp_unslash($_GET[ 'page' ])) : $settings_slug;
    ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=twwc-protein" class="nav-tab <?php echo ($active_tab == $settings_slug || $active_tab == $page_indentifier) ? 'nav-tab-active' : ''; ?>">Settings</a>
        <a href="?page=twwc-protein-calculator-settings" class="nav-tab <?php echo $active_tab == $tab_two ? 'nav-tab-active' : ''; ?>">Protein Calculator</a>    
        <a href="?page=twwc-food-items-settings" class="nav-tab <?php echo $active_tab == 'twwc-food-items-settings'? 'nav-tab-active' : ''; ?>">Food Items</a>    </h2>

    <form method="post" action="options.php">
        <?php
            if( $active_tab === $settings_slug || $active_tab === $page_indentifier ) {
                settings_fields('twwc-common-settings-options');
                do_settings_sections($settings_slug);
                submit_button();
            } elseif( $active_tab === $tab_two ) {
                settings_fields('twwc-protein-calculator-options');
                do_settings_sections($tab_two);
                submit_button();
            } elseif( $active_tab === 'twwc-food-items-settings' ) {
                settings_fields('twwc-food-items-options');
                do_settings_sections('twwc-food-items-settings');
                submit_button();
            }
        ?>
    </form>
</div>
</div>
