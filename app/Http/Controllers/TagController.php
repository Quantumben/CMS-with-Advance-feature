<?php


namespace App\Http\Controllers\Tags;
namespace App\Http\Controllers;

use App\Models\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {


        Tag::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Tag created successfully');

        return redirect(route('tags.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        // $category->name = $request->name;

        // $category->save();

        $tag->update([

            'name' => $request->name
        ]);

        session()->flash('success', 'Tag updated successfully');

        return redirect(route('tags.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count())
        {
            session()->flash('error', 'Tag cannot be deleted because it is associates to some posts');

            return redirect()->back();
        }
        $tag->delete();

        session()->flash('success', 'Tag deleted successfully');

        return redirect(route('tags.index'));
    }
}
