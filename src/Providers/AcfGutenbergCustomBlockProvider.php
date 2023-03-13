<?php

use Rareloop\Lumberjack\Config;
use Rareloop\Lumberjack\Providers\ServiceProvider;

class AcfGutenbergCustomBlockProvider extends ServiceProvider
{
    public Config $config;

    public function boot(Config $config)
    {
        add_action('after_setup_theme', function () {
            // Add support for editor styles.
            add_theme_support('editor-styles');
            $styles = $this->config->get('block')['styles'];
            foreach ($styles as $style) {
                // Enqueue editor styles.
                add_editor_style($style);
            }
        });

        function acf_block_render_callback($block): void
        {
            $slug = str_replace('acf/', '', $block['name']);
            // include a template part from within the "template-parts/block" folder
            if (file_exists(get_theme_file_path("/template-parts/blocks/{$slug}/controller-{$slug}.php"))) {
                include(get_theme_file_path("/template-parts/blocks/{$slug}/controller-{$slug}.php"));
            }
        }
        $this->config = $config;
        add_action('acf/init', function () {
            $blocsToRegister = $this->config->get('block')['blocks'];
            foreach ($blocsToRegister as $bloc) {
                $bloc::register();
            }
        });
    }
}