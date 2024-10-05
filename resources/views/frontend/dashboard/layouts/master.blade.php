<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <title>@yield('title')</title>
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.calendar.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/add_row_custon.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/mobile_menu.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/multiple-image-video.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/ranger_style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.classycountdown.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">

  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
  <link href="https://cdn.datatables.net/v/bs5/dt-2.1.2/r-3.0.2/datatables.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>

    {{-- @include('frontend.home.layouts.header')
    @include('frontend.home.sections.menu') --}}
  <!--=============================
    DASHBOARD MENU START
  ==============================-->
    @include('frontend.dashboard.layouts.navbar')
  <!--=============================
    DASHBOARD MENU END
  ==============================-->
  @include('frontend.dashboard.layouts.sidebar')

  <!--=============================
    DASHBOARD START
  ==============================-->
    @yield('content')
  <!--=============================
    DASHBOARD START
  ==============================-->


  <!--============================
      SCROLL BUTTON START
    ==============================-->
  <div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
  </div>
  <!--============================
    SCROLL BUTTON  END
  ==============================-->


  <!--jquery library js-->
  <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
  <!--bootstrap js-->
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
  <!--font-awesome js-->
  <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
  <!--select2 js-->
  <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
  <!--slick slider js-->
  <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
  <!--simplyCountdown js-->
  <script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
  <!--product zoomer js-->
  <script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>
  <!--nice-number js-->
  <script src="{{ asset('frontend/js/jquery.nice-number.min.js') }}"></script>
  <!--counter js-->
  <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
  <!--add row js-->
  <script src="{{ asset('frontend/js/add_row_custon.js') }}"></script>
  <!--multiple-image-video js-->
  <script src="{{ asset('frontend/js/multiple-image-video.js') }}"></script>
  <!--sticky sidebar js-->
  <script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
  <!--price ranger js-->
  <script src="{{ asset('frontend/js/ranger_jquery-ui.min.js') }}"></script>
  <script src="{{ asset('frontend/js/ranger_slider.js') }}"></script>
  <!--isotope js-->
  <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
  <!--venobox js-->
  <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
  <!--classycountdown js-->
  <script src="{{ asset('frontend/js/jquery.classycountdown.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-2.1.2/r-3.0.2/datatables.min.js"></script>
  {{-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> --}}
  <!--main/custom js-->
  <script src="{{ asset('frontend/js/main.js') }}"></script>
  <script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                toastr()->error($error);
            @endphp
        @endforeach
    @endif
  </script>

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
            });

            $('body').on('click', '.delete-item', function(event){
                event.preventDefault();
                let deleteURL = $(this).attr('href');
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success me-7",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: true
                })

                swalWithBootstrapButtons.fire({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data ini",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ok",
                    cancelButtonText: "Batalkan",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed){
                        $.ajax({
                        type: 'DELETE',
                        url: deleteURL,

                        success: function(data){
                            if(data.status == 'success'){
                                swalWithBootstrapButtons.fire({
                                    title: "Data dihapus",
                                    text: data.message,
                                    icon: "success"
                                });
                                window.location.reload();
                            }
                            else if (data.status == 'error'){
                                swalWithBootstrapButtons.fire({
                                    title: "Error",
                                    text: data.message,
                                    icon: "error"
                                });
                            }
                        },

                        error: function(xhr, status, error){
                            console.log(error);
                        }
                        })

                    } else if(result.dismiss === Swal.DismissReason.cancel){
                        swalWithBootstrapButtons.fire({
                            title: "Operasi hapus dibatalkan",
                            text: "Data anda tidak dihapus",
                            icon: "error"
                        });
                    }
                });
            })
        })
    </script>

    @stack('script')
</body>

</html>
