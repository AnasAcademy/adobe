<?php
return [
    'accepted' => 'يجب قبول :attribute.',
    'active_url' => 'حقل :attribute لا يحتوي على رابط صحيح.',
    'after' => 'يجب أن يكون تاريخ :attribute بعد تاريخ :date.',
    'after_or_equal' => 'يجب أن يكون تاريخ :attribute بعد أو يساوي تاريخ :date.',
    'alpha' => 'يجب أن يحتوي :attribute على حروف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على حروف وأرقام وشرطات وشرطات سفلية.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروف وأرقام فقط.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'before' => 'يجب أن يكون تاريخ :attribute قبل تاريخ :date.',
    'before_or_equal' => 'يجب أن يكون تاريخ :attribute قبل أو يساوي تاريخ :date.',
    'between' => [
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم ملف :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون طول نص :attribute بين :min و :max حرف.',
        'array' => 'يجب أن يكون عدد عناصر :attribute بين :min و :max.',
    ],
    'boolean' => 'يجب أن يكون حقل :attribute صحيح أو خاطئ.',
    'confirmed' => 'تأكيد :attribute غير متطابق.',
    'date' => 'حقل :attribute ليس تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون تاريخ :attribute مساويًا لتاريخ :date.',
    'date_format' => 'التنسيق :attribute لا يتطابق مع التنسيق :format.',
    'different' => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits' => 'يجب أن يتكون :attribute من :digits أرقام.',
    'digits_between' => 'يجب أن يكون طول :attribute بين :min و :max أرقام.',
    'dimensions' => 'الصورة :attribute يحتوي على أبعاد غير صالحة.',
    'distinct' => 'حقل :attribute يحتوي على قيمة مكررة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صالحًا.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'exists' => 'القيمة المحددة :attribute غير صالحة.',
    'file' => 'الملف :attribute يجب أن يكون ملفًا.',
    'filled' => 'حقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'file' => 'يجب أن يكون حجم ملف :attribute أكبر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول نص :attribute أكثر من :value حرف.',
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
    ],
    'gte' => [
        'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
        'file' => 'يجب أن يكون حجم ملف :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يكون طول نص :attribute أكثر من أو يساوي :value حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على :value عنصر أو أكثر.',
    ],
    'image' => 'يجب أن يكون :attribute صورة.',
    'in' => 'القيمة المحددة :attribute غير صالحة.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صالحًا.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صالحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صالحًا.',
    'json' => 'يجب أن يكون :attribute سلسلة JSON صالحة.',
    'lt' => [
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'file' => 'يجب أن يكون حجم ملف :attribute أقل من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول نص :attribute أقل من :value حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
    ],
    'lte' => [
        'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
        'file' => 'يجب أن يكون حجم ملف :attribute أقل من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يكون طول نص :attribute أقل من أو يساوي :value حرفًا.',
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عنصر.',
    ],
    'max' => [
        'numeric' => 'يجب أن لا يكون :attribute أكبر من :max.',
        'file' => 'يجب أن لا يكون حجم ملف :attribute أكبر من :max كيلوبايت.',
        'string' => 'يجب أن لا يكون طول نص :attribute أكبر من :max حرف.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عنصر.',
    ],
    'mimes' => 'يجب أن يكون :attribute ملف من النوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملف من النوع: :values.',
    'min' => [
        'numeric' => 'يجب أن يكون :attribute على الأقل :min.',
        'file' => 'يجب أن يكون حجم ملف :attribute على الأقل :min كيلوبايت.',
        'string' => 'يجب أن يكون طول نص :attribute على الأقل :min حرف.',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عنصرًا.',
    ],
    'not_in' => 'القيمة المحددة :attribute غير صالحة.',
    'not_regex' => 'صيغة :attribute غير صالحة.',
    'numeric' => 'يجب أن يكون :attribute عددًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب أن يكون حقل :attribute موجودًا.',
    'regex' => 'صيغة :attribute غير صالحة.',
    'required' => 'حقل :attribute مطلوب.',
    'required_if' => 'حقل :attribute مطلوب عندما يكون :other يساوي :value.',
    'required_unless' => 'حقل :attribute مطلوب ما لم يكن :other في :values.',
    'required_with' => 'حقل :attribute مطلوب عندما يكون :values موجودًا.',
    'required_with_all' => 'حقل :attribute مطلوب عندما تكون :values موجودةً.',
    'required_without' => 'حقل :attribute مطلوب عندما لا يكون :values موجودًا.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا يكون أي من :values موجودًا.',
    'same' => 'حقل :attribute و :other يجب أن يتطابقا.',
    'size' => [
        'numeric' => 'يجب أن يكون :attribute بحجم :size.',
        'file' => 'يجب أن يكون حجم ملف :attribute :size كيلوبايت.',
        'string' => 'يجب أن يكون طول نص :attribute :size حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على :size عنصرًا.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون :attribute نصًا.',
    'timezone' => 'يجب أن يكون :attribute منطقة صحيحة.',
    'unique' => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل تحميل :attribute.',
    'url' => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid' => 'يجب أن يكون :attribute UUID صالحًا.',
    'password_or_username' => 'البريد الالكتروني او كلمة المرور خاطئة',
 
    'captcha' => 'الكود غير صحيح...',
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'full_name' => [
            'regex' => ' :attribute يجب ان يكون باللغة العربية',
            ],
 
    ],
    'attributes' => [
        'ar_name' =>"الاسم بالغه العربيه",
        'en_name' =>"الاسم بالغه الانجليزيه",
        'academic_num'=>"الرقم الاكاديمي",
        'action' =>"نوع الحجز",
        'test_type'=>"الاختبار",
        'email' =>"البريد الالكتروني",
        'phone' => "رقم الجوال",
        'country' =>"الدوله",
        'city' =>"المدينه",
        'diploma' =>"دبلومه",
        'photoshop_appointment_date' =>"مواعيد اختبار الفوتوشوب",
        'illustrator_appointment_date' => "مواعيد اختبار الاليستريتور",
        'design_appointment_date' => "مواعيد اختبار ان ديزاين",
        'duplicated_appointment_date' => "مواعيد اعاده الاختبار",
        'Endorsement2' =>"اقرار الاول",
        'Endorsement3' =>"اقرار الثاني",
        'Endorsement4' =>"اقرار الثالث",
        'Endorsement5' =>"اقرار الرابع",
    ],
 
];