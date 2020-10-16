<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
session_start();
class CategoryProduct extends Controller
{
    public function add_category_product(){
    	return view('admin.add_category_product');//vao admin lay add_category product

    }

    public function all_category_product(){
    	return view('admin.all_category_product');
    	
    }

    public function save_category_product(Request $request){//request la yeu cau
    	$data = array();
    	$data['category_name']= $request->category_product_name; //lấy dữ liệu của category product name bên trag add_categoryproduct, còn dữ liệu ở data là của  DB 
    	$data['category_desc']= $request->category_product_desc;
    	$data['category_status']= $request->category_product_status;
    	
    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    }
}
