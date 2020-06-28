<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
  <div class="mdc-drawer__header">
    <a href="index.html" class="brand-logo">
      <span class="d-flex">
        <img src="{{ asset('images/logo-1.svg') }}" alt="logo" style="width:38px;">
        <span style="margin-left: 10px;color:#ffffef;"><h5 style="margin:0;padding:0;">Perangkat<br/><small>Mengajar</small></h5> </span>
      </span>
    </a>
  </div>
  <div class="mdc-drawer__content">
    <div class="user-info">
      <p class="name">
          {{Auth::user()->fullname}}
      </p>
      <p class="email">{{Auth::user()->email  }}</p>
    </div>
    <div class="mdc-list-group">
      <nav class="mdc-list mdc-drawer-menu">
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link" href="/home">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
            Dashboard
          </a>
        </div>
        @if(Auth::user())

          @if(Auth::user()->role != 'admin')
            <div class="mdc-list-item mdc-drawer-item">
              {{-- <a class="mdc-drawer-link" href="{{ route('dashadmin_users') }}"> --}}
              <a class="mdc-drawer-link" href="/nilai">
                <i class="mdi mdi-book mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                Buku Nilai
              </a>
            </div>
          
            <div class="mdc-list-item mdc-drawer-item">
                  <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sub-rapor">
                    <i class="mdi mdi-file-document mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                    Rapor
                    <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                  </a>
                  <div class="mdc-expansion-panel" id="sub-rapor">
                      <nav class="mdc-list mdc-drawer-submenu">
                          <div class="mdc-list-item mdc-drawer-item">
                              <a class="mdc-drawer-link" href="/rapor/entri-nilai">
                                  <i class="mdi mdi-file-document-edit mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                  Nilai Akademik
                              </a>
                          </div>
                          <div class="mdc-list-item mdc-drawer-item">
                              <a class="mdc-drawer-link" href="/rapor/entri-nilai-ekstra">
                                  <i class="mdi mdi-file-document-edit mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                  Nilai Ekskul
                              </a>
                          </div>
                          <div class="mdc-list-item mdc-drawer-item">
                              <a class="mdc-drawer-link" href="/rapor/siswa">
                                  <i class="mdi mdi-printer mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                  Cetak
                              </a>
                          </div>
                      </nav>
                  </div>
            </div>
          @endif
            <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sub-perangkat">
                  <i class="mdi mdi-database mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                  Perangkat
                  <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                </a>
                <div class="mdc-expansion-panel" id="sub-perangkat">
                    <nav class="mdc-list mdc-drawer-submenu">
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/pemetaan">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Pemetaan KD
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/kaldik">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Kaldik
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/prota">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Prota
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/promes">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Promes
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/silabus">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Silabus
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/rpp">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                RPP
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/jurnal">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Jurnal
                            </a>
                        </div>
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/evaluasi">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Evaluasi
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="sub-data-lain">
                  <i class="mdi mdi-database mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                  Data Lain
                  <i class="mdc-drawer-arrow material-icons">chevron_right</i>
                </a>
                <div class="mdc-expansion-panel" id="sub-data-lain">
                    <nav class="mdc-list mdc-drawer-submenu">
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/kompetensi">
                                <i class="mdi mdi-database-search mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Kompetensi
                            </a>
                        </div>

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="pages/ui-features/typography.html">
                                <i class="mdi mdi-file-pdf mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                Jurnal
                            </a>
                        </div>
                        @if(Session::get('wali') == 1)
                          <div class="mdc-list-item mdc-drawer-item">
                              <a class="mdc-drawer-link" href="/siswaku">
                                  <i class="mdi mdi-human-child mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                  Siswa
                              </a>
                          </div>
                        @endif
                        @if(Auth::user()->level == 'admin')
                          <div class="mdc-list-item mdc-drawer-item">
                              <a class="mdc-drawer-link" href="/pengguna">
                                  <i class="mdi mdi-account mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                                  Pengguna
                              </a>
                          </div>
                          <div class="mdc-list-item mdc-drawer-item">
                            {{-- <a class="mdc-drawer-link" href="{{ route('dashadmin_users') }}"> --}}
                            <a class="mdc-drawer-link" href="/siswa">
                              <i class="mdi mdi-human-child mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                              Siswa
                            </a>
                          </div>
                          <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/rombel">
                              <i class="mdi mdi-google-classroom mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                              Rombel
                            </a>
                          </div>
                          <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="/sekolah">
                              <i class="mdi mdi-bank mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                              Sekolah
                            </a>
                          </div>
                        @endif
                    </nav>
                </div>
            </div>

        @endif

    <div class="profile-actions">
      <a href="javascript:;">Settings</a>
      <span class="divider"></span>
      <a href="/logout">Logout</a>
    </div>
  </div>
</aside>
