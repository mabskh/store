<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Exception;


class SubCategoriesContrloller extends Controller
{
    public function index()
    {
        // PAGINATION_COUNT -> Constant Defined In general Helper File
        $categories = Category::child()->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.subcategories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::parent()->orderBy('id', 'DESC')->get();
        return view('dashboard.subcategories.create', compact('categories'));
    }

    public function edit($id)
    {
        //get specific categories and its translations
        $category = Category::orderBy('id', 'DESC')->find($id);

        if (!$category)
            return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

        $categories = Category::parent()->orderBy('id', 'DESC')->get();

        return view('dashboard.subcategories.edit', compact('category', 'categories'));
    }

    public function store(SubCategoryRequest $request)
    {

        try {

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $fileName = "";
            if ($request->has('photo')) {
                $fileName = uploadImage('subcategories', $request->photo);
            }

            $category = new Category([
                'is_active' => $request->get('is_active'),
                'parent_id' => $request->get('parent_id'),
                'slug' => $request->get('slug')
            ]);


            $category->name = $request->name;
            $category->photo = $fileName;
            $category->save();

            return redirect()->route('admin.subcategories')->with(['success' => 'تمت الاضافة بنجاح']);

        } catch (Exception $ex) {

            return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);

        }
    }

    public function update(SubCategoryRequest $request, $id)
    {
        try {

            $subCategory = Category::find($id);

            if (!$subCategory)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);


            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            if( $request->has('photo')){
                $fileName = uploadImage('subcategories', $request->photo);
                Category::where('id' , $id)->update([
                    'photo' => $fileName
                ]);
            }

            //$request['slug'] = Category::createSlug($request->name);
            $subCategory->update($request->all());

            // Save Translations
            $subCategory->name = $request->name;
            $subCategory->save();

            return redirect()->route('admin.subcategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);
        }
    }

    public function changeStatus($id)
    {
        try {

            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            $status = $category->is_active == 0 ? 1 : 0;

            $category->update(['is_active' => $status]);
            return redirect()->route('admin.maincategories')->with(['success' => 'تم تغيير حالة القسم بنجاح ']);

        } catch (Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function activeCategories()
    {
        $categories = Category::child()->ActiveCAtegories()->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.active', compact('categories'));
    }

    public function destroy($id)
    {
        try {
            $subCategory = Category::orderBy('id', 'DESC')->find($id);
            if (!$subCategory)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

            $subCategory->delete();

            return redirect()->route('admin.subcategories')->with(['success' => 'تم الحذف بنجاح ']);
        } catch (Exception $ex) {
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


}
