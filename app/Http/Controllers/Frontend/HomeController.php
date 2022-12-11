<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        return view('frontend.index');
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function faq()
    {
        return view('frontend.faq');
    }
    public function book_service()
    {
        return view('frontend.bookservice');
    }
    
    public function privacy()
    {
        return view('frontend.privacy');
    }
    public function quote()
    {
        return view('frontend.quote');
    }
    public function terms()
    {
        return view('frontend.terms');
    }
}
