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
        <div class="" style="width: 100%;">
            <div style="width: 359px;line-height: 1.5;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Date: @php echo Carbon::now('Asia/Colombo')->format('Y-m-d'); @endphp</p>
            </div>
        </div>
        <div style="width: 100%;line-height: 1.5;margin-top: 5px;">
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">{{ session('r_letter_whom') }}</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Consultant Radiologist</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Dear colleague,</p>
            <p style="font-size: 14px;font-family:Arial, sans-serif;font-weight: 600;margin-top: 5px;">{{ session('r_letter_title')}} {{ session('r_letter_name') }} {{ session('r_letter_age') }} years, {{ session('r_letter_address') }}</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Please kindly arrange {{ session('illness') }}</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">
                @php
                    echo str_replace(array("\r\n", "\r", "\n"), '<br>', session('r_letter_problem'))
                @endphp
            </p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">for this patient.</p>
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
