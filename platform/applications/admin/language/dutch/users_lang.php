<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Language File
 */

// Titles
$lang['users title forgot']                   = "Wachtwoord vergeten";
$lang['users title login']                    = "Login";
$lang['users title profile']                  = "Profiel";
$lang['users title register']                 = "Registreren";
$lang['users title user_add']                 = "Gebruiker toevoegen";
$lang['users title user_delete']              = "Gebruiker verwijderen bevestigen";
$lang['users title user_edit']                = "Gebruiker bewerken";
$lang['users title user_list']                = "Gebruikerslijst";
$lang['users title dasboard']                 = "Dashboard";
$lang['users title history']                  = "Operationen geschichte";
$lang['users title resolution']               = "Auflösung zentrum";
$lang['users title det_dispute']              = "Einzelheiten des streits";
$lang['users title support']                  = "Unterstützung";
$lang['users title all_tickets']              = "Alle tickets";
$lang['users title request']                  = "Zahlung anfordern";
$lang['users title request_form']             = "Zahlungsformular";
$lang['users title new_ticket']               = "Neues еicket";
$lang['users title money_transfer']           = "Geldtransfer";
$lang['users title form_transfer']            = "Form von geldtransfer";
$lang['users title exchange']                 = "Geldwechsel";
$lang['users title form_exchange']            = "Austausch von basiswährung";
$lang['users title to_form_exchange']         = "Umstellung auf basiswährung";
$lang['users title withdrawal']               = "Entnahme";
$lang['users title deposit']                  = "Depositengeld";
$lang['users title form_withdrawal']          = "Wählen sie, wie sie geld erhalten";
$lang['users title form_deposit']             = "Wahl der einzahlungsmethode";
$lang['users title verifi']                   = "Verifizierung";
$lang['users title settings']                 = "Account Einstellungen";
$lang['users title about']                    = "Profiel";

// Buttons
$lang['users button add_new_user']            = "Nieuwe gebruiker toevoegen";
$lang['users button register']                = "Account aanmaken";
$lang['users button reset_password']          = "Reset wachtwoord";
$lang['users button login_try_again']         = "Probeer het nog eens";

// Tooltips
$lang['users tooltip add_new_user']           = "Maak een nieuwe gebruiker.";

// Links
$lang['users link forgot_password']           = "Wachtwoord vergeten?";
$lang['users link register_account']          = "Registreer voor een account.";

// Table Columns
$lang['users col first_name']                 = "Voornaam";
$lang['users col is_admin']                   = "Admin";
$lang['users col last_name']                  = "Achternaam";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "Gebruikersnaam";

// Form Inputs
$lang['users input email']                    = "E-mail";
$lang['users input first_name']               = "Voornaam";
$lang['users input is_admin']                 = "Is Admin";
$lang['users input language']                 = "Taal";
$lang['users input last_name']                = "Achternaam";
$lang['users input password']                 = "Wachtwoord";
$lang['users input password_repeat']          = "Herhaal wachtwoord";
$lang['users input status']                   = "Status";
$lang['users input username']                 = "Gebruikersnaam";
$lang['users input username_email']           = "Gebruikersnaam of E-mail";

// Help
$lang['users help passwords']                 = "Vul alleen wachtwoorden in als u wilt wijzigen.";

// Messages
$lang['users msg add_user_success']           = "%s is succesvol toegevoegd!";
$lang['users msg delete_confirm']             = "Weet u zeker dat u wilt verwijderen van de <strong>%s</strong>? Dit kan niet ongedaan gemaakt worden.";
$lang['users msg delete_user']                = "U hebt <strong>%s</strong> met succes vewijderd!";
$lang['users msg edit_profile_success']       = "Uw profiel was succesvol gewijzigd!";
$lang['users msg edit_user_success']          = "%s is met succes bewerkt!";
$lang['users msg register_success']           = "Bedankt voor het registreren, %s! Check je email voor een bevestigingsbericht. Zodra
uw account heeft geverifieerd, zal u in staat zijn om in te loggen met de referenties
u verstrekt.";
$lang['users msg password_reset_success']     = "Uw wachtwoord zijn hersteld, %s! Controleer uw e-mailadres voor uw nieuwe tijdelijke wachtwoord.";
$lang['users msg validate_success']           = "Uw account is geverifieerd. U kan nu inloggen op uw account.";
$lang['users msg email_new_account']          = "<p>Bedankt voor het aanmaken van een account op %s bekijken. Klik op de link hieronder voor het valideren van uw
e-mail adres en uw account te activeren.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['users msg email_new_account_title']    = "Nieuwe Account voor %s";
$lang['users msg email_password_reset']       = "<p>Uw wachtwoord op %s is gereset. Klik op de link hieronder om in te loggen met uw
nieuw wachtwoord:<br /><br/><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
Zodra u aangemeld bent, zorg ervoor dat uw wachtwoord te veranderen naar iets dat je kunt
te onthouden.</p>";
$lang['users msg email_password_reset_title'] = "Reset van het wachtwoord voor %s";

