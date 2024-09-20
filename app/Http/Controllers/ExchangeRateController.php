<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Auth;

class ExchangeRateController extends Controller
{
    public function create()
    {
        return view('Office.create1');
    }

    public function store(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string',
            'publish_date' => 'required|date',
            'usd_to_try' => 'required|numeric',
            'try_to_usd' => 'required|numeric',
            'usd_to_syp' => 'required|numeric',
            'syp_to_usd' => 'required|numeric',
            'office_id' => 'required',
        ]);

        // إضافة بيانات 'office_id' مع باقي البيانات
        ExchangeRate::create($request->all());

        return redirect()->route('show1')->with('success', 'تمت إضافة أسعار الصرف بنجاح.');
    }


    public function showAllRates()
    {
        $exchangeRates = ExchangeRate::all();
        //return response()->json(['exchangeRates' => $exchangeRates]);
        return view('show1', compact('exchangeRates'));
    }
    public function showAllRates1()
    {
        $exchangeRates = ExchangeRate::all();
        //return response()->json(['exchangeRates' => $exchangeRates]);
        return view('admin.Delete_prices', compact('exchangeRates'));
    }

    public function showAllRatesforOffice()
    {
        // جلب المكتب المسجل دخوله
        $office = Auth::guard('Office')->user();

        // جلب أسعار الصرف الخاصة بالمكتب فقط
        $exchangeRates = ExchangeRate::where('office_id', $office->id)->get();

        // تمرير البيانات إلى الـ view
        return view('Office.exchangeRates', compact('exchangeRates'));
    }


    public function edit($id)
    {
        $exchangeRate = ExchangeRate::findOrFail($id);
        return view('Office.editexchangeRate', compact('exchangeRate'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'office_name' => 'required|string',
        'publish_date' => 'required|date',
        'usd_to_try' => 'required|numeric',
        'try_to_usd' => 'required|numeric',
        'usd_to_syp' => 'required|numeric',
        'syp_to_usd' => 'required|numeric',
    ]);

    $exchangeRate = ExchangeRate::findOrFail($id);

    // تحديث الحقول المطلوبة فقط
    $exchangeRate->update($request->only([
        'office_name',
        'publish_date',
        'usd_to_try',
        'try_to_usd',
        'usd_to_syp',
        'syp_to_usd'
    ]));

    return redirect()->route('Office.exchangeRates')->with('success', 'تم التحديث بنجاح.');
}



    public function destroy($id)
    {
        // العثور على سجل الصرف بواسطة الهوية
        $exchangeRate = ExchangeRate::find($id);

        // التحقق من وجود السجل قبل حذفه
        if ($exchangeRate) {
            // حذف السجل
            $exchangeRate->delete();

        } else {
            // يمكنك التعامل مع عدم العثور على السجل هنا
        }
    }
}
