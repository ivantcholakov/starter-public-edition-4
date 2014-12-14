<?php
/**
 * @author      Gwenaeël Gallon (GitHub : dev-ggallon), 2014.
 * @license     The MIT License (MIT), http://opensource.org/licenses/MIT
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['db_invalid_connection_str']     = 'Impossible de déterminer les paramètres de la base de données avec l\'instruction de connection donnée.';
$lang['db_unable_to_connect']          = 'Impossible de se connecter à la base de données en utilisant les paramètres fournis.';
$lang['db_unable_to_select']           = 'Impossible de sélectionner la base de données demandée : %s';
$lang['db_unable_to_create']           = 'Impossible de créer la base de données demandée : %s';
$lang['db_invalid_query']              = 'La requête que vous avez soumise n\'est pas valide.';
$lang['db_must_set_table']             = 'Vous devez spécifier une table à utiliser pour effectuer votre requête.';
$lang['db_must_use_set']               = 'Vous devez utiliser la méthode "set()" pour mettre à jour une entrée.';
$lang['db_must_use_index']             = 'Vous devez spécifier un index à cibler pour les mises à jour par lot.';
$lang['db_batch_missing_index']        = 'Une ou plusieurs lignes envoyées pour une mise à jour par lot n\'ont pas l\'index spécifié.';
$lang['db_must_use_where']             = 'Il faut obligatoirement spécifier le critère de sélection "WHERE" pour mettre à jour une entrée.';
$lang['db_del_must_use_where']         = 'Il faut obligatoirement spécifier le critère de sélection "WHERE" pour supprimer une entrée.';
$lang['db_field_param_missing']        = 'Récupérer des champs requiert le nom de la table en paramètre.';
$lang['db_unsupported_function']       = 'Cette fonctionnalité n\'est pas disponible pour la base de données que vous utilisez.';
$lang['db_transaction_failure']        = 'Erreur de transaction : Rollback effectué';
$lang['db_unable_to_drop']             = 'Impossible de supprimer la base de données spécifiée.';
$lang['db_unsupported_feature']        = 'Fonctionnalité non supportée sur le système de gestion de base de données que vous utilisez.';
$lang['db_unsupported_compression']    = 'Le format de compression que vous avez choisi n\'est pas supporté par votre serveur.';
$lang['db_filepath_error']             = 'Écriture des données impossible dans le fichier dont vous avez indiqué le chemin d\'accès.';
$lang['db_invalid_cache_path']         = 'Le dossier de cache que vous avez indiqué n\'est pas valide ou n\'est pas accessible en écriture.';
$lang['db_table_name_required']        = 'Un nom de table est nécessaire à cette opération.';
$lang['db_column_name_required']       = 'Un nom de champ est nécessaire à cette opération.';
$lang['db_column_definition_required'] = 'Une définition de champ est nécessaire à cette opération.';
$lang['db_unable_to_set_charset']      = 'Impossible de définir le charset de connexion client : %s';
$lang['db_error_heading']              = 'Une erreur de base de données s\'est produite.';
