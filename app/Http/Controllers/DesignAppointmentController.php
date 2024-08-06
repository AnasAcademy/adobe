<?php

namespace App\Http\Controllers;

use App\Models\design_appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Imports\design_appointmentImport;

class DesignAppointmentController extends Controller
{
    public function index()
    {
        $appointments = design_appointment::orderBy('created_at', 'desc')->paginate(20);
         $isTableNotEmpty = $appointments->isNotEmpty();

        return view('appointments.design_appointment', ['appointments' => $appointments,'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new design_appointmentImport, $file);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:design_appointments',
            'user_count'=>'required|numeric'
        ]);
        design_appointment::create($validatedData);
        Session::flash('success', 'تم إضافة الموعد بنجاح.');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:design_appointments,appointment_date,' . $id,
            'user_count'=>'required|numeric'
        ]);

        $appointment = design_appointment::find($id);

        if (!$appointment) {
            Session::flash('error', 'الموعد غير موجود.');
            return redirect()->back();
        }

        $appointment->update($validatedData);
        Session::flash('success', 'تم تعديل الموعد بنجاح.');
        return redirect()->back();
    }
    public function destroy(string $id)
    {
        $appointment = design_appointment::find($id);

        if (!$appointment) {
            Session::flash('error', 'الموعد غير موجود.');
            return redirect()->back();
        }

        $appointment->delete();
        Session::flash('success', 'تم حذف الموعد بنجاح.');
        return redirect()->back();
    }
    public function deleteTable()
    {
       design_appointment::deleteAllEmails();
       Session::flash('success', 'تم حذف جيميع لمواعيد بنجاح.');
        return redirect()->back();
    }
}
