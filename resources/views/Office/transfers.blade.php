<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>عرض الحوالات</title>
    <style>

    .container {
        margin-top: 20px;
    }

    h1 {
        color: #333;
        text-align: center
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .table th {
        background-color: #f2f2f2;
    }

    p {
        color: #777;
    }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    @section('content')
    <div class="container">
        <h1>عرض الحوالات</h1>

        @if (count($transfers) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>المكتب المرسل</th>
                        <th>المرسل</th>
                        <th>المكتب المستقبل</th>
                        <th>المستلم</th>
                        <th>المبلغ</th>
                        <th>تاريخ الإرسال</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfers as $transfer)
                        <tr>
                            <td>{{ $transfer->sender_office }}</td>
                            <td>{{ $transfer->sender_name }}</td>
                            <td>{{ $transfer->receiver_office }}</td>
                            <td>{{ $transfer->receiver_name }}</td>
                            <td>{{ $transfer->amount }}</td>
                            <td>{{ $transfer->send_date }}</td>
                            <td>
                                <a href="{{ route('Office.edittransfers', $transfer->id) }}" class="btn btn-primary">تعديل</a>
                                <form action="{{ route('transfers.delete', $transfer->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('هل أنت متأكد؟')" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>لا توجد حوالات حالياً.</p>
        @endif
    </div>
</body>
</html>
