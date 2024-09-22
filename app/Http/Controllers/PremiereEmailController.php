<?php

namespace App\Http\Controllers;

use App\Imports\premiere_emailImport;
use App\Models\Premiere_email;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class PremiereEmailController extends Controller
{
    public function index()
    {
        $emails = Premiere_email::orderBy('created_at', 'desc')->paginate(20);
        $isTableNotEmpty = $emails->isNotEmpty();
        return view('emails.premiere_email', ['emails' => $emails,'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new premiere_emailImport, $file);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email_address' => 'required|email|unique:premiere_emails',
        ]);
        Premiere_email::create($validatedData);
        Session::flash('success', 'تم إضافة البريد بنجاح.');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'email_address' => 'required|email|unique:premiere_emails,email_address,' . $id,
        ]);

        $email = Premiere_email::find($id);

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
        $email = Premiere_email::find($id);

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
        Premiere_email::deleteAllEmails();
       Session::flash('success', 'تم حذف جميع االايميلات بنجاح.');
        return redirect()->back();
    }
}
