<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function Product($id){
        return $product=$this->productRepository->Product($id);
      }
  
      public function products(){
          return  $products=$this->productRepository->products();
         }
  
         public function insertProduct(Request $request){
          return  $insretProduct=$this->productRepository->insertProduct($request);
         }
  
         public function updateProduct(Request $request , $id){
          return  $updateProduct=$this->productRepository->updateProduct($request,$id);
         }
  
         public function deleteProduct($id){
          return  $deleteProduct=$this->productRepository->deleteProduct($id);
         }
}
