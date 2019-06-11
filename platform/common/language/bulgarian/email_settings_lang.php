<?php
/**
 * @author      Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2016.
 * @license     The MIT License (MIT), http://opensource.org/licenses/MIT
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_protocol'] = 'Протокол';
$lang['email_protocol_tip'] = 'Протокол за изпращане на e-mail съобщения: mail, sendmail, smtp.';
$lang['email_mailpath'] = 'Път до Sendmail';
$lang['email_mailpath_tip'] = 'Път до програмата за изпращане на съобщения Sendmail. Важи, ако протоколът е sendmail, само за Linux системи.';
$lang['email_smtp_host'] = 'SMTP сървър';
$lang['email_smtp_host_tip'] = 'Адрес на SMTP сървъра. Важи, ако протоколът е SMTP.';
$lang['email_smtp_user'] = 'SMTP потребителско име';
$lang['email_smtp_user_tip'] = 'Потребителско име, регистрирано в SMTP сървъра. Важи, ако протоколът е SMTP.';
$lang['email_smtp_pass'] = 'SMTP парола';
$lang['email_smtp_pass_tip'] = 'Парола към регистрираното в SMTP сървъра потребителско име. Важи, ако протоколът е SMTP.';
$lang['email_smtp_port'] = 'SMTP порт';
$lang['email_smtp_port_tip'] = 'Номер на TCP порта за комуникация със SMTP сървъра. Важи, ако протоколът е SMTP. Обикновено портът е 25 при комуникация без криптиране, 465 при ssl криптиране, 587 при tls криптиране. Важи, ако протоколът е SMTP.';
$lang['email_smtp_crypto'] = 'SMTP криптиране';
$lang['email_smtp_crypto_tip'] = 'Вид на криптиране на комуникацията със SMTP сървъра: без криптиране, ssl, tls. Важи, ако протоколът е SMTP.';
$lang['email_none'] = 'няма';
$lang['email_email'] = 'E-mail адрес';
$lang['email_email_tip'] = 'E-mail адрес, на който ще се изпрати тестовото съобщение.';
$lang['mailer_enabled_tip'] = 'Разрешаване на системата да изпраща автоматично e-mail съобщения.';
$lang['site_email'] = 'E-mail адрес на сайта';
$lang['site_email_tip'] = 'E-mail адрес, от който системата изпраща автоматично съобщения.';
$lang['notification_email'] = 'E-mail адрес за уведомяване';
$lang['notification_email_tip'] = 'E-mail адрес, на който се получават автоматично съобщения за събития в системата.';
$lang['cc_email'] = 'E-mail адрес за копия';
$lang['cc_email_tip'] = 'E-mail адрес, на който се получават копия на автоматично генерираните съобщения.';
$lang['email_smtp_auto_tls'] = 'SMTP автоматично TLS';
$lang['email_smtp_auto_tls_tip'] = 'Дали да се активира автоматично TLS криптиране, ако се поддържа от сървъра дори ако "SMTP криптиране" не е зададено "tls".';
$lang['email_smtp_conn_options'] = 'SMTP опции на връзката';
$lang['email_smtp_conn_options_tip'] = 'Опции на SMTP връзката, записани в JSON формат, например: { "ssl": { "verify_peer": false, "verify_peer_name": false, "allow_self_signed": true } }';
$lang['email_dkim_domain'] = 'DKIM домейн';
$lang['email_dkim_domain_tip'] = 'Име на подписващия домейн, например "example.com".';
$lang['email_dkim_private'] = 'DKIM частен ключ';
$lang['email_dkim_private_tip'] = 'Име на файла, съдържащ частния ключ. Името пирема променливи като {APPPATH}, {COMMONPATH} и {PLATFORMPATH}';
$lang['email_dkim_selector'] = 'DKIM селектор';
$lang['email_dkim_selector_tip'] = 'DKIM селектор, дава допълнителна индикация за намиране на публичния ключ.';
$lang['email_dkim_passphrase'] = 'DKIM парола';
$lang['email_dkim_passphrase_tip'] = 'Използва се, ако частният ключ е криптиран.';
$lang['email_dkim_identity'] = 'DKIM идентичност';
$lang['email_dkim_identity_tip'] = 'Обикновено е email-адресът от който се изпраща съобщението.';
