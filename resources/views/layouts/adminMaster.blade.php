<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Meta -->
        <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
        <meta name="author" content="ThemePixels">

        @php
        $settings = App\Models\Setting::where('id', 1)->first();
        @endphp
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/settings/'.$settings->favicon_icon) }}">
        <title>@yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
        <!-- vendor css -->
        <link href="{{ asset('admin') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="{{ asset('admin') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
        <link href="{{ asset('admin') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <link href="{{ asset('admin') }}/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
        
        <link href="{{ asset('admin') }}/lib/highlightjs/github.css" rel="stylesheet">
        <!----<!-- Data Table Stylesheet -->
        <link href="{{ asset('admin') }}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
        <link href="{{ asset('admin') }}/lib/select2/css/select2.min.css" rel="stylesheet">
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <link href="{{ asset('admin') }}/lib/medium-editor/medium-editor.css" rel="stylesheet">
        <link href="{{ asset('admin') }}/lib/medium-editor/default.css" rel="stylesheet">
        <link href="{{ asset('admin') }}/lib/summernote/summernote-bs4.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
        <link href="{{ asset('admin') }}/lib/spectrum/spectrum.css" rel="stylesheet">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <!-- Starlight CSS -->
        <link rel="stylesheet" href="{{ asset('admin') }}/css/starlight.css">
        
    </head>

    <body>

        <!-- ########## START: LEFT PANEL ########## -->
        <div class="sl-logo">
            <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
                <i class="icon ion-android-cart"></i> 
                @if($settings->site_logo) 
                <img src="{{ asset('uploads/settings/'.$settings->site_logo ) }}" style="height: 25px;">
                @elseif($settings->site_name) 
                {{$settings->site_name}} 
                @else {{ config('app.name') }} @endif
            </a>
        </div>

        <!-- ########## START: LEFT PANEL ########## -->
        @include('admin.include.leftbar')


        <!-- ########## START: HEAD PANEL ########## -->
        @include('admin.include.header')

        <!-- ########## START: MAIN PANEL ########## -->

        <div class="sl-mainpanel">

            <!-- sl-pagebody -->
            @yield('adminContent')

        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

        
        <script src="{{ asset('admin') }}/lib/jquery/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        
<!--        <script src="{{ asset('admin') }}/lib/jquery/jquery.js"></script>
        <script src="{{ asset('admin') }}/lib/popper.js/popper.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>-->
        <script src="{{ asset('admin') }}/lib/jquery-ui/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
        
        <script src="{{ asset('admin') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>


        <!--------------<!-- Data Table Script -->
        <script src="{{ asset('admin') }}/lib/datatables/jquery.dataTables.js"></script>
        <script src="{{ asset('admin') }}/lib/datatables-responsive/dataTables.responsive.js"></script>
        <script src="{{ asset('admin') }}/lib/select2/js/select2.min.js"></script>
        <script src="{{ asset('admin') }}/lib/spectrum/spectrum.js"></script>
        <script>
$(function () {
    'use strict';
  
  <!--------------<!-- Select with Searchbox Script -->
    $('.select2').select2({
          minimumResultsForSearch: Infinity
        });

        // Select2 by showing the search
        $('.select2-show-search').select2({
          minimumResultsForSearch: ''
        });

        // Select2 with tagging support
        $('.select2-tag').select2({
          tags: true,
          tokenSeparators: [',', ' ']
        });
<!--------------<!-- End : Select with Searchbox Script -->

    $('#datatable1').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        }
    });

    $('#datatable2').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true
    });

    // Select2
    $('.dataTables_length select').select2({minimumResultsForSearch: Infinity});

});
        </script>

        <!--------------<!-- End Data Table Script -->

        <script src="{{ asset('admin') }}/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
        <script src="{{ asset('admin') }}/lib/d3/d3.js"></script>
        <script src="{{ asset('admin') }}/lib/rickshaw/rickshaw.min.js"></script>
        <script src="{{ asset('admin') }}/lib/chart.js/Chart.js"></script>
        <script src="{{ asset('admin') }}/lib/Flot/jquery.flot.js"></script>
        <script src="{{ asset('admin') }}/lib/Flot/jquery.flot.pie.js"></script>
        <script src="{{ asset('admin') }}/lib/Flot/jquery.flot.resize.js"></script>
        <script src="{{ asset('admin') }}/lib/flot-spline/jquery.flot.spline.js"></script>
        <script src="{{ asset('admin') }}/lib/summernote/summernote-bs4.min.js"></script>
        <script>
        $(function(){
          'use strict';

          // Summernote editor
          $('#summernoteShortEN').summernote({
            height: 150,
            tooltip: false
          })
          
          $('#summernoteShortBN').summernote({
            height: 150,
            tooltip: false
          })
          
          $('#summernoteLongEN').summernote({
            height: 150,
            tooltip: false
          })
          
          $('#summernoteLongBN').summernote({
            height: 150,
            tooltip: false
          })
          
          
        });
      </script>        

        <script src="{{ asset('admin') }}/js/starlight.js"></script>
        <script src="{{ asset('admin') }}/js/ResizeSensor.js"></script>
        <script src="{{ asset('admin') }}/js/dashboard.js"></script>
        <script src="{{ asset('admin') }}/lib/highlightjs/highlight.pack.js"></script>
        

        <!--------------- Start Toastr Script ---------------------------->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
              @if (Session::has('message'))
              var type = "{{Session::get('alert-type','info')}}"
              switch (type) {
                  case 'info':
                      toastr.info(" {{Session::get('message')}} ");
                      break;
                  case 'success':
                      toastr.success(" {{Session::get('message')}} ");
                      break;
                  case 'warning':
                      toastr.warning(" {{Session::get('message')}} ");
                      break;
                  case 'error':
                      toastr.error(" {{Session::get('message')}} ");
                      break;
              }
              @endif
        </script>
        <!--------------- End Toastr Script ---------------------------->


      <!------------------------ Sweet Alert  ------------------------------------------>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('admin') }}/js/sweetalert-custom.js"></script>
     <!--------------- End Sweet Alert ---------------------------->
        
    
    </body>
</html>
