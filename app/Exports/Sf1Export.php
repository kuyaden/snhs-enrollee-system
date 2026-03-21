<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class Sf1Export implements WithEvents, WithTitle
{
    protected $grade, $schoolYear, $schoolName, $schoolId, $division, $district;

    public function __construct(
        $grade,
        $schoolYear = null,
        $schoolName = null,
        $schoolId = null,
        $division = null,
        $district = null
    ) {
        $this->grade = $grade;
        $this->schoolYear = $schoolYear ?? date('Y') . '-' . (date('Y') + 1);
        $this->schoolName = $schoolName ?? 'SAN ISIDRO NATIONAL HIGH SCHOOL';
        $this->schoolId = $schoolId ?? '';
        $this->division = $division ?? '';
        $this->district = $district ?? '';
    }

    public function title(): string
    {
        return 'School Form 1 (SF1)';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                /* ================= PAGE SETUP ================= */
                $sheet->getPageSetup()
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(PageSetup::PAPERSIZE_A4)
                    ->setFitToWidth(1)
                    ->setScale(100);

                /* ================= GLOBAL FONT ================= */
                $sheet->getStyle('A1:AD500')->getFont()->setName('Arial')->setSize(9);

                /* ================= COLUMN WIDTHS ================= */
                $widths = [
                    'A'=>12,'B'=>12,'C'=>35,'D'=>6,'E'=>12,'F'=>6,'G'=>12,'H'=>12,
                    'I'=>12,'J'=>15,'K'=>12,'L'=>12,'M'=>20,'N'=>12,'O'=>15,'P'=>8,
                    'Q'=>20,'R'=>8,'S'=>12,'T'=>35,'U'=>12,'V'=>15,'W'=>20,'X'=>15,
                    'Y'=>12,'Z'=>20,'AA'=>25,'AB'=>12,'AC'=>12,'AD'=>12
                ];
                foreach ($widths as $col => $w) {
                    $sheet->getColumnDimension($col)->setWidth($w);
                }

                /* ================= TITLES ================= */
                $sheet->mergeCells('A1:Z1');
                $sheet->setCellValue('A1', 'School Form 1 (SF 1) School Register');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getRowDimension(1)->setRowHeight(28);

                $sheet->mergeCells('A2:Z2');
                $sheet->setCellValue('A2', '(This replaces Form 1, Master List & STS Form 2-Family Background and Profile)');
                $sheet->getStyle('A2')->getFont()->setItalic(true)->setSize(9);
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getRowDimension(2)->setRowHeight(18);

                /* ================= HEADER INFO ================= */
                $sheet->setCellValue('D4', 'School ID');
                $sheet->setCellValue('E4', $this->schoolId);
                $sheet->setCellValue('L4', 'Division');
                $sheet->setCellValue('M4', $this->division);
                $sheet->setCellValue('S4', 'District');
                $sheet->setCellValue('T4', $this->district);

                $sheet->setCellValue('C6', 'School Name');
                $sheet->mergeCells('D6:H6');
                $sheet->setCellValue('D6', $this->schoolName);

                $sheet->setCellValue('L6', 'School Year');
                $sheet->setCellValue('M6', $this->schoolYear);

                $sheet->setCellValue('S6', 'Grade Level');
                $sheet->setCellValue('T6', $this->grade);

                $sheet->setCellValue('W6', 'Section');
                $sheet->setCellValue('X6', '');

                /* ================= TABLE HEADER ================= */
                $sheet->getRowDimension(8)->setRowHeight(30);
                $sheet->getRowDimension(9)->setRowHeight(40);

                $sheet->setCellValue('A8', 'LRN');
                $sheet->mergeCells('B8:C8');
                $sheet->setCellValue('B8', 'NAME');
                $sheet->mergeCells('B9:C9');
                $sheet->setCellValue('B9', '(Last Name, First Name, Middle Name)');

                $sheet->setCellValue('D8', 'Sex');
                $sheet->setCellValue('D9', '(M/F)');

                $sheet->mergeCells('E8:F8');
                $sheet->setCellValue('E8', 'BIRTH DATE');
                $sheet->setCellValue('E9', '(mm/dd/yyyy)');

                $sheet->setCellValue('G8', 'AGE as of');
                $sheet->setCellValue('G9', '1st Friday June');

                $sheet->setCellValue('H8', 'BIRTH PLACE');
                $sheet->setCellValue('H9', '(Province)');

                $sheet->setCellValue('J8', 'MOTHER');
                $sheet->setCellValue('J9', 'TONGUE');

                $sheet->setCellValue('K8', 'IP');
                $sheet->setCellValue('K9', '(Ethnic Group)');

                $sheet->setCellValue('L8', 'RELIGION');

                $sheet->mergeCells('M8:P8');
                $sheet->setCellValue('M8', 'ADDRESS');
                $sheet->setCellValue('M9', 'House # / Street / Sitio');
                $sheet->setCellValue('N9', 'Barangay');
                $sheet->setCellValue('O9', 'Municipality / City');
                $sheet->setCellValue('P9', 'Province');

                $sheet->mergeCells('Q8:U8');
                $sheet->setCellValue('Q8', 'PARENTS');
                $sheet->mergeCells('Q9:S9');
                $sheet->setCellValue('Q9', "Father's Name");
                $sheet->mergeCells('T9:U9');
                $sheet->setCellValue('T9', "Mother's Maiden Name");

                $sheet->mergeCells('V8:X8');
                $sheet->setCellValue('V8', 'GUARDIAN');
                $sheet->setCellValue('V9', 'Name');
                $sheet->setCellValue('W9', 'Relationship');

                $sheet->setCellValue('Y8', 'Contact Number');
                $sheet->setCellValue('Z8', 'REMARKS');
                $sheet->setCellValue('Z9', '(See legend)');

                $sheet->getStyle('A8:AA9')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);

                /* ================= DATA ================= */
                $row = 10;
                $students = Student::where('grade_level', $this->grade)
                    ->orderBy('last_name')
                    ->orderBy('first_name')
                    ->get();

                foreach ($students as $s) {

                    $sheet->getRowDimension($row)->setRowHeight(22);

                    $sheet->setCellValue("A$row", $s->lrn);
                    $sheet->mergeCells("B$row:C$row");
                    $sheet->setCellValue("B$row", strtoupper("{$s->last_name}, {$s->first_name} {$s->middle_name}"));
                    $sheet->setCellValue("D$row", strtoupper($s->sex));
                    $sheet->setCellValue("E$row", $s->birthdate ? date('m/d/Y', strtotime($s->birthdate)) : '');
                    $sheet->setCellValue("G$row", $this->calculateAgeAsOfFirstFridayJune($s->birthdate));
                    $sheet->setCellValue("H$row", strtoupper($s->birthplace ?? ''));

                    $sheet->setCellValue("J$row", strtoupper($s->mother_tongue ?? ''));
                    $sheet->setCellValue("K$row", strtoupper($s->ip ?? ''));
                    $sheet->setCellValue("L$row", strtoupper($s->religion ?? ''));

                    $sheet->setCellValue("M$row", strtoupper($s->street_address ?? ''));
                    $sheet->setCellValue("N$row", strtoupper($s->barangay ?? ''));
                    $sheet->setCellValue("O$row", strtoupper($s->municipality ?? ''));
                    $sheet->setCellValue("P$row", strtoupper($s->province ?? ''));

                    $sheet->setCellValue("Q$row", strtoupper($s->father_name ?? ''));
                    $sheet->setCellValue("T$row", strtoupper($s->mother_name ?? ''));
                    $sheet->setCellValue("V$row", strtoupper($s->guardian_name ?? ''));
                    $sheet->setCellValue("W$row", strtoupper($s->guardian_relationship ?? ''));
                    $sheet->setCellValue("Y$row", $s->contact_number ?? '');

                    $remarks = [];
                    if ($s->is_4ps) $remarks[] = 'CCT';
                    if ($s->pwd) $remarks[] = 'LWD';
                    $sheet->setCellValue("Z$row", implode(', ', $remarks));

                    $sheet->getStyle("A$row:AA$row")->applyFromArray([
                        'borders' => [
                            'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                        ],
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ],
                    ]);

                    $row++;
                }

                $sheet->getPageSetup()->setPrintArea("A1:AD" . ($row + 10));
            }
        ];
    }

    private function calculateAgeAsOfFirstFridayJune($birthDate)
    {
        if (!$birthDate) return '';
        $ref = date_create("first friday of june " . date('Y'));
        return date_diff(date_create($birthDate), $ref)->y;
    }
}
