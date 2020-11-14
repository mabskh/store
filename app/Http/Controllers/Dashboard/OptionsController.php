<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionsRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;

class OptionsController extends Controller
{
    public function index()
    {
        $options = Option::with(['product' => function ($prod) {
            $prod->select('id');
        }, 'attribute' => function ($attr) {
            $attr->select('id');
        }]) ->select('id', 'product_id', 'attribute_id', 'price')
            ->paginate(PAGINATION_COUNT);
        return view('dashboard.options.index', compact('options'));
    }

    public function create()
    {
        $data = [];
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();
        return view('dashboard.options.create', $data);
    }

    public function store(OptionsRequest $request)
    {
        // return $request;
        $option = Option::create([
            'attribute_id' => $request->attribute_id,
            'product_id' => $request->product_id,
            'price' => $request->price
        ]);

        $option->name = $request->name;
        $option->save();
        return redirect()->route('admin.products')->with(['success' => 'تمت الاضافة بنجاح']);
    }
}
