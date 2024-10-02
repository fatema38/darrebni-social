<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request){
        $user=auth()->user();
        $user->postsreports()->syncWithoutDetaching([
         $request->post_id=>['note'=>$request->note]
        ]);
//       $report= Report::create([
//           'post_id'=>$request->post_id,
//           'user_id'=>auth()->id(),
//           'note'=>$request->note,
//       ]);
       return redirect()->back();
    }
    public function index(){
        $reports=Report::WhereHas('post', function ($query)  {
            $query->where('group_id', null);})->get();


       return view('pages.reports.reports',compact('reports'));
    }
    public function  reject($id){
        $report=Report::find($id);
        $report->delete();
        return redirect()->back();
    }
    public function approve($id){
        $report=Report::with('post.usersRatings','post.comments')->find($id);
        if($report->post !=null)
        $report->post->delete();
        if($report->post->usersRatings != null)
            $report->post->usersRatings()->detach();
        if($report->post->comments !=null)
            $report->post->comments()->delete();
        $report->delete();
        return redirect()->back();
    }
    public function reportShow($id){
        $post_id=$id;
        return view('pages.reports.reportShow',compact('post_id'));
    }
}
