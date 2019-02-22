<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name','category','price','special_price','is_special_price','is_sale_flag','image_aspectratio_code'];
    public $timestamps = false;
}
