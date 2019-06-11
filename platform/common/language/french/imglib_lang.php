<?php
/**
 * @author      Gwenaël Gallon (GitHub : dev-ggallon), 2014.
 * @license     The MIT License (MIT), http://opensource.org/licenses/MIT
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['imglib_source_image_required']   = 'Vous devez spécifier une image source dans vos préférences.';
$lang['imglib_gd_required']             = 'La librairie GD est requise pour cette fonctionnalité.';
$lang['imglib_gd_required_for_props']   = 'Votre serveur doit supporter la librairie d\'images GD pour déterminer les propriétés de l\'image.';
$lang['imglib_unsupported_imagecreate'] = 'Votre serveur ne dispose pas de la fonction GD nécessaire pour traiter ce type d\'image.';
$lang['imglib_gif_not_supported']       = 'Le format GIF est souvent inutilisable du fait de restrictions de licence. Vous pourriez devoir utiliser le format JPG ou PNG à la place.';
$lang['imglib_jpg_not_supported']       = 'Le format JPG n\'est pas supporté.';
$lang['imglib_png_not_supported']       = 'Le format PNG n\'est pas supporté.';
$lang['imglib_jpg_or_png_required']     = 'Le protocole de redimensionnement spécifié dans vos préférences ne fonctionne qu\'avec les formats d\'image JPG ou PNG.';
$lang['imglib_copy_error']              = 'Une erreur est survenue lors du remplacement du fichier. Veuillez vérifier les permissions d\'écriture de votre répertoire.';
$lang['imglib_rotate_unsupported']      = 'La rotation d\'images n\'est pas supporter apparemment.';
$lang['imglib_libpath_invalid']         = 'Le chemin d\'accès à votre librairie de traitement d\'image n\'est pas correct. Veuillez indiquer le chemin correct dans vos préférences.';
$lang['imglib_image_process_failed']    = 'Le traitement de l\'image a échoué. Veuillez vérifier que votre serveur supporte le protocole choisi et que le chemin d\'accès à votre librairie de traitement d\'image est correct.';
$lang['imglib_rotation_angle_required'] = 'Un angle de rotation doit être indiqué pour tourner l\'image.';
$lang['imglib_invalid_path']            = 'Le chemin d\'accès à l\'image est incorrect.';
$lang['imglib_invalid_image']           = "L'image fournie n'est pas valide.";
$lang['imglib_copy_failed']             = 'Le processus de copie d\'image a échoué.';
$lang['imglib_missing_font']            = 'Impossible de trouver une police d\'écriture utilisable.';
$lang['imglib_save_failed']             = 'Impossible d\'enregistrer l\'image. Assurez-vous que vous avez les droits d\'écriture sur l\'image et sur le dossier.';
