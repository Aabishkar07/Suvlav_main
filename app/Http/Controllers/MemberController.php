<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = new Member;


        $search = $members->query();
        if ($request->search == 'search') {
            if ($request->title) {
                $search->where('name', 'like', '%' . $request->title . '%')->orWhere('email', 'like', '%' . $request->title . '%');
            }
        }

        $members = $search->latest()->paginate(siteSettings('posts_per_page'));
        return view('admin.member.index', compact('members', 'request'));
    }



    public function destroy(Member $member)
    {


        $member->delete();
        return redirect()->back()->with('success', 'Member Deleted');
    }

    public function sharestatus(Request $request, Member $member)
    {
        $member->share_status = $request->status;
        $member->save();
        return redirect()->back()->with('success', 'Status Updated');
    }
}
