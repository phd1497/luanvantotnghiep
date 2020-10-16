<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{
    public function index(){

    	return view('admin_login');
    }
    public function show_dashboard(){
    	return view('admin.dashboard');
    }
    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password); //do mật khẩu mã hóa là md5

    	$result =DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password', $admin_password)->first();//mình sẽ lấy kết quả từ bảng tbl admin kiểm tra (where) điều kiện là cột admin_email = giá trị admin_email (password cũng như vậy) firt là lấy giới hạn là 1 user
    	if($result){
    		Session::put('admin_name',$result->admin_name);//nếu lấy thành công thì sẽ lấy biến admin name lấy từ kết quả (result)(đã lấy được trong csdl) admin name trong database
    		Session::put('admin_id',$result->admin_id);
    		return Redirect::to('/dashboard'); //sau khi lấy xong thì trả về trang dashboard
    	}else//nếu sai trả về trang admin login
    	{
    		Session::put('message','mat khau hoac tk sai');
    		return Redirect::to('/admin');
    	}
    }

     public function logout(){
    	Session::put('admin_name',null);
		Session::put('admin_id',null);
		return Redirect::to('/admin'); //quay lại page admin
    }
}
