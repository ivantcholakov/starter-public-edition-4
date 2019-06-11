<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Language File
 */

// Titles
$lang['admin title admin']                = "Administración";
$lang['admin title currency']             = "Moneda del gerente";
$lang['admin title logs']                 = "Registro de actividades";
$lang['admin title transactions']         = "Transacciones";
$lang['admin title edit_transactions']    = "Detalles de la transacción";
$lang['admin title edit_dispute']         = "Detalles de la disputa";
$lang['admin title disputes']             = "Disputas";
$lang['admin title tickets']              = "Tickets";
$lang['admin title verification']         = "Verificación";
$lang['admin title template']             = "Plantillas de mensajes";
$lang['admin title request']              = "Solicitar pago";
$lang['admin title fee']                  = "Gerente de tasa comision de retirada ";
$lang['admin title fee_dep']              = "Gerente de tasa comision de depositar";

// Buttons
$lang['admin button csv_export']          = "CSV Exporte";
$lang['admin button dashboard']           = "Dashboard";
$lang['admin button delete']              = "Borrar";
$lang['admin button edit']                = "Editar";
$lang['admin button messages']            = "Mensajes";
$lang['admin button settings']            = "Ajustes";
$lang['admin button users']               = "Usuarios";
$lang['admin button users_verification']  = "Verificación en espera";
$lang['admin button blocked_users']       = "Obstruido";
$lang['admin button users_business']      = "Business cuentas";
$lang['admin button currency']            = "Divisa";
$lang['admin button users_add']           = "Añadir nuevo usuario";
$lang['admin button users_list']          = "Lista de usuarios";
$lang['admin button users_all']           = "Todos los usuarios";
$lang['admin button transactions']        = "Transacciónes";
$lang['admin button all_transactions']    = "Todas las transacciones";
$lang['admin button deposits']            = "Depósitos";
$lang['admin button withdrawal_funds']    = "Retirada de fondos";
$lang['admin button transfers']           = "Transferencias";
$lang['admin button disputes']            = "Disputas";
$lang['admin button logs']                = "Registro de actividad";
$lang['admin button disputes']            = "Disputas";
$lang['admin button tickets']             = "Tickets";
$lang['admin button untreated_tickets']   = "No leído tickets";
$lang['admin button processed_tickets']   = "Procesamiento tickets";
$lang['admin button closed_tickets']      = "Cerrados tickets";
$lang['admin button add_tickets']         = "Añadir nuevo ticket";
$lang['admin button det_tickets']         = "Detalles del ticket";
$lang['admin button pages']               = "Administrar páginas";
$lang['admin button template']            = "Mensajes de plantilla";
$lang['admin button pending']             = "Pendiente";
$lang['admin button confirmed']           = "Confirmed";
$lang['admin button disputed']            = "Disputado";
$lang['admin button blocked']             = "Bloqueados";
$lang['admin button refunded']            = "Reembolsado";
$lang['admin button all_dispute']         = "Todas las disputas";
$lang['admin button open_disputes']       = "Abierto disputas";
$lang['admin button open_claims']         = "Abierto reclamación";
$lang['admin button rejected_disputes']   = "Desechado disputes";
$lang['admin button satisfied_disputes']  = "Satisfacer de disputes";
$lang['admin button fees']                = "Tasa de comisión";
$lang['admin button fees_win']            = "Tasa de retirada fondos";
$lang['admin button fees_dep']            = "Tasa de depósito";

// Tooltips
$lang['admin tooltip csv_export']         = "Exportación de un archivo CSV de todos los resultados con los filtros aplicados.";
$lang['admin tooltip filter']             = "Actualizar resultados en función de sus filtros.";
$lang['admin tooltip filter_reset']       = "Borrar todos los filtros y clasificación.";

// Form Inputs
$lang['admin input active']               = "Activo";
$lang['admin input inactive']             = "Inactivo";
$lang['admin input items_per_page']       = "artìculos/página";
$lang['admin input use_detail']           = "Detalle del usuario";
$lang['admin input select']               = "seleccionar...";
$lang['admin input username']             = "Nombre de usuario";
$lang['admin input verifi_status']        = "Estado de verificación";
$lang['admin input verifi_ok']            = "Verificado";
$lang['admin input anonymous']            = "Anónimo";
$lang['admin input business']             = "Business";
$lang['admin input waiting']              = "Verificación en espera";
$lang['admin input fraud_status']         = "Estado de fraude";
$lang['admin input fraud_none']           = "No limites";
$lang['admin input no_withdrawal']        = "No retirada";
$lang['admin input fraud_banned']         = "Banned todas operaciones";
$lang['admin input overview']             = "Visualización cuenta";
$lang['admin input wallet']               = "Wallet";
$lang['admin input phone']                = "Teléfono";
$lang['admin input document']             = "Documentos";
$lang['admin input debit_base']           = "Débito";
$lang['admin input charge']               = "Cambio";
$lang['admin input add_transaction']      = "Añadir transacción";
$lang['admin input login_history']        = "Historial de operaciones";
$lang['admin input all_transactions']     = "Todas transacciones";
$lang['admin input you_change']           = "Tú cambiar";
$lang['admin input available']            = "Disponible para intercambio";
$lang['admin input getting']              = "Usted está consiguiendo";
$lang['admin input base_exchange']        = "Cambio de base moneda para extra moneda";
$lang['admin input start_charge']         = "Comenzar cambio";
$lang['admin input error_charge']         = "Usted no tiene fondos suficientes para realizar operaciones";

