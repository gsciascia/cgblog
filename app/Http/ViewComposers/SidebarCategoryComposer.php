<?php

namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\View\View;

class SidebarCategoryComposer
{
    private $categoryList = [];

    /**
     * Create a Sidebar composer.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->categoryList = $category->linearizeCategoryArray();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', end($this->movieList));
    }
}

