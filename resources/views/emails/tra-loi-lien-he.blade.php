<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Phản hồi từ quản trị viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f5f8fa;
            padding: 20px;
        }
        .email-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        .header {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }
        .content {
            font-size: 16px;
            color: #555;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            Dear {{ $contact->ho_ten ?? 'bạn' }},
        </div>

        <div class="content">
            {!! nl2br(e($noiDung)) !!}
        </div>

        <div class="content" style="margin-top: 20px;">
            Cảm ơn bạn đã góp ý
        </div>

        <div class="footer">
            Trân trọng,<br>
            <strong>Nhà sách GK</strong><br>
            SĐT:0123456789<br>
            Email: {{ config('mail.from.address') }}<br>
            Website: <a href="{{ url('/') }}">{{ url('/') }}</a>
        </div>
    </div>
</body>
</html>
