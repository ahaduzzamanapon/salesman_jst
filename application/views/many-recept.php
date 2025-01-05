<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 800px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header .logo img {
            height: 60px;
        }

        .header .details {
            text-align: right;
            font-size: 14px;
        }

        .header .details h2 {
            margin: 0;
            color: #f89c1c;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .content {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .content .row {
            display: flex;
            margin-bottom: 10px;
        }

        .content .row .label {
            width: 30%;
            font-weight: bold;
        }

        .content .row .value {
            width: 70%;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            align-items: center;
        }

        .footer .signature {
            text-align: center;
            margin-top: 30px;
        }

        .footer .signature span {
            display: block;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <div class="details">
                <h2>JST Trading Corporation</h2>
                <p>14 Purana Paltan (7th floor), Darus Salam Arcade</p>
                <p>Room No. 10/A, Dhaka-1000, Bangladesh</p>
                <p>+88 01733 606 723 | jsttradingbd@gmail.com</p>
            </div>
        </div>

        <div class="title">Money Receipt</div>

        <div class="content">
            <div class="row">
                <div class="label">Received with thanks from</div>
                <div class="value"></div>
            </div>
            <div class="row">
                <div class="label">Purpose</div>
                <div class="value"></div>
            </div>
            <div class="row">
                <div class="" style="white-space:nowrap">In Cash / Cheque / D.D. No________________ Bank __________ Branch __________Date____________</div>
            </div>
            <div class="row">
                <div class="label">Taka</div>
                <div class="">________________ In Word __________________________</div>
            </div>
        </div>

        <div class="footer">
            <div class="signature">
                <p>Paid By</p>
                <span>_______________________</span>
            </div>
            <div class="signature">
                <p>For JST Trading Corporation</p>
                <span>_______________________</span>
            </div>
        </div>
    </div>
</body>
</html>
