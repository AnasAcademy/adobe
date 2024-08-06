<?php

namespace App\Imports;

use App\Models\design_appointment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;

class design_appointmentImport implements ToModel
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

        $appointmentDate = $row[8];
        $user_count=$row[7];

        if (!empty($appointmentDate) && !empty($user_count)) {

            $existingAppointment = design_appointment::where('appointment_date', $appointmentDate)->first();

            if (!$existingAppointment) {
                Session::flash('success', 'تم اضافه الموعد بنجاح.');
                return new design_appointment([
                    'appointment_date' => $appointmentDate,
                    'user_count'=>$user_count
                ]);
            }
            Session::flash('error', 'الموعد موجود بالفعل.');
        }

    return null;
    }
}
