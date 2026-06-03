<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $table = 'purchase_requests';

    protected $fillable = [
        'pr_no',
        'title',
        'description',
        'status',
        'requested_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}