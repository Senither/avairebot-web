<?php

namespace App\Http\Controllers\Api;

use App\Faq;
use App\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends ApiController
{
    public function index()
    {
        return $this->sendSuccess(FaqCategory::with('faqs')->get());
    }
}
