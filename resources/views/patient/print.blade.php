<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dist/output.css') }}" type="text/css">
    <script src="{{ asset('lib/jQuery/jquery-2.2.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/print_plugins/jQuery.print.js') }}" type="text/javascript"></script>
    <title>MedOne | Prescription Print</title>
</head>
<body class="bg-gray-800">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="print-page relative" style="background: #fff;width: 604.72px;height: 774.80px;margin: 0 auto;padding: 0 37.79px 0 37.79px;position:relative;">
        <!-- Start Header section -->
        <div class="" style="display: flex;border-bottom: 2px solid #000;">
            <div style="width: 377.95px;text-align: center;line-hieght: 1;padding: 5px;">
                <p style="font-size: 14px;">FAMILY CARE MEDICAL CONSULTAION CENTRE</p>
                <p style="font-size: 11px;">No 47 - Hulangamuwa Road, Matale</p>
                <p style="font-size: 11px;">071 4352116 / 066 2230681</p>
            </div>
            <div class="flex" style="width: 188.97px;padding: 5px;justify-content: center;">
                @php
                    echo DNS1D::getBarcodeHTML($patient->barcode, 'C128', 1.5, 50);
                @endphp
            </div>
        </div>
        <!-- End Header section -->
        <!-- Page Header -->
        <div class="" style="display:flex;">
            <div style="width: 359px;line-height: 2;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">
                    BP:
                    @if ($patient_rec != null)
                        {{ $patient_rec->bp }}
                    @endif
                </p>
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">
                    Weight:
                    @if ($patient_rec != null)
                        {{ $patient_rec->kg.'Kg' }}
                    @endif
                </p>
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">
                    Allergic:
                    @if ($patient_rec != null)
                        {{ $patient_rec->allegic_desc }}
                    @endif
                </p>
                {{-- <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">
                    S/H:
                    @if ($patient_rec != null)
                        {{ $patient_rec->sh }}
                    @endif
                </p> --}}
            </div>
            <div style="width: 359px;line-height: 1.5;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Dr. Athula Kulasinghe,</p>
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">MBBS(SL), MD(Medicine), MCCP</p>
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Consultant Physician</p>
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Teaching Hospital,</p>
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 600;">Peradeniya.</p>
            </div>
        </div>
        <!-- End Header -->
        <div class="" style="display:flex; border-top: 2px solid #000;">
            <div style="width: 359px;padding: 5px;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: 700;">Name: {{ $patient->title }} {{ $patient->name }} - {{ $patient->address }}</p>
            </div>
            <div style="width: 359px;padding: 5px;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: normal;text-align:right;">Patient ID: {{ $patient->patient_id }}</p>
            </div>
        </div>
        <div class="" style="display:flex; border-top: 2px solid #000;border-bottom: 1px solid #000;">
            <div style="width: 150px;padding: 5px;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: normal;">Age: {{ $patient->age }}</p>
            </div>
            <div style="width: 359px;padding: 5px;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: normal;">Phone No: 0{{ $patient->contact_no }}</p>
            </div>
            <div style="width: 359px;padding: 5px;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: normal;">NIC: {{ $patient->nic }}</p>
            </div>
            <div style="width: 359px;padding: 5px;">
                <p style="font-size: 12px;font-family:Arial, sans-serif;font-weight: normal;">Date: @php echo Carbon::now('Asia/Colombo')->format('Y-m-d'); @endphp</p>
            </div>
        </div>
        <div style="width: 100%;padding:5px;">
            <table style="font-size: 13px;font-weight: 700;width: 100%;">
                @php
                    $x = 0;
                @endphp
                @foreach ($prescription as $pre)
                    @php
                        $x++;
                    @endphp
                    <tr>
                        <td>
                            @if ($pre->drug_name != '')
                                {{ $x.'.' }}
                            @else
                                @php
                                    $x -= 1;
                                @endphp
                            @endif
                        </td>
                        <td width="50%">{{ $pre->drug_name }}</td>
                        <td>{{ $pre->dose }}</td>
                        <td style="text-align: center;">{{ $pre->frequency }}</td>
                        <td>
                            @php
                                $find = strpos($pre->days, 'days');
                            @endphp
                            @if ($find > 0)
                                {{ $pre->days }}
                            @else
                                {{ $pre->days. ' days' }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div style="width: 100%;display:flex;">
            @if ($patient_rec != null)
                @if ($patient_rec->problem != '')
                    <div style="width: 113.38px;padding: 5px;">
                        <h6 style="text-decoration: underline;font-weight: 700;font-size:12px;">Problems</h6>
                        <p style="margin-top: 15px;font-size: 11px;">
                            @php
                                echo str_replace(array("\r\n", "\r", "\n"), '<br>', $patient_rec->problem);
                            @endphp
                        </p>
                    </div>
                @endif
            @endif
            @if ($patient_rec != null)
                @if ($patient_rec->investigation != '')
                    <div style="width: 185.19px;padding: 5px;">
                        <h6 style="text-decoration: underline;font-weight: 700;font-size:12px;">Today Investigation</h6>
                        <p style="margin-top: 15px;font-size: 11px;">
                            @php
                                echo str_replace(array("\r\n", "\r", "\n"), '<br>', $patient_rec->investigation);
                            @endphp
                        </p>
                    </div>
                @endif
            @endif
            @if ($patient_rec != null)
                @if ($patient_rec->next_day_investigation != '')
                    <div style="width: 185.19px;padding: 5px;">
                        <h6 style="text-decoration: underline;font-weight: 700;font-size:12px;">Next Visit Investigation</h6>
                        <p style="margin-top: 0;font-size: 11px;">(නැවත ප්‍රතිකාර සදහා පැම්නෙන ව්ට පහත සදහන් පරික්ෂණ වාර්තා රැගෙන එන්න.)</p>
                        <p style="margin-top: 15px;font-size: 11px;border: 1px solid #000;padding: 5px;">
                            @php
                                echo str_replace(array("\r\n", "\r", "\n"), '<br>', $patient_rec->next_day_investigation);
                            @endphp
                        </p>
                    </div>
                @endif
            @endif
        </div>
        <div style="width: 100%;display:flex;">
            @if ($patient_rec != null)
                @if ($patient_rec->current_problem != '')
                    <div style="width: 185.19px;padding: 5px;">
                        <h6 style="text-decoration: underline;font-weight: 700;font-size:12px;">Current Issues</h6>
                        <p style="margin-top: 15px;font-size: 11px;">
                            @php
                                echo str_replace(array("\r\n", "\r", "\n"), '<br>', $patient_rec->current_problem);
                            @endphp
                        </p>
                    </div>
                @endif
            @endif
            @if ($patient_rec != null)
                @if ($patient_rec->clinic_followup != '')
                    <div style="width: 185.19px;padding: 5px;">
                        <h6 style="text-decoration: underline;font-weight: 700;font-size:12px;">Clinic Follow Up</h6>
                        <p style="margin-top: 15px;font-size: 11px;">
                            @php
                                echo str_replace(array("\r\n", "\r", "\n"), '<br>', $patient_rec->clinic_followup);
                            @endphp
                        </p>
                    </div>
                @endif
            @endif
        </div>
        <!-- Note section -->
        @if ($patient_rec != null)
            @if ($patient_rec->note != '')
                <div style="width: 100%;padding: 5px;hieght:auto;margin-bottom: 5px;">
                    <p class="" style="font-size: 12px;margin-bottom: 8px;"><strong>Note: </strong>&nbsp;{{ $patient_rec->note }}</p>
                </div>
            @endif
        @endif
        <!-- Note section -->
    </div>
    <script src="{{ asset('js/print.js') }}" type="text/javascript"></script>
</body>
</html>
