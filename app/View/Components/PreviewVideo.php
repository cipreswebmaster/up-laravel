<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PreviewVideo extends Component
{
    public $videoId;
    public $text;
    public $example;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($videoId, $text, $example)
    {
        $this->videoId = $videoId;
        $this->text = $text;
        $this->example = $example;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.preview-video');
    }
}
