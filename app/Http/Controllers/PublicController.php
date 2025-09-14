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
    
    /**
     * Show the student dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('public.dashboard');
    }
    
    /**
     * Show the resources page for a specific bootcamp.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function resources($slug)
    {
        // In a real application, you would fetch the bootcamp by slug
        // For now, we'll just pass the slug to the view
        return view('public.resources', compact('slug'));
    }
    
    /**
     * Show the assessments page for a specific bootcamp.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function assessments($slug)
    {
        // In a real application, you would fetch the bootcamp by slug
        // For now, we'll just pass the slug to the view
        return view('public.assessments', compact('slug'));
    }
    
    /**
     * Show the projects page for a specific bootcamp.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function projects($slug)
    {
        // In a real application, you would fetch the bootcamp by slug
        // For now, we'll just pass the slug to the view
        return view('public.projects', compact('slug'));
    }
}