<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienvenue au Consortium Jeunesse Sénégal</title>
</head>
<body style="margin:0; padding:0; background-color:#f0fdf4; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">

  <!-- Outer wrapper -->
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f0fdf4; padding: 40px 16px;">
    <tr>
      <td align="center">

        <!-- Card -->
        <table width="600" cellpadding="0" cellspacing="0" border="0"
               style="max-width:600px; width:100%; background:#ffffff; border-radius:16px; overflow:hidden;
                      box-shadow: 0 4px 24px rgba(22,163,74,0.10);">

          <!-- ===== HEADER ===== -->
          <tr>
            <td style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); padding: 44px 48px 36px; text-align:center;">
              <img src="{{ config('app.url') }}/images/logo.png"
                   alt="CSJ-SN Logo"
                   width="72" height="72"
                   style="border-radius:50%; border:3px solid rgba(255,255,255,0.3); margin-bottom:20px; display:block; margin-left:auto; margin-right:auto;" />
              <h1 style="margin:0 0 6px; color:#ffffff; font-size:22px; font-weight:700; letter-spacing:-0.3px;">
                Consortium Jeunesse Sénégal
              </h1>
              <p style="margin:0; color:rgba(255,255,255,0.80); font-size:13px; letter-spacing:0.5px; text-transform:uppercase;">
                Ensemble pour l'épanouissement de la jeunesse
              </p>
            </td>
          </tr>

          <!-- ===== WELCOME BANNER ===== -->
          <tr>
            <td style="background:#dcfce7; padding: 18px 48px; text-align:center; border-bottom: 1px solid #bbf7d0;">
              <p style="margin:0; color:#15803d; font-size:14px; font-weight:600;">
                ✅ &nbsp;Votre compte a été créé avec succès
              </p>
            </td>
          </tr>

          <!-- ===== CONTENT ===== -->
          <tr>
            <td style="padding: 44px 48px 32px;">

              <h2 style="margin:0 0 16px; color:#111827; font-size:20px; font-weight:700;">
                Bienvenue, {{ $user->prenom }} !
              </h2>

              <p style="margin:0 0 20px; color:#4b5563; font-size:15px; line-height:1.7;">
                Nous sommes ravis de vous compter parmi les membres de la plateforme du
                <strong style="color:#15803d;">Consortium Jeunesse Sénégal</strong>.
                Votre compte est désormais actif et prêt à être utilisé.
              </p>

              <!-- Account info box -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0"
                     style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; margin-bottom:28px;">
                <tr>
                  <td style="padding: 20px 24px;">
                    <p style="margin:0 0 12px; color:#6b7280; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.6px;">
                      Informations du compte
                    </p>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="padding: 6px 0; color:#374151; font-size:14px; width:110px;">
                          <span style="color:#9ca3af;">Nom complet</span>
                        </td>
                        <td style="padding: 6px 0; color:#111827; font-size:14px; font-weight:600;">
                          {{ $user->prenom }} {{ $user->nom }}
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 6px 0; color:#374151; font-size:14px;">
                          <span style="color:#9ca3af;">Email</span>
                        </td>
                        <td style="padding: 6px 0; color:#111827; font-size:14px; font-weight:600;">
                          {{ $user->email }}
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 6px 0; color:#374151; font-size:14px;">
                          <span style="color:#9ca3af;">Membre depuis</span>
                        </td>
                        <td style="padding: 6px 0; color:#111827; font-size:14px; font-weight:600;">
                          {{ $user->created_at->format('d/m/Y') }}
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <!-- Features -->
              <p style="margin:0 0 16px; color:#374151; font-size:14px; font-weight:600;">
                Ce que vous pouvez faire sur la plateforme :
              </p>
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                <tr>
                  <td style="padding: 8px 0; color:#4b5563; font-size:14px; line-height:1.6;">
                    <span style="color:#16a34a; font-weight:700; margin-right:8px;">✦</span>
                    Gérer les membres du Consortium (ajouter, modifier, supprimer)
                  </td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color:#4b5563; font-size:14px; line-height:1.6;">
                    <span style="color:#16a34a; font-weight:700; margin-right:8px;">✦</span>
                    Suivre les statistiques (membres actifs, villes couvertes)
                  </td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color:#4b5563; font-size:14px; line-height:1.6;">
                    <span style="color:#16a34a; font-weight:700; margin-right:8px;">✦</span>
                    Rechercher et filtrer les membres par statut ou compétences
                  </td>
                </tr>
              </table>

              <!-- CTA Button -->
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td align="center">
                    <a href="{{ config('app.url') }}"
                       style="display:inline-block; background: linear-gradient(135deg, #16a34a, #15803d);
                              color:#ffffff; font-size:15px; font-weight:600; text-decoration:none;
                              padding: 14px 40px; border-radius:8px; letter-spacing:0.2px;">
                      Accéder à la plateforme →
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- ===== DIVIDER ===== -->
          <tr>
            <td style="padding: 0 48px;">
              <div style="height:1px; background:#e5e7eb;"></div>
            </td>
          </tr>

          <!-- ===== FOOTER ===== -->
          <tr>
            <td style="padding: 28px 48px 36px; text-align:center;">
              <p style="margin:0 0 8px; color:#9ca3af; font-size:12px; line-height:1.6;">
                Cet email vous a été envoyé automatiquement, merci de ne pas y répondre.<br/>
                Si vous n'êtes pas à l'origine de cette inscription, ignorez ce message.
              </p>
              <p style="margin:0; color:#d1d5db; font-size:12px;">
                &copy; {{ date('Y') }} Consortium Jeunesse Sénégal — Tous droits réservés
              </p>
            </td>
          </tr>

        </table>
        <!-- /Card -->

      </td>
    </tr>
  </table>

</body>
</html>
