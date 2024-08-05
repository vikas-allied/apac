<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>APAC | @yield('title')</title>

    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE | Dashboard v2">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <!--end::Primary Meta Tags-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ url('/backend/dist/css/adminlte.css') }}">
    <!--end::Required Plugin(AdminLTE)-->

    <!--begin::Sweetalert2-->
    <link rel="stylesheet" href="{{url('/backend/plugins/sweetalert2/sweetalert2.min.css')}}">
    <!--begin::Sweetalert2-->

    <!--datatable-->
    <link href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet" />
    <!--datatable-->

    <!--begin::stack css-->
    @stack('css')
    <!--end::stack css-->


</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<!--begin::App Wrapper-->
<div class="app-wrapper">

    <!--begin::Header-->
    @include('backend.partials.header')
    <!--end::Header-->

    <!--begin::Sidebar-->
    @include('backend.partials.sidebar')
    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
        @yield('content')
    </main>
    <!--end::App Main-->

    <!--begin::Footer-->
    @include('backend.partials.footer')
    <!--end::Footer-->

</div>
<!--end::App Wrapper-->

<!--begin::Script-->

<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)-->

<!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)-->

<!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)-->

<!--begin::Required Plugin(AdminLTE)-->
<script src="{{ url('/backend/dist/js/adminlte.js') }}"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<!--end::Required Plugin(AdminLTE)-->

<!--begin::Sweetalert2-->
<script src="{{url('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!--end::Sweetalert2-->

<!--begin::Jquery-->
<script src="{{url('backend/plugins/jquery/jquery.min.js')}}"></script>
<!--end::Jquery-->

<!--datatable-->
<script type="application/javascript" src="//cdn.datatables.net/2.0.7/js/dataTables.min.js" ></script>
<!--datatable-->


<script>

    <!-- sidebar starts-->
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });


    /* toast messages settings */
    @if(Session::has('msg'))

    let icon = "{{ Session::get('alert-type','info') }}";
    let msg = "{{Session::get('msg')}}";
    toast(icon,msg);

    @endif

    function toast(icon='info',msg='')
    {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: icon,
            title: msg,
        });
    }


    $(function () {

        // DataTable initiation
        let table = new DataTable('.dataTable');

        // Delete with sweet alert
        $(document).on('click', '.delete-data', function(event) {
            event.preventDefault(); // Prevent default link behavior

            let url = $(this).data("url");

            Swal.fire({
                title: 'Are you sure you want to delete this record?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(url, { '_method': 'delete'})
                        .then(function (response) {
                            if(response.data.status === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    // 'The Item has been deleted successfully.',
                                    response.data.message,
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        // The user clicked "OK"
                                        window.location.reload();
                                    }
                                });

                                // Set a timeout to reload the page after 2 seconds
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            }

                        })
                        .catch(function(error){
                            Swal.fire(
                                'Error!',
                                // 'An error occurred while deleting the product.',
                                error.response.data.message,
                                'error'
                            );
                        });
                }
            });
        });

    });


</script>
<!--end::Script-->

<!--begin::stack js-->
@stack('js')
<!--end::stack js-->

</body>
<!--end::Body-->

</html>
