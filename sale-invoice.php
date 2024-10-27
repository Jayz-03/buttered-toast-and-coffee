<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thermal Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 58mm;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 5px;
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .header img {
            max-width: 50px;
            margin-bottom: 5px;
        }
        .header h2 {
            margin: 0;
        }
        .address {
            text-align: center;
            margin-bottom: 10px;
        }
        .info {
            margin-bottom: 10px;
        }
        .info p {
            margin: 2px 0;
        }
        .table {
            width: 100%;
            margin-bottom: 10px;
        }
        .table th, .table td {
            text-align: left;
            padding: 3px;
        }
        .table th {
            border-bottom: 1px solid #000;
        }
        .table td {
            border-bottom: 1px dotted #000;
        }
        .table .right {
            text-align: right;
        }
        .total-section {
            margin-top: 10px;
        }
        .total-section p {
            margin: 2px 0;
        }
        .footer {
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 10px;
            margin-top: 10px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo">
            <h2>INVOICE</h2>
        </div>

        <div class="address">
            <p>Altavista</p>
            <p>9022 Suspendisse Rd.</p>
        </div>

        <div class="info">
            <p><strong>Invoice from:</strong> Imani Lara</p>
            <p>Asset Management</p>
            <p>9022 Suspendisse Rd., High Wycombe</p>
            <p>(478) 446-9234</p>
        </div>

        <div class="info">
            <p><strong>Invoice to:</strong> Walter Sawyer</p>
            <p>Human Resources</p>
            <p>Ap #992-8933 Sagittis Street, Ivanteyevka</p>
            <p>(803) 792-2559</p>
        </div>

        <div class="info">
            <p><strong>Invoice #:</strong> 1806</p>
            <p><strong>Due date:</strong> April 20, 2020</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th class="right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Creative Design</td>
                    <td class="right">$30.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Front-End Development</td>
                    <td class="right">$100.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Back-End Development</td>
                    <td class="right">$155.00</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <p>Subtotal: $285.00</p>
            <p>VAT (10%): $28.50</p>
            <p><strong>Total: $313.50</strong></p>
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>For support, contact us at (478) 446-9234</p>
        </div>
    </div>
</body>
</html>
