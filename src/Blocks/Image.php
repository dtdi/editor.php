<?php

namespace BumpCore\EditorPhp\Blocks;

use BumpCore\EditorPhp\Block\Block;
use BumpCore\EditorPhp\Block\Field;
use BumpCore\EditorPhp\Helpers;
use Illuminate\Support\Facades\View;

class Image extends Block
{
    /**
     * Rules to validate data of the block.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            Field::make('file.url', 'url'),
            Field::make('caption', 'string'),
            Field::make('withBorder', 'boolean'),
            Field::make('stretched', 'boolean'),
            Field::make('withBackground', 'boolean'),
        ];
    }

    /**
     * Renderer for the block.
     *
     * @return string
     */
    public function render(): string
    {
        if (View::getFacadeRoot())
        {
            return view('editor.php::image')
                ->with(['data' => $this->data])
                ->render();
        }

        return Helpers::renderNative(__DIR__ . '/../../resources/php/image.php', ['data' => $this->data]);
    }

    /**
     * Generates fake data for the block.
     *
     * @param Generator $faker
     *
     * @return array
     */
    public static function fake(\Faker\Generator $faker): array
    {
        return [
            'file' => ['url' => $faker->imageUrl()],
            'caption' => $faker->text(),
            'withBorder' => $faker->boolean(),
            'stretched' => $faker->boolean(),
            'withBackground' => $faker->boolean(),
        ];
    }
}
