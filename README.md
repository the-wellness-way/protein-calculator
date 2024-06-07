# TWW Protein Calculator Plugin

The TWW Protein Calculator Plugin for WordPress allows users to calculate their protein intake based on various parameters such as weight, activity level, and special conditions like pregnancy or lactation. The plugin includes a frontend calculator and backend settings for easy customization and integration.

## Features

- **Protein Calculation**: Dynamically calculates protein needs based on user input.
- **Unit Conversion**: Supports both imperial and metric systems.
- **Activity Level Adjustment**: Customizes protein requirements according to the user's activity level.
- **Special Conditions**: Adjusts protein needs for pregnant or lactating users.
- **Shortcode Integration**: Easily integrates the calculator into any post or page with a shortcode.
- **Admin Settings**: Provides a backend interface for configuring default values and options.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the shortcode `[twwc_protein_calculator]` in your posts or pages to display the protein calculator.

## Usage

### Shortcode

You can place the `[twwc_protein_calculator]` shortcode in any post or page where you want the protein calculator to appear. This shortcode renders a form that users can interact with to calculate their protein needs.

### JavaScript Client-Side Functionality

- **Unit Toggle**: Allows users to switch between metric and imperial units; the calculator will convert weights and update calculations accordingly.
- **Dynamic Form Adjustments**: Shows or hides fields based on user selections such as pregnancy status.
- **Real-Time Calculations**: Calculates and displays the required protein intake as users fill out the form.

### PHP Server-Side Functionality

#### Shortcode

- The `TwwcProteinCalculatorShortcode` class handles the rendering of the calculator. It fetches options from the database to configure the calculator's default states and units.

#### Admin Settings

- **Admin Menu**: The `TwwcAdminMenu` class sets up an admin page where default settings for the calculator can be adjusted, such as default unit system, multiplier values, and activity levels.
- **Settings Validation**: Ensures that all inputs for settings like weight multipliers and activity levels are validated before saving to prevent errors.

## Admin Customization

The plugin provides an administrative interface under the "TWW Calculator" menu. Here, settings such as default units (imperial or metric), weight multipliers for different conditions, and activity levels can be customized. These settings impact how protein requirements are calculated on the frontend.

### Custom Fields

Admins can set various parameters through the plugin's settings page:

- **Default System**: Choose between imperial and metric units.
- **Weight Multipliers**: Set specific multipliers that adjust the protein calculations based on the unit system.
- **Activity Levels**: Customize multipliers for different levels of activity.
- **Pregnancy and Lactation Adjustments**: Additional protein requirements for pregnant or lactating users.

## Customizing and Extending

Developers can extend the functionality of the plugin by modifying the JavaScript calculations or the PHP backend logic. Custom styles can be applied to match the calculator with the theme of the site.

## Documentation and Support

For more detailed documentation and support, visit [The Wellness Way's support page](https://www.thewellnessway.com/support).

## License

This plugin is licensed under the GPL-2.0+ license. Feel free to modify and distribute as needed.
