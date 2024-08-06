<?php

namespace App\Http\Controllers;

use App\Imports\ill_emailImport;
use App\Models\illustrator_email;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class IllustratorEmailController extends Controller
{
    public function index()
    {
        $emails = illustrator_email::orderBy('created_at', 'desc')->paginate(20);
        $isTableNotEmpty = $emails->isNotEmpty();
        return view('emails.illustrator_email', ['emails' => $emails,'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new ill_emailImport, $file);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email_address' => 'required|email|unique:illustrator_emails',
        ]);
        illustrator_email::create($validatedData);
        Session::flash('success', 'تم إضافة البريد بنجاح.');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'email_address' => 'required|email|unique:illustrator_emails,email_address,' . $id,
        ]);

        $email = illustrator_email::find($id);

        if (!$email) {
            Session::flash('error', 'البريد الأكاديمي غير موجود.');
            return redirect()->back();
        }

        $email->update($validatedData);
        Session::flash('success', 'تم تعديل البريد الأكاديمي بنجاح.');
        return redirect()->back();
    }
    public function destroy(string $id)
    {
        $email = illustrator_email::find($id);

        if (!$email) {
            Session::flash('error', 'البريد الأكاديمي غير موجود.');
            return redirect()->back();
        }

        $email->delete();
        Session::flash('success', 'تم حذف البريد الأكاديمي بنجاح.');
        return redirect()->back();
    }

    public function deleteTable()
    {
       illustrator_email::deleteAllEmails();
       Session::flash('success', 'تم حذف جميع االايميلات بنجاح.');
        return redirect()->back();
    }
}
