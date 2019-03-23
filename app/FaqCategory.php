<?php

namespace App;

use App\Traits\HideTimestampsTrait;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HideTimestampsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category');
    }
}
