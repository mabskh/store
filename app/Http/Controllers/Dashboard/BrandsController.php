<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        if (!$brand)
            return redirect()->route('admin.brands')->with(['error' => 'هذه العلامة التجارية غير متوفرة ']);

        return view('dashboard.brands.edit', compact('brand'));
    }


    public function store(BrandRequest $request)
    {

        try {
            if(!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $fileName ="";
            if($request->has('photo')){
                $fileName = uploadImage('brands', $request->photo);
            }

            $brand = new Brand([
                'is_active'    =>  $request->get('is_active'),
            ]);

            $brand->name = $request->name;
            $brand->photo = $fileName;

            $brand->save();

            return redirect()->route('admin.brands')->with(['success' => 'تمت الاضافة بنجاح']);

        }catch (\Exception $ex){

            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);

        }
    }

    public function update(BrandRequest $request, $id)
    {
        try {

            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);

            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            if( $request->has('photo')){
                $fileName = uploadImage('brands', $request->photo);
                Brand::where('id' , $id)->update([
                        'photo' => $fileName
                ]);
            }

            $brand->update($request->except('_token','id','photo'));

            // Save Translations
            $brand->name = $request->name;
            $brand->save();

            DB::commit();
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);

        }
    }

    public function changeStatus($id)
    {
        try {

            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);

            $status = $brand->is_active == 0 ? 1 : 0;

            $brand->update(['is_active' => $status]);
            return redirect()->route('admin.brands')->with(['success' => 'تم تغيير حالة القسم بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function activeBrands()
    {
        $brand = Brand::ActiveCAtegories()->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.active', compact('brand'));
    }

    public function destroy($id)
    {
        try {
            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);

            $brand->translations()->delete();
            $brand->delete();

            return redirect()->route('admin.brands')->with(['success' => 'تم الحذف بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
