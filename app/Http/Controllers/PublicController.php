<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Show the homepage for the public site.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('public.homepage');
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('public.contact');
    }

    /**
     * Show the bootcamps page.
     *
     * @return \Illuminate\View\View
     */
    public function bootcamps()
    {
        return view('public.bootcamps');
    }

    /**
     * Show a specific bootcamp details page.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function bootcamp($slug)
    {
        // In a real application, you would fetch the bootcamp by slug
        // For now, we'll just pass the slug to the view
        return view('public.bootcamp-details', compact('slug'));
    }
}