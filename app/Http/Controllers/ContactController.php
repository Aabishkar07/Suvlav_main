<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    public function contact(Request $request){
        $pages = new Contact();
        $search = $pages->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%');
            }    
        }  

        $pages = $search->latest()->paginate(siteSettings('posts_per_page'));        

        return view('admin.contact.index', compact('request','pages'));
    }


    public function delete(Contact $contact){
        $contact->delete();
        return redirect()->back()->with('success','Contact deleted Successfully');
    }
}
