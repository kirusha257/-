<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новое бронирование</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
            border-radius: 10px;
            overflow: hidden;
        }
        .header {
            background: #1a1a1a;
            padding: 20px;
            text-align: center;
        }
        .header h2 {
            color: #d4af37;
            margin: 0;
        }
        .content {
            padding: 20px;
            background: white;
        }
        .booking-details {
            margin: 20px 0;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 8px;
        }
        .booking-details p {
            margin: 8px 0;
        }
        .btn {
            display: inline-block;
            background: #d4af37;
            color: #1a1a1a;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #999;
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🟡 Новое бронирование</h2>
        </div>
        <div class="content">
            <p>Здравствуйте!</p>
            <p>Поступила новая заявка на бронирование столика:</p>
            
            <div class="booking-details">
                <p><strong>👤 Имя:</strong> {{ $booking->guest_name }}</p>
                <p><strong>📞 Телефон:</strong> {{ $booking->phone }}</p>
                <p><strong>📧 Email:</strong> {{ $booking->email ?? 'не указан' }}</p>
                <p><strong>📅 Дата:</strong> {{ $booking->date }}</p>
                <p><strong>⏰ Время:</strong> {{ $booking->time }}</p>
                <p><strong>👥 Количество гостей:</strong> {{ $booking->guests_count }}</p>
            </div>
            
            <p>
                <a href="{{ url('/admin/login') }}" class="btn">📋 Перейти в админ-панель</a>
            </p>
        </div>
        <div class="footer">
            <p>Письмо отправлено автоматически. Пожалуйста, не отвечайте на него.</p>
            <p>© {{ date('Y') }} Ресторан Вкусно</p>
        </div>
    </div>
</body>
</html>