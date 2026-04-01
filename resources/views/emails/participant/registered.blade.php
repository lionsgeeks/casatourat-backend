<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Inscription confirmée – CasaMémoire</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
</head>

<body
    style="margin:0; padding:0; width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; background-color:#f1f5f9; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;">
    <div style="display:none; max-height:0; overflow:hidden; mso-hide:all;">
        Votre inscription à CasaMémoire est confirmée — {{ $participant->full_name }}
    </div>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
        style="background-color:#f1f5f9; border-collapse:collapse; mso-table-lspace:0; mso-table-rspace:0;">
        <tr>
            <td align="center" style="padding:40px 16px 48px;">
                <!-- Card -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                    style="max-width:580px; border-collapse:collapse; mso-table-lspace:0; mso-table-rspace:0; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(18,33,175,0.08),0 0 0 1px rgba(226,232,240,0.9);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1221af; padding:0;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse;">
                                <tr>
                                    <td style="padding:36px 40px 32px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                            style="border-collapse:collapse;">
                                            <tr>
                                                {{-- <td valign="middle" style="padding-right:12px;">
                                                    <img src="{{ asset('assets/images/Logo-Casamemoire-color.svg') }}" width="56" height="56"
                                                        alt="CasaMémoire"
                                                        style="display:block; border:0; outline:none; text-decoration:none; width:56px; height:56px;" />
                                                </td> --}}
                                                <td valign="middle">
                                                    <span
                                                        style="font-size:14px; font-weight:600; color:rgba(255,255,255,0.9); letter-spacing:0.8px; text-transform:uppercase;">CasaMémoire</span>
                                                </td>
                                            </tr>
                                        </table>
                                        <h1
                                            style="margin:0; padding:24px 0 0; font-size:28px; line-height:1.25; font-weight:700; color:#ffffff; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;">
                                            Votre inscription<br />est confirmée.
                                        </h1>
                                        <p
                                            style="margin:0; padding:10px 0 0; font-size:13px; color:rgba(255,255,255,0.55); line-height:1.5;">
                                            Confirmation de participation à l'événement
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:3px; line-height:3px; font-size:0; background:linear-gradient(90deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.45) 50%, rgba(255,255,255,0.08) 100%); background-color:#2a3bc4;">
                                        &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:36px 40px 32px; background-color:#ffffff;">
                            <!-- Badge -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse; margin-bottom:24px;">
                                <tr>
                                    <td
                                        style="background-color:#ecfdf5; border:1px solid #a7f3d0; border-radius:999px; padding:6px 14px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                            style="border-collapse:collapse;">
                                            <tr>
                                                <td valign="middle" style="padding-right:8px;">
                                                    <span
                                                        style="display:inline-block; width:6px; height:6px; border-radius:50%; background-color:#10b981; line-height:0; font-size:0;">&nbsp;</span>
                                                </td>
                                                <td valign="middle"
                                                    style="font-size:11px; font-weight:600; color:#065f46; letter-spacing:0.4px; text-transform:uppercase;">
                                                    Inscription validée
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p
                                style="margin:0 0 10px; font-size:19px; font-weight:600; color:#0f172a; line-height:1.35;">
                                Bonjour {{ $participant->full_name }},
                            </p>
                            <p
                                style="margin:0 0 28px; font-size:14px; color:#64748b; line-height:1.75; max-width:100%;">
                                Nous avons bien reçu votre inscription. Votre QR code d'accès est
                                maintenant joint en pièce attachée au format PDF. Présentez ce document
                                à l'entrée de l'événement pour confirmer votre identité en quelques secondes.
                            </p>

                            <!-- Divider -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse; margin-bottom:24px;">
                                <tr>
                                    <td style="border-top:1px solid #e2e8f0; font-size:0; line-height:0;">&nbsp;</td>
                                </tr>
                            </table>

                            <p
                                style="margin:0 0 14px; font-size:10.5px; font-weight:600; text-transform:uppercase; letter-spacing:0.9px; color:#64748b;">
                                Détails de l'inscription
                            </p>

                            <!-- Detail: full name -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse; margin-bottom:10px;">
                                <tr>
                                    <td
                                        style="background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:14px 16px;">
                                        <p
                                            style="margin:0 0 6px; font-size:10.5px; font-weight:500; color:#64748b; text-transform:uppercase; letter-spacing:0.65px;">
                                            Nom complet</p>
                                        <p style="margin:0; font-size:14px; font-weight:600; color:#0f172a; line-height:1.35; word-break:break-word;">
                                            {{ $participant->full_name }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Row: email | phone -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse; margin-bottom:10px;">
                                <tr>
                                    <td width="50%" valign="top" style="padding-right:5px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                            border="0" style="border-collapse:collapse;">
                                            <tr>
                                                <td
                                                    style="background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:14px 16px;">
                                                    <p
                                                        style="margin:0 0 6px; font-size:10.5px; font-weight:500; color:#64748b; text-transform:uppercase; letter-spacing:0.65px;">
                                                        Adresse e-mail</p>
                                                    <p
                                                        style="margin:0; font-size:14px; font-weight:600; color:#0f172a; line-height:1.35; word-break:break-word;">
                                                        {{ $participant->email }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="50%" valign="top" style="padding-left:5px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                            border="0" style="border-collapse:collapse;">
                                            <tr>
                                                <td
                                                    style="background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:14px 16px;">
                                                    <p
                                                        style="margin:0 0 6px; font-size:10.5px; font-weight:500; color:#64748b; text-transform:uppercase; letter-spacing:0.65px;">
                                                        Téléphone</p>
                                                    <p
                                                        style="margin:0; font-size:14px; font-weight:600; color:#0f172a; line-height:1.35; word-break:break-word;">
                                                        {{ $participant->phone_number }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Row: id | event start -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse; margin-bottom:10px;">
                                <tr>
                                    <td width="50%" valign="top" style="padding-right:5px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                            border="0" style="border-collapse:collapse;">
                                            <tr>
                                                <td
                                                    style="background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:14px 16px;">
                                                    <p
                                                        style="margin:0 0 6px; font-size:10.5px; font-weight:500; color:#64748b; text-transform:uppercase; letter-spacing:0.65px;">
                                                        Identifiant participant</p>
                                                    <p style="margin:0;">
                                                        <span
                                                            style="display:inline-block; background-color:rgba(18,33,175,0.1); color:#1221af; font-size:13px; padding:4px 11px; border-radius:6px; font-weight:600; letter-spacing:0.3px;">#{{ $participant->id }}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="50%" valign="top" style="padding-left:5px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                            border="0" style="border-collapse:collapse;">
                                            <tr>
                                                <td
                                                    style="background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:14px 16px;">
                                                    <p
                                                        style="margin:0 0 6px; font-size:10.5px; font-weight:500; color:#64748b; text-transform:uppercase; letter-spacing:0.65px;">
                                                        Début de l'événement</p>
                                                    <p
                                                        style="margin:0; font-size:14px; font-weight:600; color:#0f172a; line-height:1.35;">
                                                        {{ optional(optional($participant->cmevent)->start_date)->format('d M Y, H:i') ?? '—' }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Row: registered (full width) -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse; margin-bottom:24px;">
                                <tr>
                                    <td
                                        style="background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:14px 16px;">
                                        <p
                                            style="margin:0 0 6px; font-size:10.5px; font-weight:500; color:#64748b; text-transform:uppercase; letter-spacing:0.65px;">
                                            Inscrit le</p>
                                        <p
                                            style="margin:0; font-size:14px; font-weight:600; color:#0f172a; line-height:1.35;">
                                            {{ $participant->created_at->format('d M Y, H:i') }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Note -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse;">
                                <tr>
                                    <td
                                        style="background-color:#fefce8; border:1px solid #fde68a; border-radius:10px; padding:16px 18px;">
                                        <p
                                            style="margin:0; font-size:13px; color:#713f12; line-height:1.65;">
                                            <strong style="font-weight:600;">Vous n'êtes pas à l'origine de cette inscription ?</strong><br />
                                            Ignorez cet e-mail ou contactez-nous immédiatement à
                                            <a href="mailto:casamemoire@casamemoire.org"
                                                style="color:#92400e; font-weight:600; text-decoration:underline;">casamemoire@casamemoire.org</a>.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background-color:#f8fafc; border-top:1px solid #e2e8f0; padding:20px 40px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="border-collapse:collapse;">
                                <tr>
                                    <td valign="middle" style="padding-bottom:8px;">
                                        <span
                                            style="font-size:13px; font-weight:600; color:#1221af; letter-spacing:0.3px;">Casamémoire</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-size:11.5px; color:#64748b; line-height:1.5;">Message
                                            automatique — merci de ne pas répondre.</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
