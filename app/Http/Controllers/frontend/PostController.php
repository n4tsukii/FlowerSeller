<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
class PostController extends Controller
{
    public function index()
    {
        $post_list = Post::where('status','=',1)
        ->orderBy('created_at','desc')
        ->paginate(6);
        $topic_list = Topic::where('status', '=', 1)
        ->orderBy('created_at', 'desc')
        ->get();
         return view("frontend.post",compact("post_list","topic_list"));
    }

    public function topic($slug)
    {
        $row = Topic::where([['slug', $slug], ['status', '=', 1]])->select('id','name','slug')
        ->first();
        $topic_list = Topic::where('status', '=', 1)
        ->orderBy('created_at', 'desc')
        ->get();
        $post_list = Post::where([['post.status','!=',0],['post.topic_id','=',$row->id]])
        ->orderBy('created_at','desc')
        ->paginate(6);
        return view("frontend.post-topic",compact("post_list",'row','topic_list'));
    } 

    public function post_detail($slug)
    {
        $post = Post::where([['status', '=', 1], ['slug', '=', $slug]])->first();
        $related_posts = Post::where('post.status','=', 1)
        ->where([['topic_id', '=', $post->topic_id],['id','!=',$post->id]])
        ->orderBy('post.created_at', 'desc')
        ->limit(8)
        ->get();
        return view('frontend.post-detail', compact('post','related_posts'));
    }

    public function single_page($link){
        $page = Post::where([['slug','=', $link],['type','=', 'page']])->first();
        return view('frontend.single-page', compact('page'));
    }
}
