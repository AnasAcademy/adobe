<?php

namespace App\Imports;

use App\Models\Email;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportEmails implements ToModel
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
        return new Email([
            'email_address' => $emailAddress,
        ]);
    }

    return null;
    }
}
