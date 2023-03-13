<?php

namespace Block;

class AbstractBlock
{
    public static function register(): void
    {
        if (function_exists('acf_register_block')) {
            acf_register_block(array(
                'name' => static::getName(),
                'title' => __(static::getTitle()),
                'description' => __(static::getDescription()),
                'render_callback' => function ($block) {
                    static::getController($block);
                },
                'category' => static::getCategory(),
                'icon' => static::getIcon(),
                'keywords' => static::getKeywords(),
                'example' => static::getExample(),
                'enqueue_assets' => static::getEnqueueAssets(),
            ));
        }
        if(function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group(static::getLocalFieldGroup());
        }
    }

    public static function getLocalFieldGroup(): array
    {
        return [];
    }
}