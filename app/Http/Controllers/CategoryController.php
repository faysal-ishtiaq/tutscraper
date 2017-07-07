<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Site;
use App\Category;
use App\Jobs\GeneratePageLinks;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'site_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'page_count' => 'required|integer',
            'pagination_pattern' => 'required|string|max:255',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::all();
        $categories = Category::paginate(15);

        $data = [
            'sites' => $sites,
            'categories' => $categories,
        ];

        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::paginate(15);

        $data = [
            'categories' => $categories,
        ];

        return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create([
            'site_id' => $request->site_id,
            'name' => $request->name,
            'link' => $request->link,
            'page_count' => $request->page_count,
            'pagination_pattern' => $request->pagination_pattern,
            'processed' => false,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category   = Category::findOrFail($id);
        $posts      = $category->posts()->paginate(30);

        $data       = [
            'category' => $category,
            'posts'    => $posts
        ];

        return view('admin.category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category   = Category::findOrFail($id);
        $categories = Category::paginate(15);
        $sites = Site::all();

        $data   = [
            'sites' => $sites,
            'category'  => $category,
            'categories' => $categories
        ];

        return view('admin.category.edit', $data);
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

        Category::findOrFail($id)->update([
            'site_id' => $request->site_id,
            'name' => $request->name,
            'link' => $request->link,
            'page_count' => $request->page_count,
            'pagination_pattern' => $request->pagination_pattern,
        ]);

        return back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return back()->with('success', 'category deleted successfully.');        //
    }

    public function listPages($id)
    {
        $category = Category::findOrFail($id);

        if($category->pagination_pattern) $this->dispatch(new GeneratePageLinks($category));

        return back();
    }
}
