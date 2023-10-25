<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        // dd($products);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2160'
        ]);

        try {
            DB::beginTransaction();
            $product = Product::create($request->only(
                'category_id',
                'name',
                'description',
                'price'
            ));

            $filename = 'no-image.jpg';
            if ($request->hasFile('image')) {
                $filename = time() . "." . $request->file('image')->extension();
                $request->file('image')->move(public_path('product-images/'), $filename);
            }
            $product->image = $filename;
            $product->save();

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::channel('web-issues')->error('Error while creating product', [
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2160'

        ]);

        try {
            DB::beginTransaction();

            $product->fill($request->only(
                'category_id',
                'name',
                'description',
                'price'
            ));

            if ($request->hasFile('image')) {
                $filename = time() . "." . $request->file('image')->extension();
                $request->file('image')->move(public_path('product-images/'), $filename);
                $product->image = $filename;
            }
            $product->save();
            DB::commit();
            return redirect()->route('products.index')
                ->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::channel('web-issues')->error('Error while creating product', [
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        echo json_encode(['message' => 'Product deleted successfully.']);
        exit;
    }
}
