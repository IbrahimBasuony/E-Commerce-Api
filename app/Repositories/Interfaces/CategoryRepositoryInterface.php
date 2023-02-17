<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;



interface CategoryRepositoryInterface
{
   public function category($id);

   public function categories();

   public function insertCategory(Request $request);

   public function updateCategory(Request $request , $id);

   public function deleteCategory($id);
   
   


}