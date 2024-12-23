<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $pages = new Faq;
        $search = $pages->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%');
            }    
        }  


        $pages = $search->latest()->paginate(siteSettings('posts_per_page'));        

        return view('admin.faq.index', compact('pages' ,'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.faq.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

          $page = new Faq();

          $page->title = $request->input('title');
          $page->description = $request->input('description');
     
          $page->save();
          return redirect()->route('faqs.index')->with('success', 'Faq created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {


        $page = Faq::find($id);
        return view('admin.faq.edit', compact('page'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {


        $page = Faq::find($id);
          $page->title = $request->input('title');
         
          $page->description = $request->input('description');

          $page->update();
            return redirect()->route('faqs.index')->with('success', 'Faq updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $page = Faq::find($id);

        $page->delete();
        return redirect()->route('faqs.index')->with('success', 'Faq deleted successfully');
    }
}
