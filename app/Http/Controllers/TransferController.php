<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function create()
    {
        return view('Office.create');
    }
    public function dashboard()
    {
        // قم بوضع الكود الخاص بعرض لوحة التحكم هنا
        return view('Office.dashboard');
    }


    public function store(Request $request)
    {
        $request->validate([
            'sender_office' => 'required|string',
            'receiver_office' => 'required|string',
            'sender_name' => 'required|string',
            'receiver_name' => 'required|string',
            'amount' => 'required|numeric',
            'send_date' => 'required|date',
            'office_id' => 'required|exists:offices,id',
        ]);

        // إنشاء نموذج الحوالة وحفظه في قاعدة البيانات
        $transfer = Transfer::create($request->all());

        // تحديث رصيد المكتب المرسل
        $senderOffice = Office::where('name', $request->input('sender_office'))->first();
        $senderOffice->balance -= $request->input('amount');
        $senderOffice->save();

        // تحديث رصيد المكتب المستلم
        $receiverOffice = Office::where('name', $request->input('receiver_office'))->first();
        $receiverOffice->balance += $request->input('amount');
        $receiverOffice->save();

        return redirect()->route('Office.dashboard')->with('success', 'تمت إضافة الحوالة بنجاح.');
    }

    public function showTransfers()
    {
        $transfers = Transfer::all();

        return view('show', compact('transfers'));
    }

    public function showTransfersForOffice()
    {
        $office = Auth::guard('Office')->user();
        $transfers = Transfer::where('office_id', $office->id)->get();

        return view('Office.transfers', compact('transfers'));
    }

    public function showTransfers1()
    {
        $transfers = Transfer::all();

        return view('admin.Delete_transfers', compact('transfers'));
    }



    public function edit($id)
    {
        $transfer = Transfer::findOrFail($id);
        return view('Office.edittransfers', compact('transfer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sender_office' => 'required|string',
            'receiver_office' => 'required|string',
            'sender_name' => 'required|string',
            'receiver_name' => 'required|string',
            'amount' => 'required|numeric',
            'send_date' => 'required|date',
        ]);

        $transfer = Transfer::findOrFail($id);

        // تحديث الحقول المطلوبة فقط
        $transfer->update($request->only([
            'sender_office',
            'receiver_office',
            'sender_name',
            'receiver_name',
            'amount',
            'send_date',
        ]));

        return redirect()->route('Office.transfers')->with('success', 'تم التحديث بنجاح.');
    }



    public function destroy($id)
    {
        // العثور على الحوالة
        $transfer = Transfer::find($id);

        // حذف الحوالة
        $transfer->delete();
    }
}
