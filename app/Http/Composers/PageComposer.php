<?php

namespace App\Http\Composers;
use Illuminate\View\View;
use App\Models\Page;

class PageComposer
{
    protected $pages;

    public function __construct(Page $pages)
    {
        $this->pages = $pages;
    }

    public function compose(View $view)
    {
        return $view->with('pages',$this->pages->all());
    }
}
