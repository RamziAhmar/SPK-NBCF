<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Kelayakan Bahan Beling | {{ $title }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets') }}/images/favicon.svg" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets') }}/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets') }}/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style-preset.css">

    <!-- [Custom CSS untuk Modern Clean Look] -->
    <style>
        :root {
            --primary-color: #1890ff;
            --primary-light: #e6f7ff;
            --primary-dark: #0050b3;

            /* Background Colors */
            --bg-body: #f4f7fa;
            --bg-sidebar: #f8fbfd;
            /* Sentuhan warna biru super pucat (Ice Blue) */
            --bg-header-gradient: linear-gradient(to right, #ffffff 40%, #eff5fc 100%);
            /* Gradasi halus di header */

            --card-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 8px 25px 0 rgba(0, 0, 0, 0.1);
            --border-color: #eaedf1;
            --text-main: #262626;
            --text-muted: #8c8c8c;

            /* Dashboard Stats Colors */
            --color-total: #1890ff;
            --color-layak: #52c41a;
            --color-tidak-layak: #ff4d4f;
            --color-training: #faad14;
        }

        body,
        .pc-container {
            background-color: var(--bg-body) !important;
        }

        /* 1. HEADER DIBERI GRADASI HALUS */
        .pc-header {
            background: var(--bg-header-gradient) !important;
            /* Menggunakan gradasi */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid var(--border-color);
            /* Garis pemisah bawah yang sangat tipis */
        }

        /* 2. SIDEBAR DIBERI WARNA ICE BLUE PUCAT */
        .pc-sidebar {
            background-color: var(--bg-sidebar) !important;
            border-right: 1px solid var(--border-color);
        }

        /* Sidebar Active Menu */
        .pc-sidebar .pc-navbar>.pc-item.active>.pc-link {
            background-color: var(--primary-light) !important;
            color: var(--primary-color) !important;
            border-right: 4px solid var(--primary-color);
            border-radius: 0 8px 8px 0;
            margin-right: 15px;
        }

        .pc-sidebar .pc-navbar>.pc-item.active>.pc-link .pc-micon i {
            color: var(--primary-color) !important;
        }

        /* Sidebar Hover Effect - Diperhalus agar cocok dengan background baru */
        .pc-sidebar .pc-navbar>.pc-item:not(.active)>.pc-link:hover {
            background-color: rgba(24, 144, 255, 0.04);
            /* Transparansi biru tipis */
            color: var(--primary-color);
            border-radius: 8px;
            margin: 0 15px 0 0;
            border-right: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .card {
            background-color: #ffffff;
            border: none !important;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .card-body h6.text-muted {
            color: var(--text-muted) !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.8px;
            margin-bottom: 12px !important;
        }

        .card-body h4 {
            color: var(--text-main);
            font-weight: 700;
            font-size: 1.8rem;
        }

        /* Dashboard Aksen Border Otomatis */
        .row>div:nth-child(1) .card {
            border-bottom: 4px solid var(--color-total) !important;
        }

        .row>div:nth-child(2) .card {
            border-bottom: 4px solid var(--color-layak) !important;
        }

        .row>div:nth-child(3) .card {
            border-bottom: 4px solid var(--color-tidak-layak) !important;
        }

        .row>div:nth-child(4) .card {
            border-bottom: 4px solid var(--color-training) !important;
        }

        .pc-footer {
            background-color: #ffffff !important;
            border-top: 1px solid var(--border-color);
            padding: 1.25rem 1.5rem;
        }

        .pc-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .pc-footer a:hover {
            color: var(--primary-dark);
        }
    </style>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    @include('layouts.header')



    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">{{ $title }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                {{-- <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body"> --}}
                @include($page)
                {{-- </div>
                    </div>
                </div> --}}
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    @include('layouts.footer')
    <script src="{{ asset('assets') }}/js/plugins/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/simplebar.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/fonts/custom-font.js"></script>
    {{-- <script src="{{ asset('assets') }}/js/pcoded.js"></script> --}}
    <script src="{{ asset('assets') }}/js/plugins/feather.min.js"></script>

    {{-- <script>
        layout_change('light');
    </script> --}}




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


</body>
<!-- [Body] end -->

</html>
