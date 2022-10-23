<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //

    public function index()
    {
        # code...
        $data = Category::all();
        return response()->json([
            "success" => true,
            "message" => "Data Kategori",
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'name' => $request->name
        ]);

        if($category)
        {
            return response()->json([
                'success' => true,
                "message" => "Data Category Berhasil di tambah",
                'kategori' => $category 
            ], 201);
        }

        return response()->json([
            'success' => false,
            "message" => "Data Category Gagal di tambah",
        ], 409);
    }

    public function show($id)
    {
        $findata = Category::find($id);

        if(is_null($findata))
        {
            return response()->json([
                "success" => false,
                "message" => "Data Kategori tidak ada",
            ], 422);
        }
        
        return response()->json([
            "success" => true,
            "message" => "Data Kategori Berhasil Tampil",
            "data" => $findata
        ]);
    }

    public function update(Request $request, $id)
    {

        $category = Category::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $category->update([
            'name' => $request->name
        ]);

        return response()->json([
            "success" => true,
            "message" => "Data Kategori Berhasil Di ubah",
            "data" => $category
        ]);

    }

    public function delete($id)
    {
        $category = Category::find($id);
        
        $category->delete();

        return response()->json([
            "success" => true,
            "message" => "Data Kategori Berhasil Di hapus",
            "data" => $category
        ]);
    }

}
