<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function productCreate(Request $request){
        $validate = $request->validate([
            'image'=>'required |string',
            'name'=>'required |string|max:50',
            'price'=>'required',
            'descrition'=>'string',
            'amount'=>'required',
            'category'=>'required|string',
        ]);

        $product = Product::create($validate);
        $response = [
            'product' => $product,
            'massage' => 'Create Success'
        ];
        return $response;
    }

    public function productRead(){
        return Product::all();
    }

    public function productReadID($id){
        return Product::find($id);
    }

    public function productUpdate(Request $request,$id){
        $product = Product::find($id);
        $product ->update($request->all());

        $response = [
            'product' => $product,
            'massage' => 'Update Success'
        ];
        return $response;
    }

    public function productDelete($id){
        product::destroy($id);

        $response = [
            'massage' => 'Delete Success'
        ];
        return $response;
    }

    public function productReadGuest()
    {
      
       return product::limit(6)->get();

    }

    
    

}
