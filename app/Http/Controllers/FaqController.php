<?php

namespace App\Http\Controllers;

use App\Faq;
use App\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return response([
            'status' => 200,
            'data' => FaqCategory::with('faqs')->get(),
        ]);
    }
}
