<?php

namespace App\Http\Controllers;

use App\Imports\afterEffect_emailImport;
use App\Models\After_effect_email;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class AfterEffectEmailController extends Controller
{
    public function index()
    {
        $emails = After_effect_email::orderBy('created_at', 'desc')->paginate(20);
        $isTableNotEmpty = $emails->isNotEmpty();
        return view('emails.afterEffect_email', ['emails' => $emails,'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new afterEffect_emailImport, $file);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email_address' => 'required|email|unique:after_effect_emails',
        ]);
        After_effect_email::create($validatedData);
        Session::flash('success', 'تم إضافة البريد بنجاح.');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'email_address' => 'required|email|unique:after_effect_emails,email_address,' . $id,
        ]);

        $email = After_effect_email::find($id);

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
        $email = After_effect_email::find($id);

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
        After_effect_email::deleteAllEmails();
       Session::flash('success', 'تم حذف جميع االايميلات بنجاح.');
        return redirect()->back();
    }
}
