<?php

namespace App\Http\Controllers;

class ScanController extends Controller
{
    /**
     * Render the QR code scanner page.
     * No auth required — the page only reads data embedded in the QR code itself.
     */
    public function index()
    {
        return view('scan');
    }
}
