<?php

namespace BumpCore\EditorPhp\Blocks;

use BumpCore\EditorPhp\Block\Block;
use BumpCore\EditorPhp\EditorPhp;
use BumpCore\EditorPhp\Helpers;
use Illuminate\Support\Facades\View;

class Code extends Block
{
    /**
     * Tag allow list for purifying data.
     *
     * @return array|string
     */
    public function allows(): array|string
    {
        return [
            'code' => '*',
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
            'code' => 'string',
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
            return view(sprintf('editor.php::%s.code', EditorPhp::usingTemplate()))
                ->with(['data' => $this->data, 'tunes' => $this->tunes])
                ->render();
        }

        return Helpers::renderNative(__DIR__ . sprintf('/../../resources/php/%s/code.php', EditorPhp::usingTemplate()), ['data' => $this->data, 'tunes' => $this->tunes]);
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
        return ['code' => $faker->text()];
    }
}
