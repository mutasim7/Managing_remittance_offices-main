<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الحوالة</title>
    <style>
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>تعديل الحوالة</h1>
    <form action="{{ route('transfers.update', $transfer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="sender_office">المكتب المرسل</label>
            <input type="text" name="sender_office" id="sender_office" value="{{ $transfer->sender_office }}" required readonly>
        </div>

        <div class="form-group">
            <label for="sender_name">اسم المرسل</label>
            <input type="text" name="sender_name" id="sender_name" value="{{ $transfer->sender_name }}" required>
        </div>

        <div class="form-group">
            <label for="receiver_office">المكتب المستقبل</label>
            <input type="text" name="receiver_office" id="receiver_office" value="{{ $transfer->receiver_office }}" required>
        </div>

        <div class="form-group">
            <label for="receiver_name">اسم المستلم</label>
            <input type="text" name="receiver_name" id="receiver_name" value="{{ $transfer->receiver_name }}" required>
        </div>

        <div class="form-group">
            <label for="amount">المبلغ</label>
            <input type="number" name="amount" id="amount" value="{{ $transfer->amount }}" required>
        </div>

        <div class="form-group">
            <label for="send_date">تاريخ الإرسال</label>
            <input type="date" name="send_date" id="send_date" value="{{ $transfer->send_date }}" required>
        </div>

        <button type="submit" class="btn">تحديث</button>
    </form>
</div>

</body>
</html>
