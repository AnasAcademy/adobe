<?php

namespace App\Imports;

use App\Models\After_effect_appointment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;
class After_appointmentImport implements ToModel
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

        $appointmentDate = $row[14];
        $user_count=$row[13];

        if (!empty($appointmentDate) && !empty($user_count)) {

            $existingAppointment = After_effect_appointment::where('appointment_date', $appointmentDate)->first();

            if (!$existingAppointment) {
                Session::flash('success', 'تم اضافه الموعد بنجاح.');
                return new After_effect_appointment([
                    'appointment_date' => $appointmentDate,
                    'user_count'=>$user_count
                ]);
            }
            Session::flash('error', 'الموعد موجود بالفعل.');
        }

    return null;
    }
}
