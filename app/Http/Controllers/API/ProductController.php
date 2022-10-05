<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller{



    public function store(Request $request){


    		$validator = Validator::make($request->all(), [


		    	'category_id'   => 'required|max:191',
		        'meta_title'    => 'required|max:191',
		        'meta_keyword'  => 'required|max:191',
		        'meta_descrip'  => 'required|max:191',
		        'slug'          => 'required|max:191',
		        'name'          => 'required|max:191',
		        'description'   => 'required|max:191',          
		        'brand'         => 'required|max:20 ',
		        'selling_price' => 'required|max:20',
		        'original_price'=> 'required|max:20',
		        'qty'           => 'required|max:4',
		        'image'         => 'required|image|mimes:jpg,png,jpeg|max:2048',
		     
    		]);


    		if ($validator->fails()) {
    			
    			return response()->json([

    				'status' => 422,
    				'errors' => $validator->messages(),

    			]);


    		}else{

	    		$product = new Product();

	    		$product->category_id    = $request->input('category_id');


	    		$product->slug           = $request->input('slug');
	    		$product->name           = $request->input('name');
	    		$product->description    = $request->input('description');


	    		$product->meta_title     = $request->input('meta_title');
	    		$product->meta_keyword   = $request->input('meta_keyword');
	    		$product->meta_descrip   = $request->input('meta_descrip');
	    	


	    		$product->brand          = $request->input('brand');
	    		$product->selling_price  = $request->input('selling_price');
	    		$product->original_price = $request->input('original_price');
	    		$product->qty            = $request->input('qty');


	    		if ($request->hasFile('image')) {
	    			
	    			$file = $request->file('image');
	    			$extension = $file->getClientOriginalExtension();

	    			$filename = time().'.'.$extension;
	    			$file->move('uploads/product/',$filename);
	    			$product->image = 'uploads/product/'.$filename;

	    		}



	    		$product->featured = $request->input('featured') ? '1' : '0';
	    		$product->popular = $request->input('popular') ? '1' : '0';
	    		$product->status = $request->input('status') ? '1' : '0';

	    		$product->save();

	             return response()->json([

    				'status' => 200,
    				'message' => 'Termék sikeresen hozzáadva!',

    			]);


    		}





    }
}