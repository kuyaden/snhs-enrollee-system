<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>School Dashboard Report</title>
<style>
    /* Formal Color Palette */
    :root {
        --primary-color: #004a99; /* Darker, professional blue */
        --secondary-color: #f0f4f7; /* Very light background for headers */
        --border-color: #cccccc; /* Light gray border */
        --text-color: #333333;
        --title-color: #1a1a1a;
    }

    body {
        font-family: 'Times New Roman', Times, serif; /* More formal font */
        margin: 20px 30px;
        font-size: 11pt; /* Slightly larger base font for formality */
        color: var(--text-color);
    }

    /* Header */
    .header-table {
        width: 100%;
        border-bottom: 3px solid var(--primary-color); /* Stronger, colored bottom line */
        margin-bottom: 20px;
        table-layout: fixed;
        page-break-inside: avoid;
    }
    .header-table td {
        vertical-align: top; /* Align content to the top */
        padding: 5px 0;
    }
    .header-table img {
        height: 60px; /* Slightly larger logos */
        max-height: 60px;
    }
    .report-title {
        margin: 0;
        font-size: 20pt; /* Larger, more impactful title */
        font-weight: bold;
        color: var(--primary-color);
        text-transform: uppercase; /* Formal title style */
        line-height: 1.2;
    }
    .report-subtitle {
        margin: 2px 0 0;
        font-size: 12pt;
        color: #555;
        line-height: 1.4;
    }

    /* Section Titles */
    h3 {
        margin-top: 25px;
        margin-bottom: 10px;
        color: var(--title-color);
        font-size: 14pt; /* Prominent section heading */
        font-weight: bold;
        border-bottom: 1px solid var(--border-color); /* Subtle separation */
        padding-bottom: 4px;
        padding-left: 0;
        text-transform: uppercase;
    }

    /* Tables */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10pt;
        margin-bottom: 25px;
    }
    table th, table td {
        border: none; /* Remove all internal borders for a cleaner look */
        border-bottom: 1px solid var(--border-color); /* Use horizontal dividers */
        padding: 8px 10px;
        text-align: left; /* Align data left for better readability (except numbers) */
    }
    table th {
        background-color: var(--secondary-color); /* Light blue-gray header background */
        color: var(--primary-color);
        font-weight: bold;
        border-top: 2px solid var(--primary-color); /* Strong top border for header */
        border-bottom: 2px solid var(--primary-color); /* Stronger bottom border for header */
        text-align: center;
    }

    /* Specific column alignments (for numbers) */
    table th:last-child, table td:last-child {
        text-align: center; /* Center numbers */
        width: 15%; /* Fix width for the count column */
    }
    table tr:nth-child(even) {
        background: #fafafa; /* Subtle zebra striping */
    }

    /* Summary Table adjustments */
    .summary-table th {
        text-align: center; /* Center headers in the summary */
    }
    .summary-table td {
        text-align: center;
        font-size: 11pt;
    }
    .total-row td {
        font-weight: bold;
        background-color: #e6f0ff; /* Light, official-looking background for totals/summary */
        color: var(--primary-color);
        border: 1px solid var(--primary-color); /* Define the box clearly */
    }

    /* Footer and Signatures */
    .footer {
        text-align: right; /* Right-align footer text for a professional look */
        margin-top: 40px;
        font-size: 9pt;
        color: #777;
        page-break-inside: avoid;
    }
    .signatures {
        margin-top: 60px; /* More space for signatures */
        display: flex;
        justify-content: space-around; /* Distribute horizontally */
        font-size: 11pt;
    }
    .signatures div {
        width: 40%; /* Slightly smaller width */
        text-align: center;
    }
    .signatures hr {
        border: 0;
        border-top: 1px solid var(--text-color); /* Darker line */
        margin: 50px 0 5px; /* More space for actual signature */
    }
    .signature-label {
        margin-top: 5px;
        font-style: italic;
    }
</style>
</head>
<body>

<table class="header-table">
    <tr>
        <td style="width:15%; text-align:left;">
            <img src="{{ public_path('images/deped.png') }}" alt="DepEd Logo">
        </td>
        <td style="width:70%; text-align:center;">
            <p class="report-title">School Dashboard Report</p>
            <p class="report-subtitle">San Isidro National High School</p>
            <p class="report-subtitle">School Year {{ now()->format('Y') }}</p> 
        </td>
        <td style="width: 15%; text-align:right;">
            <img src="{{ public_path('images/snhs.png') }}" alt="School Logo">
        </td>
    </tr>
</table>

<h3>Summary Statistics</h3>
<table class="summary-table">
    <thead>
        <tr>
            <th>Total Students</th>
            <th>Male</th>
            <th>Female</th>
            <th>4Ps Beneficiaries</th>
        </tr>
    </thead>
    <tbody>
        <tr class="total-row">
            <td>{{ $students->count() }}</td>
            <td>{{ $students->where('sex', 'Male')->count() }}</td>
            <td>{{ $students->where('sex', 'Female')->count() }}</td>
            <td>{{ $students->where('is_4ps', true)->count() }}</td>
        </tr>
    </tbody>
</table>

<h3>Students by Barangay</h3>
<table>
    <thead>
        <tr>
            <th style="text-align:left;">Barangay</th> 
            <th>No. of Students</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students->groupBy('barangay') as $barangay => $group)
        <tr>
            <td style="text-align:left;">{{ $barangay }}</td>
            <td>{{ $group->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Students by Grade Level</h3>
<table>
    <thead>
        <tr>
            <th style="text-align:left;">Grade Level</th>
            <th>No. of Students</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students->groupBy('grade_level') as $grade => $group)
        <tr>
            <td style="text-align:left;">{{ $grade }}</td>
            <td>{{ $group->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Students by Age</h3>
<table>
    <thead>
        <tr>
            <th style="text-align:left;">Age</th>
            <th>No. of Students</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students->groupBy('age') as $age => $group)
        <tr>
            <td style="text-align:left;">{{ $age }}</td>
            <td>{{ $group->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Students by Enrollment Status</h3>
<table>
    <thead>
        <tr>
            <th style="text-align:left;">Status</th>
            <th>No. of Students</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students->groupBy('enrollment_status') as $status => $group)
        <tr>
            <td style="text-align:left;">{{ $status }}</td>
            <td>{{ $group->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="signatures">
    <div>
        <hr>
        <p class="signature-label">Prepared by</p>
    </div>
    <div>
        <hr>
        <p class="signature-label">Verified by</p>
    </div>
</div>

<div class="footer">
    Generated on **{{ now()->format('F d, Y') }}** | Page <span class="pageNumber"></span> of <span class="totalPages"></span>
</div>

</body>
</html>