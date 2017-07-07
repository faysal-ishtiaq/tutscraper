<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Site;
use App\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'publish' => 'boolean',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::paginate(15);

        $data = [
            'sites' => $sites,
        ];

        return view('admin.site.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = Site::paginate(15);

        $data = [
            'sites' => $sites,
        ];

        return view('admin.site.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Site::create([
            'name' => $request->name,
            'url' => $request->url,
            'publish' => false,
        ]);

        return back()->with('success', 'Site created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site  = Site::findOrFail($id);
        $categories = Category::where('site_id', $id)->paginate(30);

        $data   = [
            'site'  => $site,
            'categories' => $categories
        ];

        return view('admin.site.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $site   = Site::findOrFail($id);
        $sites  = Site::paginate(15);

        $data   = [
            'site'  => $site,
            'sites' => $sites
        ];

        return view('admin.site.edit', $data);
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
        Site::findOrFail($id)->update([
            'name' => $request->name,
            'url' => $request->url,
            'publish' => $request->has('publish'),
        ]);

        return back()->with('success', 'Site created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Site::destroy($id);

        return back()->with('success', 'Site deleted successfully.');        //
    }

    /**
     * publish site for end-users
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $site = Site::findOrFail($id);
        $site->publish = true;
        $site->save();

        return back()->with('success', 'Site published successfully.');
    }
}
