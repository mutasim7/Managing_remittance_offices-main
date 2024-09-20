<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $table = 'transfers';
    protected $fillable = [
        'sender_office',
        'receiver_office',
        'sender_name',
        'receiver_name',
        'amount',
        'send_date',
        'office_id',
    ];

    public function office() {
        return $this->belongsTo(Office::class);
    }

    // public function Admin() {
    //     return $this->belongsTo(Admin::class);
    // }
}
