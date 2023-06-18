<?php
require('fpdf/fpdf.php');
class PDF extends FPDF
{
    function Header(){
        $this->setFont("Arial","B",12);
        $this->Cell(0,20,"Sammy ndung'u",0,1,"C");
    }
    function Body(){
        $this->setFont("Arial","B",12);
        $this->Cell(0,10,"Welcome to iSam Solutions",0,1,"C");
        for($i=0;$i<200;$i++)
        {
            $this->Cell(0,10,"Line ".$i,0,1);
        }
    }
    function Footer(){
        $this->setY(-20);
        $this->setFont("Arial","B",12);
        $this->Cell(0,20,"Page- ".$this->PageNo(),0,0,"C");
        $this->setY(-10);
        $this->setFont("Arial","I",7);
        $this->Cell(0,10,"Created by: iSam Solutions",0,1,"R");
    }
}
$pdf = new PDF();
$pdf->Addpage();
$pdf->Body();
$pdf->output();

?>