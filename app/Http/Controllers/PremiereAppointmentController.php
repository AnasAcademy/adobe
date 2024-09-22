<?php

namespace App\Http\Controllers;

use App\Models\Premiere_appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Imports\Premiere_appointmentImport;
class PremiereAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Premiere_appointment::orderBy('created_at', 'desc')->paginate(20);
         $isTableNotEmpty = $appointments->isNotEmpty();

        return view('appointments.premiere_appointment', ['appointments' => $appointments,'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new Premiere_appointmentImport, $file);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:premiere_appointments',
            'user_count'=>'required|numeric'
        ]);
        Premiere_appointment::create($validatedData);
        Session::flash('success', 'تم إضافة الموعد بنجاح.');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:premiere_appointments,appointment_date,' . $id,
            'user_count'=>'required|numeric'
        ]);

        $appointment = Premiere_appointment::find($id);

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
        $appointment = Premiere_appointment::find($id);

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
        Premiere_appointment::deleteAllEmails();
       Session::flash('success', 'تم حذف جيميع المواعيد بنجاح.');
        return redirect()->back();
    }
}
