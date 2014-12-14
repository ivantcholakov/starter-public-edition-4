<?php
/**
 * @author      Gwenaeël Gallon (GitHub : dev-ggallon), 2014.
 * @license     The MIT License (MIT), http://opensource.org/licenses/MIT
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['migration_none_found']          = 'Aucune migration n\'a été trouvé.';
$lang['migration_not_found']           = 'Aucune migration n\'a pu être trouvée avec le numéro de version : %d.';
$lang['migration_sequence_gap']        = 'Il y a un problème dans la séquence de migration numéro de version : %d.';
$lang['migration_multiple_version']    = 'Il y a plusieurs migrations avec le même numéro de version : %d.';
$lang['migration_class_doesnt_exist']  = 'La classe de migration "%s" n\'a pu être trouvée.';
$lang['migration_missing_up_method']   = 'La classe de migration "%s" est manquant dans la méthode "up".';
$lang['migration_missing_down_method'] = 'La classe de migration "%s" est manquant dans la méthode "down".';
$lang['migration_invalid_filename']    = 'Migration "%s" a un nom de fichier non valide.';
