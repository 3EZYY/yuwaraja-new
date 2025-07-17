<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Get active FAQs for homepage display
     */
    public function getActiveFaqs()
    {
        return Faq::active()->ordered()->get();
    }

    /**
     * Get all FAQs (for admin purposes)
     */
    public function getAllFaqs()
    {
        return Faq::ordered()->get();
    }
}
