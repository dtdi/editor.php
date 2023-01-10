<?php

namespace BumpCore\EditorPhp\Blocks;

use BumpCore\EditorPhp\Block\Data;
use BumpCore\EditorPhp\Block\Field;
use BumpCore\EditorPhp\Contracts\Provider;
use BumpCore\EditorPhp\Helpers;
use Illuminate\Support\Facades\View;

class Embed implements Provider
{
    /**
     * Rules to validate data of the block.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            Field::make('service', 'string'),
            Field::make('source', 'url'),
            Field::make('embed', 'url'),
            Field::make('width', 'numeric'),
            Field::make('height', 'numeric'),
            Field::make('caption', 'string'),
        ];
    }

    /**
     * Renderer for the block.
     *
     * @param Data $data
     *
     * @return string
     */
    public function render(Data $data): string
    {
        if (View::getFacadeRoot())
        {
            return view('editor.php::embed')
                ->with(compact('data'))
                ->render();
        }

        return Helpers::renderNative(__DIR__ . '/../../resources/php/embed.php', compact('data'));
    }
}
