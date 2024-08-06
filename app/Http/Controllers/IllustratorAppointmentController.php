<?php

namespace App\Http\Controllers;

use App\Models\illustrator_appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Imports\ill_appointmentImport;
class IllustratorAppointmentController extends Controller
{
    public function index()
    {
        $appointments = illustrator_appointment::orderBy('created_at', 'desc')->paginate(20);
         $isTableNotEmpty = $appointments->isNotEmpty();

        return view('appointments.illustrator_appointment', ['appointments' => $appointments,'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new ill_appointmentImport, $file);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:illustrator_appointments',
            'user_count'=>'required|numeric'
        ]);
        illustrator_appointment::create($validatedData);
        Session::flash('success', 'تم إضافة الموعد بنجاح.');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:illustrator_appointments,appointment_date,' . $id,
            'user_count'=>'required|numeric'
        ]);

        $appointment = illustrator_appointment::find($id);

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
        $appointment = illustrator_appointment::find($id);

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
       illustrator_appointment::deleteAllEmails();
       Session::flash('success', 'تم حذف جيميع المواعيد بنجاح.');
        return redirect()->back();
    }
}