// Menu
$lang['users menu dashboard']                 = "Dashboard";
$lang['users menu transfer']                  = "Geldüberweisung";
$lang['users menu exchange']                  = "Geldwechsel";
$lang['users menu history']                   = "Geschichte der operationen";
$lang['users menu dispute']                   = "Auflösung zentrum";
$lang['users menu request']                   = "Zahlung anfordern";
$lang['users menu acceptance']                = "Akzeptanzzahlungen";
$lang['users menu support']                   = "Unterstützung";
$lang['users menu settings']                  = "Account einstellungen";

// Dashboard
$lang['users dashboard ballance']             = "Verfügbares guthaben";
$lang['users dashboard deposit']              = "Depositengeld";
$lang['users dashboard withdrawal']           = "Entnahme";
$lang['users dashboard other_ballance']       = "Andere geldbörses";
$lang['users dashboard success_verif_title']  = "Status ihres kontos - verifiziert";
$lang['users dashboard success_verif_text']   = "Ausgezeichnet! jetzt können sie geld von ihrem konto ohne einschränkungen abheben.  <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard danger_verif_title']   = "Status ihres kontos - anonym";
$lang['users dashboard danger_verif_text']    = "Hoppla! Ihr kontostatus erlaubt ihnen nicht, geld von ihrem konto abzuheben. <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard warning_verif_title']  = "Status ihres kontos - anstehende verifikation";
$lang['users dashboard warning_verif_text']   = "Vielen dank! Wir haben ihre unterlagen erhalten und innerhalb von 2-3 werktagen eine entscheidung treffen. <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard info_verif_title']     = "The status ihres kontos - geschäft";
$lang['users dashboard info_verif_text']      = "Groß! Sie haben ihren zuverlässigkeitsstatus bestätigt und können externe zahlungen akzeptieren. <a href=\"/account/identification\">Learn More</a>";
$lang['users trans deposit']                  = "Depositengeld";
$lang['users trans withdrawal']               = "Entnahme";
$lang['users trans transfer']                 = "Übertragung";
$lang['users trans exchange']                 = "Austausch";
$lang['users trans external']                 = "Äußere kaution";
$lang['users trans pending']                  = "Steht aus";
$lang['users trans success']                  = "Erledigt";
$lang['users trans refund']                   = "Rückerstattung";
$lang['users trans dispute']                  = "Streit";
$lang['users trans blocked']                  = "Blockiert";
$lang['users trans id']                       = "ID";
$lang['users trans type']                     = "Typ";
$lang['users trans sum']                      = "Summe";
$lang['users trans fee']                      = "Gebühr";
$lang['users trans amount']                   = "Betrag";
$lang['users trans status']                   = "Status";
$lang['users trans sender']                   = "Absender";
$lang['users trans receiver']                 = "Empfänger";
$lang['users trans date']                     = "Datum";
$lang['users trans comment']                  = "Kommentar";
$lang['users trans cyr']                      = "Währung";
$lang['users trans detail']                   = "Detail";
$lang['users trans 10last']                   = "Die letzten 10 operationen";
$lang['users trans all']                      = "Alle transaktionen";

// History
$lang['users history all']                    = "IP geschichte";
$lang['users history detail']                 = "Detail transaktion";
$lang['users history id_trans']               = "ID transaktion";
$lang['users history open_dispute']           = "Eröffnen dispute";
$lang['users history print']                  = "Drücken detail";
$lang['users history of']                     = "Data";
$lang['users history open_dispute']           = "Eröffnen dispute";
$lang['users history dispute_title']          = "Grund für die eröffnung eines streits";
$lang['users history not_received']           = "Ich habe die ware nicht erhalten";
$lang['users history not_desk']               = "Produkt stimmt nicht mit der beschreibung überein";
$lang['users history reason']                 = "Beschreibe das wesen des streits";
$lang['users history help']                   = "Geben sie im textfeld den grund an, warum sie diesen streit eröffnen. So detaillierte wie möglich beschreibung des problems und fragen sie den verkäufer von optionen für seine lösungen.";
$lang['users history start']                  = "Disput anfangen";
$lang['users history dispute_success']        = "Der streit wurde erfolgreich eröffnet! Sie können den streit in der Auflösung zentrum";
$lang['users history swift']                  = "We expect your payment! Enter in the payment Bank order your username.";

