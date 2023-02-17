<?php

namespace App\Repositories;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryRepositoryInterface
{

  //------------------------Select Category --------------------
    public function category($id){
    
      $category=Category::find($id);
      if($category != null){
        return new CategoryResource($category);
      }else{
        return response()->json([
            "msg"=>"Category Not Found"
        ]);
      }
    }


    //------------------------ All Categories --------------------

    public function categories(){
          $categories=Category::all();
          return CategoryResource::collection($categories);
       }


    //------------------------Insert Category --------------------
       public function insertCategory(Request $request){

        $validator=Validator::make($request->all(),[
          "name"=>'required|string'
        ]);

        if($validator->fails()){
          return response()->json([
              $validator->errors()
          ],404);
      }

      $insertCategory=Category::create(["name"=>$request->name]);

      return response()->json([
        "Msg"=>"Success",
        "insertCategory"=>$insertCategory

    ],200);

       }


       //------------------------Update Category --------------------
       public function updateCategory(Request $request , $id){
        $category=Category::find($id);
          if($category == null){
            return response()->json([
              "msg"=>"Category Not Found"
          ]);          
          }else{
            $validator=Validator::make($request->all(),[
              "name"=>'required|string'
            ]);

            if($validator->fails()){
              return response()->json([
                  $validator->errors()
              ],404);
          }

          $category->update(["name"=>$request->name]);

          return response()->json([
            "Msg"=>"Success",
            "updateCategory"=>$category
    
        ],200);
          }
       }

       //------------------------Delete Category --------------------
       public function deleteCategory($id){
        $category=Category::find($id);
          if($category == null){
            return response()->json([
              "msg"=>"Category Not Found"
          ]);          
          }
          $category->delete();

          return response()->json([
            "msg"=>"Category Deleted Successfully"
        ]); 
          

        }   
}
