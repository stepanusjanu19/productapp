<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //

    public function index()
    {
        $data = Product::all();
        return response()->json([
            "success" => true,
            "message" => "Data Product",
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
        ]);

        if($product)
        {
            return response()->json([
                "success" => true,
                "message" => "Data Produk Berhasil di tambah",
                "product" => $product
            ], 201);
        }

        return response()->json([
            'success' => false,
            "message" => "Data Product Gagal di tambah",
        ], 409);
    }

    public function show($id)
    {
        $findata = Product::find($id);

        if(is_null($findata))
        {
            return response()->json([
                "success" => false,
                "message" => "Data Product tidak ada",
            ], 422);
        }
        
        return response()->json([
            "success" => true,
            "message" => "Data Product Berhasil Tampil",
            "data" => $findata
        ]);
    }

    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        $validator = Validator::make($request->all(), [
            'product_category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $product->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Data Product Berhasil Di ubah",
            "data" => $product
        ]);

    }

    public function delete($id)
    {
        $product = Product::find($id);
        
        $product->delete();

        return response()->json([
            "success" => true,
            "message" => "Data Product Berhasil Di hapus",
            "data" => $product
        ]);
    }

}
