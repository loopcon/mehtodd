<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .invoice-container {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .invoice-header {
            width: 100%;
            margin-bottom: 20px;
        }

        .invoice-header .invoice-title {

            font-weight: bold;
            text-align: center;


        }

        .text-primary {
            color: #007bff;
        }

        .invoice-details {
            width: 100%;
            margin-bottom: 20px;
        }

        .invoice-details td {
            width: 45%;
            vertical-align: top;
        }

        .text-muted {
            color: #6c757d;
            font-size: 14.5px;
        }

        .fw-bold {
            font-weight: bold;
            font-size: 14px;
        }

        .invoice-details .text-muted {
            line-height: 0%;
        }

        .invoice-meta {
            width: 100%;
            margin-bottom: 15px;
        }

        /* .invoice-meta td {
            width: 40%;
            vertical-align: top;
        } */

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
            /* Ensures consistent column widths */
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
            font-size: 14px;
        }

        .invoice-table th {
            background-color: #f8f9fa;
        }

        .invoice-table td:nth-child(1) {
            width: 20%;
            /* Subscription Title */
        }

        .invoice-table td:nth-child(2) {
            width: 40%;
            /* Description */
        }

        .invoice-table td:nth-child(3) {
            width: 10%;
            /* Quantity */
        }

        .invoice-table td:nth-child(4) {
            width: 15%;
            /* Price */
        }

        .invoice-table td:nth-child(5) {
            width: 15%;
            /* Total */
        }


        .invoice-total {
            width: 100%;
            margin-top: 20px;
        }

        .invoice-total td {
            width: 75%;
        }

        .invoice-total .totals {
            width: 30%;
            text-align: right;
        }

        .invoice-total .totals table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-total .totals td {
            padding: 10px;
            text-align: right;
            font-size: 14px;
        }

        .fw-bold {
            font-weight: bold;
        }

        @media print {
            body {
                background-color: #fff;
            }

            .invoice-container {
                border: none;
                width: 100%;
                padding: 0;
            }

            .text-primary {
                color: black !important;
                font-size: 14px;
                line-height: 0%;
            }

            .invoice-title,
            .fw-bold,
            .fw-semibold {
                color: black;
                font-size: 14px;
                line-height: 0%;

            }

            .invoice-table th,
            .invoice-table td {
                border: 1px solid #000;
            }
        }

    </style>
</head>

<body>
    <div class="invoice-container">
        <table class="invoice-header">
            <tr>
                <td colspan="2" class="invoice-title">
                    INVOICE ID: <span class="text-primary">{{ $subInvoice->id ?? '' }}</span>
                </td>
            </tr>
        </table>

        <table class="invoice-details">
            <tr>
                <td class="billing-from">
                    <p class="text-muted">Billing From:</p>
                    <p class="fw-bold">Herodicus</p>
                </td>
                <td></td>
                <td class="billing-to">
                    <p class="text-muted">Billing To:</p>
                    <p class="fw-bold">{{ Auth::user()->fullname }}</p>
                    <p class="text-muted">+91 {{ Auth::user()->mobile_number }}</p>
                </td>
            </tr>
        </table>

        <table class="invoice-meta">
            <tr>
                <td>
                    <p class="fw-semibold">Invoice ID:</p>
                    <p style="font-size: 14px; line-height:0%;">{{ $subInvoice->id ?? '' }}</p>
                </td>
                <td>
                    <p class="fw-semibold">Date:</p>
                    <p style="font-size: 14px; line-height:0%;">{{ $subInvoice->created_at ? $subInvoice->created_at->format('Y-m-d') : '' }}</p>
                </td>
                <td>
                    <p class="fw-semibold">Amount:</p>
                    <p class="fw-bold" style="font-size: 14px; line-height:0%;">{{ $subInvoice->amount }}</p>
                </td>
            </tr>
        </table>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>SUBSCRIPTION</th>
                    <th>DESCRIPTION</th>
                    <th>QTY.</th>
                    <th>PRICE</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $videoDetails->title ?? '' }}</td>
                    <td> {{ $videoDetails->description ?? '' }}</td>
                    <td>1</td>
                    <td>{{ $subInvoice->amount ?? '' }}</td>
                    <td>{{ $subInvoice->amount ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <table class="invoice-total">
            <tr>
                <td colspan="2"></td>
                <td class="totals">
                    <table>
                        <tr>
                            <td style="white-space: nowrap;">Sub Total:</td>
                            <td>{{ $subInvoice->amount }}</td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap;">Total:</td>
                            <td class="fw-bold">{{ $subInvoice->amount ?? 0 }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
