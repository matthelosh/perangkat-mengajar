<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
          @if($page_title)
            {{$page_title}}
          @else
            Sekedar
          @endif
        </title>

        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
        {{-- <link rel="stylesheet" href="{{ asset('mdb/css/mdb.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/demo/style.css') }}">
        <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/rapor.css') }}">
        <style media="screen">

        </style>
    </head>
    <body>
      <script src="{{ asset('js/preloader.js') }}"></script>
      <div id="app">
        <div class="body-wrapper">
          <!-- partial:partials/_sidebar.html -->
          @include('partials._sidebar')
          <!-- partial -->
          <div class="main-wrapper mdc-drawer-app-content">
            <!-- partial:partials/_navbar.html -->
            @include('partials._navbar')
            <!-- partial -->
            <div class="page-wrapper mdc-toolbar-fixed-adjust">
              <main class="content-wrapper">
                @yield('content')
              </main>
              <!-- partial:partials/_footer.html -->
              @include('partials._footer')
              <!-- partial -->
            </div>
          </div>
        </div>
      </div>

        @if(Auth::user()->role == 'wali')
          @include('modals.guru')
        @endif
        @if(Auth::user()->role == 'admin')
          @include('modals.admin')
        @endif
        {{-- <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script> --}}
        {{-- <script type="text/javascript" src="{{ asset('mdb/js/jquery.js')}}"></script> --}}
        {{-- <script type="text/javascript" src="{{ asset('mdb/js/mdb.js')}}"></script> --}}
        
        <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
        
        
        
        <script src="{{ asset('js/material.js') }}"></script>
        <script src="{{ asset('js/misc.js') }}"></script>
        <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>

        <script src="{{ asset('js/moment.js') }}"></script>
        <script src="{{ asset('js/moment-with-locales.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
      @include('sweet::alert')
      @if(Session::get('error'))
        <script type="text/javascript">
          var required = ''
          var text = {!! Session::get('error') !!}
          Object.keys(text).forEach(key => {
            required += key+", "
          })
          swal({
            text: "Field : " + required +" harus diisi",
            title: "Error",
            timer: 10000,
            icon: "error",
            // buttons:
          });
        </script>
      @endif
      @if(Session::get('status') == 'error')
        <script>
        swal({
          text: "{!! Session::get('msg')!!}",
          title: "Error",
          timer: 0,
          icon: "error",
          // buttons:
        });
        </script>
      @elseif(Session::get('status') == 'sukses')
        <script>
        swal({
          text: "{!! Session::get('msg')!!}",
          title: "Sukses",
          timer: 10000,
          icon: "success",
          content: 'html'
          // buttons:
        });
        </script>
      @endif
      @if(Session::get('wali') == 1)
        <script>
          sessionStorage.setItem('wali', true)
          sessionStorage.setItem('rombel', '{{ Session::get('rombel')->kode_rombel }}')
        </script>
      @endif
    </body>
</html>
