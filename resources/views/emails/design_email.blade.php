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
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('add_email_design') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail">إضافة بريد أكاديمي design جديد</label>
                                <input type="text" name="email_address" class="form-control" id="exampleInputEmail" placeholder="اكتب البريد الأكاديمي">
                            </div>
                            @if ($errors->has('email_address'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email_address') }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">إضافه</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="import_design_email" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">اختر ملف اكسيل:</label>
                                <input type="file" name="file" class="form-control" accept=".xlsx, .csv">
                            </div>
                            <button type="submit" class="btn btn-success">تنفيذ</button>
                        </form>
                    </div>
                </div>
            </div>
            <h1> <b>البريد الأكاديمي design</b></h1>
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">البريد الأكاديمي</th>
                    <th scope="col">الموعد</th>
                    <th scope="col">الأجراءات</th>
                  </tr>
                </thead>
                <tbody>
                    @if(!empty($emails))
                    @foreach ($emails as $email)
                        <tr>
                            <td>{{ $email->email_address }}</td>
                            <td>
                                @if($email->appointment_date)
                                {{ $email->appointment_date }}
                                @else
                                لم يتم حجز موعد بعد
                                @endif
                            </td>
                             <td>
                                <div style="display: inline-block; margin-right: 10px;">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$email->id}}">تعديل</button>
                                </div>
                                <div style="display: inline-block;">
                                <form action="{{ route('emails_design.destroy', $email->id) }}" method="POST" class="d-inline">
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
                    <button onclick="confirmDelete()" class="btn btn-danger">Delete Table</button>
                @endif
            
                @if (isset($confirmation))
                    <p>Are you sure you want to delete the table? This action cannot be undone.</p>
                    <form method="post" action="{{ route('deleteDesign_email') }}">
                        @csrf
                        <button type="submit">Yes, I'm sure</button>
                    </form>
                @endif
              @endif 
              {{-- Pagination --}}
                 <div class="d-flex justify-content-center">
                {!! $emails->links() !!}
                </div>
              {{-- editmodel --}}
              @foreach ($emails as $email)
                <div class="modal fade" id="editModal{{$email->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$email->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('emails_design.update', $email->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{$email->id}}">تعديل البريد الأكاديمي</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="email{{$email->id}}">البريد الأكاديمي</label>
                                        <input type="text" class="form-control" id="email{{$email->id}}" name="email_address" value="{{$email->email_address}}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </main>
    </div>
</div>

  </div>

<script src="your-script.js?v=1"></script>
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
                window.location.href = "{{ route('deleteDesign_email', ['confirmation' => true]) }}";
            }
        }
        </script>
</body>
</html>


