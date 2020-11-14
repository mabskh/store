<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        if (!$tag)
            return redirect()->route('admin.tags')->with(['error' => 'هذه العلامة التجارية غير متوفرة ']);
       // $tag -> makeVisible(['translations']);
        return view('dashboard.tags.edit', compact('tag'));
    }


    public function store(TagsRequest $request)
    {

        try {

            $tag = new Tag([
                'slug'    =>  $request->get('slug'),
            ]);

            $tag->name = $request->name;
            $tag->save();

            return redirect()->route('admin.tags')->with(['success' => 'تمت الاضافة بنجاح']);

        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);
        }
    }

    public function update(TagsRequest $request, $id)
    {
        try {

            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => 'هذا الوسم غير موجود ']);

            DB::beginTransaction();

            $tag->update($request->except('_token','id'));

            // Save Translations
            $tag->name = $request->name;
            $tag->save();

            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.tags')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);

        }
    }

    public function changeStatus($id)
    {
        try {

            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);

            $status = $tag->is_active == 0 ? 1 : 0;

            $tag->update(['is_active' => $status]);
            return redirect()->route('admin.tags')->with(['success' => 'تم تغيير حالة القسم بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function activeTags()
    {
        $tag = Tag::ActiveCategories()->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.active', compact('Tag'));
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);
            $tag->translations()->delete();
            $tag->delete();

            return redirect()->route('admin.tags')->with(['success' => 'تم الحذف بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
