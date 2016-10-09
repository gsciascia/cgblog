<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BackendCategoryController extends Controller
{



    /**
     * The category repository instance.
     */
    protected $categories;

    /**
     * Assign Category Model in Controller
     *
     * @param  Category $categories
     */
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }




    /**
     * Display a listing of all the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id=0)
    {


        // Get the categories child of the $id
        $categories = Category::childOf($parent_id)->withCount('children')->paginate(10);

        $next_parent_id = 0;
        $parent_name = null;



        if($parent_id>0){
            $current_parent_category = Category::findOrFail($parent_id);

            // Save the next Parent Category
            $next_parent_id = $current_parent_category->parent_id;
            //Get the current name of the category parent
            $parent_name = $current_parent_category->name;
        }

       return view('backend.categories.index', compact('categories','next_parent_id','parent_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_tree = $this->categories->listTreeCategories();
        $categories = $this->categories->linearizeCategoryArray($categories_tree);

        return view('backend.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Set some rules, I Set here because are only few rows
        $this->validate( $request, [
            'name' => 'required|max:250',
            'parent_id' => 'required|numeric|min:0',
        ]);

        //Recovery input data
        $input_data = $request->all();

        // Create new category
        $new_category = $this->categories->create($input_data);

        if ($new_category) {
                //  Create new insert in pivot table
                $seo_data = $new_category->seo()->create($input_data);
                $new_category->seo()->save($seo_data);

            \Session::flash('flash_message_success', 'Success! Entry saved.');
        }else{
            \Session::flash('flash_message_error', 'Error! Entry Not saved.');
        }






        // Return to list Category page
        return redirect()->route('categories.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categories->findOrFail($id);

        $categories_tree = $category->listTreeCategories();
        $categories = $category->linearizeCategoryArray($categories_tree);

        // retrieve seo data
        $seo = $category->seo->first();



        return view('backend.categories.edit', compact('category','categories','seo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // Set some rules, I Set here because are only few rows
        $this->validate( $request, [
            'name' => 'required|max:250',
            'parent_id' => 'required|numeric|min:0',
        ]);

        //Recovery input data
        $input_data = $request->all();

        $category = $this->categories->find($id);


        if ($category->update($input_data)) {

            $category->seo()->update(['title_tag'=>$input_data['title_tag'], 'description_tag'=>$input_data['description_tag']]);

            \Session::flash('flash_message_success', 'Success! Entry updated.');
        }else{
            \Session::flash('flash_message_error', 'Error! Entry Not updated.');
        }


        return redirect()->route('categories.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     * We retrieve the user choose about how manage sub folder and posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        //Recovery input data
        $input_data = $request->all();

        if(intval($input_data['delete_option'])>0){

            switch ($input_data['delete_option']){

                case 1 : $result = $this->categories->deleteCategoryAndSubcategory($id);
                         break;

                case 2 : $result = $this->categories->moveSubcategory($id,$input_data['move_in_id_category']);
                          break;

                case 3 :  $result = $this->categories->movePostsToCategory($id, $input_data['new_id_category']);

                         break;
            }

        }



        if($result){
            \Session::flash('flash_message_success', 'Success! Category deleted.');
        }else{
            \Session::flash('flash_message_error', 'Error! Category Not deleted.');
        }

        return redirect()->route('categories.index');
    }




    /**
     * Show the form with options for delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);

        //Check some point
        // 1) Did The Category selected has sub-categories?
        // If it has, so I need to ask to user what they want to do with subfolder (delete, Move)
            $has_sub_category = $category->children()->count();

         //2) Did the category selected has post?
        //If it has,  so I need to ask to user what they want to do with Posts (delete, Move)
            $has_posts = $category->posts()->count();

        // Get all Category tree except the category branch and its related sub category
        $categories_tree = $this->categories->listTreeCategories(0,$id);

        // Linearize in array
        $categories_available = $this->categories->linearizeCategoryArray($categories_tree);

        return view( 'backend.categories.delete', compact('category', 'has_sub_category', 'has_posts', 'categories_available') );
    }



}
