<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
    protected $table = 'exchange_rates';
    protected $fillable = [
        'office_name',
        'publish_date',
        'usd_to_try',
        'try_to_usd',
        'usd_to_syp',
        'syp_to_usd',
        'office_id',
    ];

    public function office() {
        return $this->belongsTo(Office::class);
    }

    // public function Admin() {
    //     return $this->belongsTo(Admin::class);
    // }
}
