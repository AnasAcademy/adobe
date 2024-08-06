<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class illustrator_appointment extends Model
{
    use HasFactory;
    protected $fillable = ['appointment_date','user_count'];
     public static function deleteAllEmails()
    {
        // Use the `truncate` method to delete all records from the table
        self::truncate();
    }
}
