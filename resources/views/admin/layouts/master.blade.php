<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  <title>General Dashboard &mdash; marketp</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href={{asset("backend/assets/modules/bootstrap/css/bootstrap.min.css")}}>
  <link rel="stylesheet" href={{asset("backend/assets/modules/fontawesome/css/all.min.css")}}>

  <!-- CSS Libraries -->
  <link rel="stylesheet" href={{asset("backend/assets/modules/jqvmap/dist/jqvmap.min.css")}}>
  <link rel="stylesheet" href={{asset("backend/assets/modules/weather-icon/css/weather-icons.min.css")}}>
  <link rel="stylesheet" href={{asset("backend/assets/modules/weather-icon/css/weather-icons-wind.min.css")}}>
  <link rel="stylesheet" href={{asset("backend/assets/modules/summernote/summernote-bs4.css")}}>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-iconpicker.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href={{asset("backend/assets/css/style.css")}}>
  <link rel="stylesheet" href={{asset("backend/assets/css/components.css")}}>
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
        @include('admin.layouts.navbar')
        @include('admin.layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>


    </div>
  </div>

  <!-- General JS Scripts -->
  <script src={{asset("backend/assets/modules/jquery.min.js")}}></script>
  <script src={{asset("backend/assets/modules/popper.js")}}></script>
  <script src={{asset("backend/assets/modules/tooltip.js")}}></script>
  <script src={{asset("backend/assets/modules/bootstrap/js/bootstrap.min.js")}}></script>
  <script src={{asset("backend/assets/modules/nicescroll/jquery.nicescroll.min.js")}}></script>
  <script src={{asset("backend/assets/modules/moment.min.js")}}></script>
  <script src={{asset("backend/assets/js/stisla.js")}}></script>

  <!-- JS Libraies -->
  <script src={{asset("backend/assets/modules/simple-weather/jquery.simpleWeather.min.js")}}></script>
  <script src={{asset("backend/assets/modules/chart.min.js")}}></script>
  <script src={{asset("backend/assets/modules/jqvmap/dist/jquery.vmap.min.js")}}></script>
  <script src={{asset("backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js")}}></script>
  <script src={{asset("backend/assets/modules/summernote/summernote-bs4.js")}}></script>
  <script src={{asset("backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js")}}></script>

  <!-- Page Specific JS File -->
  <script src={{asset("backend/assets/js/page/index-0.js")}}></script>
  <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('backend/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

  <!-- Template JS File -->
  <script src={{asset("backend/assets/js/scripts.js")}}></script>
  <script src={{asset("backend/assets/js/custom.js")}}></script>
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
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed){
                    $.ajax({
                      type: 'DELETE',
                      url: deleteURL,

                      success: function(data){
                        if(data.status == 'success'){
                            swalWithBootstrapButtons.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            window.location.reload();
                        }
                        else if (data.status == 'error'){
                            swalWithBootstrapButtons.fire({
                                title: "Error",
                                text: "Error",
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
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
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
