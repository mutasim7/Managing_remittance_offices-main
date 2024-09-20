<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تعديل سعر الصرف</title>
    <style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    }

    .container {
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
    color: #007bff;
    text-align: center;
    margin-bottom: 20px;
    }

    label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    }

    .submit-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
    }

    .submit-btn:hover {
    background-color: #0056b3;
    }

    .back-btn {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: #007bff;
    }
    </style>
</head>
<body>

<div class="container">
    <h1>تعديل سعر الصرف</h1>

    <form action="{{ route('Office.update', $exchangeRate->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- نستخدم طريقة PUT أو PATCH للتعديل -->

        <label for="office_name">اسم المكتب</label>
        <input type="text" id="office_name" name="office_name" value="{{ $exchangeRate->office_name }}" required readonly>

        <label for="publish_date">تاريخ النشر</label>
        <input type="date" id="publish_date" name="publish_date" value="{{ $exchangeRate->publish_date }}" required>

        <label for="usd_to_try">الدولار إلى التركي</label>
        <input type="number" step="0.01" id="usd_to_try" name="usd_to_try" value="{{ $exchangeRate->usd_to_try }}" required>

        <label for="try_to_usd">التركي إلى الدولار</label>
        <input type="number" step="0.01" id="try_to_usd" name="try_to_usd" value="{{ $exchangeRate->try_to_usd }}" required>

        <label for="usd_to_syp">الدولار إلى السوري</label>
        <input type="number" step="0.01" id="usd_to_syp" name="usd_to_syp" value="{{ $exchangeRate->usd_to_syp }}" required>

        <label for="syp_to_usd">السوري إلى الدولار</label>
        <input type="number" step="0.01" id="syp_to_usd" name="syp_to_usd" value="{{ $exchangeRate->syp_to_usd }}" required>

        <button type="submit" class="submit-btn">تحديث</button>
    </form>
</div>

</body>
</html>
