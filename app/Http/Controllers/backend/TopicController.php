<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use Flasher\Toastr\Prime\ToastrInterface;
use Flasher\Prime\FlasherInterface;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FlasherInterface $flasher)
    {
        $list = Topic::where('status','!=',0)->orderBy('created_at','desc')->get();
        $htmlsortorder="";
        foreach($list as $item)
        {
            $htmlsortorder .="<option value='" . $item->sort_order . "'>" . $item->sort_order . "</option>";
        }

        return view("backend.topic.topic",compact("list","htmlsortorder"));
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->sort_order =$request->sort_order;
        $topic->description =$request->description;
        $topic->created_at =date('Y-m-d H:i:s');
        $topic->created_by =Auth::id()??1;
        $topic->status = $request->status;
        if ($topic->save()) {
            toastr()->success('Added successfully!');
        }
        return redirect()->route('admin.topic.index');
    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list = Topic::where('status','!=',0)->orderBy('created_at','desc')->get();
        $topic = Topic::find($id);
        if ($topic == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.topic.index');
        }
        $htmlsortorder="";
        foreach($list as $item)
        {
            if($topic->sort_order==$item->sort_order)
            {
                $htmlsortorder .="<option selected value='" . $item->sort_order . "'>" . $item->name . "</option>";             }
            else {
                $htmlsortorder .="<option  value='" . $item->sort_order . "'>" . $item->name . "</option>";             }        }
        return view("backend.topic.edit",compact("topic","htmlsortorder"));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, string $id)
    {
        $topic =Topic::find($id);
        if ($topic == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.topic.index');
        }
        $topic->name = $request->name;
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->sort_order =$request->sort_order;
        $topic->description =$request->description;
        $topic->updated_at =date('Y-m-d H:i:s');
        $topic->created_by =Auth::id()??1;
        $topic->status = $request->status;
        if ($topic->save()) {
            toastr()->success('Updated successfully!');
        }
        return redirect()->route('admin.topic.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trash()
    {
        $list= Topic::where('status','=',0)->orderBy('updated_at','desc')->get();
        return view("backend.topic.trash",compact("list"));
    }
    public function show(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.topic.index');
        }
        return view("backend.topic.show", compact("topic"));
    }
    public function destroy(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $topic->delete();
        return redirect()->route('admin.topic.trash');
    }

    public function delete(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $topic->status = 0;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = Auth::id() ?? 1; //id cua quan tri
        $topic->save();
        return redirect()->route('admin.topic.index');
    }
    public function status(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            toastr()->error('The item does not exist.');
            return redirect()->route('admin.topic.index');
        }
        $topic->status = ($topic->status == 2) ? 1:2;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = Auth::id() ?? 1; //id cua quan tri
        $topic->save();
        return redirect()->route('admin.topic.index');
    }

    public function restore(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $topic->status = 2;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = Auth::id() ?? 1; //id cua quan tri
        $topic->save();
        return redirect()->route('admin.topic.trash');
    }
}
