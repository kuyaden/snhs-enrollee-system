<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithTitle, WithStyles
{
    protected $year;
    protected $grade;
    protected $barangay;
    protected $sex;
    protected $totalStudents;
    
    // School information with your requested updates
    protected $schoolName = "SAN ISIDRO NATIONAL HIGH SCHOOL";
    protected $municipality = "Tanauan";
    protected $province = "Leyte";
    protected $schoolAddress = "San Isidro, Tanauan, Leyte";
    protected $schoolId = "300324";
    
    // Modern color scheme - professional blues
    protected $primaryBlue = '1A365D';     // Dark navy blue
    protected $secondaryBlue = '2D5EA0';   // Medium blue
    protected $accentBlue = '4A90E2';      // Light blue accent
    protected $lightGray = 'F8F9FA';       // Very light gray
    protected $headerBlue = '2C5282';      // Header blue
    protected $borderColor = 'E2E8F0';     // Light border color
    
    // Modern fonts
    protected $titleFont = 'Segoe UI';
    protected $headerFont = 'Segoe UI Semibold';
    protected $bodyFont = 'Segoe UI';

    public function __construct($year = null, $grade = null, $barangay = null, $sex = null)
    {
        $this->year = $year;
        $this->grade = $grade;
        $this->barangay = $barangay;
        $this->sex = $sex;
    }

    public function title(): string
    {
        return 'Student Registry';
    }

    public function collection()
    {
        $students = Student::query()
            ->select([
                'last_name',
                'first_name',
                'middle_name',
                'extension_name',
                'sex',
                'birthdate',
                'birthplace',
                'grade_level',
                'lrn',
                'mother_tongue',
                'ip',
                'religion',
                'is_4ps',
                'barangay',
                'municipality',
                'province',
                'father_name',
                'mother_name',
                'guardian_name',
                'contact_number',
                'enrollment_year',
                'enrollment_status',
                'pwd',
                'created_at',
                'updated_at',
            ])
            ->when($this->year, fn($q) => $q->where('enrollment_year', $this->year))
            ->when($this->grade, fn($q) => $q->where('grade_level', $this->grade))
            ->when($this->barangay, fn($q) => $q->where('barangay', $this->barangay))
            ->when($this->sex, fn($q) => $q->where('sex', $this->sex))
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->get();

        $this->totalStudents = $students->count();
        return $students;
    }

    public function map($student): array
    {
        // Format birthdate
        $birthdate = $student->birthdate ? date('m/d/Y', strtotime($student->birthdate)) : '';
        
        // Format 4Ps status - use checkboxes
        $is4ps = $student->is_4ps ? '✅' : '❌';
        
        // Format PWD status - use checkboxes
        $pwd = $student->pwd ? '✅' : '❌';
        
        // Format enrollment status
        $enrollmentStatus = $this->formatEnrollmentStatus($student->enrollment_status);
        
        // Ensure LRN is string to preserve leading zeros
        $lrn = (string) $student->lrn;
        
        // Ensure contact number is string
        $contact = $student->contact_number ? (string) $student->contact_number : '';
        
        // Format sex
        $sex = strtoupper($student->sex) == 'M' ? 'MALE' : (strtoupper($student->sex) == 'F' ? 'FEMALE' : strtoupper($student->sex));

        return [
            $student->last_name,
            $student->first_name,
            $student->middle_name,
            $student->extension_name,
            $sex,
            $birthdate,
            $student->birthplace,
            $student->grade_level,
            $lrn,
            $student->mother_tongue,
            $student->ip,
            $student->religion,
            $is4ps,
            $student->barangay,
            $student->municipality,
            $student->province,
            $student->father_name,
            $student->mother_name,
            $student->guardian_name,
            $contact,
            $student->enrollment_year,
            $enrollmentStatus,
            $pwd,
            date('m/d/Y', strtotime($student->created_at)),
            date('m/d/Y', strtotime($student->updated_at)),
        ];
    }

    public function headings(): array
    {
        return [
            'LAST NAME',
            'FIRST NAME', 
            'MIDDLE NAME',
            'EXTENSION',
            'SEX',
            'BIRTH DATE',
            'BIRTH PLACE',
            'GRADE',
            'LRN',
            'MOTHER TONGUE',
            'ETHNIC GROUP',
            'RELIGION',
            '4Ps',
            'BARANGAY',
            'MUNICIPALITY/CITY',
            'PROVINCE',
            "FATHER'S NAME",
            "MOTHER'S NAME",
            'GUARDIAN',
            'CONTACT NO.',
            'SCHOOL YEAR',
            'STATUS',
            'PWD',
            'DATE ENROLLED',
            'LAST UPDATE',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Set default row height
        $sheet->getDefaultRowDimension()->setRowHeight(20);
        
        // Set optimized column widths for modern design
        $columnWidths = [
            'A' => 16, 'B' => 16, 'C' => 16, 'D' => 10, 'E' => 10,
            'F' => 12, 'G' => 20, 'H' => 10, 'I' => 15, 'J' => 16,
            'K' => 16, 'L' => 14, 'M' => 8, 'N' => 18, 'O' => 18,
            'P' => 14, 'Q' => 22, 'R' => 22, 'S' => 22, 'T' => 16,
            'U' => 12, 'V' => 12, 'W' => 8, 'X' => 14, 'Y' => 14,
        ];
        
        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }
        
        // Wrap text for columns with longer content
        $wrapColumns = ['G', 'Q', 'R', 'S', 'N', 'O', 'P'];
        foreach ($wrapColumns as $col) {
            $sheet->getStyle($col)->getAlignment()->setWrapText(true);
        }
        
        // Center align specific columns
        $centerColumns = ['E', 'H', 'M', 'U', 'V', 'W'];
        foreach ($centerColumns as $col) {
            $sheet->getStyle($col)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Set modern page setup
                $sheet->getPageSetup()
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(PageSetup::PAPERSIZE_A4)
                    ->setFitToWidth(1)
                    ->setFitToHeight(0)
                    ->setHorizontalCentered(true);
                
                // Set margins for clean print layout
                $sheet->getPageMargins()
                    ->setTop(0.4)
                    ->setRight(0.3)
                    ->setLeft(0.3)
                    ->setBottom(0.4);
                
                // Modern header/footer
                $sheet->getHeaderFooter()
                    ->setOddHeader('&C&"' . $this->titleFont . ',Bold"&12' . $this->schoolName);
                
                $sheet->getHeaderFooter()
                    ->setOddFooter('&CPage &P of &N &R' . date('F j, Y'));
                
                /* ================= MODERN HEADER SECTION ================= */
                $sheet->insertNewRowBefore(1, 5);
                
                // Row 1: School Name with gradient effect (dark blue)
                $sheet->mergeCells('A1:Y1');
                $sheet->setCellValue('A1', $this->schoolName);
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 20,
                        'color' => ['rgb' => 'FFFFFF'],
                        'name' => $this->titleFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $this->primaryBlue],
                    ],
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => $this->accentBlue],
                        ],
                    ],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(35);
                
                // Row 2: School Address and ID with modern typography
                $sheet->mergeCells('A2:Y2');
                $sheet->setCellValue('A2', $this->schoolAddress . ' • School ID: ' . $this->schoolId);
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'size' => 11,
                        'color' => ['rgb' => '4A5568'],
                        'name' => $this->bodyFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $sheet->getRowDimension(2)->setRowHeight(22);
                
                // Row 3: Report Title with accent background
                $sheet->mergeCells('A3:Y3');
                $sheet->setCellValue('A3', 'STUDENT MASTER REGISTRY');
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'color' => ['rgb' => 'FFFFFF'],
                        'name' => $this->titleFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $this->secondaryBlue],
                    ],
                ]);
                $sheet->getRowDimension(3)->setRowHeight(30);
                
                // Row 4: Filter Information with subtle background
                $filters = [];
                if ($this->year) $filters[] = 'School Year: ' . $this->year;
                if ($this->grade) $filters[] = 'Grade: ' . $this->grade;
                if ($this->barangay) $filters[] = 'Barangay: ' . $this->barangay;
                if ($this->sex) $filters[] = 'Sex: ' . ucfirst(strtolower($this->sex));
                
                $filterText = !empty($filters) ? 'FILTERS APPLIED: ' . implode(' • ', $filters) : 'COMPLETE STUDENT REGISTRY';
                
                $sheet->mergeCells('A4:Y4');
                $sheet->setCellValue('A4', $filterText);
                $sheet->getStyle('A4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 11,
                        'color' => ['rgb' => $this->primaryBlue],
                        'name' => $this->headerFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $this->lightGray],
                    ],
                ]);
                
                // Row 5: Generation timestamp and separator
                $sheet->mergeCells('A5:Y5');
                $sheet->setCellValue('A5', 'Generated: ' . date('F j, Y') . ' at ' . date('h:i A') . ' | Department of Education - Region VIII');
                $sheet->getStyle('A5')->applyFromArray([
                    'font' => [
                        'size' => 9,
                        'color' => ['rgb' => '718096'],
                        'name' => $this->bodyFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => $this->borderColor],
                        ],
                    ],
                ]);
                
                /* ================= MODERN TABLE HEADERS ================= */
                $headerRow = 6;
                $headerRange = 'A' . $headerRow . ':Y' . $headerRow;
                
                // Modern header styling with subtle gradient effect
                $sheet->getStyle($headerRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 10,
                        'color' => ['rgb' => 'FFFFFF'],
                        'name' => $this->headerFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $this->headerBlue],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => $this->accentBlue],
                        ],
                    ],
                ]);
                
                // Set header row height
                $sheet->getRowDimension($headerRow)->setRowHeight(28);
                
                // Enable auto-filter for modern Excel feel
                $sheet->setAutoFilter($headerRange);
                
                /* ================= MODERN DATA ROWS ================= */
                $dataStartRow = $headerRow + 1;
                $dataEndRow = $dataStartRow + $this->totalStudents - 1;
                
                if ($this->totalStudents > 0) {
                    // Apply subtle alternating row colors
                    for ($row = $dataStartRow; $row <= $dataEndRow; $row++) {
                        $fillColor = ($row % 2 == 0) ? 'FFFFFF' : $this->lightGray;
                        $sheet->getStyle("A{$row}:Y{$row}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => $fillColor],
                            ],
                        ]);
                    }
                    
                    // Apply modern borders and styling
                    $dataRange = 'A' . $dataStartRow . ':Y' . $dataEndRow;
                    $sheet->getStyle($dataRange)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => $this->borderColor],
                            ],
                        ],
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                        'font' => [
                            'size' => 10,
                            'name' => $this->bodyFont,
                        ],
                    ]);
                    
                    // Center align specific columns
                    $centerColumns = ['E', 'H', 'M', 'U', 'V', 'W'];
                    foreach ($centerColumns as $col) {
                        $sheet->getStyle("{$col}{$dataStartRow}:{$col}{$dataEndRow}")
                            ->getAlignment()
                            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    }
                    
                    // Right align numeric columns
                    $rightAlignColumns = ['I', 'T'];
                    foreach ($rightAlignColumns as $col) {
                        $sheet->getStyle("{$col}{$dataStartRow}:{$col}{$dataEndRow}")
                            ->getAlignment()
                            ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                    }
                    
                    // Format date columns with modern format
                    $dateColumns = ['F', 'X', 'Y'];
                    foreach ($dateColumns as $col) {
                        $sheet->getStyle("{$col}{$dataStartRow}:{$col}{$dataEndRow}")
                            ->getNumberFormat()
                            ->setFormatCode('mm/dd/yyyy');
                        $sheet->getStyle("{$col}{$dataStartRow}:{$col}{$dataEndRow}")
                            ->getAlignment()
                            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    }
                    
                    // Format LRN column
                    $sheet->getStyle("I{$dataStartRow}:I{$dataEndRow}")
                        ->getNumberFormat()
                        ->setFormatCode('0');
                    
                    // Style checkbox columns with proper alignment
                    $checkboxColumns = ['M', 'W'];
                    foreach ($checkboxColumns as $col) {
                        $sheet->getStyle("{$col}{$dataStartRow}:{$col}{$dataEndRow}")
                            ->getAlignment()
                            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    }
                }
                
                /* ================= MODERN SUMMARY SECTION ================= */
                $summaryRow = $dataEndRow + 3;
                
                // Summary header with accent color
                $sheet->mergeCells("A{$summaryRow}:Y{$summaryRow}");
                $sheet->setCellValue("A{$summaryRow}", "REGISTRY SUMMARY");
                $sheet->getStyle("A{$summaryRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => 'FFFFFF'],
                        'name' => $this->titleFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $this->primaryBlue],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => $this->accentBlue],
                        ],
                    ],
                ]);
                $sheet->getRowDimension($summaryRow)->setRowHeight(32);
                
                $summaryRow++;
                
                // Total Students in a highlighted box
                $sheet->mergeCells("A{$summaryRow}:G{$summaryRow}");
                $sheet->setCellValue("A{$summaryRow}", "TOTAL STUDENTS:");
                $sheet->getStyle("A{$summaryRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => ['rgb' => $this->primaryBlue],
                        'name' => $this->headerFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
                
                $sheet->mergeCells("H{$summaryRow}:L{$summaryRow}");
                $sheet->setCellValue("H{$summaryRow}", $this->totalStudents);
                $sheet->getStyle("H{$summaryRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'color' => ['rgb' => $this->secondaryBlue],
                        'name' => $this->titleFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => $this->accentBlue],
                        ],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $this->lightGray],
                    ],
                ]);
                
                $summaryRow++;
                
                // Sex breakdown with modern layout
                if (!$this->sex && $this->totalStudents > 0) {
                    $maleCount = $this->getCountBySex('MALE');
                    $femaleCount = $this->getCountBySex('FEMALE');
                    
                    $sheet->mergeCells("A{$summaryRow}:G{$summaryRow}");
                    $sheet->setCellValue("A{$summaryRow}", "MALE:");
                    $sheet->mergeCells("H{$summaryRow}:L{$summaryRow}");
                    $sheet->setCellValue("H{$summaryRow}", $maleCount);
                    $sheet->getStyle("H{$summaryRow}")->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 12,
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                    
                    $sheet->mergeCells("M{$summaryRow}:Q{$summaryRow}");
                    $sheet->setCellValue("M{$summaryRow}", "FEMALE:");
                    $sheet->mergeCells("R{$summaryRow}:V{$summaryRow}");
                    $sheet->setCellValue("R{$summaryRow}", $femaleCount);
                    $sheet->getStyle("R{$summaryRow}")->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 12,
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                    
                    $summaryRow++;
                }
                
                // Modern footer section
                $footerRow = $summaryRow + 2;
                
                // Thin separator line
                $sheet->mergeCells("A{$footerRow}:Y{$footerRow}");
                $sheet->getStyle("A{$footerRow}:Y{$footerRow}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $this->borderColor],
                    ],
                ]);
                $sheet->getRowDimension($footerRow)->setRowHeight(3);
                
                $footerRow++;
                
                // Modern footer text
                $sheet->mergeCells("A{$footerRow}:Y{$footerRow}");
                $sheet->setCellValue("A{$footerRow}", "End of Student Registry • " . $this->schoolName . " • " . date('Y'));
                $sheet->getStyle("A{$footerRow}")->applyFromArray([
                    'font' => [
                        'size' => 10,
                        'color' => ['rgb' => '718096'],
                        'italic' => true,
                        'name' => $this->bodyFont,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                
                // Set print area
                $printEndRow = $footerRow;
                $sheet->getPageSetup()->setPrintArea("A1:Y{$printEndRow}");
                
                // Freeze header for better navigation
                $sheet->freezePane('A' . ($headerRow + 1));
            },
        ];
    }

    /**
     * Format enrollment status
     */
    private function formatEnrollmentStatus($status)
    {
        $statusMap = [
            'enrolled' => 'Enrolled',
            'transferred' => 'Transferred',
            'dropped' => 'Dropped',
            'graduated' => 'Graduated',
            'completed' => 'Completed',
            'active' => 'Active',
            'inactive' => 'Inactive',
        ];
        
        return $statusMap[$status] ?? ucfirst($status);
    }

    /**
     * Get count by sex for summary
     */
    private function getCountBySex($sex)
    {
        return Student::query()
            ->when($this->year, fn($q) => $q->where('enrollment_year', $this->year))
            ->when($this->grade, fn($q) => $q->where('grade_level', $this->grade))
            ->when($this->barangay, fn($q) => $q->where('barangay', $this->barangay))
            ->where('sex', strtoupper($sex))
            ->count();
    }

    /**
     * Get count by 4Ps status
     */
    private function getCountBy4Ps()
    {
        return Student::query()
            ->when($this->year, fn($q) => $q->where('enrollment_year', $this->year))
            ->when($this->grade, fn($q) => $q->where('grade_level', $this->grade))
            ->when($this->barangay, fn($q) => $q->where('barangay', $this->barangay))
            ->when($this->sex, fn($q) => $q->where('sex', $this->sex))
            ->where('is_4ps', true)
            ->count();
    }

    /**
     * Get count by PWD status
     */
    private function getCountByPWD()
    {
        return Student::query()
            ->when($this->year, fn($q) => $q->where('enrollment_year', $this->year))
            ->when($this->grade, fn($q) => $q->where('grade_level', $this->grade))
            ->when($this->barangay, fn($q) => $q->where('barangay', $this->barangay))
            ->when($this->sex, fn($q) => $q->where('sex', $this->sex))
            ->where('pwd', true)
            ->count();
    }
}