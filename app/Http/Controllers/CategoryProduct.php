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

    	return view('admin.add_category_product');
    }

    public function all_category_product(){
    	
    	$all_category_product = DB::table('tbl_category_product')->get();// nó sẽ lấy dữ liệu của category product sẽ gán vào biến $
    	$manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);//nó sẽ gọi file all_category_product với dữ liệu $all.. gán vào'all_category_product'
    	return view('admin_layout')->with('admin.all_category_product', $manager_category_product);//trang admin_layout nó sẽ chứa all_cate... gán vào biến $manager (b13)

    	
    }

    public function save_category_product(Request $request){//request là lấy yêu cầu dữ liệu
    	$data = array();
    	$data['category_name']= $request->category_product_name; //lấy dữ liệu của category product name bên trag add_categoryproduct, còn dữ liệu ở data là của  DB 
    	$data['category_desc']= $request->category_product_desc;
    	$data['category_status']= $request->category_product_status;
    	
    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id){

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);//điều kiện là category id = category_product_id khi mà bằng mình sẽ update
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>0]);//điều kiện là category id = category_product_id khi mà bằng mình sẽ update
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();// lấy dữ liệu thuộc category_id
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }


    public function update_category_product(Request $request, $category_product_id){
        $data =array();
        $data['category_name']= $request->category_product_name;
        $data['category_desc']= $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message',' Cập nhật thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
            DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
            Session::put('message',' Xóa danh mục sản phẩm thành công');
            return Redirect::to('all-category-product');
    }
}
