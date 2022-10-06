<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller{
    


    public function category(){

    	$category = Category::where('status', '1')->get();

    	return response()->json([

    		'status' => 200,
    		'category' => $category

    	]);
    }



    public function FetchCategoryBySlug($slug){

    		$category = Category::where('slug', $slug)->where('status', '1')->first();

    		if ($category) {

    			$product = Product::where('category_id', $category->id)->where('status', '1')->get();

    			if ($product) {

    			   return response()->json([
		    		'status' => 200,
		    		'product_data' => [

		    			'product' => $product,
		    			'category' => $category
		    		]

    	          ]);

    			}else{

		            return response()->json([
		    		'status' => 400,
		    		'message' => 'Kategória nem található'

    	            ]);

    			}

    			
    		 }else{

            return response()->json([
    		'status' => 404,
    		'message' => 'Kategória nem található'

    	    ]);

    		}

    }




}
