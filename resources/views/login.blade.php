<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Perangkat Mengajar</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/demo/style.css') }}">
        <style media="screen">
        .page-wrapper {
          background: #edf3ee!important;
        }
            #show-password:hover{
                cursor: pointer;
            }
          @media (max-width: 600px) {
            .mdc-card {
              box-shadow: none;
              background: transparent;
            }
            .page-wrapper {
              background: #fefefe!important;
            }
          }
        </style>
    </head>
    <body>
      <script src="{{ asset('js/preloader.js') }}"></script>
      <div id="app">
        <div class="body-wrapper">
        <div class="main-wrapper">
          <div class="page-wrapper full-page-wrapper d-flex align-items-center justify-content-center">
            <main class="auth-page">
              <div class="d-flex justify-content-center" style="margin-bottom: 20px;">
                <img src="{{ asset('images/logo-1.svg')}}" alt="" width="256px">
              </div>
              <div class="d-flex justify-content-center">
                <h1><i class="mdi mdi-book"></i> Perangkat<small>Mengajar</small></h1>
              </div>
              <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                  <div class="stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-6-tablet">

                    <div class="mdc-card">
                      <form method="POST" action="/login">
                        @csrf()
                        <div class="mdc-layout-grid">
                          <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                              <div class="mdc-text-field w-100">
                                <input class="mdc-text-field__input" name="username" id="username" required autofocus>
                                <div class="mdc-line-ripple"></div>
                                <label for="username" class="mdc-floating-label"><i class="mdi mdi-account-circle"></i> Nama Pengguna</label>
                              </div>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                              <div class="mdc-text-field w-100">
                                <input class="mdc-text-field__input" type="password" name="password" id="password" required>
                                <span id="show-password" title="Tampilkan Sandi"><i class="mdi mdi-eye-off"></i></span>
                                <div class="mdc-line-ripple"></div>
                                <label for="password" class="mdc-floating-label"><i class="mdi mdi-key"></i> Kata Sandi</label>
                              </div>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                              <button type="submit" class="mdc-button mdc-button--raised w-100" id="btn-login">
                                Login
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
                </div>
              </div>
              {{-- @if(session('status'))
                <div class="container">
                  <div class="alert alert-danger">
                    {{ session('status') }}
                  </div>
                </div>
              @endif --}}
            </main>
          </div>
        </div>
      </div>

      </div>
        <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
        {{-- <script type="text/javascript" src="{{ asset('js/vue.js')}}"></script> --}}
        <!-- plugins:js -->
        <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        {{-- <script src="{{ asset('vendors/chartjs/Chart.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
        <script src="{{ asset('vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{ asset('js/material.js') }}"></script>
        {{-- <script src="{{ asset('js/misc.js') }}"></script> --}}
        <!-- endinject -->
        <!-- Custom js for this page-->
        {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}
        <!-- End custom js for this page-->
        @include('sweet::alert')
        @if(Session::get('status') == 'error')
          <script>
          swal({
            text: "{!! Session::get('msg')!!}",
            title: "Error",
            timer: 1500,
            icon: "error",
            // buttons:
          });
          </script>
        @endif
        <script>
            $(document).ready(function(){
              sessionStorage.removeItem('wali')
              sessionStorage.removeItem('rombel')
                $('#show-password').click(function(){
                    var eye = $('#show-password i').hasClass('mdi-eye-off')
                    if (eye) {
                        $('#show-password i').removeClass('mdi-eye-off').addClass('mdi-eye')
                        $('#show-password').prop('title', 'Sembunyikan Sandi')
                        $('#password').prop('type', 'text')
                    } else {
                        $('#show-password i').removeClass('mdi-eye').addClass('mdi-eye-off')
                        $('#password').prop('type', 'password')
                        $('#show-password').prop('title', 'Tampilkan Sandi')
                    }
                })
            })
        </script>
    </body>
</html>