// Dispute
$lang['users dispute list']                   = "Liste der streitigkeiten";
$lang['users dispute id']                     = "ID der streitigkeiten";
$lang['users dispute date']                   = "Datum";
$lang['users dispute claimant']               = "Antragsteller";
$lang['users dispute action']                 = "Aktion";
$lang['users dispute start_claim']            = "Starten anspruch";
$lang['users dispute close_claim']            = "Streit schließen";
$lang['users disputes id_tran']               = "ID transaktion";
$lang['users disputes id_tran_time']          = "Datum transaktion";
$lang['users disputes time_dispute']          = "Datum dispute";
$lang['users disputes all_dispute']           = "Alle streitigkeiten";
$lang['users disputes edit_dispute']          = "Streit bearbeiten";
$lang['users disputes claimant']              = "Antragsteller";
$lang['usersn disputes defendant']            = "Beklagte";
$lang['users disputes status']                = "Status";
$lang['users disputes open']                  = "Streit ist offen";
$lang['users disputes rejected']              = "Anspruch abgelehnt";
$lang['users disputes satisfied']             = "Anspruch zufrieden";
$lang['users disputes claim']                 = "Anspruch";
$lang['users disputes detail']                = "Einzelheiten des streits";
$lang['users disputes overwiev']              = "Übersichtsstreit";
$lang['users disputes back']                  = "Zurück";
$lang['users disputes new_comment']           = "Neuer kommentar";
$lang['users disputes add_comment']           = "Einen kommentar hinzufügen";
$lang['users disputes comment_success']       = "Dein kommentar wurde erfolgreich hinzugefügt!";
$lang['users disputes open_claim_success']    = "Der streit wurde erfolgreich auf den anspruch übertragen!";
$lang['users disputes transferred']           = "Der Streit wird auf den Anspruch übertragen. Bitte warten Sie auf die Entscheidung der аdministrations.";
$lang['users disputes stop']                  = "Der streit wird gestoppt. Mein problem ist gelöst";
$lang['users disputes success_stop']          = "Disput wurde erfolgreich gestoppt";

// Tickets
$lang['users tickets add']                    = "Neues ticket erstellen";
$lang['users tickets date']                   = "Datum erstellen";
$lang['users tickets date_info']              = "Datum";
$lang['users tickets user']                   = "Benutzername";
$lang['users tickets message']                = "Nachricht";
$lang['users tickets create']                 = "Ticket erstellen";
$lang['users tickets title']                  = "Thema";
$lang['users tickets untreated']              = "Unbehandelt";
$lang['users tickets processed']              = "Im gange";
$lang['users tickets closed']                 = "Geschlossen";
$lang['users tickets success_edit']           = "Ticket erfolgreich geändert";
$lang['users tickets reply']                  = "Antwort auf ticket";
$lang['users tickets id']                     = "ID ticket";
$lang['users tickets close']                  = "Schließen sie das ticket";
$lang['users tickets new']                    = "Neuer kommentar";
$lang['users tickets success_comment']        = "Kommentar wurde erfolgreich hinzugefügt!";
$lang['users tickets success_close']          = "Ticket erfolgreich geschlossen!";
$lang['users tickets success_new']            = "Ticket erfolgreich erstellt! Wir werden innerhalb von zwei werktagen antworten";
$lang['users tickets form']                   = "Füllen sie das formular für die supportanfrage";
$lang['users tickets send']                   = "Ticket senden";

// Request
$lang['users reqest purpose']                 = "Zweck der zahlung";
$lang['users reqest invoice']                 = "Rechnungsnummer";
$lang['users reqest email']                   = "Email";
$lang['users reqest note']                    = "Hinweis für empfänger";
$lang['users reqest send']                    = "Anfrage senden";
$lang['users reqest success']                 = "Ihre anfrage wurde erfolgreich gesendet!";

// Transfer
$lang['users transfer amount']                = "Betragsübertragung";
$lang['users transfer sum']                   = "Gebühr";
$lang['users transfer help_com']              = "Mit provision";
$lang['users transfer receiver']              = "Benutzername empfänger";
$lang['users transfer send']                  = "Geld schicken";
$lang['users transfer success']               = "Geldüberweisung wurde erfolgreich abgeschlossen!";

