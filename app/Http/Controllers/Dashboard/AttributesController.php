<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\BrandRequest;
use App\Models\Attribute;
use App\Models\Brand;
use Exception;
use Illuminate\Support\Facades\DB;

class AttributesController extends Controller
{
    public function index()
    {
        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('dashboard.attributes.create');
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        if (!$attribute)
            return redirect()->route('admin.attributes')->with(['error' => 'هذه الخاصية غير متوفرة ']);

        return view('dashboard.attributes.edit', compact('attribute'));
    }


    public function store(AttributeRequest $request)
    {
        try {
            $attribute = new Attribute([

            ]);

            $attribute->name = $request->name;
            $attribute->save();

            return redirect()->route('admin.attributes')->with(['success' => 'تمت الاضافة بنجاح']);

        } catch (Exception $ex) {

            return redirect()->route('admin.attributes')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);
        }
    }

    public function update(BrandRequest $request, $id)
    {
        try {

            $attribute = Attribute::find($id);
            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' => 'هذه الخاصية غير متوفرة ']);

            DB::beginTransaction();

            // Save Translations
            $attribute->name = $request->name;
            $attribute->save();

            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => 'تم التحديث بنجاح']);

        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);
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
            $attribute = Attribute::find($id);
            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' => 'هذه الخاصية غير متوفرة ']);

            $attribute->translations()->delete();
            $attribute->delete();

            return redirect()->route('admin.attributes')->with(['success' => 'تم الحذف بنجاح ']);
        } catch (Exception $ex) {
            return redirect()->route('admin.attributes')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
