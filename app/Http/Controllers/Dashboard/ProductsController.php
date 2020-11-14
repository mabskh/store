<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceRequest;
use App\Http\Requests\ProductStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'slug', 'price', 'created_at')
            ->orderBy('id' , 'DESC')
            ->paginate(PAGINATION_COUNT);
        return view('dashboard.products.general.index' , ['products' => $products]);
    }

    public function create()
    {
        $data = [];
        $data['brands'] = Brand::activeBrands()->select('id')->get();
        $data['tags']   = Tag::select('id')->get();
        $data['categories']   = Category::activeCategories()->select('id')->get();

        return view('dashboard.products.general.create', compact('data'));
    }

    public function edit($id)
    {
        //get specific categories and its translations
       $product = Product::find($id);
        if (!$product)
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);

        $product_cat   = $product -> categories ;

        $data = [];
        $data['brands'] = Brand::activeBrands()->select('id')->get();
        $data['tags']   = Tag::select('id')->get();
        return $data['categories']   = Category::activeCategories()->get();


        return view('dashboard.products.general.edit', compact('data' , 'product' , 'product_cat'));
    }

    public function store(GeneralProductRequest  $request)
    {
      //  return  $request;

        try {
            DB::beginTransaction();

           if (!$request->has('is_active'))
               $request->request->add(['is_active' => 0]);
           else
               $request->request->add(['is_active' => 1]);

           $product = Product::create([
              'slug' => $request->slug,
              'brand_id' => $request->brand_id,
              'is_active' => $request->is_active,
           ]);

           $product->name = $request->name;
           $product->description = $request->description;
           $product->short_description = $request->short_description;
           $product->save();

           $product ->categories() -> attach($request->categories);
           $product ->tags() -> attach($request->tags);

            DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'تمت الاضافة بنجاح']);

        }catch (\Exception $ex){
         DB::rollBack();
            return redirect()->route('admin.products')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);

        }
    }

    public function update(GeneralProductRequest $request, $id)
    {
        //return $request;
        $product = Product::find($id);

        if (!$product)
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $product->update($request->all());

        $product -> categories() -> attach($request->categories);
        $product -> tags() -> attach($request->tags);

        return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح ']);
    }

    public function changeStatus($id)
    {
        try {

            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.products')->with(['error' => 'هذا القسم غير موجود ']);

            $status = $category->is_active == 0 ? 1 : 0;

            $category->update(['is_active' => $status]);
            return redirect()->route('admin.products')->with(['success' => 'تم تغيير حالة القسم بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
            $product = Product::find($id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);

            $product->translations()->delete();
            $product->delete();

            return redirect()->route('admin.products')->with(['success' => 'تم الحذف بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function getPrice($product_id)
    {
        $products = Product::get();
        return view('dashboard.products.price.create', compact('products'))->with('id',$product_id);
    }

    public function saveProductPrice(ProductPriceRequest $request)
    {
         // return $request;
        try {
            Product::whereId($request->product_id)->update($request->only(['price','special_price', 'special_price_type','special_price_start','special_price_end']));
            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function getStock($product_id)
    {
        return view('dashboard.products.stock.create')->with('id',$product_id);
    }

    public function saveProductStock(ProductStockRequest $request)
    {
            Product::whereId($request->product_id)->update($request->except('_token' , 'product_id'));
            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح ']);
    }

    public function addImages($product_id)
    {
        return view('dashboard.products.images.create')->withId($product_id);
    }

    public function saveProductImages(Request  $request)
    {
       $file = $request->file('dzfile');
       $fileName = uploadImage('products' , $file);

       return response()->json([
          'name' => $fileName,
           'original_name' => $file-> getClientOriginalName(),
       ]);
    }

    public function saveProductImagesDB(ProductImagesRequest  $request)
    {
        if ($request->has('document') && count($request->document) > 0) {
            foreach ($request->document as $image){
                Image::create([
                   'product_id' => $request->product_id,
                   'photo' => $image,
                ]);
            }
        }
        return redirect()->route('admin.products')->with(['success' => 'تم الاضافة بنجاح ']);
    }




}

