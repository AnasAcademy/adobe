<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AppointmentsExport implements FromQuery, WithHeadings
{
    public function headings(): array
    {

        return [
            'الاسم رباعي باللغة العربية',
            'الاسم رباعي باللغة الانجليزية',
            'الرقم الأكاديمي',
            'البريد الإلكتروني المسجل في الأكاديمية',
            'رقم الجوال',
            'العنوان',
            'الدبلوم المسجل',
            'نوع الحجز',
            'الاختبار المحدد',
            'موعد الاختبار',
        ];
    }

    public function query()
    {
        return Appointment::query()->select('ar_name', 'en_name','academic_num','email','phone',  \DB::raw("CONCAT(country, ', ', city) as address"),'diploma','type','test_type','appointment_date')->orderBy('created_at', 'desc');
    }
}
