<?php

namespace App\Http\ViewComposers;


use App\Repositories\BlogRepository;
use Illuminate\View\View;

class SidebarCategoryComposer
{
    private $categoryList = [];

    /**
     * Create a Sidebar composer.
     *
     * @param Category $category
     */
    public function __construct(BlogRepository $blog)
    {
        $this->categoryList = $blog->listCategoriesHierarchy();

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $view->with('categories', $this->categoryList);
    }
}

