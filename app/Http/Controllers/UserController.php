<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {        
        $users = new User;
        $search = $users->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('name', 'like', '%'.$request->title.'%')->orWhere('email', 'like', '%'.$request->title.'%');
            }          
            
          } 

        $users = $search->latest()->paginate(siteSettings('posts_per_page'));        
        return view('admin.user.index',compact('users','request'));
    }
}
