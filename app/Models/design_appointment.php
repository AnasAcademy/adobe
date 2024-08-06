<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class design_appointment extends Model
{
    use HasFactory;
    protected $guarded=[];
    public static function deleteAllEmails()
    {
        // Use the `truncate` method to delete all records from the table
        self::truncate();
    }
}
