<?php

namespace App\Imports;

use App\Models\duplicated_email;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Session;
class duplicated_emailImport implements ToModel
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

        $emailAddress = $row[9];

        if (!empty($emailAddress)) {

            $existingEmail = duplicated_email::where('email_address', $emailAddress)->first();

            if (!$existingEmail) {
                Session::flash('success', 'تم اضافه البريد الأكديمي بنجاح.');
                return new duplicated_email([
                    'email_address' => $emailAddress,
                ]);
            }
            Session::flash('error', 'البريد الأكاديمي موجود بالفعل.');
        }

    return null;
    }
}
