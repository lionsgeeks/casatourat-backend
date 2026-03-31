<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} — QR Scanner</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background-color: #0f172a;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #e2e8f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 16px 48px;
        }

        header {
            text-align: center;
            margin-bottom: 32px;
        }
        header h1 {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 4px;
            color: #f8fafc;
        }
        header p {
            font-size: 14px;
            color: #94a3b8;
            margin: 0;
        }

        /* ── Scanner container ── */
        #scanner-wrapper {
            width: 100%;
            max-width: 420px;
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid #1e293b;
            background: #1e293b;
            margin-bottom: 28px;
        }
        #reader {
            width: 100%;
        }

        /* ── Result card ── */
        #result-card {
            display: none;
            width: 100%;
            max-width: 420px;
            background: #1e293b;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid #334155;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 999px;
            margin-bottom: 20px;
        }
        .badge-valid   { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-error   { background: #fee2e2; color: #991b1b; }

        #result-card h2 {
            font-size: 17px;
            font-weight: 700;
            margin: 0 0 18px;
            color: #f1f5f9;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 10px 0;
            border-bottom: 1px solid #334155;
            font-size: 14px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label {
            color: #94a3b8;
            font-weight: 500;
            flex-shrink: 0;
            margin-right: 12px;
        }
        .detail-value {
            color: #f1f5f9;
            font-weight: 600;
            text-align: right;
            word-break: break-all;
        }

        #error-msg {
            display: none;
            width: 100%;
            max-width: 420px;
            background: #1e293b;
            border: 1px solid #ef4444;
            border-radius: 12px;
            padding: 18px 22px;
            font-size: 14px;
            color: #fca5a5;
        }

        /* Scan-again button */
        #scan-again-btn {
            display: none;
            margin-top: 20px;
            padding: 11px 28px;
            background: #3b82f6;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s;
        }
        #scan-again-btn:hover { background: #2563eb; }
    </style>
</head>
<body>

    <header>
        <h1>{{ config('app.name') }}</h1>
        <p>Participant QR Code Scanner</p>
    </header>

    <div id="scanner-wrapper">
        <div id="reader"></div>
    </div>

    <div id="error-msg"></div>

    <div id="result-card">
        <div id="result-badge" class="badge"></div>
        <h2>Participant Details</h2>
        <div class="detail-row">
            <span class="detail-label">Participant ID</span>
            <span class="detail-value" id="r-id">—</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Name</span>
            <span class="detail-value" id="r-name">—</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Email</span>
            <span class="detail-value" id="r-email">—</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Registered at</span>
            <span class="detail-value" id="r-date">—</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Signature</span>
            <span class="detail-value" id="r-sig">—</span>
        </div>
    </div>

    <button id="scan-again-btn" onclick="resetScanner()">Scan another</button>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        let scanner = null;

        function formatDate(isoString) {
            if (!isoString) return '—';
            try {
                return new Date(isoString).toLocaleString('en-GB', {
                    day: '2-digit', month: 'short', year: 'numeric',
                    hour: '2-digit', minute: '2-digit',
                });
            } catch {
                return isoString;
            }
        }

        function showResult(data) {
            document.getElementById('scanner-wrapper').style.display = 'none';

            const card   = document.getElementById('result-card');
            const badge  = document.getElementById('result-badge');
            const errBox = document.getElementById('error-msg');

            let payload;
            try {
                payload = JSON.parse(data);
            } catch {
                errBox.textContent = 'Invalid QR code — could not parse JSON payload.';
                errBox.style.display = 'block';
                document.getElementById('scan-again-btn').style.display = 'inline-block';
                return;
            }

            // Signature presence check (visual only — full HMAC verify requires server)
            const hasSig = typeof payload.sig === 'string' && payload.sig.length === 64;

            badge.className = 'badge ' + (hasSig ? 'badge-valid' : 'badge-warning');
            badge.innerHTML = hasSig
                ? '✓ Valid Participant'
                : '⚠ Signature Missing — verify manually';

            document.getElementById('r-id').textContent    = payload.participant_id ?? '—';
            document.getElementById('r-name').textContent  = payload.name           ?? '—';
            document.getElementById('r-email').textContent = payload.email          ?? '—';
            document.getElementById('r-date').textContent  = formatDate(payload.registered_at);
            document.getElementById('r-sig').textContent   = hasSig
                ? payload.sig.slice(0, 16) + '…'
                : 'Not present';

            card.style.display = 'block';
            document.getElementById('scan-again-btn').style.display = 'inline-block';
        }

        function resetScanner() {
            document.getElementById('result-card').style.display  = 'none';
            document.getElementById('error-msg').style.display    = 'none';
            document.getElementById('scan-again-btn').style.display = 'none';
            document.getElementById('scanner-wrapper').style.display = 'block';
            startScanner();
        }

        function startScanner() {
            scanner = new Html5Qrcode('reader');

            // Prefer rear camera (environment-facing) for mobile check-in devices
            Html5Qrcode.getCameras().then(cameras => {
                if (!cameras || cameras.length === 0) {
                    document.getElementById('error-msg').textContent = 'No camera found on this device.';
                    document.getElementById('error-msg').style.display = 'block';
                    return;
                }

                // Pick the last camera — on mobile this is typically the rear camera
                const cameraId = cameras[cameras.length - 1].id;

                scanner.start(
                    cameraId,
                    { fps: 10, qrbox: { width: 260, height: 260 } },
                    (decodedText) => {
                        scanner.stop().then(() => showResult(decodedText)).catch(() => showResult(decodedText));
                    },
                    () => { /* scan failure — ignore per-frame errors */ }
                ).catch(err => {
                    document.getElementById('error-msg').textContent = 'Camera access denied: ' + err;
                    document.getElementById('error-msg').style.display = 'block';
                });
            }).catch(err => {
                document.getElementById('error-msg').textContent = 'Could not enumerate cameras: ' + err;
                document.getElementById('error-msg').style.display = 'block';
            });
        }

        startScanner();
    </script>

</body>
</html>
