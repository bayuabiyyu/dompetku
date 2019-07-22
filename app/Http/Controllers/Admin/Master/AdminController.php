<?php

namespace App\Http\Controllers\admin\master;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DataTables;


class AdminController extends Controller
{
    private $model;

    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role != 'root'){
            return redirect()->route('admin.home');
        }
        return view('admin.master.admin.index_admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.admin.form_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'password' => 'required',
            'email' => 'required|email|unique:admins'
        ]);

        $model = Admin::create([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);

        if($model){
            $msg = [
                'msg' => 'Data has been Saved',
                'status' => true,
            ];
        }else{
            $msg = [
                'msg' => 'Error Saved',
                'status' => false,
            ];
        }

        return response()->json($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['admin'] = Admin::findOrFail($id);
        return view('admin.master.admin.form_show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['admin'] = Admin::findOrFail($id);
        return view('admin.master.admin.form_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required',
        ]);

        $model = Admin::findOrFail($id);
        $model->update([
            'name' => $request->nama,
        ]);

        if($model){
            $msg = [
                'msg' => 'Data has been Update',
                'status' => true,
            ];
        }else{
            $msg = [
                'msg' => 'Error Update',
                'status' => false,
            ];
        }

        return response()->json($msg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Admin::where('id', '=', $id);
        $model->delete();
        if($model){
            $msg = [
                'msg' => 'Data has been Deleted',
                'status' => true,
            ];
        }else{
            $msg = [
                'msg' => 'Error Deleted',
                'status' => false,
            ];
        }

        return response()->json($msg);
    }

    public function dataTable(){
        //GET DATA JUST ROLE ADMIN / NO SHOW ROLE ROOT
        $data = Admin::where('role', 'admin')->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($data){
                return '<a id="btnShow" href="'.route('admin.show', $data->id).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-search"></i> Show</a>
                        <a id="btnEdit" href="'.route('admin.edit', $data->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a id="btnDelete" href="'.route('admin.destroy', $data->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->make(true);
    }

}
