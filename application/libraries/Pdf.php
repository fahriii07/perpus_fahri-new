<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {

    public function generate($html, $filename, $paper = 'A4', $orientation = 'portrait')
    {
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        // 🔥 ini yang penting biar tidak blank
        $dompdf->stream($filename, ["Attachment" => false]);
        exit;
    }
}