<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Certificate of Completion</title>
    <style>
        @page { margin: 40px; }
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2933;
            background: #f8fafc;
        }
        .certificate {
            border: 6px double #1f2933;
            padding: 40px;
            height: 100%;
            box-sizing: border-box;
            background: #ffffff;
            position: relative;
        }
        .certificate h1 {
            text-align: center;
            font-size: 32px;
            letter-spacing: 8px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .subtitle {
            text-align: center;
            font-size: 18px;
            margin-bottom: 40px;
            color: #64748b;
        }
        .content {
            text-align: center;
            margin-top: 40px;
        }
        .recipient {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .details {
            margin-top: 50px;
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            position: absolute;
            bottom: 40px;
            left: 40px;
            right: 40px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #334155;
        }
        .signature {
            text-align: center;
            margin-top: 60px;
        }
        .signature-line {
            margin-top: 40px;
            border-top: 1px solid #1f2933;
            width: 220px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certificate</h1>
        <p class="subtitle">of Achievement</p>

        <div class="content">
            <p>This certificate is proudly presented to</p>
            <div class="recipient">{{ $user->name }}</div>
            <p>for successfully completing the</p>
            <div class="recipient" style="font-size: 22px;">{{ $bootcamp->title }}</div>

            <div class="details">
                <p>Batch: {{ $batch->code }}</p>
                <p>Program Duration: {{ optional($batch->start_date)->format('d M Y') }} &mdash; {{ optional($batch->end_date)->format('d M Y') }}</p>
                <p>Issued on {{ $issued_date }}</p>
                <p>Certificate ID: {{ $certificate->certificate_no }}</p>
            </div>
        </div>

        <div class="signature">
            <div class="signature-line">
                {{ config('app.name') }} Lead Instructor
            </div>
        </div>

        <div class="footer">
            <span>{{ config('app.url') }}</span>
            <span>{{ config('app.name') }}</span>
        </div>
    </div>
</body>
</html>
