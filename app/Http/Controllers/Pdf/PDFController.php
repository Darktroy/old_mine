<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        $user = auth()->user();
        $PDF = app('dompdf.wrapper');

        /** @var PDF $PDF */
        $pdf = $PDF->loadView('pdf.pdf', ['user' => $user]);

        return $pdf->download('profile.pdf');
    }
}