// logs user
$lang['admin log id']                   = "ID";
$lang['admin log date']                 = "Data";
$lang['admin log ip']                   = "dirección IP";
$lang['admin log event']                = "Evento";
$lang['admin log device']               = "Ver dispositivo";
$lang['admin log last_operations']      = "Las 20 últimas operaciones";
$lang['admin log last_trans']           = "Las últimas 10 transacciones salientes";
$lang['admin log last_trans_in']        = "Las últimas 10 transacciones entrantes";
$lang['admin log see_operations']       = "Ver todas las operaciones";
$lang['admin log see_trans']            = "Todas las transacciones salientes";
$lang['admin log see_trans_in']         = "Todas las transacciones entrantes";
$lang['admin log login']                = "Iniciar la sesión";
$lang['admin log username']             = "Nombre de usuario";
$lang['admin log clear']                = "Borrar registro";
$lang['admin log search']               = "Búsqueda";
$lang['admin log list']                 = "Todos los registros";

// Transactions
$lang['admin trans id']                 = "ID";
$lang['admin trans type']               = "Tipo";
$lang['admin trans sum']                = "Total";
$lang['admin trans fee']                = "Tasa de comisión";
$lang['admin trans amount']             = "Suma";
$lang['admin trans status']             = "Estado";
$lang['admin trans sender']             = "Remitente";
$lang['admin trans receiver']           = "Beneficiario";
$lang['admin trans time']               = "Hora";
$lang['admin trans deposit']            = "Depósito";
$lang['admin trans withdrawal']         = "Retirada";
$lang['admin trans transfer']           = "Transferir";
$lang['admin trans exchange']           = "Intercambio";
$lang['admin trans external']           = "SCI";
$lang['admin trans pending']            = "Pendiente";
$lang['admin trans success']            = "Confirmado";
$lang['admin trans refund']             = "Reembolso";
$lang['admin trans dispute']            = "Disputa";
$lang['admin trans blocked']            = "Bloqueados";
$lang['admin trans edit']               = "Editar transacción";
$lang['admin trans comment']            = "Comentario";
$lang['admin trans admin_comment']      = "Nota de administración";
$lang['admin trans check_notify']       = "Notificación de activación";
$lang['admin trans notification']       = "Notificación de mensaje";
$lang['admin trans add_ball']           = "Añadir para equilibrar";
$lang['admin trans win_ball']           = "Cargar en balance";
$lang['admin trans add_success']        = "Transacción completada!";
$lang['admin trans all']                = "Todas las transacciones";
$lang['admin trans pen_trans']          = "Transacciones pendientes";
$lang['admin trans com_trans']          = "Transacciones confirmadas";
$lang['admin trans dis_trans']          = "Transacciones en disputa";
$lang['admin trans blo_trans']          = "Transacciones bloqueadas";
$lang['admin trans ref_trans']          = "Transacciones reembolso";
$lang['admin trans success_blocked']    = "The transaction was successfully blocked. Funds are debited from the user's account.";
$lang['admin trans success_confirm']    = "The transaction was successfully confirmed. Funds added to the balance of the user.";
$lang['admin trans success_refund']     = "Money was successfully returned to the sender!";

