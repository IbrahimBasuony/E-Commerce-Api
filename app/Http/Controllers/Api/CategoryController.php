<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function category($id){
      return $category=$this->categoryRepository->category($id);
    }

    public function categories(){
        return  $categories=$this->categoryRepository->categories();
       }

       public function insertCategory(Request $request){
        return  $insretCategory=$this->categoryRepository->insertCategory($request);
       }

       public function updateCategory(Request $request , $id){
        return  $updateCategory=$this->categoryRepository->updateCategory($request,$id);
       }

       public function deleteCategory($id){
        return  $deleteCategory=$this->categoryRepository->deleteCategory($id);
       }
}
