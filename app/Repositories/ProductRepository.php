<?php

namespace App\Repositories;



use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    //------------------------Select Product --------------------
    public function Product($id){
    
        $Product=Product::find($id);
        if($Product != null){
          return new ProductResource($Product);
        }else{
          return response()->json([
              "msg"=>"Product Not Found"
          ]);
        }
      }

      
    //------------------------ All Products --------------------

    public function products(){
        $products=Product::all();
        return ProductResource::collection($products);
     }

      //------------------------Insert Product --------------------
      public function insertProduct(Request $request){

        $validator=Validator::make($request->all(),[
            "title"=>'required|string',
            "description"=>'required|string',
            "price"=>'required|numeric',
            "quantity"=>'required|numeric',
            "image"=>'image|mimes:png,jpg,gif,jpeg',
            "category_id"=>'exists:categories,id|required'
        ]);

        if($validator->fails()){
          return response()->json([
              $validator->errors()
          ],404);
      }
  
      $imageName=Storage::putFile("products",$request->image);

      $insertProduct=Product::create([
        "title"=>$request->title,
        "description"=>$request->description,
        "price"=>$request->price,
        "quantity"=>$request->quantity,
        "image"=>$imageName,
        "category_id"=>$request->category_id,
    ]);

      return response()->json([
        "Msg"=>"Success",
        "insertProduct"=>$insertProduct

    ],200);

       }

        //------------------------Update Product --------------------
        public function updateProduct(Request $request , $id){
            $product=Product::find($id);
              if($product == null){
                return response()->json([
                  "msg"=>"Product Not Found"
              ]);          
              }
                $validator=Validator::make($request->all(),[
                    "title"=>'required|string',
                    "description"=>'required|string',
                    "price"=>'required|numeric',
                    "quantity"=>'required|numeric',
                    "image"=>'image|mimes:png,jpg,gif,jpeg',
                    "category_id"=>'exists:categories,id|required'
                ]);
    
                if($validator->fails()){
                  return response()->json([
                      $validator->errors()
                  ],404);
              }

                if($request->has("image")){
                    Storage::delete($product->image);
                    $imageName=Storage::putFile("products",$request->image);
                }
    
              $product->update([
                "title"=>$request->title,
                "description"=>$request->description,
                "price"=>$request->price,
                "quantity"=>$request->quantity,
                "image"=>$imageName,
                "category_id"=>$request->category_id,
            ]);
    
              return response()->json([
                "Msg"=>"Success",
                "updateProduct"=>$product
        
            ],200);
              
           }

              //------------------------Delete Product --------------------
       public function deleteProduct($id){
        $product=Product::find($id);
          if($product == null){
            return response()->json([
              "msg"=>"Product Not Found"
          ]);          
          }
          if($product->image != null){
            Storage::delete($product->image);
          }
          
          $product->delete();

          return response()->json([
            "msg"=>"Product Deleted Successfully"
        ]); 
          

        }   
  
}