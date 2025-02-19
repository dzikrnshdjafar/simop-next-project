<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'place',
        'date',
        'attachment',
        'pic_id'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            if (!$model->exists) {
                $model->uuid = (string) Uuid::uuid4();
            }
        });
    }

    public function documentations(): HasMany
    {
        return $this->hasMany(Documentation::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('j F Y');
    }

    public function pic()
    {
        return $this->belongsTo(Pic::class);
    }
}
