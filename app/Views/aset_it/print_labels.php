<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Label QR Code Aset IT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .label-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-start;
        }
        .label-box {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 200px;
            height: 110px;
            padding: 10px;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .label-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-right: 10px;
            overflow: hidden;
        }
        .label-header {
            font-size: 10px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            border-bottom: 1px solid #eee;
            padding-bottom: 2px;
            text-transform: uppercase;
        }
        .label-aktiva {
            font-size: 12px;
            font-weight: bold;
            color: #000;
            margin-bottom: 3px;
        }
        .label-nama {
            font-size: 10px;
            color: #555;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .label-ruangan {
            font-size: 9px;
            color: #777;
            margin-top: 3px;
            background-color: #f8f9fa;
            padding: 2px 4px;
            border-radius: 3px;
            display: inline-block;
            width: fit-content;
        }
        .qrcode-wrapper {
            width: 64px;
            height: 64px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Print Specific Styles */
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .label-box {
                border: 1px dashed #999; /* Dashed line as cutting guide */
            }
            @page {
                margin: 5mm; /* Minimum margin */
            }
        }
        
        .print-btn-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .print-btn {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.2s;
        }
        .print-btn:hover {
            background-color: #0b5ed7;
            transform: scale(1.05);
        }
    </style>
    <!-- Load qrcode.js via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>

    <div class="print-btn-container no-print">
        <button class="print-btn" onclick="window.print()">🖨️ Cetak Label Sekarang</button>
        <p style="color: #666; font-size: 13px; margin-top: 8px;">*Pastikan pengaturan margin pada dialog print diatur ke "None" atau "Minimum"</p>
    </div>

    <div class="label-container">
        <?php foreach ($aset as $a): ?>
            <div class="label-box">
                <div class="label-info">
                    <div class="label-header">IT ASSET</div>
                    <div class="label-aktiva"><?= esc($a['no_aktiva']) ?></div>
                    <div class="label-nama" title="<?= esc($a['nama_aset']) ?>"><?= esc($a['nama_aset']) ?></div>
                    <div class="label-ruangan"><?= esc($a['ruangan']) ?></div>
                </div>
                <div class="qrcode-wrapper" id="qr-<?= $a['id'] ?>" data-text="<?= site_url('asetit/scan/' . $a['id']) ?>"></div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Render QR Codes dynamically
            const qrWrappers = document.querySelectorAll('.qrcode-wrapper');
            qrWrappers.forEach(function(wrapper) {
                const text = wrapper.getAttribute('data-text');
                new QRCode(wrapper, {
                    text: text,
                    width: 64,
                    height: 64,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.M
                });
            });

            // Automatically open print dialog after a short delay to ensure QR codes are fully rendered
            setTimeout(function() {
                window.print();
            }, 800);
        });
    </script>
</body>
</html>
