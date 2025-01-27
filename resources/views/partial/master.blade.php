<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>
    <style>
        .required {
            color: red;
        }

        .tbl-status-drowdown {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border: var(--bs-border-width) solid var(--input-border);
            border-radius: 0.35rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .tbl-status-drowdown:focus {
            border-color: var(--input-border);
            /* Adjust the focus border color as needed */
            outline: 0;
            box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.25);
            /* Example focus style, adjust accordingly */
        }
    </style>

    <!-- Meta Data -->


    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        {{ isset($site_title) ? $site_title . ' | ' . config('app.name', 'Mehtodd') : config('app.name', 'Mehtodd') }}
    </title>
    <!-- Set the favicon -->
    <link rel="icon" type="image/png" href="{{ asset('uploads/fevicon/' . GetSetting('fevicon')) }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <meta name="Description" content="">
    <meta name="Author" content="">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Favicon -->
    {{-- <link rel="icon" href="{{ asset('backend/images/brand-logos/favicon.ico') }}" type="image/x-icon"> --}}
    <!-- Choices JS -->
    <script src="{{ asset('backend/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <!-- Main Theme Js -->
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('backend/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Style Css -->
    <link href="{{ asset('backend/css/styles.min.css') }}" rel="stylesheet">
    <!-- Icons Css -->
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet">
    <!-- Node Waves Css -->
    <link href="{{ asset('backend/libs/node-waves/waves.min.css') }}" rel="stylesheet">
    <!-- Simplebar Css -->
    <link href="{{ asset('backend/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('backend/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/libs/@simonwep/pickr/themes/nano.min.css') }}">
    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('backend/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/libs/jsvectormap/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/libs/quill/quill.snow.css') }}">
    {{-- <!-- datatablecss-->
    <link rel="stylesheet" href="{{ asset('datatable/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap5.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@0.1.2/css/themify-icons.css">





</head>

<body>



    @include('partial.header')
    @include('partial.left_sidebar')
    <div class="main-content app-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    @include('partial.footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function triggerSweetAlert(message, type) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: type,
                type: type,
                title: message,
                showConfirmButton: false,
                timer: 1500,
            })
        }
    </script>

    <!-- Custom JS -->
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <!--datatable js-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    {{--  --}}
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="{{ asset('datatable/js/buttons/html5.min.js') }}"></script>
    <script src="{{ asset('datatable/js/buttons/print.min.js') }}"></script>
    <script src="{{ asset('datatable/js/datatables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('datatable/js/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatable/js/datatables.responsive.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('datatable/js/datatables.js') }}"></script> --}}


    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ asset('assets/js/choices.js') }}"></script>
    <script src="{{ asset('backend/js/quill-editor.js') }}"></script>
    <script src="{{ asset('backend/js/quill.min.js') }}"></script>

    <!-- Include CKEditor script from CDN -->
    <script src="{{ asset('backend/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Defaultmenu JS -->
    <script src="{{ asset('backend/js/defaultmenu.min.js') }}"></script>
    <!-- Node Waves JS-->
    <script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>
    <!-- Sticky JS -->
    <script src="{{ asset('backend/js/sticky.js') }}"></script>
    <!-- Simplebar JS -->
    <script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/js/simplebar.js') }}"></script>
    <!-- Color Picker JS -->
    <script src="{{ asset('backend/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
    <!-- JSVector Maps JS -->
    <script src="{{ asset('backend/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <!-- JSVector Maps MapsJS -->
    <script src="{{ asset('backend/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <!-- Apex Charts JS -->
    <script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Chartjs Chart JS -->
    <script src="{{ asset('backend/libs/chart.js/chart.min.js') }}"></script>
    <!-- CRM-Dashboard -->
    <script src="{{ asset('backend/libs/quill/quill.min.js') }}"></script>
    <!-- Custom-Switcher JS -->
    <script src="{{ asset('backend/js/custom-switcher.min.js') }}"></script>

    {{-- <script src="{{ asset('backend/js/quill-editor.js') }}"></script>
    <script src="{{ asset('backend/js/quill.min.js') }}"></script> --}}


    <script src="{{ asset('backend/js/quill.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('form').submit(function() {
                $('#submitBtn').val('Adding...').prop('disabled', true);
            });
        });
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Enter Description',
            modules: {
                toolbar: [
                    [{
                        'size': ['small', false, 'large', 'huge']
                    }],
                    [{
                        'font': []
                    }],
                    ['blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'header': 1
                    }, {
                        'header': 2
                    }],
                    ['blockquote', 'code-block'],
                    [{
                        'color': []
                    }],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'align': []
                    }],

                    ['script', 'formula'],
                    ['image'],
                    ['clean'],

                    // Add other toolbar options as needed
                ],
            },
        });

        // Update the hidden textarea with Quill content
        quill.on('text-change', function() {
            var editorContent = quill.root.innerHTML; // Get HTML content
            document.getElementById('description').value = editorContent;
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.get_category_data').change(function() {
                var data_level = $(this).data('level');
                var id = $(this).find('select').val();
                var option_html = '<option value="">--Select--</option>';

                if (data_level == 0) {
                    $('#select_sub_category_1').html(option_html);
                    $('#select_sub_category_2').html(option_html);
                    $('#select_sub_category_3').html(option_html);
                    $('#select_sub_category_4').html(option_html);
                } else if (data_level == 1) {
                    $('#select_sub_category_2').html(option_html);
                    $('#select_sub_category_3').html(option_html);
                    $('#select_sub_category_4').html(option_html);
                } else if (data_level == 2) {
                    $('#select_sub_category_3').html(option_html);
                    $('#select_sub_category_4').html(option_html);
                } else if (data_level == 3) {
                    $('#select_sub_category_4').html(option_html);
                }


                var formData = new FormData();
                formData.append('data_level', data_level);
                formData.append('category_id', id);

                var next_level = data_level + 1;

                $.ajax({
                    type: "POST",
                    url: "{{ route('get.category.data') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    success: function(response) {
                        $('#sub_category_' + next_level).html(response.html_data);

                    },
                    error: function(response, status, error) {}
                });

            });
        });
    </script>

    @yield('js')

</body>



</html>
