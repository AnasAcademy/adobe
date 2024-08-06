<!DOCTYPE html>
<html lang="ar" dir="RTL">
<head>
  <meta charset="utf-8" />
  <title>Anas Academy</title>
  <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="{{ asset('assets/images/logo.png') }}">

  <!-- style -->
  <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="app" id="app">
@include('layouts.sidebar')
<div id="content" class="app-content box-shadow-z0" role="main">
    <div ui-view class="app-body" id="view" style="margin-right: 200px">
        <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
            <i class="material-icons">&#xe5d2;</i>
        </a>
          <main class="col-md-12 ms-sm-12 col-lg-12 px-md-12 main-content">
            <div class="container">
            </div>
            <h1> <b>المواعيد التي تم حجزها</b></h1>
            <br><br>
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">الاسم رباعي باللغة العربية</th>
                    <th scope="col">الاسم رباعي باللغة الانجليزية</th>
                    <th scope="col">الرقم الأكاديمي </th>
                    <th scope="col">البريد الالكتروني المسجل في الأكاديمية </th>
                    <th scope="col"> رقم الجوال </th>
                    <th scope="col"> العنوان </th>
                    <th scope="col"> الدبلوم المسجل </th>
                    <th scope="col"> نوع الحجز </th>
                    <th scope="col"> الأختبارالمحدد</th>
                    <th scope="col">موعد الأختبار</th>
                    <th scope="col"> أنشئت في</th>
                    <th scope="col">الإجراءات</th>
                  </tr>
                </thead>
                <tbody>
                    @if(!empty($appointments))
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->ar_name }}</td>
                            <td>{{ $appointment->en_name }}</td>
                            <td>{{ $appointment->academic_num }}</td>
                            <td>{{ $appointment->email }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->country ? ($appointment->country .'، '.$appointment->city) : '' }}</td>
                            <td>{{ $appointment->diploma }}</td>
                            <td>{{ $appointment->type ? ($appointment->type=='new' ? 'حجز موعد جلسه اختبار' : 'حجز للاعادة'):'' }} </td>
                            <td>{{ $appointment->test_type }}</td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{$appointment->created_at}}</td>
                            <td>
                                <div style="display: inline-block;">
                                <form action="{{ route('delete-appointments', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" data-confirm="هل أنت متأكد من أنك تريد حذف هذا؟">حذف</button>
                                </form>
                                </div>
                            </td>
                          </tr>
                    @endforeach
                    @endif
                </tbody>
              </table>
              @if($isTableNotEmpty)
                @if (!isset($confirmation))
                    <button onclick="confirmDelete()" class="btn btn-danger">Delete Table</button><br>
                @endif

                @if (isset($confirmation))
                    <p>Are you sure you want to delete the table? This action cannot be undone.</p>
                    <form method="post" action="{{ route('deleteAllAppointment') }}">
                        @csrf
                        <button type="submit">Yes, I'm sure</button>
                    </form>
                @endif
                 <br>
              <a href="export-appointments" class="btn btn-success">Export Excel</a>
              @endif
              {{-- Pagination --}}
                 <div class="d-flex justify-content-center">
                {!! $appointments->links() !!}
                </div>
                <!--@if($isTableNotEmpty)-->

              <!--@endif-->

        </main>
    </div>
</div>

  </div>


  <script src="../libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="../libs/jquery/PACE/pace.min.js"></script>

  <script src="{{ asset('scripts/config.lazyload.js') }}"></script>
{{-- <script src="../../"></script> --}}
  <script src="{{ asset('scripts/palette.js') }}"></script>
  <script src="{{ asset('scripts/ui-load.js') }}"></script>
  <script src="{{ asset('scripts/ui-jp.js') }}"></script>
  <script src="{{ asset('scripts/ui-include.js') }}"></script>
  <script src="{{ asset('scripts/ui-device.js') }}"></script>
  <script src="{{ asset('scripts/ui-form.js') }}"></script>
  <script src="{{ asset('scripts/ui-nav.js') }}"></script>
  <script src="{{ asset('scripts/ui-screenfull.js') }}"></script>
  <script src="{{ asset('scripts/ui-scroll-to.js') }}"></script>
  <script src="{{ asset('scripts/ui-toggle-class.js') }}"></script>

  <script src="{{ asset('scripts/app.js') }}"></script>

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="{{ asset('scripts/ajax.js') }}"></script>
<!-- endbuild -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('[data-confirm]');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const confirmationMessage = this.getAttribute('data-confirm');
                if (!confirm(confirmationMessage)) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
    <script>
     function confirmDelete() {
        if (confirm("Are you sure you want to delete the table? This action cannot be undone.")) {
            window.location.href = "{{ route('deleteAllAppointment', ['confirmation' => true]) }}";
        }
    }
    </script>

</body>
</html>


