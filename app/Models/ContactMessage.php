<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    protected $fillable = ['user_id', 'nom', 'email', 'telephone', 'sujet', 'message', 'est_lu'];

    protected function casts(): array
    {
        return ['est_lu' => 'boolean'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
