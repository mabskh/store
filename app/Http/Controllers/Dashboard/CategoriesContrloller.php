<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;


class CategoriesContrloller extends Controller
{
    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);

        return view('dashboard.new-categories.index', compact('categories'));
    }

    public function create()
    {
        $categories =   Category::select('id','parent_id')->get();
        return view('dashboard.new-categories.create',compact('categories'));
    }

    public function edit($id)
    {
        //get specific categories and its translations
       $category = Category::find($id);

        if (!$category)
            return redirect()->route('admin.categories', compact('type'))->with(['error' => 'هذا القسم غير موجود ']);

        $categories = Category::orderBy('id', 'desc')->get();

        return view('dashboard.new-categories.edit', compact('category','categories'));
    }

    public function store(MainCategoryRequest  $request)
    {

        try {
            DB::beginTransaction();

            if(!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $fileName ="";
            if($request->has('photo')){
                $fileName = uploadImage('categories', $request->photo);
            }

            if ($request->type == CategoryType::mainCategory ){
                $request->request->add(['parent_id' => null]);
            }

            $category = new Category([
                'is_active'   =>  $request->get('is_active'),
                'slug'        =>  $request->get('slug'),
                'parent_id'   =>  $request->get('parent_id')
            ]);

            $category->name = $request->name;
            $category->photo = $fileName;
            $category->save();

            DB::commit();
            return redirect()->route('admin.categories')->with(['success' => 'تمت الاضافة بنجاح']);

        }catch (\Exception $ex){
         DB::rollBack();
            return redirect()->route('admin.categories')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);

        }
    }

    public function update(MainCategoryRequest $request, $id)
    {

        try {
           // return $request;
            $category = Category::find($id);

            if (!$category)
                return redirect()->route('admin.categories', compact('type'))->with(['error' => 'هذا القسم غير موجود ']);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            if ($request->type == 1) //main category
            {
                $request->request->add(['parent_id' => null ]);
            }


            if( $request->has('photo')){
                $fileName = uploadImage('categories', $request->photo);
                Category::where('id' , $id)->update([
                    'photo' => $fileName
                ]);
            }

            $category->update($request->all());
            $category->name = $request->name;
            $category->save();

            DB::commit();
            return redirect()->route('admin.categories')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.categories')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);
        }
    }

    public function changeStatus($id)
    {
        try {

            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => 'هذا القسم غير موجود ']);

            $status = $category->is_active == 0 ? 1 : 0;

            $category->update(['is_active' => $status]);
            return redirect()->route('admin.categories')->with(['success' => 'تم تغيير حالة القسم بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function activeCategories()
    {
        $categories = Category::parent()->activeCategories()->paginate(PAGINATION_COUNT);
        return view('dashboard.new-categories.active', compact('categories'));
    }

    public function destroy($id)
    {
        try {
            $category = Category::orderBy('id','DESC')->find($id);
            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => 'هذا القسم غير موجود ']);

            $category->translations()->delete();
            $category->delete();

            return redirect()->route('admin.categories')->with(['success' => 'تم الحذف بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
