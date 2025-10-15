
<div style="border: 1px solid #337ab7; padding: 10px 20px; width: 600px;">
    <h2>Xác nhận Email</h2>
    <h3>Hi: {{ $account->name }}</h3>
    <p>Cảm ơn bạn đã đăng ký tài khoản. Vui lòng nhấn vào nút bên dưới để xác nhận địa chỉ email của bạn:</p>
    <a href="{{ route('account.verify', $account->email) }}">Xác nhận Email</a>
    <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
</div>
