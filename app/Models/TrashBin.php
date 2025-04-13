<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class TrashBin extends Model
{
    // protected $fillable = [
    //    'user_id'
    // ];
    // public function trashBins()
    // {
    //     return $this->hasMany(TrashBin::class);
    // }

    protected $fillable = ['user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

}
