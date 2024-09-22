<div id="aside" class="app-aside modal nav-dropdown">
    <!-- fluid app aside -->
  <div class="left navside dark dk" data-layout="column">
<div class="navbar no-radius">
    <!-- brand -->
    <a class="navbar-brand">
        <img src="../assets/images/logo.png" alt=".">
        <span class="hidden-folded inline">أكاديمة أنس للفنون</span>
    </a>
    <!-- / brand -->
  </div>
<div class="" data-flex>
    <nav class="scroll nav-light">
        <ul class="nav" ui-nav>
          <li>
            <a href="/adminPanel" >

              <span class="nav-text">حجز موعد اختبار Adobe</span>
            </a>
          </li>

          <li>
            <a>
              <span class="nav-caret">
                <i class="fa fa-caret-down"></i>
              </span>
              <span class="nav-icon">
                <i class="material-icons">&#xe8f0;
                  <span ui-include="'../assets/images/i_2.svg'"></span>
                </i>
              </span>
              <span class="nav-text">البريد الأكاديمي</span>
            </a>
            <ul class="nav-sub">
              <li>
                <a href="illustrator_email" >
                  <span class="nav-text">البريد الالكتروني Illustrator</span>
                </a>
              </li>
              <li>
                <a href="photoshop_email" >
                  <span class="nav-text">البريد الإلكتروني Photoshop</span>
                </a>
              </li>
               <li>
                <a href="design_email" >
                  <span class="nav-text">البريد الإلكتروني <br>Design</span>
                </a>
              </li>
               <li>
                <a href="duplicated_email" >
                  <span class="nav-text">البريد الإلكتروني <br>Duplicated</span>
                </a>
              </li>
              <li>
                <a href="after_effect_email" >
                  <span class="nav-text">البريد الإلكتروني <br>After Effect</span>
                </a>
              </li>

              <li>
                <a href="premiere_email" >
                  <span class="nav-text">البريد الإلكتروني <br>Premiere</span>
                </a>
              </li>
            </ul>
          </li>

          <li>
            <a>
              <span class="nav-caret">
                <i class="fa fa-caret-down"></i>
              </span>
              <span class="nav-icon">
                <i class="material-icons">&#xe8f0;
                  <span ui-include="'../assets/images/i_2.svg'"></span>
                </i>
              </span>
              <span class="nav-text">المواعيد</span>
            </a>
            <ul class="nav-sub">
              <li>
                <a href="illustrator_appointment" >
                  <span class="nav-text">موعد Illustrator</span>
                </a>
              </li>
              <li>
                <a href="photoshop_appointment" >
                  <span class="nav-text">موعد Photoshop</span>
                </a>
              </li>
               <li>
                <a href="design_appointment" >
                  <span class="nav-text">موعد Design</span>
                </a>
              </li>
              <li>
                <a href="duplicated_appointment" >
                  <span class="nav-text">موعد Duplicated</span>
                </a>
              </li>

              <li>
                <a href="after_effect_appointment" >
                  <span class="nav-text">موعد After Effect</span>
                </a>
              </li>

              <li>
                <a href="premiere_appointment" >
                  <span class="nav-text">موعد Premiere</span>
                </a>
              </li>
            </ul>
          </li>

          <li>
            <a href="/allAppointment" >
            <span class="nav-icon">
                <i class="material-icons">&#xe8f0;
                  <span ui-include="'../assets/images/i_2.svg'"></span>
                </i>
            </span>
              <span class="nav-text"> المواعيد التي تم حجزها</span>
            </a>
          </li>
        </ul>
    </nav>
</div>
<div class="b-t">
    <div class="nav-fold">
        <a>
            <span class="pull-left">
              {{-- <img src="../assets/images/a0.jpg" alt="..." class="w-40 img-circle"> --}}

            </span>
            <span class="clear hidden-folded p-x">
              @if (auth()->check())
              <span class="block _500 text-success">Welcome, {{ auth()->user()->name }}</span>
              @endif
            </span>
            <br>
            <form action="logout" method="POST">
                @csrf
                <input type="submit" class="pull-left btn btn-outline-danger btn-sm" value="logout">
                {{-- <input:butt href="logout"class="pull-left text-danger">logout</input:butt> --}}
            </form>

        </a>
    </div>
  </div>

</div>
</div>
