<?php

namespace App\Imports;

use App\Models\Premiere_appointment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;
class Premiere_appointmentImport implements ToModel
{
    private $skipFirstRow = true;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($this->skipFirstRow) {
            $this->skipFirstRow = false;
            return null;
        }

        $appointmentDate = $row[17];
        $user_count=$row[16];

        if (!empty($appointmentDate) && !empty($user_count)) {

            $existingAppointment = Premiere_appointment::where('appointment_date', $appointmentDate)->first();

            if (!$existingAppointment) {
                Session::flash('success', 'تم اضافه الموعد بنجاح.');
                return new Premiere_appointment([
                    'appointment_date' => $appointmentDate,
                    'user_count'=>$user_count
                ]);
            }
            Session::flash('error', 'الموعد موجود بالفعل.');
        }

    return null;
    }
}
