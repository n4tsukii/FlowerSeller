<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use App\Models\Post;
use App\Models\Topic;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Post::where('post.status','!=',0)
        ->join('topic','topic.id','=','post.topic_id')
        ->orderBy('post.created_at','desc')
        ->select('post.id','post.image','topic.id as topcid','topic.name as topicname','post.title','post.description','post.status','post.detail' )
        ->get();
        return view("backend.post.post",compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Topic::where('status','=',1)
        ->get();
        $htmltopicid="";
        foreach($list as $item)
        {
            $htmltopicid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        return view("backend.post.create",compact("list","htmltopicid"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::of($request->title)->slug('-');
        $post->topic_id =$request->topic_id;
        $post->detail =$request->detail;
        $post->description =$request->description;
        $post->type =$request->type;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $post->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/posts"), $filename);
                $post->image = $filename;
            }
        }
        $post->created_at =date('Y-m-d H:i:s');
        $post->created_by =Auth::id()??1;
        $post->status = $request->status;
        if ($post->save()) {
            toastr()->success('Added successfully!');
        }
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.post.index');
        }

        $list = Post::where('post.status','!=',0)
        ->join('topic','topic.id','=','post.topic_id')
        ->orderBy('post.created_at','desc')
        ->select('post.id','post.image','topic.id as topicid','topic.name as topicname','post.title','post.description','post.status','post.detail' )
        ->get();
        $htmltopicid="";
        foreach($list as $item)
        {
            if($post->topic_id==$item->topicid)
            {
                $htmltopicid .= "<option selected value='" . $item->topicid . "'>" . $item->topicname . "</option>";
            }
            else {
                $htmltopicid .= "<option value='" . $item->topicid . "'>" . $item->topicname . "</option>";
            }
        }
        return view("backend.post.edit",compact("post","htmltopicid"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.post.index');
        }
        $post->title = $request->title;
        $post->slug = Str::of($request->title)->slug('-');
        $post->topic_id =$request->topic_id;
        $post->detail =$request->detail;
        $post->description =$request->description;
        $post->type =$request->type;
        if ($request->hasFile('image')) {
            if (in_array($request->image->extension(), ["jpg", "png", "webp", "gif"])) {
                $filename = $post->slug . '.' . $request->image->extension();
                $request->image->move(public_path("images/posts"), $filename);
                $post->image = $filename;
            }
        }
        $post->updated_at =date('Y-m-d H:i:s');
        $post->created_by =Auth::id()??1;
        $post->status = $request->status;
        if ($post->save()) {
            toastr()->success('Updated successfully!');
        }
        return redirect()->route('admin.post.index');
    }
    public function trash()
    {
        $list= Post::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.post.trash",compact("list"));
    }
    public function show(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.post.index');
        }
        return view("backend.post.show", compact("post"));
    }
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('admin.post.index');
        }
        $post->delete();
        return redirect()->route('admin.post.trash');
    }

    public function delete(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('admin.post.index');
        }
        $post->status = 0;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = Auth::id() ?? 1; //id cua quan tri
        $post->save();
        return redirect()->route('admin.post.index');
    }
    public function status(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.post.index');
        }
        $post->status = ($post->status == 2) ? 1:2;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = Auth::id() ?? 1; //id cua quan tri
        $post->save();
        return redirect()->route('admin.post.index');
    }

    public function restore(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('admin.post.index');
        }
        $post->status = 2;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = Auth::id() ?? 1; //id cua quan tri
        $post->save();
        return redirect()->route('admin.post.trash');
    }
}
