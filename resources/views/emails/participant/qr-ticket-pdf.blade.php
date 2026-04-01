<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Billet QR - CasaMemoire</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #0f172a;
            margin: 28px;
        }

        .card {
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            overflow: hidden;
        }

        .header {
            background: #1221af;
            color: #ffffff;
            padding: 18px 22px;
        }

        .title {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .subtitle {
            font-size: 12px;
            margin: 0;
            opacity: 0.92;
        }

        .content {
            padding: 22px;
        }

        .qr-wrap {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            width: 280px;
            height: 280px;
            margin: 0 auto 20px;
            padding: 8px;
            background: #ffffff;
            text-align: center;
        }

        .qr-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .meta {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .meta td {
            border-top: 1px solid #e2e8f0;
            padding: 10px 8px;
            font-size: 12px;
            vertical-align: top;
        }

        .meta td:first-child {
            width: 40%;
            color: #475569;
        }

        .meta td:last-child {
            width: 60%;
            font-weight: 600;
        }

        .foot {
            margin-top: 20px;
            font-size: 11px;
            color: #64748b;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="header">
            <p class="title">Billet d'acces evenement</p>
            <p class="subtitle">CasaMemoire - Code QR de verification</p>
        </div>

        <div class="content">
            <div class="qr-wrap">
                <img src="data:image/svg+xml;base64,{{ $qrBase64 }}" alt="QR code d'acces">
            </div>

            <table class="meta">
                <tr>
                    <td>Participant</td>
                    <td>{{ $participant->full_name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $participant->email }}</td>
                </tr>
                <tr>
                    <td>Telephone</td>
                    <td>{{ $participant->phone_number }}</td>
                </tr>
                <tr>
                    <td>ID participant</td>
                    <td>#{{ $participant->id }}</td>
                </tr>
                <tr>
                    <td>Date d'inscription</td>
                    <td>{{ $participant->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td>Date de l'evenement</td>
                    <td>{{ optional(optional($participant->cmevent)->start_date)->format('d/m/Y H:i') ?? '-' }}</td>
                </tr>
            </table>

            <p class="foot">
                Presentez ce PDF a l'entree de l'evenement pour scanner le QR code.
                Ce document est personnel et ne doit pas etre partage.
            </p>
        </div>
    </div>
</body>

</html>
