<?php

namespace App\Http\Controllers;

use App\Imports\ImportCodes;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Code;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $codes = Code::paginate(5);

        return view('GMatrixCode.codes', ['codes' => $codes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new ImportCodes, $file);
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code_number' => 'required|unique:codes',
        ]);
        Code::create($validatedData);
        Session::flash('success', 'تم اضافة الكود بنجاح.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'code_number' => 'required|unique:codes,code_number,' . $id,
        ]);

        $code = Code::find($id);

        if (!$code) {
            Session::flash('error', 'الكود غير موجود.');
            return redirect()->back();
        }

        $code->update($validatedData);
        Session::flash('success', 'تم تعديل الكود بنجاح.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $code = Code::find($id);

        if (!$code) {
            Session::flash('error', 'الكود غير متاح.');
            return redirect()->back();
        }

        $code->delete();
        Session::flash('success', 'تم حذف الكود بنجاح.');
        return redirect()->back();
    }
}
