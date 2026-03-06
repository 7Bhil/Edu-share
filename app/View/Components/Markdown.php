<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Markdown extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function render()
    {
        $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return view('components.markdown', [
            'html' => $converter->convert($this->content)
        ]);
    }
}
