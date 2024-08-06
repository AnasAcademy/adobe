<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class duplicated_email extends Model
{
    use HasFactory;
    protected $guarded=[];
    public static function deleteAllEmails()
    {
        // Use the `truncate` method to delete all records from the table
        self::truncate();
    }
}
