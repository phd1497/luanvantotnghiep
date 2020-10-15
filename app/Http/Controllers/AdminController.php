<?php

namespace App\Http\Controllers;

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
    	return view('admin.dashboard');
    }
}
