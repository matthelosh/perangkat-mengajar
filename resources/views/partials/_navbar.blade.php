<header class="mdc-top-app-bar">
  <div class="mdc-top-app-bar__row">
    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
      <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
      <span class="mdc-top-app-bar__title">
        @if(Auth::user()->level == 'guru' || Auth::user()->level == 'admin' || Auth::user()->level == 'superadmin')
          {{Auth::user()->fullname}}
        @elseif (Auth::user()->level == 'siswa')
          {{ Auth::user()->nama_siswa}}
        @endif
        <br />
        <small>
          {{ (Session::get('wali') == 1) ? 'Wali Kelas '.Session::get('rombel')->nama_rombel : Auth::user()->role }}
        </small>
      </span>

    </div>
    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
      <div class="menu-button-container menu-profile d-none d-md-block">
        <button class="mdc-button mdc-menu-button">
          <span class="d-flex align-items-center">
            <span class="figure">
              <img src="{{ asset('images/faces/'.Auth::user()->nip.'.jpg') }}" alt="user" class="user">
            </span>
            {{-- <span class="user-name">{{ Auth::user()->fullname }}</span> --}}
          </span>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-account-edit-outline text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Edit profile</h6>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-settings-outline text-primary"></i>
              </div>
              <a href="/logout">
                <div class="item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="item-subject font-weight-normal">Logout</h6>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="divider d-none d-md-block"></div>
      <div class="menu-button-container d-none d-md-block">
        <button class="mdc-button mdc-menu-button">
          <i class="mdi mdi-settings"></i>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem" data-toggle="modal" data-target="#modal-setting-rapor">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-alert-circle-outline text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Settings</h6>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-progress-download text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Update</h6>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="menu-button-container">
        <button class="mdc-button mdc-menu-button">
          <i class="mdi mdi-bell"></i>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <h6 class="title"> <i class="mdi mdi-bell-outline mr-2 tx-16"></i> Notifications</h6>
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon">
                <i class="mdi mdi-email-outline"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">You received a new message</h6>
                <small class="text-muted"> 6 min ago </small>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon">
                <i class="mdi mdi-account-outline"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">New user registered</h6>
                <small class="text-muted"> 15 min ago </small>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon">
                <i class="mdi mdi-alert-circle-outline"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">System Alert</h6>
                <small class="text-muted"> 2 days ago </small>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon">
                <i class="mdi mdi-update"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">You have a new update</h6>
                <small class="text-muted"> 3 days ago </small>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="menu-button-container">
        <button class="mdc-button mdc-menu-button">
          <i class="mdi mdi-email"></i>
          <span class="count-indicator">
            <span class="count">3</span>
          </span>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <h6 class="title"><i class="mdi mdi-email-outline mr-2 tx-16"></i> Messages</h6>
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail">
                <img src="{{ asset('images/faces/face4.jpg') }}" alt="user">
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Mark send you a message</h6>
                <small class="text-muted"> 1 Minutes ago </small>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail">
                <img src="{{ asset('images/faces/face2.jpg') }}" alt="user">
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Cregh send you a message</h6>
                <small class="text-muted"> 15 Minutes ago </small>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail">
                <img src="{{ asset('images/faces/face3.jpg') }}" alt="user">
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Profile picture updated</h6>
                <small class="text-muted"> 18 Minutes ago </small>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="menu-button-container d-none d-md-block">
        <button class="mdc-button mdc-menu-button">
          <i class="mdi mdi-arrow-down-bold-box"></i>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-lock-outline text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Lock screen</h6>
              </div>
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-logout-variant text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <h6 class="item-subject font-weight-normal">Logout</h6>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="modal" id="modal-setting-rapor">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pengaturan Rapor</h4>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        @if(Auth::user()->level == 'admin')
          <form action="/rapor/setting" id="form-setting-rapor" method="POST">
            @csrf()
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="tapel">Tapel:</label>
                <select name="tapel" class="form-control" width="100%">
                  @php
                    $Y = date('Y');
                    $m = date('m');
                    for($i = ($Y-3) ; $i < ($Y + 5) ; $i++) {
                      if($m < 7) {
                        $selected = ($i == ($Y -1)) ? 'selected' : '';
                      } else {
                        $selected = ($i == $Y) ? 'selected' : '';
                      }
                    
                      echo '<option value="'.$i.'/'.($i+1).'" '.$selected.'>'.$i.'/'.($i+1).'</option>';
                    }
                  @endphp
                  {{-- <option value="0">Semester</option> --}}
                </select>
              </div>
              <div class="form-group col-sm-6">
                  <label for="semester">Semester</label>
                  <select name="semester" class="form-control" width="100%">
                    @php
                      $m = date('m');
                      if($m > 6 ) {
                        echo '<option value="1" selected>Ganjil</option>';
                        echo '<option value="2" >Genap</option>';
                      } else {
                        echo '<option value="1" >Ganjil</option>';
                        echo '<option value="2" selected >Genap</option>';
                      }
                    @endphp
                    {{-- <option value="0">Semester</option> --}}
                </select>
              </div>
              <div class="form-group col-sm-6">
                <label for="tanggal_rapor">Tanggal Rapor</label>
                <input type="date" class="form-control" name="tanggal_rapor">
              </div>
              <div class="form-group col-sm-6">
                <label for="submit" style="color:transparent">TOmbol Simpan Setting Rapor SUpaya</label>
                <button class="btn btn-primary" type="submit">
                  <i class="mdi mdi-save"></i>
                  Simpan
                </button>
              </div>
            </div>
            
          </form>
        @elseif(Auth::user()->level == 'guru')
          <form action="/rapor/ganti-semester" method="POST" id="form-ganti-semester">
            @csrf()
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="tapel">Tapel:</label>
                <select name="tapel" class="form-control" width="100%">
                  @php
                    $Y = date('Y');
                    $m = date('m');
                    for($i = ($Y-3) ; $i < ($Y + 5) ; $i++) {
                      if($m < 7) {
                        $selected = ($i == ($Y -1)) ? 'selected' : '';
                      } else {
                        $selected = ($i == $Y) ? 'selected' : '';
                      }
                    
                      echo '<option value="'.$i.'/'.($i+1).'" '.$selected.'>'.$i.'/'.($i+1).'</option>';
                    }
                  @endphp
                  {{-- <option value="0">Semester</option> --}}
                </select>
              </div>
              <div class="form-group col-sm-6">
                  <label for="semester">Semester</label>
                  <select name="semester" class="form-control" width="100%">
                    @php
                      $m = date('m');
                      if($m > 6 ) {
                        echo '<option value="1" selected>Ganjil</option>';
                        echo '<option value="2" >Genap</option>';
                      } else {
                        echo '<option value="1" >Ganjil</option>';
                        echo '<option value="2" selected >Genap</option>';
                      }
                    @endphp
                    {{-- <option value="0">Semester</option> --}}
                </select>
              </div>
              <div class="form-group col-sm-6">
                <button class="btn btn-primary" type="submit">
                  <i class="mdi mdi-save"></i>
                  Ubah Semester
                </button>
              </div>
            </div>
          </form>
        @endif

      </div>
    </div>
  </div>
</div>