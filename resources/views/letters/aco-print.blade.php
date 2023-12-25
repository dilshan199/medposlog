<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dist/output.css') }}" type="text/css">
    <script src="{{ asset('lib/jQuery/jquery-2.2.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/print_plugins/jQuery.print.js') }}" type="text/javascript"></script>
    <title>Medposlog | Prescription Print</title>
</head>
<body class="bg-gray-800">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="print-page" style="background: #fff;width: 604.72px;height: 774.80px;margin: 0 auto;margin-top: 5px;padding: 37.79px 37.79px 37.79px 56.69px;">
        <!-- Page Header -->
        <div class="" style="width: 100%">
            <div style="width: 359px;line-height: 1.5;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Date: @php echo Carbon::now('Asia/Colombo')->format('Y-m-d'); @endphp</p>
            </div>
        </div>
        <div class="w-full mt-1" style="line-height: 1.5;">
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Airport custom officer,</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">To whom it may concern,</p>
        </div>
        <div class="mt-[15px] w-full flex items-center space-x-3">
            {{-- <p style="font-size: 15px;font-family:Arial, sans-serif;font-weight: 600;">Mr/Mrs/Miss/Rev.</p> --}}
            <p style="font-size: 14px;font-family:Arial, sans-serif;font-weight: 600;">{{ session('aco_title')}} {{ session('aco_name') }} {{ session('aco_age') }} years, {{ session('aco_address') }}, Sri Lanka</p>
        </div>
        <div class="w-full" style="line-height: 1.5;">
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Kindly authorize to take following medications.</p>
            <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">(Prescription attached)</p>
        </div>
        <div class="w-full mt-[20px]">
            <div class="flex items-center space-x-3">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Passport number</p>
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">{{ session('aco_passport') }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Prescription number</p>
               <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">{{ session('aco_prescription') }}</p>
            </div>
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
