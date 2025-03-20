<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JasperPHP\JasperPHP as JasperPHP;
use App\Computer;

class ReportController extends Controller
{
    public function index()
    {
    	return view('report.index');
    }

    public function computerHardwareReport($id)
    {
        $jasper = new JasperPHP;
        $jasper->process(
            base_path('rpt/computer_report.jrxml'),
            false,
            ['pdf'],
            ['computer_id' => $id],
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'comlog',
                'port' => 3306
            )
        )->execute();

        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="HARDWARE_REPORT_'.date('Ymd').'.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile(base_path('rpt/computer_report.pdf'));
    }

    public function getComputerHostnames()
    {
        $comHostnames = Computer::all();

        return $comHostnames;
    }
}
