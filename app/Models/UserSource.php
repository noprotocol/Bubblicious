<?php

namespace App\Models;
use App\User;
use App\Models\Source;

use Illuminate\Database\Eloquent\Model;

class UserSource extends Model
{
    protected $fillable = [
        'user_id',
        'source_id',
    ];

    /**
     * Source user reads
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    /**
     * User reads source
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
