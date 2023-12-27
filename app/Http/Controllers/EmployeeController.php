<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::all();
        return view('admin.employees.index',compact('employees'));
    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:employees',
                'phone' => 'required|regex:/^[0-9]+$/|min:10|max:10',
                'address' => 'required',
                'position' => 'required',
                'shift' => 'required',
                'hire_date' => 'required',
            ],[
                'name.required'=>"Tên không được bỏ trống!",
                'name.unique' => 'Tên này đã tồn tại!',
                'phone.required' => 'SĐT không được bỏ trống!',
                'phone.regex' => "SĐT phải là số và có 10 chữ số!",
                'phone.min' => "SĐT phải có 10 chữ số!",
                'phone.max' => "SĐT phải có 10 chữ số!",
                'address.required' => 'Địa chỉ không được bỏ trống!',
                'position.required' => "Chức danh không được bỏ trống!",
                'shift.required' => "Ca làm việc không được bỏ trống",
                'hire_date.required' => "Ngày tuyển dụng không được bỏ trống",
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $employee = Employee::create($request->except('_token'));
            if($employee->id) {
                $notification = array(
                    "message" => "Thêm nhân viên thành công!",
                    "alert-type" => "success",
                );
                return redirect()->route('employee.index')->with($notification);
            }
        }
        return view('admin.employees.create');
    }

    public function edit(Request $request, $id){
        $employee = Employee::find($id);
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'phone' => 'required|regex:/^[0-9]+$/|min:10|max:10',
                'address' => 'required',
                'position' => 'required',
                'shift' => 'required',
                'hire_date' => 'required',
            ],[
                'name.required'=>"Tên không được bỏ trống!",

                'phone.required' => 'SĐT không được bỏ trống!',
                'phone.regex' => "SĐT phải là số và có 10 chữ số!",
                'phone.min' => "SĐT phải có 10 chữ số!",
                'phone.max' => "SĐT phải có 10 chữ số!",
                'address.required' => 'Địa chỉ không được bỏ trống!',
                'position.required' => "Chức danh không được bỏ trống!",
                'shift.required' => "Ca làm việc không được bỏ trống",
                'hire_date.required' => "Ngày tuyển dụng không được bỏ trống",
            ]);
            $result = Employee::where('id',$id)->update($request->except('_token'));
            if($result){
                $notification = array(
                    "message" => "Cập nhập nhân viên thành công",
                    "alert-type" => "success",
                );
                return redirect()->route('employee.index')->with($notification);
            }
        }
        return view('admin.employees.edit',compact('employee'));
    }

    public function delete($id) {
        if($id){
        $employee = Employee::find($id);
        if($employee->delete()){
            $notification = array(
                "message"=> "Xóa nhân viên thành công",
                "alert-type" =>"success",
            );
            return redirect()->route('employee.index')->with($notification);
        }else{
            $notification = array(
                "message"=> "Xóa nhân viên thất bại",
                "alert-type" =>"success",
            );
            return redirect()->back()->with($notification);
        }
    }
return;
    }
}
