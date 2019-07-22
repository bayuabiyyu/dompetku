<?php

namespace App\Http\Controllers\User\Dompet;

use Auth;
use App\Expense;
use App\Expense_D;
use App\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
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
        return view('user.expense.index_expense', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // KODE JENIS 0 = EXPENSE/PENGELUARAN
        $data['kategori'] = Kategori::where('user_id', '=', Auth::user()->username)
                            ->where('kode_jenis', '=', '0')
                            ->orderBy('nama_kategori', 'ASC')
                            ->get();
        return view('user.expense.form_add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');
        $this->validate($request,[
            'tanggal' => ['required', Rule::unique('expense')->where(function($query) use ($request){
                $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');
                return $query->where('tanggal', "=", $tanggal)
                             ->where('user_id', "=", Auth::user()->username);
            })],
            'txtKategori' => 'required',
            'txtKeterangan' => 'required',
            'txtNominal' => 'required',
        ]);

        //JIKA BELUM ADA HEADER MAKA INSERT HEADER
        $expenseCheck = Expense::where('tanggal', '=', $tanggal)->first();
        if(!$expenseCheck){
            Expense::create([
                'tanggal' => $tanggal,
                'user_id' => Auth::user()->username,
            ]);
        }

        $model = Expense_D::create([
            'tanggal' => $tanggal,
            'kode_kategori' => $request->txtKategori,
            'keterangan' => $request->txtKeterangan,
            'nominal' => $request->txtNominal,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // MULTIPLE PARAMETER
    public function edits($id, $tanggal)
    {
        $data['expense'] = Expense_D::where('tanggal', "=", $tanggal)
                            ->where('id', '=', $id)
                            ->firstOrFail();
        $data['kategori'] = Kategori::where('user_id', '=', Auth::user()->username)
                            ->where('kode_jenis', '=', '0')
                            ->orderBy('nama_kategori', 'ASC')
                            ->get();
        return view('user.expense.form_edit', compact('data'));
    }


    // MULTIPLE PARAMETER
    public function updates($id, $tanggal, Request $request){

        $this->validate($request,[
            'txtKategori' => 'required',
            'txtKeterangan' => 'required',
            'txtNominal' => 'required',
        ]);

        $model = Expense_D::where('tanggal', "=", $tanggal)
                ->where('id', '=', $id)
                ->firstOrFail();

        $model->update([
            'kode_kategori' => $request->txtKategori,
            'keterangan' => $request->txtKeterangan,
            'nominal' => $request->txtNominal,
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


    // MULTIPLE PARAMETER
    public function destroys($id, $tanggal)
    {
        $model = Expense_D::where('tanggal', "=", $tanggal)
                ->where('id', '=', $id)
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

    public function dataTable(Request $request){
        $date = Carbon::parse($request->txtDate)->format('Y-m-d');
        $data = Expense::expenseDataTable($date);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return '<a id="btnEdit" href="'.route('expense.edits', [$data->id, $data->tanggal]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a id="btnDelete" href="'.route('expense.destroys', [$data->id, $data->tanggal]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->make(true);
    }

}
