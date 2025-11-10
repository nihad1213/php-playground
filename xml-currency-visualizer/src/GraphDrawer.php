<?php

declare(strict_types=1);

class GraphDrawer
{
    private int $width;
    private int $height;
    private int $padding;
    private int $fontSize;

    public function __construct(
        int $width = 1200,
        int $height = 600,
        int $padding = 60,
        int $fontSize = 3
    ) {
        $this->width = $width;
        $this->height = $height;
        $this->padding = $padding;
        $this->fontSize = $fontSize;
    }

    public function draw(array $rates, string $outputPath): void
    {
        $directory = dirname($outputPath);
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true)) {
                throw new Exception("Failed to create directory: $directory");
            }
        }

        $image = imagecreatetruecolor($this->width, $this->height);
        
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        $blue = imagecolorallocate($image, 70, 130, 180);
        $gray = imagecolorallocate($image, 200, 200, 200);
        
        imagefill($image, 0, 0, $white);
        
        $chartWidth = $this->width - (2 * $this->padding);
        $chartHeight = $this->height - (2 * $this->padding);
        
        $maxRate = max($rates);
        
        $barCount = count($rates);
        $barWidth = floor($chartWidth / $barCount) - 2;
        
        $title = "EUR Exchange Rates - " . date('Y-m-d');
        $titleWidth = imagefontwidth($this->fontSize) * strlen($title);
        imagestring($image, $this->fontSize, (int)(($this->width - $titleWidth) / 2), 10, $title, $black);
        
        imageline($image, $this->padding, $this->padding, $this->padding, $this->height - $this->padding, $black);
        imageline($image, $this->padding, $this->height - $this->padding, $this->width - $this->padding, $this->height - $this->padding, $black);
        
        $x = $this->padding + 5;
        foreach ($rates as $currency => $rate) {
            $barHeight = ($rate / $maxRate) * $chartHeight;
            $y = $this->height - $this->padding - $barHeight;
            
            imagefilledrectangle($image, (int)$x, (int)$y, (int)($x + $barWidth), $this->height - $this->padding, $blue);
            
            imagestring($image, 2, (int)$x, $this->height - $this->padding + 5, $currency, $black);
            
            if ($barHeight > 20) {
                $rateText = number_format($rate, 2);
                imagestring($image, 1, (int)$x, (int)($y - 12), $rateText, $black);
            }
            
            $x += $barWidth + 2;
        }
        
        $steps = 5;
        for ($i = 0; $i <= $steps; $i++) {
            $value = ($maxRate / $steps) * $i;
            $y = $this->height - $this->padding - (($value / $maxRate) * $chartHeight);
            
            imageline($image, $this->padding, (int)$y, $this->width - $this->padding, (int)$y, $gray);
            
            $label = number_format($value, 1);
            imagestring($image, 2, 5, (int)($y - 6), $label, $black);
        }
        
        imagepng($image, $outputPath);
        imagedestroy($image);
    }

    public function output(array $rates): void
    {
        $image = imagecreatetruecolor($this->width, $this->height);
        
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        $blue = imagecolorallocate($image, 70, 130, 180);
        $gray = imagecolorallocate($image, 200, 200, 200);
        
        imagefill($image, 0, 0, $white);
        
        $chartWidth = $this->width - (2 * $this->padding);
        $chartHeight = $this->height - (2 * $this->padding);
        
        $maxRate = max($rates);
        
        $barCount = count($rates);
        $barWidth = floor($chartWidth / $barCount) - 2;
        
        $title = "EUR Exchange Rates - " . date('Y-m-d');
        $titleWidth = imagefontwidth($this->fontSize) * strlen($title);
        imagestring($image, $this->fontSize, (int)(($this->width - $titleWidth) / 2), 10, $title, $black);
        
        imageline($image, $this->padding, $this->padding, $this->padding, $this->height - $this->padding, $black);
        imageline($image, $this->padding, $this->height - $this->padding, $this->width - $this->padding, $this->height - $this->padding, $black);
        
        $x = $this->padding + 5;
        foreach ($rates as $currency => $rate) {
            $barHeight = ($rate / $maxRate) * $chartHeight;
            $y = $this->height - $this->padding - $barHeight;
            
            imagefilledrectangle($image, (int)$x, (int)$y, (int)($x + $barWidth), $this->height - $this->padding, $blue);
            
            imagestring($image, 2, (int)$x, $this->height - $this->padding + 5, $currency, $black);
            
            if ($barHeight > 20) {
                $rateText = number_format($rate, 2);
                imagestring($image, 1, (int)$x, (int)($y - 12), $rateText, $black);
            }
            
            $x += $barWidth + 2;
        }
        
        $steps = 5;
        for ($i = 0; $i <= $steps; $i++) {
            $value = ($maxRate / $steps) * $i;
            $y = $this->height - $this->padding - (($value / $maxRate) * $chartHeight);
            
            imageline($image, $this->padding, (int)$y, $this->width - $this->padding, (int)$y, $gray);
            
            $label = number_format($value, 1);
            imagestring($image, 2, 5, (int)($y - 6), $label, $black);
        }
        
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
}