// Disputes
$lang['admin disputes id_tran']         = "ID transacción";
$lang['admin disputes id_tran_time']    = "Data transacción";
$lang['admin disputes time_dispute']    = "Data disputa";
$lang['admin disputes all_dispute']     = "Todos disputas";
$lang['admin disputes edit_dispute']    = "Editar disputa";
$lang['admin disputes claimant']        = "Demandador";
$lang['admin disputes defendant']       = "Respondedor";
$lang['admin disputes status']          = "Estado";
$lang['admin disputes open']            = "La disputa está abierta";
$lang['admin disputes rejected']        = "Reclamación rechazado";
$lang['admin disputes satisfied']       = "Considerar la demanda";
$lang['admin disputes claim']           = "Reclamación";
$lang['admin disputes detail']          = "Detalles de disputa";
$lang['admin disputes success']         = "La disputa se cambió con éxito";
$lang['admin disputes overview']        = "Visualizacion";
$lang['admin disputes written']         = "Escrito de";
$lang['admin disputes new_comment']     = "Nuevo comentario";
$lang['admin disputes add_comment']     = "Agregar comentario";
$lang['admin disputes decision']        = "Decisión";
$lang['admin disputes open']            = "Abrir disputa";
$lang['admin disputes open_claim']      = "Abrir reclamación";
$lang['admin disputes reject']          = "Rechazar";
$lang['admin disputes satisfy']         = "Satisfacer";
$lang['admin disputes admin']           = "Administración";
$lang['admin disputes success_com']     = "El comentario se agregó correctamente a la disputa";
$lang['admin disputes transferred']     = "La disputa se transfiere a la reclamación. Por favor, espere la decisión de la administración.";
$lang['admin disputes open_dispute_ad'] = "TLa disputa está abierta. Puede dejar un mensaje para tomar una decisión sobre el reembolso.";
$lang['admin disputes open_reject']     = "Después de un análisis exhaustivo de las pruebas aportadas
Hemos completado la investigación y hemos decidido a favor del beneficiario.";
$lang['admin disputes open_satisfy']    = "Después de un análisis exhaustivo de las pruebas aportadas
Hemos completado la investigación y decidido a favor del remitente del pago. De acuerdo con nuestro acuerdo con el usuario, debitamos el importe en disputa de su cuenta.";
$lang['admin disputes success_reject']  = "La reclamación fue rechazada con éxito";
$lang['admin disputes success_dispute'] = "La disputa se abrió con éxito";
$lang['admin disputes success_claim']   = "La reclamación se abrió con éxito. El beneficiario del pago en disputa no podrá retirar dinero de su cuenta hasta que se tome una decisión.";
$lang['admin disputes success_satisfy'] = "La demanda está satisfecha. El dinero fue devuelto.";
$lang['admin disputes odi_status']      = "Abiertas disputas";
$lang['admin disputes ocl_status']      = "Abiertas reclamaciones";
$lang['admin disputes rej_status']      = "Rechazado disputas";
$lang['admin disputes sat_status']      = "Satisfechos disputas";

// Tickets
$lang['admin tickets all']              = "Todos tickets";
$lang['admin tickets date']             = "Data de creación";
$lang['admin tickets date_info']        = "Data";
$lang['admin tickets user']             = "Nombre de usuario";
$lang['admin tickets message']          = "Mensaje";
$lang['admin tickets create']           = "Crear ticket";
$lang['admin tickets title']            = "Titular ";
$lang['admin tickets untreated']        = "No leído";
$lang['admin tickets processed']        = "Procesadas";
$lang['admin tickets closed']           = "Cerrado";
$lang['admin tickets success_edit']     = "El ticket cambió correctamente";
$lang['admin tickets reply']            = "Contestar una ticket";
$lang['admin tickets id']               = "ID ticket";
$lang['admin tickets textarea']         = "Su respuesta a un mensaje de usuario";
$lang['admin tickets close']            = "Cerrar ticket";
$lang['admin tickets admin_comment']    = "Tu mensaje ha sido enviado. Se ha cambiado correctamente el estado del ticket!";
$lang['admin tickets success_close']    = "Ticket cerrado con éxito! El usuario no puede dejar comentarios.";
$lang['admin tickets success_create']   = "Ticket creado correctamente!";

// Verification
$lang['admin verification all']         = "Todos peticiones";
$lang['admin verification pending']     = "En espera";
$lang['admin verification confirmed']   = "Confirmar";
$lang['admin verification disapproved'] = "Rechazado";
$lang['admin verification img']         = "Documento";
$lang['admin verification doc_user']    = "Tarjeta de identificación";
$lang['admin verification doc_adress']  = "Confirmar la dirección de registro";
$lang['admin verification doc_bus']     = "Documentos que confirman negocio";
$lang['admin verification doc_for']     = "para";
$lang['admin verification action']      = "Acción";
$lang['admin verification comfirm']     = "Confirmar";
$lang['admin verification comfirm_ver'] = "Confirmar y verificar";
$lang['admin verification comfirm_bus'] = "Confirmar y cuenta de business";
$lang['admin verification reject']      = "Rechazar documentos";
$lang['admin verification list']        = "Listar documentos";
$lang['admin verification reject_suc']  = "Documentos rechazados con éxito!";
$lang['admin verification com_suc']     = "Los documentos se han verificado correctamente!";
$lang['admin verification com_ver_suc'] = "Los documentos se han verificado correctamente. El usuario ha recibido un estado verificado!";
$lang['admin verification com_bus_suc'] = "Los documentos se han verificado correctamente. El usuario recibió el estado de business!";

