<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" sizes="196x196" href="{{ asset('assets/images/logo.png') }}">
    <title>نموذج متابعة اختبارات أدوبي</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            text-align: right;
        }

        body {
            background-color: #f6f7f8;
            width: 50%;
            margin: auto;
            font-family: "IBM Plex Sans Arabic" !important;
        }

        .container {
            background-color: #ffffff;
            margin-top: 50px;
            margin-bottom: 50px;
            border-radius: 20px;
            box-shadow: 0 0 5px 0px #0000004d;
        }

        .text-center h3 {
            text-align: center;
        }

        .section {
            padding: 40px 0 40px 0;
        }

        .my-button {
            text-align: center;
            color: white;
            margin: 0px;
        }

        label {
            margin-bottom: 5px;
        }

        .form-check-label {
            display: inline;
            margin: 5px;
            vertical-align: middle;
        }

        /* #sum_btn {
            text-align: center;
            margin: 0;
            width: 100%;
            background-color: #5E0A83;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 700;
            cursor: not-allowed;
            pointer-events: none;

        } */

        .my-button .btn {
            background-color: #F70387;
            text-align: center;
            padding: 10px 20px 15px;
            border-radius: 10px;
            font-weight: 700;
        }

        .my-button .btn:hover {
            opacity: 0.9;
            text-align: center;
            padding: 10px 20px 15px;
            border-radius: 10px;
            font-weight: 700;
            color: #fff;
        }

        .iti__selected-flag {
            direction: ltr !important;
        }

        .iti__country-list li {
            direction: ltr !important;

        }

        .styled-button {
            width: 100%;
            /* Set the width to the form width */
            background-color: #F70387;
            /* Set the background color to red */
            color: white;
            /* Set the text color to white */
            border: none;
            /* Remove the border */
            padding: 10px;
            /* Add some padding */
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }


        .styled-button:hover {
            opacity: 0.8;
            /* Reduce opacity on hover */
        }

        @media only screen and (max-width: 600px) {
            body {
                background-color: #fff;
                width: 100%;
                margin: auto;
                font-family: "IBM Plex Sans Arabic" !important;

            }

            .container {
                background-color: #ffffff;
                margin-top: 50px;
                margin-bottom: 50px;
                border-radius: 20px;
                box-shadow: none !important;
            }
        }
    </style>
</head>
<!----->
<!------->

