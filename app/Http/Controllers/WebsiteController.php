<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
	public function header(Request $request)
	{
		$lang = $request->lang;
		return view('backend.website_settings.header', compact('lang'));
	}
	public function footer(Request $request)
	{	
		$lang = $request->lang;
		return view('backend.website_settings.footer', compact('lang'));
	}
	public function pages(Request $request)
	{
		return view('backend.website_settings.pages.index');
	}
	public function shop(Request $request)
	{
		$lang = $request->lang;
		return view('backend.website_settings.shop', compact('lang'));
	}
	public function appearance(Request $request)
	{
		return view('backend.website_settings.appearance');
	}
}