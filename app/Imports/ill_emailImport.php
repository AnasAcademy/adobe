<?php

namespace App\Imports;

use App\Models\illustrator_email;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;
class ill_emailImport implements ToModel
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

        $emailAddress = $row[0];

        if (!empty($emailAddress)) {

            $existingEmail = illustrator_email::where('email_address', $emailAddress)->first();

            if (!$existingEmail) {
                Session::flash('success', 'تم اضافه البريد الأكديمي بنجاح.');
                return new illustrator_email([
                    'email_address' => $emailAddress,
                ]);
            }
            Session::flash('error', 'البريد الأكاديمي موجود بالفعل.');
        }

    return null;
    }
}
