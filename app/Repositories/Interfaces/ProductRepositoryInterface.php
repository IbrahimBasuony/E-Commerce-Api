<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;



interface ProductRepositoryInterface
{

    public function product($id);

   public function products();

   public function insertProduct(Request $request);

   public function updateProduct(Request $request , $id);

   public function deleteProduct($id);


}