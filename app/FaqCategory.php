<?php

namespace App;

use App\Traits\HideTimestampsTrait;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HideTimestampsTrait;

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category');
    }
}