<body>
    <div class="container">
        {{-- if form closed --}}
        @if (Session::has('close'))
            <div class="overflow-hidden">
                <p class="alert alert-danger my-3 mx-3">
                    {{ Session::get('close') }}
                </p>
            </div>
        @elseif (Session::has('ill_confirmation_message') ||
                Session::has('photo_confirmation_message') ||
                Session::has('design_confirmation_message'))
            @if (Session::has('ill_confirmation_message'))
                 <div class="overflow-hidden">
                    <p class="alert alert-success my-3 mx-3">
                        {{ Session::get('ill_confirmation_message') }}
                    </p>
                </div>
            @endif

            @if (Session::has('photo_confirmation_message'))
                 <div class="overflow-hidden">
                    <p class="alert alert-success my-3 mx-3">
                        {{ Session::get('photo_confirmation_message') }}
                    </p>
                </div>
            @endif

            @if (Session::has('design_confirmation_message'))
                 <div class="overflow-hidden">
                    <p class="alert alert-success my-3 mx-3">
                        {{ Session::get('design_confirmation_message') }}
                    </p>
                </div>
            @endif
        @elseif (Session::has('error'))
            <div class="overflow-hidden">
                <p class="alert alert-danger my-3 mx-3">
                    {{ Session::get('error') }}
                </p>
            </div>
        @else
            {{-- form opened --}}
            <div class="section">
                <div class="text-center">
                    <img src="https://anasacademy.uk/wp-content/uploads/2024/02/01-3-768x148-1.png"
                        style="
                    width: 80px;
                    height: auto;
                    margin: 20px;

                " />
                    <h3>نموذج المواعيد لاختبارات أدوبي </h3>
                </div>
                <form method="POST" action="{{ route('submit_form') }}" id="payment-form">
                    @csrf
                    <div class="form-group mb-3">
                        <label>الاسم رباعي باللغة العربية *</label>
                        <input class="form-control" name="ar_name" type="text">
                    </div>
                    @if ($errors->has('ar_name'))
                        <div class="alert alert-danger">
                            {{ $errors->first('ar_name') }}
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label>الاسم رباعي باللغة الانجليزية *</label>
                        <input id="english_name" class="form-control" name="en_name" type="text">
                    </div>
                    @if ($errors->has('en_name'))
                        <div class="alert alert-danger">
                            {{ $errors->first('en_name') }}
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label>الرقم الأكاديمي *</label>
                        <input class="form-control" name="academic_num" type="text">
                    </div>
                    @if ($errors->has('academic_num'))
                        <div class="alert alert-danger">
                            {{ $errors->first('academic_num') }}
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">البريد الالكتروني الأكاديمي *</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="email"
                            placeholder="اكتب البريد الإلكتروني الذي تسجل دخولك به على المنصة مثال XXXXXXXX@anasacademy.uk ">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label>رقم الجوال *</label><br>
                        <input type="tel" id="phone" class="form-control" name="phone">
                        <input type="hidden" id="countryCode" name="country_code">
                    </div>

                    @if ($errors->has('phone'))
                        <div class="alert alert-danger">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label>في اي دولة ؟ *</label>
                        <input class="form-control" name="country" type="text">
                    </div>
                    @if ($errors->has('country'))
                        <div class="alert alert-danger">
                            {{ $errors->first('country') }}
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label>في اي مدينة ؟ *</label>
                        <input class="form-control" name="city" type="text">
                    </div>
                    @if ($errors->has('city'))
                        <div class="alert alert-danger">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect2"> الدبلوم المسجل فيه *</label>
                        <div>
                            <input class="form-check-input" type="radio" name="diploma"
                                value="التصميم المرئي و واجهة المستخدم" id="flexRadioDefault10">
                            <label class="form-check-label mr-4" for="flexRadioDefault10">
                                التصميم المرئي و واجهة المستخدم
                            </label>
                        </div>
                        <div>
                            <input class="form-check-input" type="radio" name="diploma"
                                value="التصميم المرئي و التسويق رقمي" id="flexRadioDefault20">
                            <label class="form-check-label mr-4" for="flexRadioDefault20">
                                التصميم المرئى و التسويق رقمي
                            </label>
                        </div>
                        <div>
                            <input class="form-check-input" type="radio" name="diploma"
                                value="التصميم المرئي و الرسوم متحركة" id="flexRadioDefault30">
                            <label class="form-check-label mr-4" for="flexRadioDefault30">
                                التصميم المرئي و الرسوم متحركة
                            </label>
                        </div>
                        <div>
                            <input class="form-check-input" type="radio" name="diploma"
                                value="التصميم المرئي و التفكير التصميمي" id="flexRadioDefault30">
                            <label class="form-check-label mr-4" for="flexRadioDefault30">
                                التصميم المرئي و التفكير التصميمي 
                            </label>
                        </div>
                        
                        <div>
                            <input class="form-check-input" type="radio" name="diploma"
                                value="دبلوم عالي في الرسوم المتحركة ومؤثرات الصوت والفيديو" id="flexRadioDefault30">
                            <label class="form-check-label mr-4" for="flexRadioDefault30">
                               دبلوم عالي في الرسوم المتحركة ومؤثرات الصوت والفيديو 
                            </label>
                        </div>
                        
                        <div>
                            <input class="form-check-input" type="radio" name="diploma"
                                value="دبلوم عالي في التصميم المرئي للعلامة التجارية" id="flexRadioDefault30">
                            <label class="form-check-label mr-4" for="flexRadioDefault30">
                                دبلوم عالي في التصميم المرئي للعلامة التجارية
                              </label>
                        </div>
                    </div>

                    <div class="form-group mb-3" id="action">
                        <label for="example1">نوع الحجز</label>
                        <div>
                            <input class="form-check-input" type="radio" name="action" id="flexRadio11"
                                value="new">
                            <label class="form-check-label mr-4" for="flexRadio11">حجز موعد جلسة اختبار</label>
                        </div>
                        <div>
                            <input class="form-check-input" type="radio" name="action" id="flexRadio12"
                                value="duplicated">
                            <label class="form-check-label mr-4" for="flexRadio12">حجز موعد للإعادة</label>
                        </div>
                    </div>


                    <div class="form-group mb-3" id="DublicatedDates" style="display: none;">
                        <label for="example02">مواعيد اعاده الاختبار </label>
                        <select class="form-control" name="duplicated_appointment_date" id="example02">
                            @foreach ($duplicated_appointments as $item)
                                <option>
                                    {!! str_replace(' ', '&ensp;', $item->appointment_date) !!}
                                    @if ($item->user_count === 0)
                                        (العدد مكتمل)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="test" style="display: none;">
                        <div class="form-group mb-3" id="testType">
                            <label for="exampleFormControlSelect2">حدد الاختبار *</label>
                            <div>
                                <input class="form-check-input" type="radio" name="test_type"
                                    value="photoshop_illustrator" id="flexRadioDefault11">
                                <label class="form-check-label mr-4" for="flexRadioDefault11">
                                    فوتوشوب و اليستريتور
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="test_type"
                                    value="photoshop_design" id="flexRadioDefault12">
                                <label class="form-check-label mr-4" for="flexRadioDefault12">
                                    فوتوشوب وإن ديزاين
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="test_type" value="other"
                                    id="otherType">
                                <label class="form-check-label mr-4" for="flexRadioDefault13">
                                    أرغب في اختبار واحد فقط ولن أتقدم للاختبار الثاني
                                </label>
                            </div>
                            <div id="selectContainer" style="display: none;" class="mt-3 mb-3">
                                <select class="form-control" id="testSelect">
                                    <option value="" selected disabled hidden>حدد الاختبار</option>
                                    <option value="photoshop">فوتوشوب</option>
                                    <option value="illustrator">اليستريتور</option>
                                    <option value="design">ان ديزاين</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3" id="photoshopDates" style="display: none;">
                            <label for="exampleFormControlSelect2">مواعيد اختبار الفوتوشوب</label>
                            <select class="form-control" name="photoshop_appointment_date"
                                id="exampleFormControlSelect2">
                                @foreach ($photoshop_appointments as $item)
                                    <option>
                                        {!! str_replace(' ', '&ensp;', $item->appointment_date) !!}
                                        @if ($item->user_count === 0)
                                            (العدد مكتمل)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3" id="illustratorDates" style="display: none;">
                            <label for="exampleFormControlSelect23">مواعيد اختبار الاليستريتور</label>
                            <select class="form-control" name="illustrator_appointment_date"
                                id="exampleFormControlSelect23">
                                @foreach ($illustrator_appointments as $item)
                                    <option>
                                        {!! str_replace(' ', '&ensp;', $item->appointment_date) !!}
                                        @if ($item->user_count === 0)
                                            (العدد مكتمل)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3" id="designDates" style="display: none;">
                            <label for="exampleFormControlSelect24">مواعيد اختبار ان ديزاين</label>
                            <select class="form-control" name="design_appointment_date"
                                id="exampleFormControlSelect24" style="white-space: pre;">
                                @foreach ($design_appointments as $item)
                                    <option>
                                        {!! str_replace(' ', '&ensp;', $item->appointment_date) !!}
                                        @if ($item->user_count === 0)
                                            (العدد مكتمل)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if ($errors->has('photoshop_appointment_date'))
                            <div class="alert alert-danger">
                                {{ $errors->first('photoshop_appointment_date') }}
                            </div>
                        @endif
                        @if ($errors->has('illustrator_appointment_date'))
                            <div class="alert alert-danger">
                                {{ $errors->first('illustrator_appointment_date') }}
                            </div>
                        @endif
                        <div id="payment-message" style="display:none;" class="alert alert-info">

                        </div>
                        <div class="form-group mb-3" id="payment-element">

                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>إقرار *</label>
                        <div class="">
                            <input class="form-check-input " type="checkbox" name="Endorsement1" value="1"
                                id="defaultCheck1">
                            <label class="form-check-label mr-4" for="defaultCheck1">أقر بأني أعلم أنه لن يتم اعتماد
                                أي حجز أو
                                جدولته عند الحجز بغير البريد الأكاديمي الذي تم التسجيل به في نموذج 99</label>
                        </div>
                        @if ($errors->has('Endorsement1'))
                            <div class="alert alert-danger">
                                {{ $errors->first('Endorsement1') }}
                            </div>
                        @endif
                        <div class="">
                            <input class="form-check-input " type="checkbox" name="Endorsement2" value="1"
                                id="defaultCheck2">
                            <label class="form-check-label mr-4" for="defaultCheck1">
                                أقر بأن لدي حساب على Certiport للدخول للاختبار الذي حجزت موعده وأنني قد تأكدت أن البريد
                                المسجل في الموقع هو بريدي الشخصي وأنه مسجل بصورة صحيحة (في حال الرسوب يصل كود الإعادة
                                على
                                بريد المتدرب)</label>
                        </div>
                        @if ($errors->has('Endorsement2'))
                            <div class="alert alert-danger">
                                {{ $errors->first('Endorsement2') }}
                            </div>
                        @endif
                        <div class="">
                            <input class="form-check-input" type="checkbox" name="Endorsement3" value="1"
                                id="defaultCheck3">
                            <label class="form-check-label mr-4" for="defaultCheck1">
                                أقر بأني أعلم أنه سيتم اعتماد حجزي الأول وجدولته في كل الأحوال وعند عدم الحضور للحجز
                                الأول
                                أحسب غياب</label>
                        </div>
                        @if ($errors->has('Endorsement3'))
                            <div class="alert alert-danger">
                                {{ $errors->first('Endorsement3') }}
                            </div>
                        @endif
                        <div class="">
                            <input class="form-check-input" type="checkbox" name="Endorsement4" value="1"
                                id="defaultCheck4">
                            <label class="form-check-label mr-4" for="defaultCheck1">

                                أقر بأني أعلم أنه عند التأخر عن 30 دقيقة تلغى الجلسة بشكل تلقائي من النظام وأحسب غياب
                                ويلزمني إعادة حجز موعد جلسة اختبار بمبلغ 99 ريال
                            </label>
                        </div>
                        @if ($errors->has('Endorsement4'))
                            <div class="alert alert-danger">
                                {{ $errors->first('Endorsement4') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label>تعهد *</label>
                        <div>
                            <input class="form-check-input " type="checkbox" name="Endorsement5" value="1"
                                id="defaultCheck5">
                            <label class="form-check-label mr-4" for="defaultCheck1">أتعهد وأوافق بأن جميع البيانات
                                المدخلة صحيحة، وأكاديمية أنس غير مسؤولة عن عدم صحة البيانات

                            </label>
                        </div>
                    </div>
                    @if ($errors->has('Endorsement5'))
                        <div class="alert alert-danger">
                            {{ $errors->first('Endorsement5') }}
                        </div>
                    @endif
                    <div id="errorMessages"></div>
                    {{-- <div id="sum_btn" class="alert alert-primary styled-button2 mb-3" role="alert">
                        المجموع 0.00 ر.س
                    </div> --}}
                    <!--<button type="button" id="sum_btn" class="btn styled-button2 mb-3">المجموع 0.00 ر.س</button>-->
                    <div class="my-button">
                        <button type="submit" id="form_submit" class="btn styled-button">
                            <span id="button-text">حجز موعد</span>
                            <span id="spinner" style="display:none;">يعالج...</span>
                        </button>
                    </div>
                </form>
        @endif
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="action"]').change(function() {
                if ($(this).attr('id') == 'flexRadio12') {
                    $('#DublicatedDates').show();
                    $('#test').hide();

                } else {
                    $('#DublicatedDates').hide();
                    $("#test input[type='radio']").prop('checked', false);
                    $('input[name="test_type"]').each(function() {
                        showOptions($(this));
                    });
                    $('#test').show();
                }
            });
        });
    </script>
    <script>
        var photoshopDatesDiv = document.getElementById("photoshopDates");
        var illustratorDatesDiv = document.getElementById("illustratorDates");
        var designDatesDiv = document.getElementById("designDates");
        var otherType = document.getElementById("otherType");
        document.querySelectorAll('input[name="test_type"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.checked && (this.value === 'other' || this.value === 'photoshop' || this.value ===
                        'illustrator' || this.value === 'design')) {
                    document.getElementById('selectContainer').style.display = 'block';
                    illustratorDatesDiv.style.display = 'none';
                    designDatesDiv.style.display = 'none';
                } else {
                    document.getElementById('selectContainer').style.display = 'none';
                }
            });
        });


        document.getElementById('testSelect').addEventListener('change', function() {
            var selectedValue = this.value;
            if (selectedValue !== null && selectedValue == 'photoshop') {
                photoshopDatesDiv.style.display = 'block';
                illustratorDatesDiv.style.display = 'none';
                designDatesDiv.style.display = 'none';
            } else if (selectedValue !== null && selectedValue == 'illustrator') {
                illustratorDatesDiv.style.display = 'block';
                photoshopDatesDiv.style.display = 'none';
                designDatesDiv.style.display = 'none';
            } else if (selectedValue !== null && selectedValue == 'design') {
                designDatesDiv.style.display = 'block';
                photoshopDatesDiv.style.display = 'none';
                illustratorDatesDiv.style.display = 'none';
            }

            otherType.value = selectedValue;
        });
    </script>


    <script>
        var photoshopDatesDiv = document.getElementById("photoshopDates");
        var illustratorDatesDiv = document.getElementById("illustratorDates");
        var designDatesDiv = document.getElementById("designDates");

        document.querySelectorAll('input[name="test_type"]').forEach(function(radio) {

            radio.addEventListener('change', function() {
                showOptions(this)
            });
        });

        function showOptions(option) {
            if (option.value !== null && option.value === 'photoshop_illustrator') {
                photoshopDatesDiv.style.display = 'block';
                illustratorDatesDiv.style.display = 'block';
                designDatesDiv.style.display = 'none';
            } else if (option.value !== null && option.value === 'photoshop_design') {
                photoshopDatesDiv.style.display = 'block';
                illustratorDatesDiv.style.display = 'none';
                designDatesDiv.style.display = 'block';
            } else {
                photoshopDatesDiv.style.display = 'none';
                illustratorDatesDiv.style.display = 'none';
                designDatesDiv.style.display = 'none';
            }
        }

        var defaultCheckedRadio = document.querySelector('input[name="test_type"]:checked');
        if (defaultCheckedRadio) {
            if (defaultCheckedRadio.value === 'photoshop_illustrator') {
                photoshopDatesDiv.style.display = 'block';
                illustratorDatesDiv.style.display = 'block';
            } else if (defaultCheckedRadio.value === 'photoshop_design') {
                photoshopDatesDiv.style.display = 'block';
                designDatesDiv.style.display = 'block';
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var input = document.querySelector("#phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "sa",
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            input.addEventListener("input", function() {
                var countryCode = iti.getSelectedCountryData().dialCode;
                document.getElementById("countryCode").value = countryCode;
            });

            input.addEventListener("countrychange", function() {
                var countryCode = iti.getSelectedCountryData().dialCode;
                document.getElementById("countryCode").value = countryCode;
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            var confirmationMessage = $(".alert.alert-success");

            if (confirmationMessage.length) {
                setTimeout(function() {
                    confirmationMessage.fadeOut(1000, function() {
                        location.reload();
                    });
                }, 360000);
            }
        });
    </script>
    <!--///////////payment////////////-->
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let elements;

        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);
            resetErrors()
            //form data
            let data = await form_value();
            console.log(data);

            var action = document.querySelector('input[name="action"]:checked')?.value ?? "";
            if (data.status) {
                let form_data = JSON.parse(data.formDateJsonString);
                if (action == 'new') {
                    document.getElementById("payment-form").action = "/stripe/callback";
                     document.getElementById("payment-form").submit();
                //     $.ajax({
                //         url: '/stripe/callback',
                //         type: 'POST',
                //         data: {
                //             form_data: form_data,
                //         },
                //         success: function(response) {
                //             console.log('Cookie set successfully');
                //         },
                //         error: function(xhr, status, error) {
                //             console.error('Error setting cookie:', error);
                //         }
                //     });
                //     // location.reload();
                //     resetErrors();
                //   document.getElementById("payment-form").reset();

                } else if (action == 'duplicated') {
                    document.getElementById("payment-form").submit();
                }
            }
            setLoading(false);
        }

        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#form_submit").disabled = true;
                document.querySelector("#spinner").style.display = "inline";
                document.querySelector("#button-text").style.display = "none";
            } else {
                document.querySelector("#form_submit").disabled = false;
                document.querySelector("#spinner").style.display = "none";
                document.querySelector("#button-text").style.display = "inline";
            }
        }
        async function form_value() {
            var formDate = new FormData();
            var ar_name = document.getElementsByName('ar_name')[0];
            var en_name = document.getElementsByName('en_name')[0];
            var academic_num = document.getElementsByName('academic_num')[0];
            var email = document.getElementsByName('email')[0];
            var phone = document.getElementsByName('phone')[0];
            var country = document.getElementsByName('country')[0];
            var city = document.getElementsByName('city')[0];
            var diploma = document.querySelector('input[name="diploma"]:checked');
            var test_type = document.querySelector('input[name="test_type"]:checked');
            var action = document.querySelector('input[name="action"]:checked');
            var photoshop_appointment_date = document.getElementsByName('photoshop_appointment_date')[0];
            var illustrator_appointment_date = document.getElementsByName('illustrator_appointment_date')[0];
            var design_appointment_date = document.getElementsByName('design_appointment_date')[0];
            var duplicated_appointment_date = document.getElementsByName('duplicated_appointment_date')[0];
            var endorsement1 = document.getElementsByName('Endorsement1')[0];
            var endorsement2 = document.getElementsByName('Endorsement2')[0];
            var endorsement3 = document.getElementsByName('Endorsement3')[0];
            var endorsement4 = document.getElementsByName('Endorsement4')[0];
            var endorsement5 = document.getElementsByName('Endorsement5')[0];
            formDate.append("ar_name", ar_name.value.trim());
            formDate.append("en_name", en_name.value.trim());
            formDate.append("academic_num", academic_num.value.trim());
            formDate.append("email", email.value.trim());
            formDate.append("phone", phone.value.trim());
            formDate.append("country", country.value.trim());
            formDate.append("city", city.value.trim());
            formDate.append("diploma", diploma?.value ?? "");
            formDate.append("test_type", test_type?.value ?? "");
            formDate.append("action", action?.value ?? "");
            formDate.append("photoshop_appointment_date", photoshop_appointment_date.value);
            formDate.append("illustrator_appointment_date", illustrator_appointment_date.value);
            formDate.append("design_appointment_date", design_appointment_date.value);
            formDate.append("duplicated_appointment_date", duplicated_appointment_date.value);
            formDate.append("Endorsement1", endorsement1.checked ? 1 : 0);
            formDate.append("Endorsement2", endorsement2.checked ? 1 : 0);
            formDate.append("Endorsement3", endorsement3.checked ? 1 : 0);
            formDate.append("Endorsement4", endorsement4.checked ? 1 : 0);
            formDate.append("Endorsement5", endorsement5.checked ? 1 : 0);
            // formDate.append("_token", '{{ csrf_token() }}');
            console.log(formDate);
            try {

                let response = await fetch('{{ route('validation') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: formDate
                })

                let data = await response.json();
                console.log(data)
                if (data.errors) {
                    let errors = data.errors;
                    show_errors(errors)
                    return {
                        status: false
                    }
                } else {
                    var formDateJson = {};
                    formDate.forEach(function(value, key) {
                        formDateJson[key] = value;
                    });
                    var formDateJsonString = JSON.stringify(formDateJson);
                    // $.ajax({
                    //     url: '/set-cookie',
                    //     type: 'POST',
                    //     data: {
                    //         formdatacookie: formDateJsonString,
                    //         _token: '{{ csrf_token() }}'
                    //     },
                    //     success: function(response) {
                    //         console.log('Cookie set successfully');
                    //     },
                    //     error: function(xhr, status, error) {
                    //         console.error('Error setting cookie:', error);
                    //     }
                    // });

                    return {
                        status: true,
                        formDateJsonString,
                        form_data: formDate
                    }
                }

            } catch (error) {
                console.log(error)
                return {
                    status: false
                }
            }
            // return flag
        }

        function resetErrors() {
            var errorElements = document.querySelectorAll('.invalid-feedback');
            errorElements.forEach(function(errorElement) {
                errorElement.textContent = '';
            });

            var inputElements = document.querySelectorAll('.is-invalid');
            inputElements.forEach(function(inputElement) {
                inputElement.classList.remove('is-invalid');
            });
            
            var errorContainer = document.getElementById('errorMessages');
             errorContainer.innerHTML = "";
            
        }

        function show_errors(errors) {
            var errorContainer = document.getElementById('errorMessages');
            errorContainer.innerHTML = Object.values(errors).flat().map(message =>
                `<div style="color: red;">${message}</div>`).join('');
        }
        
        
        function showMessage(message){
            
        }
    </script>

</body>

</html>
