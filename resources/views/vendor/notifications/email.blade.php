<x-mail::message>
<img src={{ asset('images/login/mail.png') }} alt="Logo" style="width:120px;margin:auto;display:block;">

# Xin chào!

Bạn nhận được email này vì chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn tại <b>{{ config('app.name') }}</b>.

@component('mail::button', ['url' => $actionUrl, 'color' => 'success'])
Đặt lại mật khẩu
@endcomponent

Nếu bạn không yêu cầu, bạn có thể bỏ qua email này.<br>
Liên hệ hỗ trợ: <a href="mailto:quanvo1160@gmail.com">quanvo1160@gmail.com</a>

Trân trọng,<br>
{{ config('app.name') }}
</x-mail::message>
