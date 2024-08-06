<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

use App\Models\Appointment;
use App\Models\illustrator_appointment;
use App\Models\illustrator_email;
use App\Models\design_email;
use App\Models\design_appointment;
use App\Models\duplicated_appointment;
use App\Models\duplicated_email;
use App\Models\photoshop_email;
use App\Models\photoshop_appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppointmentsExport;
use App\Mail\appointmentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $illustrator_appointments = illustrator_appointment::get();
        $photoshop_appointments = photoshop_appointment::get();
        $design_appointments = design_appointment::get();
        $duplicated_appointments = duplicated_appointment::get();
        return view('appointments.allAppointment', ['illustrator_appointments' => $illustrator_appointments, 'photoshop_appointments' => $photoshop_appointments, 'design_appointments' => $design_appointments, 'duplicated_appointments' => $duplicated_appointments]);
    }




    public function index_dashboard()
    {
        $appointments = Appointment::orderBy('created_at', 'desc')->paginate(20);

        $isTableNotEmpty = $appointments->isNotEmpty();
        return view('dashboard.allAppointment', ['appointments' => $appointments, 'isTableNotEmpty' => $isTableNotEmpty]);
    }
    public function deleteAllAppointment()
    {

        Appointment::deleteAllEmails();
        Session::flash('success', 'تم حذف جميع االايميلات بنجاح.');
        return redirect()->back();
    }
    public function exportAppointmentsToExcel()
    {
        $appointments = Appointment::all(); // Replace YourModel with the actual model you're using

        return Excel::download(new AppointmentsExport($appointments), 'appointments.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createStripeIntent(Request $request, $amount)
    {
        $request_data = $request->all();
        $email = $request_data['email'];
        $name = $request_data['name'];
        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
            $customer = $stripe->customers->create([
                'name' => $name,
                'email' => $email,
            ]);
            $paymentIntent = $stripe->paymentIntents->create([
                'customer' => $customer->id,
                'amount' => $amount,
                'currency' => 'sar',
                'payment_method_types' => ['card'],
                'description' => "حجز موعد",
                'receipt_email' => $email,
            ]);
            return [
                'clientSecret' => $paymentIntent->client_secret
            ];

        } catch (\Exception $e) {
            // console . log($e);
            dd($e);
        }
    }

    public function setCookie(Request $request)
    {
        $formdatacookie = $request->input('formdatacookie');
        $minutes = 60 * 24 * 365;
        Cookie::queue('formdatacookie', $formdatacookie, $minutes);
        return response('Cookie set successfully');
    }

    public function confirm(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve($request->query('payment_intent'), []);

        if ($paymentIntent->status == 'succeeded') {
            $this->processPaymentConfirmation($request);
            return redirect()->back();
        }
    }

    public function processConfirmation(Request $request_form)
    {
        try {
            // $data = $request->cookie('formdatacookie');
            // $request_form = json_decode($data, true);
            $form_data = $request_form->all();
            if (isset($form_data)) {
                if (isset($form_data['test_type'])) {

                    if ($form_data['test_type'] == 'illustrator') {
                        $this->Illustrator($form_data);
                    } elseif ($form_data['test_type'] == 'photoshop') {
                        $this->Photoshop($form_data);
                    } elseif ($form_data['test_type'] == 'design') {
                        $this->Design($form_data);
                    } elseif ($form_data['test_type'] == 'photoshop_design') {
                        $this->Photoshop($form_data);
                        $this->Design($form_data);
                    } elseif ($form_data['test_type'] == 'photoshop_illustrator') {
                        $this->Photoshop($form_data);
                        $this->Illustrator($form_data);
                    }
                } else {
                    Session::flash('error', 'test_type is not set. يُرجى التواصل مع وحدة الاختبارات الاحترافية عبر support@anasacademy.uk');
                }
            } else {
                Session::flash('error', 'formdatacookie is not set.  يُرجى التواصل مع وحدة الاختبارات الاحترافية عبر support@anasacademy.uk');
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . ' يُرجى التواصل مع وحدة الاختبارات الاحترافية عبر support@anasacademy.uk');
        }
        return back();
    }
    public function validation(Request $request)
    {
        App::setLocale('ar');
        $validator = Validator::make($request->all(), [
            'ar_name' => 'required|string|regex:/^[\p{Arabic} ]+$/u|max:255|min:5',
            'en_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255|min:5',
            'academic_num' => 'required|max:255|min:5|regex:/^[a-zA-Z0-9]+$/',
            'action' => 'required|in:new,duplicated',
            'test_type' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->input('action') === 'new') {
                        if (is_null($value)) {
                            $fail(trans('appointment.The test type field is required when action is new.'));
                        } else {
                            $allowedValues = ['illustrator', 'photoshop', 'design', 'photoshop_design', 'photoshop_illustrator'];
                            if (!in_array($value, $allowedValues)) {
                                $fail(trans('appointment.The selected test type is invalid.'));
                            }
                        }
                    }
                },
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[a-zA-Z_][a-zA-Z0-9._%+-]*@anasacademy.uk$/',
                function ($attribute, $value, $fail) use ($request) {
                    $action = $request->action;
                    $email = Appointment::where('email', $value)->first();
                    if ($action == 'new' && $email) {
                        $fail(trans('appointment.The email already has an appointment.'));
                    }
                },
            ],
            'phone' => 'required|numeric',
            'country' => 'required|string|max:255|min:3|regex:/^(?=.*[\p{Arabic}\p{L}])[0-9\p{Arabic}\p{L}\s]+$/u',
            'city' => 'required|string|max:255|min:3|regex:/^(?=.*[\p{Arabic}\p{L}])[0-9\p{Arabic}\p{L}\s]+$/u',
            'diploma' => 'required|string|max:255|min:3|regex:/^(?=.*[\p{Arabic}\p{L}])[0-9\p{Arabic}\p{L}\s]+$/u',
            'photoshop_appointment_date' => [
                function ($attribute, $value, $fail) use ($request) {
                    $test_type = $request->test_type;
                    $action = $request->action;
                    $appointment = photoshop_appointment::where('appointment_date', $value)->first();
                    if ($action == 'new' && ($test_type == 'photoshop' || $test_type == 'photoshop_design' || $test_type == 'photoshop_illustrator') && !$appointment) {
                        $fail(trans('appointment.The selected photoshop appointment date is invalid.'));
                    } elseif ($action == 'new' && ($test_type == 'photoshop' || $test_type == 'photoshop_design' || $test_type == 'photoshop_illustrator') && $appointment && $appointment->user_count == 0) {
                        $fail(trans('appointment.The selected Photoshop appointment date is fully booked.'));
                    }
                },
            ],
            'illustrator_appointment_date' => [
                function ($attribute, $value, $fail) use ($request) {
                    $test_type = $request->test_type;
                    $action = $request->action;
                    $appointment = illustrator_appointment::where('appointment_date', $value)->first();
                    if ($action == 'new' && ($test_type == 'illustrator' || $test_type == 'photoshop_illustrator') && !$appointment) {
                        $fail(trans('appointment.The selected Illustrator appointment date is invalid.'));
                    } elseif ($action == 'new' && ($test_type == 'illustrator' || $test_type == 'photoshop_illustrator') && $appointment && $appointment->user_count == 0) {
                        $fail(trans('appointment.The selected Illustrator appointment date is fully booked.'));
                    }
                },
            ],
            'design_appointment_date' => [
                function ($attribute, $value, $fail) use ($request) {
                    $test_type = $request->test_type;
                    $action = $request->action;
                    $appointment = design_appointment::where('appointment_date', $value)->first();
                    if ($action == 'new' && ($test_type == 'design' || $test_type == 'photoshop_design') && !$appointment) {
                        $fail(trans('appointment.The selected design appointment date is invalid.'));
                    } elseif ($action == 'new' && ($test_type == 'design' || $test_type == 'photoshop_design') && $appointment && $appointment->user_count == 0) {
                        $fail(trans('appointment.The selected Design appointment date is fully booked.'));
                    }
                },
            ],
            'duplicated_appointment_date' => [
                'required_if:action,duplicated',
                function ($attribute, $value, $fail) use ($request) {
                    $action = $request->action;
                    $appointment = duplicated_appointment::where('appointment_date', $value)->first();
                    if ($action == 'duplicated' && !$appointment) {
                        $fail(trans('appointment.The selected duplicated appointment date is invalid.'));
                    } elseif ($action == 'duplicated' && $appointment && $appointment->user_count == 0) {
                        $fail(trans('appointment.The selected Design appointment date is fully booked.'));
                    }
                },
            ],
            // 'Endorsement1' => 'accepted',
            'Endorsement2' => 'accepted',
            'Endorsement3' => 'accepted',
            'Endorsement4' => 'accepted',
            'Endorsement5' => 'accepted',
        ], 
      );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return response()->json(['message' => 'Form submitted successfully']);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $appointment = duplicated_appointment::where('appointment_date', $request->duplicated_appointment_date)->first();
        $email = duplicated_email::where('email_address', $request['email'])->first();
        // dd([$appointment, $email, $request['test_type']]);
        if ($appointment && $email && ($email->appointment_count == 0) && ($appointment->user_count > 0)) {
            Appointment::create([
                'ar_name' => $request['ar_name'],
                'en_name' => $request['en_name'],
                'academic_num' => $request['academic_num'],
                'phone' => $request['phone'],
                'country' => $request['country'],
                'city' => $request['city'],
                'diploma' => $request['diploma'],
                'type' => $request['action'],
                'test_type' => 'duplicated',
                'email' => $request['email'],
                'appointment_date' => $request['duplicated_appointment_date'],
            ]);
            $email->update([
                'appointment_count' => $email->appointment_count + 1,
                'appointment_date' => $request['duplicated_appointment_date']
            ]);
            $appointment->update([
                'user_count' => $appointment->user_count - 1,
            ]);
            $appointment = $request['duplicated_appointment_date'];
            // $appointment = substr($appointment, 0, -9);

            Mail::to($request['email'])->send(new appointmentMail($appointment, $request['action']));
            Session::flash('ill_confirmation_message', 'تم تأكيد موعدك المكرر للاختبار بنجاح في تاريخ ' . $request['duplicated_appointment_date'] . '، يُرجى تصوير الشاشة للحفاظ على تأكيد الموعد.');

        } else if (!$email) {
            Session::flash('error', ' يُرجى التأكد من البريد المدخل أنه صحيح، في حالة تأكدك من ذلك وظهور نفس المشكلة يُرجى التواصل مع وحدة الاختبارات الاحترافية عبر PTU@anasacademy.uk');
        } elseif ($email->appointment_count == 1) {

            Session::flash('error', 'لديك موعد سابق لا يمكن إتمام الحجز الرجاء الالتزام بالموعد الذي اخترته');
        }

        return redirect()->back();
    }
    private function Illustrator($request)
    {
        $appointment = illustrator_appointment::where('appointment_date', $request['illustrator_appointment_date'])->first();

        Appointment::create([
            'ar_name' => $request['ar_name'],
            'en_name' => $request['en_name'],
            'academic_num' => $request['academic_num'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'city' => $request['city'],
            'diploma' => $request['diploma'],
            'type' => $request['action'],
            'test_type' => 'illustrator',
            'email' => $request['email'],
            'appointment_date' => $request['illustrator_appointment_date'],
        ]);
        $appointment->update([
            'user_count' => $appointment->user_count - 1,
        ]);
        $appointment = $request['illustrator_appointment_date'];
        // $appointment = substr($appointment, 0, -9);
        Mail::to($request['email'])->send(new appointmentMail($appointment, $request['test_type']));
        Session::flash('ill_confirmation_message', 'تم تأكيد موعدك لاختبار الاليستريتور بنجاح في تاريخ ' . $request['illustrator_appointment_date'] . '، يُرجى تصوير الشاشة للحفاظ على تأكيد الموعد.');
        // }
        // else if(!$email)
        // {
        //     Session::flash('error',' يُرجى التأكد من البريد المدخل أنه صحيح، في حالة تأكدك من ذلك وظهور نفس المشكلة يُرجى التواصل مع وحدة الاختبارات الاحترافية عبر PTU@anasacademy.uk');
        // }
        // elseif ($email->appointment_count == 1 ) {

        //     Session::flash('error','لديك موعد سابق لا يمكن إتمام الحجز الرجاء الالتزام بالموعد الذي اخترته');
        // }
        // elseif ($appointment->user_count == 0 ) {
        //     Session::flash('error','لقد تم الوصول للحد الاقصي المسموح به ف هذا الموعد يرجي اختيار موعد اخر');

        // }

    }
    private function Photoshop($request)
    {
        // $email = photoshop_email::where('email_address', $request['email'])->first();
        $appointment = photoshop_appointment::where('appointment_date', $request['photoshop_appointment_date'])->first();
        // if ($email && ($email->appointment_count == 0) && ($appointment->user_count > 0 ) ) {
        Appointment::create([
            'ar_name' => $request['ar_name'],
            'en_name' => $request['en_name'],
            'academic_num' => $request['academic_num'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'city' => $request['city'],
            'diploma' => $request['diploma'],
            'type' => $request['action'],
            'test_type' => 'photoshop',
            'email' => $request['email'],
            'appointment_date' => $request['photoshop_appointment_date'],
        ]);
        // $email->update([
        //     'appointment_count' => $email->appointment_count + 1,
        //     'appointment_date' => $request['photoshop_appointment_date']
        // ]);
        $appointment->update([
            'user_count' => $appointment->user_count - 1,
        ]);
        $appointment = $request['photoshop_appointment_date'];
        // $appointment = substr($appointment, 0, -9);
        Mail::to($request['email'])->send(new appointmentMail($appointment, $request['test_type']));
        Session::flash('photo_confirmation_message', 'تم تأكيد موعدك لاختبار الفوتوشوب بنجاح في تاريخ ' . $request['photoshop_appointment_date'] . '، يُرجى تصوير الشاشة للحفاظ على تأكيد الموعد.');

        // }
        // else if(!$email)
        // {
        //     Session::flash('error',' يُرجى التأكد من البريد المدخل أنه صحيح، في حالة تأكدك من ذلك وظهور نفس المشكلة يُرجى التواصل مع وحدة الاختبارات الاحترافية عبر PTU@anasacademy.uk');

        // }
        // elseif ($email->appointment_count == 1 ) {
        //     Session::flash('error','لديك موعد سابق لا يمكن إتمام الحجز الرجاء الالتزام بالموعد الذي اخترته');

        // }
        // elseif ($appointment->user_count == 0 ) {
        //     Session::flash('error','لقد تم الوصول للحد الاقصي المسموح به ف هذا الموعد يرجي اختيار موعد اخر');

        // }
    }
    private function Design($request)
    {
        // $email = design_email::where('email_address', $request['email'])->first();
        $appointment = design_appointment::where('appointment_date', $request['design_appointment_date'])->first();
        // if ($email && ($email->appointment_count == 0) && ($appointment->user_count > 0 ) ) {
        Appointment::create([
            'ar_name' => $request['ar_name'],
            'en_name' => $request['en_name'],
            'academic_num' => $request['academic_num'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'city' => $request['city'],
            'diploma' => $request['diploma'],
            'type' => $request['action'],
            'test_type' => 'design',
            'email' => $request['email'],
            'appointment_date' => $request['design_appointment_date'],
        ]);
        // $email->update([
        //     'appointment_count' => $email->appointment_count + 1,
        //     'appointment_date' => $request['design_appointment_date']
        // ]);
        $appointment->update([
            'user_count' => $appointment->user_count - 1,
        ]);
        $appointment = $request['design_appointment_date'];
        // $appointment = substr($appointment, 0, -9);
        Mail::to($request['email'])->send(new appointmentMail($appointment, $request['test_type']));
        Session::flash('design_confirmation_message', 'تم تأكيد موعدك لاختبار الديزاين بنجاح في تاريخ ' . $request['design_appointment_date'] . '، يُرجى تصوير الشاشة للحفاظ على تأكيد الموعد.');

        // }
        // else if(!$email)
        // {
        //     Session::flash('error',' يُرجى التأكد من البريد المدخل أنه صحيح، في حالة تأكدك من ذلك وظهور نفس المشكلة يُرجى التواصل مع وحدة الاختبارات الاحترافية عبر PTU@anasacademy.uk');

        // }
        // elseif ($email->appointment_count == 1 ) {
        //     Session::flash('error','لديك موعد سابق لا يمكن إتمام الحجز الرجاء الالتزام بالموعد الذي اخترته');

        // }
        // elseif ($appointment->user_count == 0 ) {
        //     Session::flash('error','لقد تم الوصول للحد الاقصي المسموح به ف هذا الموعد يرجي اختيار موعد اخر');

        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            Session::flash('error', 'الموعد غير موجود.');
            return redirect()->back();
        }

        $appointment->delete();
        Session::flash('success', 'تم حذف الموعد بنجاح.');
        return redirect()->back();
    }
}
