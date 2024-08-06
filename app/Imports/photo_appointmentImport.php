<?php

namespace App\Imports;

use App\Models\photoshop_appointment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;

class photo_appointmentImport implements ToModel
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

        $appointmentDate = $row[5];
        $user_count=$row[4];

        if (!empty($appointmentDate) && !empty($user_count)) {

            $existingAppointment = photoshop_appointment::where('appointment_date', $appointmentDate)->first();

            if (!$existingAppointment) {
                Session::flash('success', 'تم اضافه الموعد بنجاح.');
                return new photoshop_appointment([
                    'appointment_date' => $appointmentDate,
                    'user_count'=>$user_count
                ]);
            }
            Session::flash('error', 'الموعد موجود بالفعل.');
        }

    return null;
    }
}