// Template
$lang['admin template email']           = "Plantilla de Email";
$lang['admin template sms']             = "Plantilla de SMS";
$lang['admin template edit']            = "Editar email plantilla";
$lang['admin template sms_edit']        = "Editar sms plantilla";
$lang['admin template status']          = "Estado";
$lang['admin template enabled']         = "Disponible";
$lang['admin template disabled']        = "Inaccessible";
$lang['admin template success']         = "Plantilla modificada correctamente!";

// Dashboard
$lang['admin dashboard users']          = "Total de usuarios";
$lang['admin dashboard trans']          = "Total de transacciones";
$lang['admin dashboard dispute']        = "Disputas totales";
$lang['admin dashboard link']           = "Empezar a gestionar";
$lang['admin dashboard last_trans']     = "Las últimas 5 transacciones pendientes";
$lang['admin dashboard last_tickets']   = "Las últimas 5 tickets pendientes";
$lang['admin dashboard last_act']       = "Última actividad";

// Fees
$lang['admin fees title']               = "Todos los métodos";
$lang['admin fees ckeck']               = "Activar";
$lang['admin fees fees']                = "Tasa de comisión";
$lang['admin fees card']                = "Tarjetas bancarias";
$lang['admin fees pp']                  = "PayPal";
$lang['admin fees btc']                 = "Bitcoin";
$lang['admin fees adv']                 = "ADV Cash";
$lang['admin fees wmz']                 = "Webmoney";
$lang['admin fees payeer']              = "Payeer";
$lang['admin fees qiwi']                = "QIWI";
$lang['admin fees perfect']             = "Perfect Money";
$lang['admin fees acc_perfect']         = "Cuenta Perfect Money";
$lang['admin fees swift']               = "SWIFT";
$lang['admin fees success']             = "Cantidad de comisión cambiada con éxito";
$lang['admin fees check']               = "Sus documentos están a prueba. Necesitamos 2-3 días laborables!";
$lang['admin fees acc_pp']              = "Cuenta Paypal";
$lang['admin fees acc_payeer']          = "Merchant ID";
$lang['admin fees key_payeer']          = "Llave secreta";
$lang['admin fees crypt_payeer']        = "Clave de encriptación";
$lang['admin fees acc_adv']             = "Cuenta ADV";
$lang['admin fees sci_name']            = "SCI nombre";
$lang['admin fees pass_dep']            = "Contraseña";
$lang['admin fees shop_id']             = "Tienda ID";
$lang['admin fees key_perfect']         = "Código secreto";
$lang['admin fees swift_desk']          = "Instrucción para pagador";

// Merchants
$lang['admin merchant title']           = "Merchants";
$lang['admin merchant active']          = "Activo";
$lang['admin merchant moderation']      = "Moderación";
$lang['admin merchant disapproved']     = "Desaprobado";
$lang['admin merchant all_merch']       = "Todas merchants";
$lang['admin merchant link']            = "URL sitio";
$lang['admin merchant detail']          = "Detalle merchant";
$lang['admin merchant edit']            = "Editar merchant";
$lang['admin merchant merchant']        = "Merchant ID";
$lang['admin merchant name']            = "Nombre";
$lang['admin merchant password']        = "Contraseña";
$lang['admin merchant ipn_link']        = "IPN link";
$lang['admin merchant comment']         = "Comentario";
$lang['admin merchant reject']          = "Rechazar";
$lang['admin merchant success']         = "El merchant de estado se ha modificado correctamente";

//Pay method
$lang['admin pay title']                = "Métodos de pago";
$lang['admin pay sci']                  = "Merchant";
$lang['admin pay manager']              = "Gerente tasa de SCI";
$lang['admin pay wallet']               = "Wallet";

// Table Columns
$lang['admin col actions']                = "Acciones";
$lang['admin col status']                 = "Estado";

// Form Labels
$lang['admin label rows']                 = "%s row(s)";
$lang['admin label read']                 = "Leer el mensaje";
$lang['admin label limit']                = "Advertencia! Se está acercando al límite de GAP para";
$lang['admin label more']                 = "Detalle...";
$lang['admin label gap']                  = "Límite de GAP ahora:";

// Vouchers
$lang['admin vouchers menu']              = "Vales";
$lang['admin vouchers all']               = "Todos los vales";
$lang['admin vouchers pending']           = "En espera";
$lang['admin vouchers activated']         = "Activado";
$lang['admin vouchers code']              = "Código";
$lang['admin vouchers creator']           = "Creador";
$lang['admin vouchers activator']         = "Activador";
$lang['admin vouchers voucher']           = "Vale";
$lang['admin vouchers detail']            = "Detalle de vale";
$lang['admin vouchers date']              = "Activation date";