// Exchange
$lang['users exchange rate']                  = "Wechselkurse";
$lang['users exchange amount']                = "Geldwechsel";
$lang['users exchange get']                   = "Du erhältst";
$lang['users exchange start']                 = "Starten austausch";
$lang['users exchange note']                  = "Austauschbetrieb";
$lang['users exchange success']               = "Austausch erfolgreich abgeschlossen!";

// Withdrawal
$lang['users withdrawal amount']              = "Summe";
$lang['users withdrawal currency']            = "Währung";
$lang['users withdrawal account']             = "Dein kontoverbindung zur aufnahme von mitteln";
$lang['users withdrawal help']                = "Bitte geben sie ein gültiges konto ein, auf das sie geld übertragen möchten. zum beispiel mail@gmail.com oder 4276150025568996";
$lang['users withdrawal error']               = "Ihr bestätigungsniveau reicht nicht aus, um die operation durchzuführen";

// Method
$lang['users withdrawal card']                = "Bankkarten";
$lang['users withdrawal paypal']              = "PayPal";
$lang['users withdrawal btc']                 = "Bitcoin";
$lang['users withdrawal adv']                 = "ADV cash";
$lang['users withdrawal webmoney']            = "Webmoney";
$lang['users withdrawal payeer']              = "Payeer";
$lang['users withdrawal qiwi']                = "QIWI VISA Wallet";
$lang['users withdrawal perfect']             = "Perfect money";
$lang['users withdrawal swift']               = "SWIFT transfer";

// Verifi
$lang['users verifi title']                  = "Niveau ihres kontos";
$lang['users verifi anonymous']              = "Anonym";
$lang['users verifi verified']               = "Verifiziert";
$lang['users verifi business']               = "Geschäft";
$lang['users verifi available']              = "Verfügbar";
$lang['users verifi not_available']          = "Nicht verfügbar";
$lang['admin verifi check']                  = "Ihre dokumente sind auf check. Wir brauchen 2-3 werktage!";
$lang['users verifi deposit']                = "Depositengeld";
$lang['users verifi transfer']               = "geld übertragung";
$lang['users verifi exchange']               = "austausch";
$lang['users verifi request']                = "anfordern";
$lang['users verifi withdrawal']             = "Rückzug ronds";
$lang['users verifi acceptance']             = "annahme zahlungen";
$lang['users verifi get_it_now']             = "Hol es dir jetzt";
$lang['users verifi you_status']             = "Dein status";
$lang['users verifi upload']                 = "Dokumente hochladen";
$lang['users verifi save']                   = "Änderungen speichern";
$lang['users verifi close']                  = "Schließen";
$lang['users verifi unavailable']            = "Nicht verfügbar";
$lang['users verifi info']                   = "Wir überweisen niemals ihre persönlichen daten an jedermann oder verwenden sie für kommerzielle zwecke. Identifizierung hilft uns nur zwischen vertrauenswürdigen nutzern und potenziellen betrügern zu unterscheiden. Wenn eine person uns seine daten gibt, nehmen wir an, dass er nichts zu verbergen hat. ";
$lang['users verifi id']                     = "Personalausweis oder reisepass";
$lang['users verifi adress']                 = "Adressdokument";
$lang['users verifi doc_business']           = "Geschäftsregistrierungsunterlagen";

// Deposit
$lang['users deposit next']                  = "Ferner";
$lang['users deposit payment']               = "Gehen sie zur zahlung";

// Merchants
$lang['users merchants pay']                 = "Die rechnung begleichen";
$lang['users merchants btc_address']         = "BTC addresse";
$lang['users merchants btc_order']           = "Konto wartet auf nachschub für die höhe von";
$lang['users merchants btc_total']           = "Sie erhalten ihr konto";
$lang['users merchants btc_completed']       = "Nachdem die transaktion abgeschlossen ist";
$lang['users merchants btc_warning']         = "Bis zu sechs netzbestätigungen können erforderlich sein, um den vorgang abzuschließen.";
$lang['users merchants html']                = "HTML Form Generator";
$lang['users merchants all']                 = "Alle merchants";
$lang['users merchants id']                  = "Merchant ID";
$lang['users merchants item']                = "Zweck der Zahlung";
$lang['users merchants order']               = "Kontonummer";
$lang['users merchants price']               = "Preis";
$lang['users merchants custom']              = "Kommentar";
$lang['users merchants form']                = "Beispiel HTML formular";
$lang['users merchants generate']            = "Generieren!";
$lang['users merchants copy']                = "Kopiere den formularcode und lege ihn auf deine website.";
$lang['users merchants all']                 = "Alle merchants";
$lang['users merchants create']              = "Erstelle neuen merchant";
$lang['users merchants name']                = "Name";
$lang['users merchants url']                 = "URL site";
$lang['users merchants ipn']                 = "Status IPN link";
$lang['users merchants active']              = "Aktiv";
$lang['users merchants moderation']          = "Moderation";
$lang['users merchants disapproved']         = "Abgelehnt";
$lang['users merchants test']                = "Testformular ausfüllen";
$lang['users merchants detail']              = "Detail merchant";
$lang['users merchants password']            = "Merchant passwort";
$lang['users merchants new']                 = "Neu merchant";
$lang['users merchants comment']             = "Kommentar für die administration";
$lang['users merchants send']                = "Send für moderation";
$lang['users merchants success']             = "Anfrage wurde gesendet! Wir werden innerhalb von 2-3 werktagen eine entscheidung treffen!";

