<?php

namespace sergechurkin\cform;

class Captcha
{
    public $dirtmp = './tmp/';           // Директория для каптчи
    public $font = 'Caricaturista.ttf';  // Шрифт
    public $caplen = 5;                  // Кол.символов
    public $width = 120;                 // Ширина
    public $height = 20;                 // Длина
    public $fontsize = 14;               // Размер шрифта

    public function generatecaptcha() {
        $letters = 'ABCDEFGKIJKLMNOPQRSTUVWXYZ';
        $im = imagecreatetruecolor($this->width, $this->height);
        imagesavealpha($im, true);
        $bg = imagecolorallocatealpha($im, 0, 0, 0, 127);
        imagefill($im, 0, 0, $bg);
        $captcha = '';
        for ($i = 0; $i < $this->caplen; $i++)
        {
            $captcha .= $letters[ rand(0, strlen($letters)-1) ];
            $x = ($this->width - 20) / $this->caplen * $i + 10;
            $x = rand($x, $x+4);
            $y = $this->height - ( ($this->height - $this->fontsize) / 2 );
            $curcolor = imagecolorallocate( $im, rand(0, 100), rand(0, 100), rand(0, 100) );
            $angle = rand(-25, 25);
            imagettftext($im, $this->fontsize, $angle, $x, $y, $curcolor, $this->font, $captcha[$i]);
        }
        $file = $this->dirtmp . uniqid() . '.png'; 
        imagepng($im, $file);
        return [$captcha, $file];
    }
}
