<?php

namespace App\Http\Controllers;

use App\Models\After_effect_appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Imports\After_appointmentImport;
class AfterEffectAppointmentController extends Controller
{
    public function index()
    {
        $appointments = After_effect_appointment::orderBy('created_at', 'desc')->paginate(20);
         $isTableNotEmpty = $appointments->isNotEmpty();

        return view('appointments.afterEffect_appointment', ['appointments' => $appointments,'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new After_appointmentImport, $file);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:after_effect_appointments',
            'user_count'=>'required|numeric'
        ]);
        After_effect_appointment::create($validatedData);
        Session::flash('success', 'تم إضافة الموعد بنجاح.');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:after_effect_appointments,appointment_date,' . $id,
            'user_count'=>'required|numeric'
        ]);

        $appointment = After_effect_appointment::find($id);

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
        $appointment = After_effect_appointment::find($id);

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
        After_effect_appointment::deleteAllEmails();
       Session::flash('success', 'تم حذف جيميع المواعيد بنجاح.');
        return redirect()->back();
    }
}
