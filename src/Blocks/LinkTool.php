<?php

namespace BumpCore\EditorPhp\Blocks;

use BumpCore\EditorPhp\Block\Block;
use BumpCore\EditorPhp\EditorPhp;
use BumpCore\EditorPhp\Helpers;
use Illuminate\Support\Facades\View;

class LinkTool extends Block
{
        /**
     * Tag allow list for purifying data.
     *
     * @return array|string
     */
    public function allows(): array|string
    {
      return "*";
        return [
            'link' => [],
            'meta.title' => [],
            'meta.site_name' => [],
            'meta.description' => [],
            'meta.image.url' => [],
            'meta.type' => [],
            'meta.id' => [],
        ];
    }

    /**
     * Rules to validate data of the block.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'link' => 'url',
            'meta.title' => 'nullable|string',
            'meta.type' => 'nullable|string',
            'meta.id' => 'nullable|string',
            'meta.site_name' => 'nullable|string',
            'meta.description' => 'nullable|string',
            'meta.image.url' => 'nullable|url',
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
            return view(sprintf('editor.php::%s.linktool', EditorPhp::usingTemplate()))
                ->with(['data' => $this->data, 'tunes' => $this->tunes])
                ->render();
        }

        return Helpers::renderNative(__DIR__ . sprintf('/../../resources/php/%s/linktool.php', EditorPhp::usingTemplate()), ['data' => $this->data, 'tunes' => $this->tunes]);
    }

    /**
     * Generates fake data for the block.
     *
     * @param \Faker\Generator $faker
     *
     * @return array
     */
    public static function fake(\Faker\Generator $faker): array
    {
        return [
            'link' => $faker->url(),
            'meta' => [
                'title' => $faker->text(32),
                'site_name' => $faker->text(32),
                'description' => $faker->text(96),
                'image' => ['url' => $faker->imageUrl()],
            ],
        ];
    }
}
