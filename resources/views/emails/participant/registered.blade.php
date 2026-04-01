<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription Confirmée – CasaMémoire</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <style>
        :root {
            --primary: 18 33 175;
            --primary-foreground: 255 255 255;
            --background: 248 250 252;
            --foreground: 15 23 42;
            --muted: 100 116 139;
            --border: 226 232 240;
            --card: 255 255 255;
            --ring: 18 33 175;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: rgb(var(--background));
            font-family: 'Inter', sans-serif;
            color: rgb(var(--foreground));
            /* -webkit-font-smoothing: antialiased; */
        }

        .wrapper {
            width: 100%;
            padding: 48px 16px 64px;
            background-color: rgb(var(--background));
        }

        /* ── CARD ── */
        .card {
            max-width: 580px;
            margin: 0 auto;
            background-color: rgb(var(--card));
            border-radius: 16px;
            overflow: hidden;
            box-shadow:
                0 0 0 1px rgba(226, 232, 240, 0.9),
                0 4px 24px rgba(18, 33, 175, 0.08),
                0 1px 4px rgba(0, 0, 0, 0.04);
        }

        /* ── HEADER ── */
        .header {
            position: relative;
            background-color: rgb(var(--primary));
            overflow: hidden;
        }

        .header-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.055;
            background-image:
                repeating-linear-gradient(45deg,
                    transparent,
                    transparent 18px,
                    rgba(255, 255, 255, 1) 18px,
                    rgba(255, 255, 255, 1) 19px),
                repeating-linear-gradient(-45deg,
                    transparent,
                    transparent 18px,
                    rgba(255, 255, 255, 1) 18px,
                    rgba(255, 255, 255, 1) 19px);
        }

        /* Subtle radial glow top-right */
        .header-glow {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .header-inner {
            position: relative;
            z-index: 1;
            padding: 36px 44px 34px;
        }

        .brand-line {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 26px;
        }

        .brand-mark {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .brand-mark svg {
            width: 56px;
            height: 56px;
            fill: none;
            stroke: white;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .brand-name {
            font-family: 'Inter', serif;
            font-size: 14.5px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.88);
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .header-title {
            font-family: 'Inter', serif;
            font-size: 30px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.22;
            margin-bottom: 8px;
        }

        .header-subtitle {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 400;
            letter-spacing: 0.15px;
        }

        /* ── ACCENT BAR ── */
        .accent-bar {
            height: 3px;
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0.04) 0%,
                    rgba(255, 255, 255, 0.5) 38%,
                    rgba(255, 255, 255, 0.08) 100%);
        }

        /* ── BODY ── */
        .body {
            padding: 40px 44px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background-color: #ecfdf5;
            color: #065f46;
            font-size: 11.5px;
            font-weight: 600;
            padding: 5px 14px;
            border-radius: 999px;
            border: 1px solid #a7f3d0;
            margin-bottom: 26px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #10b981;
            flex-shrink: 0;
        }

        .greeting {
            font-family: 'Inter', serif;
            font-size: 20px;
            font-weight: 600;
            color: rgb(var(--foreground));
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .instruction {
            font-size: 14px;
            color: rgb(var(--muted));
            line-height: 1.78;
            margin-bottom: 32px;
        }

        /* ── QR BLOCK ── */
        .qr-block {
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 22px;
            background-color: rgb(var(--background));
            border: 1px solid rgb(var(--border));
            border-radius: 12px;
            padding: 20px 22px;
        }

        .qr-image-wrap {
            flex-shrink: 0;
            width: 200px;
            height: 200px;
            border-radius: 10px;
            background-color: white;
            border: 1px solid rgb(var(--border));
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .qr-image-wrap img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: contain;
        }

        /* Placeholder QR visual for preview */
        .qr-placeholder {
            width: 96px;
            height: 96px;
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            padding: 4px;
        }

        .qr-meta {
            flex: 1;
            min-width: 0;
        }

        .qr-label {
            font-size: 10.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.9px;
            color: rgb(var(--muted));
            margin-bottom: 5px;
        }

        .qr-title {
            font-family: 'Inter', serif;
            font-size: 15px;
            font-weight: 600;
            color: rgb(var(--foreground));
            margin-bottom: 9px;
            line-height: 1.35;
        }

        .qr-hint {
            font-size: 12.5px;
            color: rgb(var(--muted));
            line-height: 1.65;
        }

        /* ── DIVIDER ── */
        .divider {
            border: none;
            border-top: 1px solid rgb(var(--border));
            margin: 0 0 28px;
        }

        /* ── DETAILS ── */
        .details-label {
            font-size: 10.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.9px;
            color: rgb(var(--muted));
            margin-bottom: 14px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 32px;
        }

        .detail-cell {
            background-color: rgb(var(--background));
            border: 1px solid rgb(var(--border));
            border-radius: 10px;
            padding: 13px 16px;
        }

        .detail-cell.full {
            grid-column: 1 / -1;
        }

        .detail-key {
            font-size: 10.5px;
            font-weight: 500;
            color: rgb(var(--muted));
            text-transform: uppercase;
            letter-spacing: 0.65px;
            margin-bottom: 5px;
        }

        .detail-val {
            font-size: 14px;
            font-weight: 600;
            color: rgb(var(--foreground));
            word-break: break-word;
            line-height: 1.3;
        }

        .id-chip {
            display: inline-flex;
            align-items: center;
            background-color: rgba(18, 33, 175, 0.08);
            color: rgb(var(--primary));
            font-size: 13px;
            padding: 3px 11px;
            border-radius: 6px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* ── NOTE ── */
        .note {
            background-color: #fefce8;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 14px 18px;
            font-size: 13px;
            color: #713f12;
            line-height: 1.7;
        }

        .note strong {
            font-weight: 600;
        }

        .note a {
            color: #92400e;
            font-weight: 600;
        }

        /* ── FOOTER ── */
        .footer {
            background-color: rgb(var(--background));
            border-top: 1px solid rgb(var(--border));
            padding: 20px 44px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .footer-brand {
            font-family: 'Inter', serif;
            font-size: 13px;
            font-weight: 600;
            color: rgb(var(--primary));
            letter-spacing: 0.3px;
        }

        .footer-note {
            font-size: 11.5px;
            color: rgb(var(--muted));
        }

        /* ── PREVIEW WRAPPER ── */
        .preview-label {
            text-align: center;
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            color: rgb(var(--muted));
            margin-bottom: 14px;
            letter-spacing: 0.5px;
            opacity: 0.75;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <p class="preview-label">✦ Aperçu du modèle d'e-mail — CasaMémoire ONG ✦</p>

        <div class="card">

            <!-- HEADER -->
            <div class="header">
                <div class="header-pattern"></div>
                <div class="header-glow"></div>
                <div class="header-inner">
                    <div class="brand-line">
                        <div class="">
                            <!-- Arch / heritage icon -->
                            {{-- set the Logo-Casamemoire-color.svg here --}}
                            <img class="brand-mark" src="{{ asset('assets/images/Logo-Casamemoire-color.svg') }}"
                                alt="CasaMémoire">
                        </div>
                        <span class="brand-name">CasaMémoire</span>
                    </div>
                    <h1 class="header-title">Votre inscription<br>est confirmée.</h1>
                    <p class="header-subtitle">Confirmation de participation à l'événement</p>
                </div>
                <div class="accent-bar"></div>
            </div>

            <!-- BODY -->
            <div class="body">

                <span class="badge">
                    <span class="badge-dot"></span>
                    Inscription validée
                </span>

                <p class="greeting">Bonjour {{ $participant->full_name }},</p>
                <p class="instruction">
                    Nous avons bien reçu votre inscription. Votre QR code d'accès est
                    maintenant joint en pièce attachée au format PDF. Présentez ce document
                    à l'entrée de l'événement pour confirmer votre identité en quelques secondes.
                </p>

                <hr class="divider" />

                <!-- DETAILS -->
                <p class="details-label">Détails de l'inscription</p>

                <div class="details-grid">
                    <div class="detail-cell full">
                        <p class="detail-key">Nom complet</p>
                        <p class="detail-val">{{ $participant->full_name }}</p>
                    </div>
                    <div class="detail-cell">
                        <p class="detail-key">Adresse e-mail</p>
                        <p class="detail-val">{{ $participant->email }}</p>
                    </div>
                    <div class="detail-cell">
                        <p class="detail-key">Téléphone</p>
                        <p class="detail-val">{{ $participant->phone_number }}</p>
                    </div>
                    <div class="detail-cell">
                        <p class="detail-key">Identifiant participant</p>
                        <p class="detail-val">
                            <span class="id-chip">#{{ $participant->id }}</span>
                        </p>
                    </div>
                    <div class="detail-cell">
                        <p class="detail-key">Début de l'événement</p>
                        <p class="detail-val">
                            {{ optional(optional($participant->cmevent)->start_date)->format('d M Y, H:i') ?? '—' }}
                        </p>
                    </div>
                    <div class="detail-cell">
                        <p class="detail-key">Inscrit le</p>
                        <p class="detail-val">{{ $participant->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- WARNING NOTE -->
                <div class="note">
                    <strong>Vous n'êtes pas à l'origine de cette inscription ?</strong><br>
                    Ignorez cet e-mail ou contactez-nous immédiatement à
                    <a href="mailto:casamemoire@casamemoire.org">casamemoire@casamemoire.org</a>.
                </div>

            </div>

            <!-- FOOTER -->
            <div class="footer">
                <span class="footer-brand">Casamémoire</span>
                <span class="footer-note">Message automatique — merci de ne pas répondre.</span>
            </div>

        </div>
    </div>

</body>

</html>
