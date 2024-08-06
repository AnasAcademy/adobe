<?php

namespace App\Http\Controllers;

use App\Models\photoshop_appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Imports\photo_appointmentImport;
class PhotoshopAppointmentController extends Controller
{
    public function index()
    {
        $appointments = photoshop_appointment::orderBy('created_at', 'desc')->paginate(20);
         $isTableNotEmpty = $appointments->isNotEmpty();

        return view('appointments.photoshop_appointment', ['appointments' => $appointments,'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('file');
        Excel::import(new photo_appointmentImport, $file);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:photoshop_appointments',
            'user_count'=>'required|numeric'
        ]);
        photoshop_appointment::create($validatedData);
        Session::flash('success', 'تم إضافة الموعد بنجاح.');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'appointment_date' => 'required|unique:photoshop_appointments,appointment_date,' . $id,
            'user_count'=>'required|numeric'
        ]);

        $appointment = photoshop_appointment::find($id);

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
        $appointment = photoshop_appointment::find($id);

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
       photoshop_appointment::deleteAllEmails();
       Session::flash('success', 'تم حذف جيميع المواعيد تبنجاح.');
        return redirect()->back();
    }
}
