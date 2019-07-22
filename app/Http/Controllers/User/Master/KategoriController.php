<?php

namespace App\Http\Controllers\User\Master;

use Auth;
use App\Kategori;
use App\Jenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DataTables;
use Illuminate\Validation\Rule;


class KategoriController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.master.kategori.index_kategori');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['jenis'] = Jenis::query()->get();
        return view('user.master.kategori.form_add', compact('data'));
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
            'kode_kategori' => ['required', Rule::unique('kategori')->where(function($query) use ($request){
                return $query->where('kode_kategori', "=", $request->kode_kategori)
                             ->where('user_id', "=", Auth::user()->username);
            })],
            'nama_kategori' => 'required',
            'kode_jenis' => 'required',
        ]);

        $model = Kategori::create([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'kode_jenis' => $request->kode_jenis,
            'user_id' => Auth::user()->username,
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
        $data['kategori'] = Kategori::where('kode_kategori', "=", $id)
                            ->where('user_id', "=", Auth::user()->username)
                            ->firstOrFail();
        return view('user.master.kategori.form_show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['jenis'] = Jenis::query()->get();
        $data['kategori'] = Kategori::where('kode_kategori', "=", $id)
                            ->where('user_id', "=", Auth::user()->username)
                            ->firstOrFail();
        return view('user.master.kategori.form_edit', compact('data'));
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
            'nama_kategori' => 'required',
            'kode_jenis' => 'required',
        ]);

        $model = Kategori::where('kode_kategori', "=", $id)
                ->where('user_id', "=", Auth::user()->username)
                ->firstOrFail();
        $model->update([
            'nama_kategori' => $request->nama_kategori,
            'kode_jenis' => $request->kode_jenis,
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
        $model = Kategori::where('kode_kategori', "=", $id)
                ->where('user_id', "=", Auth::user()->username)
                ->firstOrFail();
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
        $data = Kategori::getKategoriDataTable();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($data){
                return '<a id="btnShow" href="'.route('kategori.show', $data->kode_kategori).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-search"></i> Show</a>
                        <a id="btnEdit" href="'.route('kategori.edit', $data->kode_kategori).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a id="btnDelete" href="'.route('kategori.destroy', $data->kode_kategori).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->make(true);
    }

}