// Errors
$lang['users error add_user_failed']          = "%s kon niet worden toegevoegd!";
$lang['users error delete_user']              = "<strong>%s</strong> kon niet worden verwijderd!";
$lang['users error edit_profile_failed']      = "Uw profiel kan niet worden gewijzigd!";
$lang['users error edit_user_failed']         = "%s kan niet worden gewijzigd!";
$lang['users error email_exists']             = "De e-mail <strong>%s</strong> bestaat al!";
$lang['users error email_not_exists']         = "Dit e-mail bestaat niet!";
$lang['users error invalid_login']            = "Ongeldige gebruikersnaam of wachtwoord";
$lang['users error password_reset_failed']    = "Er is een probleem met het opnieuw instellen van uw wachtwoord. Gelieve opnieuw te proberen.";
$lang['users error register_failed']          = "Uw account kan niet worden gemaakt op dit moment. Probeer het opnieuw.";
$lang['users error user_id_required']         = "Een numerieke gebruikers-ID is vereist!";
$lang['users error user_not_exist']           = "Die gebruiker bestaat niet!";
$lang['users error username_exists']          = "De gebruikersnaam <strong>%s</strong> bestaat al!";
$lang['users error validate_failed']          = "Er was een probleem voor het valideren van uw account. Probeer het opnieuw.";
$lang['users error too_many_login_attempts']  = "Je hebt te vaak geprobeerd om in te loggen te snel gemaakt. Gelieve wacht %s seconden en probeer het opnieuw.";
$lang['users error fraud']                    = "Leider können sie diesen vorgang nicht abschließen. Bitte wenden sie sich an den kundendienst";
$lang['users error form']                     = "Bitte geben sie korrekte daten über die überweisung an";
$lang['users error wallet']                   = "Entschuldigung, nicht genug geld, um die operation durchzuführen";

$lang['users error warning']                  = "Warnung!";
$lang['users error not_fraud']                = "Einige operationen sind für ihr konto verboten. Kontaktieren sie die unterstützung für weitere details!";
$lang['users error invalid_form']             = "Sie haben falsche daten eingegeben!";
$lang['users error btc_network']              = "Die Gelder werden Ihrem Konto nach 6 Netzbestätigungen gutgeschrieben!";

// Vouchers
$lang['users vouchers menu']                  = "Vouchers";
$lang['users vouchers all']                   = "Alle vouchers";
$lang['users vouchers pending']               = "In erwartung";
$lang['users vouchers activated']             = "Aktiviert";
$lang['users vouchers code']                  = "Code";
$lang['users vouchers code_v']                = "Code voucher";
$lang['users vouchers creator']               = "Autor";
$lang['users vouchers activator']             = "Aktivator";
$lang['users vouchers voucher']               = "Voucher";
$lang['users vouchers detail']                = "Detail voucher";
$lang['users vouchers date']                  = "Aktivierungsdatum";
$lang['users vouchers new']                   = "Neuer code";
$lang['users vouchers new_v']                 = "Neuer voucher";
$lang['users vouchers create_v']              = "Erstellen voucher";
$lang['users vouchers ac']                    = "Aktivieren code";
$lang['users vouchers now']                   = "Aktivieren jetzt";
$lang['users vouchers date_created']          = "Erstellungsdatum";
$lang['users vouchers error']                 = "Dieser voucher existiert nicht oder wurde bereits im system aktiviert!";
$lang['users vouchers success']               = "Voucher erfolgreich aktiviert!";
$lang['users vouchers error_new']             = "Check the correctness of the entered values!";
$lang['users vouchers success_new']           = "Voucher erfolgreich geschaffen!";