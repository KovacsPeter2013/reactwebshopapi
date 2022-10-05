<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model{

    use HasFactory;


    protected $table = 'products';

    protected $fillable = [


    	'category_id',
        'meta_title',
        'meta_keyword',
        'meta_descrip',
        'slug',
        'name',
        'description',          
        'brand',
        'selling_price',
        'original_price',
        'qty',
        'image',
        'featured',
        'popular',
        'status',

    ];



    protected $with = ['category'];
    
    // Relationship megadása a Category osztállyal
    public function category(){	

    	return $this->belongsTo(Category::class, 'category_id', 'id');
    }


}
