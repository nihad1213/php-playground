<?php

require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\SimpleType\Jc;
use Mpdf\Mpdf;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request method');
}

$data = [
    'full_name' => $_POST['full_name'] ?? '',
    'email' => $_POST['email'] ?? '',
    'phone' => $_POST['phone'] ?? '',
    'location' => $_POST['location'] ?? '',
    'website' => $_POST['website'] ?? '',
    'summary' => $_POST['summary'] ?? '',
    'job_title_1' => $_POST['job_title_1'] ?? '',
    'company_1' => $_POST['company_1'] ?? '',
    'start_date_1' => $_POST['start_date_1'] ?? '',
    'end_date_1' => $_POST['end_date_1'] ?? '',
    'job_description_1' => $_POST['job_description_1'] ?? '',
    'degree' => $_POST['degree'] ?? '',
    'institution' => $_POST['institution'] ?? '',
    'graduation_year' => $_POST['graduation_year'] ?? '',
    'gpa' => $_POST['gpa'] ?? '',
    'skills' => $_POST['skills'] ?? '',
];

$format = $_POST['format'] ?? 'word';

if ($format === 'pdf') {
    generatePDF($data);
} else {
    generateWord($data);
}

function generateWord($data) {
    $phpWord = new PhpWord();
    
    $properties = $phpWord->getDocInfo();
    $properties->setCreator($data['full_name']);
    $properties->setTitle('Resume - ' . $data['full_name']);
    
    $section = $phpWord->addSection([
        'marginLeft' => 1000,
        'marginRight' => 1000,
        'marginTop' => 1000,
        'marginBottom' => 1000,
    ]);
    
    $phpWord->addFontStyle('nameStyle', [
        'name' => 'Calibri',
        'size' => 24,
        'bold' => true,
        'color' => '2c3e50'
    ]);
    
    $phpWord->addFontStyle('headingStyle', [
        'name' => 'Calibri',
        'size' => 14,
        'bold' => true,
        'color' => '2c3e50'
    ]);
    
    $phpWord->addFontStyle('contactStyle', [
        'name' => 'Calibri',
        'size' => 10,
        'color' => '555555'
    ]);
    
    $phpWord->addFontStyle('normalStyle', [
        'name' => 'Calibri',
        'size' => 11,
        'color' => '333333'
    ]);
    
    $phpWord->addFontStyle('boldStyle', [
        'name' => 'Calibri',
        'size' => 11,
        'bold' => true,
        'color' => '2c3e50'
    ]);
    
    $phpWord->addFontStyle('italicStyle', [
        'name' => 'Calibri',
        'size' => 11,
        'italic' => true,
        'color' => '555555'
    ]);
    
    $phpWord->addFontStyle('dateStyle', [
        'name' => 'Calibri',
        'size' => 10,
        'color' => '777777'
    ]);
    
    $phpWord->addParagraphStyle('headerPara', [
        'alignment' => Jc::START,
        'spaceAfter' => 100,
        'spaceBefore' => 0,
        'borderBottomSize' => 18,
        'borderBottomColor' => '3498db',
    ]);
    
    $phpWord->addParagraphStyle('sectionPara', [
        'alignment' => Jc::START,
        'spaceAfter' => 120,
        'spaceBefore' => 240,
        'borderLeftSize' => 18,
        'borderLeftColor' => '3498db',
        'indentation' => ['left' => 200],
        'shading' => [
            'fill' => 'ecf0f1'
        ]
    ]);
    
    $section->addText(
        $data['full_name'],
        'nameStyle',
        'headerPara'
    );
    
    $contactText = [];
    if ($data['email']) $contactText[] = $data['email'];
    if ($data['phone']) $contactText[] = $data['phone'];
    if ($data['location']) $contactText[] = $data['location'];
    
    if (!empty($contactText)) {
        $section->addText(
            implode(' | ', $contactText),
            'contactStyle',
            ['spaceAfter' => 60]
        );
    }
    
    if ($data['website']) {
        $section->addText(
            $data['website'],
            'contactStyle',
            ['spaceAfter' => 200]
        );
    }
    
    if ($data['summary']) {
        $section->addText(
            'PROFESSIONAL SUMMARY',
            'headingStyle',
            'sectionPara'
        );
        
        $section->addText(
            $data['summary'],
            'normalStyle',
            ['alignment' => Jc::BOTH, 'spaceAfter' => 200]
        );
    }
    
    if ($data['job_title_1']) {
        $section->addText(
            'WORK EXPERIENCE',
            'headingStyle',
            'sectionPara'
        );
        
        $section->addText(
            $data['job_title_1'],
            'boldStyle',
            ['spaceAfter' => 60]
        );
        
        $section->addText(
            $data['company_1'],
            'italicStyle',
            ['spaceAfter' => 60]
        );
        
        $section->addText(
            $data['start_date_1'] . ' - ' . $data['end_date_1'],
            'dateStyle',
            ['spaceAfter' => 120]
        );
        
        if ($data['job_description_1']) {
            $section->addText(
                $data['job_description_1'],
                'normalStyle',
                ['alignment' => Jc::BOTH, 'spaceAfter' => 200]
            );
        }
    }
    
    if ($data['degree']) {
        $section->addText(
            'EDUCATION',
            'headingStyle',
            'sectionPara'
        );
        
        $section->addText(
            $data['degree'],
            'boldStyle',
            ['spaceAfter' => 60]
        );
        
        $section->addText(
            $data['institution'],
            'italicStyle',
            ['spaceAfter' => 60]
        );
        
        $eduDetails = $data['graduation_year'];
        if ($data['gpa']) {
            $eduDetails .= ' | GPA: ' . $data['gpa'];
        }
        $section->addText(
            $eduDetails,
            'dateStyle',
            ['spaceAfter' => 200]
        );
    }
    
    if ($data['skills']) {
        $section->addText(
            'SKILLS',
            'headingStyle',
            'sectionPara'
        );
        
        $skills = array_map('trim', explode(',', $data['skills']));
        $skillsText = implode(' • ', array_filter($skills));
        
        $section->addText(
            $skillsText,
            'normalStyle',
            ['spaceAfter' => 200]
        );
    }
    
    $filename = sanitizeFilename($data['full_name']) . '_Resume.docx';
    $tempFile = sys_get_temp_dir() . '/' . $filename;
    
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($tempFile);
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($tempFile));
    header('Cache-Control: max-age=0');
    
    readfile($tempFile);
    unlink($tempFile);
    exit;
}

