<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System - Print</title>
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background: #fff;
            padding: 20px;
            line-height: 1.6;
        }

        .print-container {
            max-width: 100%;
            margin: 0 auto;
            background: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #666;
        }

        .filter-info {
            background: #f5f5f5;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 13px;
        }

        .filter-info strong {
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table thead {
            background: #2c3e50;
            color: #fff;
        }

        .table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            border: 1px solid #ddd;
        }

        .table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 12px;
        }

        .table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .table tbody tr:hover {
            background: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .date-badge {
            background: #e3f2fd;
            color: #1565c0;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 500;
        }

        .signature-section {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .signature-box {
            width: 25%;
            border-top: 1px solid #333;
            text-align: center;
            font-size: 11px;
            margin-top: 40px;
        }

        @media print {
            body {
                padding: 0;
            }
            .print-container {
                box-shadow: none;
            }
            .no-print {
                display: none;
            }
            .table thead {
                background: #2c3e50 !important;
                color: #fff !important;
            }
            .table th {
                background: #2c3e50 !important;
                color: #fff !important;
            }
            tr {
                page-break-inside: avoid;
            }
        }

        .btn-print {
            background: #0066cc;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .btn-print:hover {
            background: #0052a3;
        }
    </style>
</head>
<body>
    <div class="print-container">
        <!-- Header -->
        <div class="header">
            <h1>Inventory Management System</h1>
            <p>Property Inventory Report</p>
        </div>

        <!-- Print Button -->
        <button class="btn-print no-print" onclick="window.print()">
            <i class="fa-solid fa-print"></i> Print Report
        </button>

        <!-- Filter Information -->
        @if($startdate || $enddate || $officeInfo)
        <div class="filter-info">
            <div>
                @if($startdate || $enddate)
                    <strong>Date Range:</strong> 
                    {{ $startdate ? \Carbon\Carbon::parse($startdate)->format('M d, Y') : 'N/A' }}
                    -
                    {{ $enddate ? \Carbon\Carbon::parse($enddate)->format('M d, Y') : 'N/A' }}
                @endif
                
                @if($officeInfo)
                    <br><strong>Office:</strong> {{ $officeInfo->office ?? 'N/A' }}
                @endif
                
                <br><strong>Generated:</strong> {{ \Carbon\Carbon::now()->format('M d, Y H:i A') }}
            </div>
        </div>
        @endif

        <!-- Data Table -->
        @if($properties->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 10%;">Article/Item</th>
                        <th style="width: 12%;">Description</th>
                        <th style="width: 11%;">Property No</th>
                        <th style="width: 8%;">Date Acquired</th>
                        <th style="width: 8%;">Unit Value</th>
                        <th style="width: 8%;">Specification</th>
                        <th style="width: 8%;">UOM</th>
                        <th style="width: 6%;">Qty/Card</th>
                        <th style="width: 8%;">Qty/Count</th>
                        <th style="width: 10%;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $index => $property)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $property->article?->article_name ?? 'N/A' }}</td>
                        <td>{{ $property->article_desc ?? 'N/A' }}</td>
                        <td class="text-center">{{ $property->property_no ?? 'N/A' }}</td>
                        <td class="text-center">
                            @if($property->date_acquired)
                                <span class="date-badge">{{ \Carbon\Carbon::parse($property->date_acquired)->format('M d, Y') }}</span>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="text-right">₱ {{ number_format($property->unit_value ?? 0, 2) }}</td>
                        <td>{{ $property->specification ?? 'N/A' }}</td>
                        <td class="text-center">{{ $property->unit_of_measurement ?? 'N/A' }}</td>
                        <td class="text-center">{{ $property->quantitycard ?? 'N/A' }}</td>
                        <td class="text-center">{{ $property->quantityphysicalcount ?? 'N/A' }}</td>
                        <td>{{ $property->remarks ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Summary -->
            <div style="margin-top: 30px; padding: 15px; background: #f5f5f5; border-radius: 4px;">
                <div style="display: flex; justify-content: space-between; font-weight: 600;">
                    <span>Total Items: <strong>{{ $properties->count() }}</strong></span>
                    <span>Total Value: <strong>₱ {{ number_format($properties->sum('unit_value') ?? 0, 2) }}</strong></span>
                </div>
            </div>

            <!-- Signature Section -->
            <div class="signature-section">
                <div class="signature-box">
                    Prepared by<br><br>
                    ____________________<br>
                    <small>Name & Signature</small>
                </div>
                <div class="signature-box">
                    Noted by<br><br>
                    ____________________<br>
                    <small>Name & Signature</small>
                </div>
                <div class="signature-box">
                    Approved by<br><br>
                    ____________________<br>
                    <small>Name & Signature</small>
                </div>
            </div>
        @else
            <div class="empty-state">
                <h3>No records found</h3>
                <p>No inventory items match the selected filters.</p>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>This is a system-generated report. Printed on {{ \Carbon\Carbon::now()->format('F d, Y \a\t H:i A') }}</p>
        </div>
    </div>

    <script>
        // Auto-open print dialog when page loads
        window.addEventListener('load', function() {
            // Uncomment to auto-print on load
            // window.print();
        });
    </script>
</body>
</html>
