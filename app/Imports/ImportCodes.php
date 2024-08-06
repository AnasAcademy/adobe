<?php

namespace App\Imports;

use App\Models\Code;
use App\Models\Email;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCodes implements ToModel
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
        $code_number=$row[1];
            if (!empty($code_number)) {
                return new Code([
                    'code_number' => $code_number,
                ]);
            }

            return null;
    }
}