function generatePDF($data) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { 
                font-family: Arial, Helvetica, sans-serif; 
                font-size: 11pt; 
                line-height: 1.6; 
                color: #333;
                margin: 0;
                padding: 20px;
            }
            h1 { 
                font-size: 28pt; 
                margin-bottom: 8px; 
                color: #1a1a1a; 
                border-bottom: 3px solid #2563eb;
                padding-bottom: 8px;
            }
            h2 { 
                font-size: 14pt; 
                margin-top: 20px; 
                margin-bottom: 10px; 
                color: #1a1a1a; 
                background-color: #f3f4f6; 
                padding: 8px 8px 8px 12px; 
                border-left: 4px solid #2563eb;
            }
            .contact-info { 
                margin-bottom: 20px; 
                color: #555; 
                line-height: 1.8;
                font-size: 10pt;
            }
            .contact-info p { margin: 2px 0; }
            .section { margin-bottom: 20px; }
            .job-entry, .education-entry { 
                margin-bottom: 15px;
            }
            .job-title, .degree { 
                font-weight: bold; 
                font-size: 12pt; 
                color: #1a1a1a; 
                margin-bottom: 4px;
            }
            .company, .institution { 
                font-style: italic; 
                color: #555; 
                margin-top: 2px;
                margin-bottom: 2px;
            }
            .dates { 
                color: #777; 
                font-size: 10pt; 
                margin-top: 2px;
                margin-bottom: 8px;
            }
            .description { 
                margin-top: 8px; 
                text-align: justify;
                line-height: 1.5;
            }
            .skills-list { 
                margin-top: 8px; 
                line-height: 2;
            }
            .skill-item { 
                display: inline-block; 
                background-color: #dbeafe; 
                padding: 5px 12px; 
                margin: 3px; 
                border-radius: 4px; 
                color: #1e40af;
                font-size: 10pt;
            }
        </style>
    </head>
    <body>';
    
    $html .= '<h1>' . htmlspecialchars($data['full_name']) . '</h1>';
    
    $html .= '<div class="contact-info">';
    $contacts = [];
    if ($data['email']) $contacts[] = htmlspecialchars($data['email']);
    if ($data['phone']) $contacts[] = htmlspecialchars($data['phone']);
    if ($data['location']) $contacts[] = htmlspecialchars($data['location']);
    if ($contacts) $html .= '<p>' . implode(' | ', $contacts) . '</p>';
    if ($data['website']) $html .= '<p>' . htmlspecialchars($data['website']) . '</p>';
    $html .= '</div>';
    
    if ($data['summary']) {
        $html .= '<div class="section">';
        $html .= '<h2>PROFESSIONAL SUMMARY</h2>';
        $html .= '<p>' . nl2br(htmlspecialchars($data['summary'])) . '</p>';
        $html .= '</div>';
    }
    
    if ($data['job_title_1']) {
        $html .= '<div class="section">';
        $html .= '<h2>WORK EXPERIENCE</h2>';
        $html .= '<div class="job-entry">';
        $html .= '<div class="job-title">' . htmlspecialchars($data['job_title_1']) . '</div>';
        $html .= '<div class="company">' . htmlspecialchars($data['company_1']) . '</div>';
        $html .= '<div class="dates">' . htmlspecialchars($data['start_date_1']) . ' - ' . htmlspecialchars($data['end_date_1']) . '</div>';
        if ($data['job_description_1']) {
            $html .= '<div class="description">' . nl2br(htmlspecialchars($data['job_description_1'])) . '</div>';
        }
        $html .= '</div>';
        $html .= '</div>';
    }
    
    if ($data['degree']) {
        $html .= '<div class="section">';
        $html .= '<h2>EDUCATION</h2>';
        $html .= '<div class="education-entry">';
        $html .= '<div class="degree">' . htmlspecialchars($data['degree']) . '</div>';
        $html .= '<div class="institution">' . htmlspecialchars($data['institution']) . '</div>';
        $dateGpa = htmlspecialchars($data['graduation_year']);
        if ($data['gpa']) $dateGpa .= ' | GPA: ' . htmlspecialchars($data['gpa']);
        $html .= '<div class="dates">' . $dateGpa . '</div>';
        $html .= '</div>';
        $html .= '</div>';
    }
    
    if ($data['skills']) {
        $html .= '<div class="section">';
        $html .= '<h2>SKILLS</h2>';
        $html .= '<div class="skills-list">';
        $skills = array_map('trim', explode(',', $data['skills']));
        foreach ($skills as $skill) {
            if ($skill) {
                $html .= '<span class="skill-item">' . htmlspecialchars($skill) . '</span>';
            }
        }
        $html .= '</div>';
        $html .= '</div>';
    }
    
    $html .= '</body></html>';
    
    try {
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);
        
        $mpdf->SetTitle('Resume - ' . $data['full_name']);
        $mpdf->SetAuthor($data['full_name']);
        $mpdf->WriteHTML($html);
        
        $filename = sanitizeFilename($data['full_name']) . '_Resume.pdf';
        $mpdf->Output($filename, 'D'); // 'D' = Download
        
    } catch (\Mpdf\MpdfException $e) {
        die('Error generating PDF: ' . $e->getMessage());
    }
    
    exit;
}

function sanitizeFilename($filename) {
    $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
    return $filename ?: 'Resume';
}
?>