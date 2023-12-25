<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dist/output.css') }}" type="text/css">
    <script src="{{ asset('lib/jQuery/jquery-2.2.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/print_plugins/jQuery.print.js') }}" type="text/javascript"></script>
    <title>MedOne | Letters Print</title>
</head>
<body class="bg-gray-800">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="print-page" style="background: #fff;width: 604.72px;height: 774.80px;margin: 0 auto;margin-top: 5px;padding: 37.79px 37.79px 37.79px 56.69px;">
        <!-- Page Header -->
        <div style="line-height: 1.5;width: 100%;">
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Family Care Medical Consultation Center</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">No. 47,</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Hulangamuwa Road,</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Matale</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">071 4352116 /066 2230681</p>
        </div>
        <div class="" style="width: 100%;margin-top: 3px;">
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Date: @php echo Carbon::now('Asia/Colombo')->format('Y-m-d'); @endphp</p>
        </div>
        <div class="mt-2" style="width: 100%;line-height: 1.5;">
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">To whom it may concern,</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">{{ session('c_whom') }}</p>
        </div>
        <div class="w-full mt-[2px]" style="line-height: 1.5;">
            <p style="font-size: 14px;font-family:Arial, sans-serif;font-weight: 600;">{{ session('c_title') }} {{ session('c_name') }} {{ session('c_age') }} years, {{ session('c_address') }}</p>
        </div>
        <div style="width: 100%;margin-top: 15px;">
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">
                @php
                    echo str_replace(array("\r\n", "\r", "\n"), '<br>', session('c_problem'))
                @endphp
            </p>
        </div>
        <div class="w-full mt-[50px]" style="line-height: 1.5;">
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Dr.Athula Kulasinghe</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">MBBS, MD, MCCP</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Consultant Physician</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Teaching Hospital</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Peradeniya</p>
        </div>
    </div>
    <script src="{{ asset('js/print.js') }}" type="text/javascript"></script>
</body>
</html>
