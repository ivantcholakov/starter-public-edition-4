<?php
/**
 * @author      Gwenaël Gallon (GitHub : dev-ggallon), 2014.
 * @license     The MIT License (MIT), http://opensource.org/licenses/MIT
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array']         = 'La méthode de validation d\'email n\'accepte que les tableaux associatifs (array).';
$lang['email_invalid_address']       = 'Adresse email invalide : %s';
$lang['email_attachment_missing']    = 'Impossible de localiser le fichier joint suivant : %s';
$lang['email_attachment_unreadable'] = 'Impossible d\'ouvrir ce fichier joint : %s';
$lang['email_no_from']               = 'Vous ne pouvez pas envoyer des messages sans tête "From".';
$lang['email_no_recipients']         = 'Vous devez spécifier des destinataires : To, Cc, ou Bcc.';
$lang['email_send_failure_phpmail']  = 'Impossible d\'envoyer des emails avec la fonction mail() de PHP. Votre serveur n\'est peut-être pas configuré pour utiliser cette méthode.';
$lang['email_send_failure_sendmail'] = 'Impossible d\'envoyer des emails avec la méthode Sendmail de PHP. Votre serveur n\'est peut-être pas configuré pour utiliser cette méthode.';
$lang['email_send_failure_smtp']     = 'Impossible d\'envoyer des emails avec la méthode SMTP de PHP. Votre serveur n\'est peut-être pas configuré pour utiliser cette méthode.';
$lang['email_sent']                  = 'Votre message a bien été expédié via le protocole suivant : %s';
$lang['email_no_socket']             = 'Impossible d\'ouvrir un socket avec Sendmail. Veuillez vérifier votre configuration.';
$lang['email_no_hostname']           = 'Vous n\'avez pas spécificé d\'hôte SMTP.';
$lang['email_smtp_error']            = 'L\'erreur SMTP suivante s\'est produite : %s';
$lang['email_no_smtp_unpw']          = 'Erreur : Vous devez spécifier un nom d\'utilisateur et un mot de passe SMTP.';
$lang['email_failed_smtp_login']     = 'Échec lors de l\'envoi de la commande AUTH LOGIN. Erreur : %s';
$lang['email_smtp_auth_un']          = 'Impossible d\'identifier le nom d\'utilisateur. Erreur : %s';
$lang['email_smtp_auth_pw']          = 'Impossible d\'identifier le mot de passe. Erreur : %s';
$lang['email_smtp_data_failure']     = 'Impossible d\'envoyer les données : %s';
$lang['email_exit_status']           = 'Code d\'état de sortie : %s';