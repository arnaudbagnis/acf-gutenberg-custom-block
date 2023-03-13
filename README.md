# Acf Gutenberg Custom Block for Lumberjack
This package provides a custom block creation functionality for the[ Lumberjack](https://lumberjack.rareloop.com/ " Lumberjack") theme with the help of [ACF Pro plugin](https://www.advancedcustomfields.com/pro/ "ACF Pro plugin"). It includes a Provider and an AbstractBlock class that allows you to create custom blocks quickly and easily.

## Installation
To use this package, you need to have ACF Pro installed and activated in your project. You can install this package via composer by running the following command:

`composer require arnaudbagnis/acf-gutenberg-custom-block
`
## Usage
Create a new block in your theme's block directory by extending the AbstractBlock class provided by this package. Here is an example:


    <?php
    namespace App\Guttenberg\Block;
    
    use Timber\Timber;
    
    class MyCustomBlock extends AbstractBlock
    {
    
        public static function getName(): string
        {
            return "my-custom-block";
        }
    
        public static function getTitle(): string
        {
            return "My Custom Block";
        }
    
        public static function getDescription(): string
        {
            return "This is a description";
        }
    
        public static function getCategory(): string
        {
            return "formatting";
        }
    
        public static function getIcon(): string
        {
            return "admin-comments";
        }
    
        public static function getKeywords(): array
        {
            return array('my-custom-block', 'quote');
        }
    
        public static function getExample(): array
        {
            return array();
        }
    
        public static function getEnqueueAssets()
        {
            // Add a style/js for only this block
            return null;
        }
    
        public static function getLocalFieldGroup(): array
        {
            // Add a php field acf block for stay in memories
            return [];
        }
    
        public static function getController($block)
        {
            $context = Timber::context();
            // retrieve an ACF field here
            $context['settings'] = [
                'title' => get_field('title'),
                'description' => get_field('description'),
                'image_right' => get_field('image_right'),
                'cta' => get_field('cta'),
                'explanations' => get_field('explanations'),
            ];
            Timber::render('templates/blocks/' . static::getName() . '.twig', $context);
        }
    }
Create a block.php file in your theme's config directory and add the following code to it:


    <?php
    
    use App\Guttenberg\Block\MyCustomBlock;
    
    return [
        'styles' => [
            './assets/dist/main.css'
        ],
        'blocks' => [
            MyCustomBlock::class,
        ]
    ];
The styles array allows you to add global styles to the Gutenberg editor, while the blocks array allows you to add the blocks you created.

That's it! Your custom block is now ready to be used in the Gutenberg editor.
