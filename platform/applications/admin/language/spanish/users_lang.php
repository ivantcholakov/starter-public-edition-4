<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Language File
 */

// Titles
$lang['users title forgot']                   = "Olvido su contraseña";
$lang['users title login']                    = "Iniciar sesión";
$lang['users title profile']                  = "Perfil";
$lang['users title register']                 = "Registrarse";
$lang['users title user_add']                 = "Añadir usuario";
$lang['users title user_delete']              = "Confirmar Eliminar usuario";
$lang['users title user_edit']                = "Editar usuario";
$lang['users title user_list']                = "Lista de usuarios";
$lang['users title dasboard']                 = "Dashboard";
$lang['users title history']                  = "Historial de operaciones";
$lang['users title resolution']               = "Centro de Resolución";
$lang['users title det_dispute']              = "Detalles de la disputa";
$lang['users title support']                  = "Apoyo";
$lang['users title all_tickets']              = "Todas tickets";
$lang['users title request']                  = "Solicitar pago";
$lang['users title request_form']             = "Formulario de Solicitar pago";
$lang['users title new_ticket']               = "Nuevo ticket";
$lang['users title money_transfer']           = "Mandato postal";
$lang['users title form_transfer']            = "Formulario de transferencia dinero";
$lang['users title exchange']                 = "Cambio de divisas";
$lang['users title form_exchange']            = "Сambio de base moneda";
$lang['users title to_form_exchange']         = "Сambio de en base moneda";
$lang['users title withdrawal']               = "Retirada de fondos";
$lang['users title deposit']                  = "Depósito";
$lang['users title form_withdrawal']          = "Elija cómo recibir fondos";
$lang['users title form_deposit']             = "Elección del método de depósito";
$lang['users title verifi']                   = "Verificación";
$lang['users title settings']                 = "Configuraciones de la cuenta";
$lang['users title about']                    = "Perfil";

// Buttons
$lang['users button add_new_user']            = "Añadir usuario nuevo";
$lang['users button register']                = "Crear cuenta";
$lang['users button reset_password']          = "Restablecer la contraseña";
$lang['users button login_try_again']         = "Inténtalo de nuevo";

// Tooltips
$lang['users tooltip add_new_user']           = "Crear un nuevo usuario.";

// Links
$lang['users link forgot_password']           = "¿Olvidaste tu contraseña?";
$lang['users link register_account']          = "Regístrese para una cuenta.";

// Table Columns
$lang['users col first_name']                 = "Nombre";
$lang['users col is_admin']                   = "Administrador";
$lang['users col last_name']                  = "Apellido";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "Nombre de usuario";

// Form Inputs
$lang['users input email']                    = "Correo";
$lang['users input first_name']               = "Nombre";
$lang['users input is_admin']                 = "Es administrador";
$lang['users input language']                 = "Idioma";
$lang['users input last_name']                = "Apellido";
$lang['users input password']                 = "Contraseña";
$lang['users input password_repeat']          = "Repetir contraseña";
$lang['users input status']                   = "Estado";
$lang['users input username']                 = "Nombre de usuario";
$lang['users input username_email']           = "Nombre de usuario o Correo";

// Help
$lang['users help passwords']                 = "Solo escribe la contraseña si deseas cambiarla.";

// Messages
$lang['users msg add_user_success']           = "%s fue añadido exitosamente!";
$lang['users msg delete_confirm']             = "¿Seguro que quieres eliminar <strong>%s</ strong>? Esto no se puede deshacer.";
$lang['users msg delete_user']                = "Ha sido eliminado correctamente <strong>%s</strong>!";
$lang['users msg edit_profile_success']       = "Su perfil se modificó con éxito!";
$lang['users msg edit_user_success']          = "%s fue modificado exitosamente!!";
$lang['users msg register_success']           = "Gracias por registrarse, %s! Verifica tu correo por un mensaje de confirmación. Una vez que su cuenta ha sido verificada, usted será capaz de iniciar sesión con las credenciales proporcionadas.";
$lang['users msg password_reset_success']     = "Tu contraseña ha sido restablecida, %s! Por favor revise su correo electrónico para su nueva contraseña temporal.";
$lang['users msg validate_success']           = "Tu cuenta ha sido verificada. Ahora puede acceder a su cuenta.";
$lang['users msg email_new_account']          = "<p>Gracias por crear una cuenta en %s. Haga clic en el enlace de abajo para validar su dirección de correo electrónico y activar su cuenta.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['users msg email_new_account_title']    = "Nueva Cuenta de %s";
$lang['users msg email_password_reset']       = "<p>Su contraseña en %s ha sido restablecida. Haga clic en el enlace de abajo para iniciar sesión con su nueva contraseña:<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Una vez iniciada la sesión, asegúrese de cambiar la contraseña a algo que pueda recordar.</p>";
$lang['users msg email_password_reset_title'] = "Restablecer contraseña para %s";

// Menu
$lang['users menu dashboard']                 = "Dashboard";
$lang['users menu transfer']                  = "Mandato postal";
$lang['users menu exchange']                  = "Cambio de divisas";
$lang['users menu history']                   = "Historial de operaciones";
$lang['users menu dispute']                   = "Centro de Resolución";
$lang['users menu request']                   = "Solicitar pago";
$lang['users menu acceptance']                = "Pagos de aceptación";
$lang['users menu support']                   = "Apoyo";
$lang['users menu settings']                  = "Configuraciones de la cuenta";

// Dashboard
$lang['users dashboard ballance']             = "Balance";
$lang['users dashboard deposit']              = "Depósito";
$lang['users dashboard withdrawal']           = "Retirada";
$lang['users dashboard other_ballance']       = "Altri wallets";
$lang['users dashboard success_verif_title']  = "El estado de su cuenta - verificado";
$lang['users dashboard success_verif_text']   = "Excelente! Ahora puede retirar fondos de su cuenta sin restricciones.  <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard danger_verif_title']   = "El estado de su cuenta - anónimo";
$lang['users dashboard danger_verif_text']    = "Vaya! El estado de tu cuenta no te permite retirar fondos de tu cuenta. <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard warning_verif_title']  = "El estado de su cuenta - verificación pendiente";
$lang['users dashboard warning_verif_text']   = "Gracias! Recibimos sus documentos y daremos una decisión dentro de 2-3 días laborables. <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard info_verif_title']     = "El estado de su cuenta - business";
$lang['users dashboard info_verif_text']      = "Estupendo! Usted confirmado su estado de confiabilidad y puede aceptar pagos externos. <a href=\"/account/identification\">Learn More</a>";
$lang['users trans deposit']                  = "Depósito";
$lang['users trans withdrawal']               = "Retirada de fondos";
$lang['users trans transfer']                 = "Transfer";
$lang['users trans exchange']                 = "Cambio de divisas";
$lang['users trans external']                 = "Externo ingreso";
$lang['users trans pending']                  = "En espera";
$lang['users trans success']                  = "Confirmado";
$lang['users trans refund']                   = "Reembolso";
$lang['users trans dispute']                  = "Disputa";
$lang['users trans blocked']                  = "Bloqueado";
$lang['users trans id']                       = "ID";
$lang['users trans type']                     = "Tipo";
$lang['users trans sum']                      = "Total ";
$lang['users trans fee']                      = "Tasa de comisión";
$lang['users trans amount']                   = "Suma";
$lang['users trans status']                   = "Estado";
$lang['users trans sender']                   = "Remitente";
$lang['users trans receiver']                 = "Beneficiario";
$lang['users trans date']                     = "Fecha";
$lang['users trans comment']                  = "Comentario";
$lang['users trans cyr']                      = "Divisas";
$lang['users trans detail']                   = "Detalle";
$lang['users trans 10last']                   = "Las 10 últimas operaciones";
$lang['users trans all']                      = "Todas las transacciones";

// History
$lang['users history all']                    = "Historia de IP";
$lang['users history detail']                 = "Detalle transacción";
$lang['users history id_trans']               = "ID transacción";
$lang['users history open_dispute']           = "Abrir disputa";
$lang['users history print']                  = "Impresión en detalle";
$lang['users history of']                     = "Fecha";
$lang['users history open_dispute']           = "Abridura disputa";
$lang['users history dispute_title']          = "Motivo de la apertura de una controversia";
$lang['users history not_received']           = "No he recibido la mercancía";
$lang['users history not_desk']               = "El producto no coincide con la descripción";
$lang['users history reason']                 = "Describa la esencia de la disputa";
$lang['users history help']                   = "Especifique en el cuadro de texto la razón por la que abre esta disputa. Tan detallado como posible descripción del problema y pedir al vendedor de opciones para sus soluciones.";
$lang['users history start']                  = "Iniciar disputa";
$lang['users history dispute_success']        = "La disputa se abrió con éxito! Puede rastrear la disputa en el Centro de la Resolución";
$lang['users history swift']                  = "We expect your payment! Enter in the payment Bank order your username.";

// Dispute
$lang['users dispute list']                   = "Lista de disputas";
$lang['users dispute id']                     = "ID de disputa";
$lang['users dispute date']                   = "Fecha";
$lang['users dispute claimant']               = "Demandante";
$lang['users dispute action']                 = "Acción";
$lang['users dispute start_claim']            = "Comenzar reclamación";
$lang['users dispute close_claim']            = "Cerrar la disputa";
$lang['users disputes id_tran']               = "ID transacción";
$lang['users disputes id_tran_time']          = "Fecha transacción";
$lang['users disputes time_dispute']          = "Fecha disputa";
$lang['users disputes all_dispute']           = "Todas las disputas";
$lang['users disputes edit_dispute']          = "Editar disputa";
$lang['users disputes claimant']              = "Demandante";
$lang['usersn disputes defendant']            = "Acusado";
$lang['users disputes status']                = "Estado";
$lang['users disputes open']                  = "La disputa está abierta";
$lang['users disputes rejected']              = "La reclamación es rechazada";
$lang['users disputes satisfied']             = "Satisfacer de disputes";
$lang['users disputes claim']                 = "Reclamación";
$lang['users disputes detail']                = "Detalles de la disputa";
$lang['users disputes overwiev']              = "Revista de la disputa";
$lang['users disputes back']                  = "Espalda";
$lang['users disputes new_comment']           = "Nuevo comentario";
$lang['users disputes add_comment']           = "Agregar comentario";
$lang['users disputes comment_success']       = "Tu comentario ha sido añadido correctamente!";
$lang['users disputes open_claim_success']    = "La disputa se transfirió con éxito a la reclamación!";
$lang['users disputes transferred']           = "La controversia se transfiere a la reclamación. Por favor, espere la decisión de la administración.";
$lang['users disputes stop']                  = "La disputa se detiene. Mi problema ha sido resuelto";
$lang['users disputes success_stop']          = "La disputa se detuvo con éxito";

// Tickets
$lang['users tickets add']                    = "Crear nuevo ticket";
$lang['users tickets date']                   = "Fecha de Creación";
$lang['users tickets date_info']              = "Fecha";
$lang['users tickets user']                   = "Nombre de usuario";
$lang['users tickets message']                = "Mensaje";
$lang['users tickets create']                 = "Crear ticket";
$lang['users tickets title']                  = "Tema";
$lang['users tickets untreated']              = "No leído";
$lang['users tickets processed']              = "Procesamiento";
$lang['users tickets closed']                 = "Cerrado";
$lang['users tickets success_edit']           = "El ticket cambió correctamente";
$lang['users tickets reply']                  = "Contestar una ticket";
$lang['users tickets id']                     = "ID ticket";
$lang['users tickets close']                  = "Cerrar la ticket";
$lang['users tickets new']                    = "Nuevo comentario";
$lang['users tickets success_comment']        = "Comment added successfully!";
$lang['users tickets success_close']          = "Ticket cerrado con éxito!";
$lang['users tickets success_new']            = "Ticket creado con éxito! Contestaremos dentro de dos días laborales";
$lang['users tickets form']                   = "Rellene el formulario de apoyo de asistencia";
$lang['users tickets send']                   = "Cursar ticket";

// Request
$lang['users reqest purpose']                 = "Propósito de pago";
$lang['users reqest invoice']                 = "Número de factura";
$lang['users reqest email']                   = "Email";
$lang['users reqest note']                    = "Nota para el destinatario";
$lang['users reqest send']                    = "Enviar petición";
$lang['users reqest success']                 = "Tu solicitud se envió correctamente!";

// Transfer
$lang['users transfer amount']                = "Cantidad de transferencia";
$lang['users transfer sum']                   = "Tasa de comisión";
$lang['users transfer help_com']              = "Con tasa de comisión";
$lang['users transfer receiver']              = "Nombre de usuario beneficiario";
$lang['users transfer send']                  = "Enviar dinero";
$lang['users transfer success']               = "La transferencia de dinero se completó con éxito!";

// Exchange
$lang['users exchange rate']                  = "Tipos de cambio";
$lang['users exchange amount']                = "Cambio de divisas";
$lang['users exchange get']                   = "Se obtiene";
$lang['users exchange start']                 = "Comenzar cambio de divisas";
$lang['users exchange note']                  = "Operación de intercambio";
$lang['users exchange success']               = "Intercambio completada con éxito!";

// Withdrawal
$lang['users withdrawal amount']              = "Suma";
$lang['users withdrawal currency']            = "Divisa";
$lang['users withdrawal account']             = "Tu requisitos de la cuenta la recepción de fondos";
$lang['users withdrawal help']                = "Por favor, introduzca una cuenta válida a la que desea transferir dinero. Por ejemplo mail@gmail.com o 4276150025568996";
$lang['users withdrawal error']               = "Su status de verificación no es suficiente para realizar la operación";

// Method
$lang['users withdrawal card']                = "Tarjeta bancaria";
$lang['users withdrawal paypal']              = "PayPal";
$lang['users withdrawal btc']                 = "Bitcoin";
$lang['users withdrawal adv']                 = "ADV cash";
$lang['users withdrawal webmoney']            = "Webmoney";
$lang['users withdrawal payeer']              = "Payeer";
$lang['users withdrawal qiwi']                = "QIWI VISA Wallet";
$lang['users withdrawal perfect']             = "Perfect money";
$lang['users withdrawal swift']               = "SWIFT transfer";

// Verifi
$lang['users verifi title']                  = "Nivel de su cuenta";
$lang['users verifi anonymous']              = "Anónimo";
$lang['users verifi verified']               = "Verificado";
$lang['users verifi business']               = "Business";
$lang['users verifi available']              = "Disponible";
$lang['users verifi not_available']          = "No disponible";
$lang['admin verifi check']                  = "Sus documentos están en el cheque. Necesitamos 2-3 días laborables!";
$lang['users verifi deposit']                = "depósito";
$lang['users verifi transfer']               = "mandato postal";
$lang['users verifi exchange']               = "cambio de divisas";
$lang['users verifi request']                = "solicitar pago";
$lang['users verifi withdrawal']             = "retirada de fondos";
$lang['users verifi acceptance']             = "pagos de aceptación";
$lang['users verifi get_it_now']             = "Consiguelo ahora";
$lang['users verifi you_status']             = "Tu estado";
$lang['users verifi upload']                 = "Subir documentos";
$lang['users verifi save']                   = "Guardar";
$lang['users verifi close']                  = "Cerca";
$lang['users verifi unavailable']            = "Indisponible";
$lang['users verifi info']                   = "Nunca transferimos su información personal a nadie ni la utilizamos con fines comerciales. La identificación sólo nos ayuda a distinguir entre usuarios confiables y posibles estafadores. Si una persona nos da sus datos, suponemos que no tiene nada que ocultar.";
$lang['users verifi id']                     = "Tarjeta de identidad o pasaporte";
$lang['users verifi adress']                 = "Documento que confirma la dirección residencial";
$lang['users verifi doc_business']           = "Documentos de registro de empresas";

// Deposit
$lang['users deposit next']                  = "En lo sucesivo";
$lang['users deposit payment']               = "Ir al pago";

// Merchants 
$lang['users merchants pay']                 = "Pagar la cuenta";
$lang['users merchants btc_address']         = "BTC dirección";
$lang['users merchants btc_order']           = "El cuenta está pendiente de transferencia por la cantidad de";
$lang['users merchants btc_total']           = "Recibirás en tu cuenta";
$lang['users merchants btc_completed']       = "una vez finalizada la transacción";
$lang['users merchants btc_warning']         = "Se pueden requerir hasta seis confirmaciones de red para completar la operación.";
$lang['users merchants html']                = "Generador de formularios HTML";
$lang['users merchants all']                 = "Todas merchants";
$lang['users merchants id']                  = "Merchant ID";
$lang['users merchants item']                = "Orden de pago";
$lang['users merchants order']               = "Número cuenta";
$lang['users merchants price']               = "Precio";
$lang['users merchants custom']              = "Comentario";
$lang['users merchants form']                = "Ejemplo de formulario HTML";
$lang['users merchants generate']            = "Generar!";
$lang['users merchants copy']                = "Copie el código del formulario y colóquelo en su sitio web.";
$lang['users merchants all']                 = "Todas merchants";
$lang['users merchants create']              = "Crear nuevo merchant";
$lang['users merchants name']                = "Nombre";
$lang['users merchants url']                 = "URL sitio";
$lang['users merchants ipn']                 = "Status IPN enlace";
$lang['users merchants active']              = "Activo";
$lang['users merchants moderation']          = "Moderación";
$lang['users merchants disapproved']         = "Desestimar";
$lang['users merchants test']                = "Formulario de pago de prueba";
$lang['users merchants detail']              = "Detalle merchant";
$lang['users merchants password']            = "Merchant contraseña";
$lang['users merchants new']                 = "Nuevo merchant";
$lang['users merchants comment']             = "Comentario para la administración";
$lang['users merchants send']                = "Enviar para moderación";
$lang['users merchants success']             = "Se ha enviado la solicitud! Tomaremos una decisión dentro de 2-3 días hábiles!";

// Errors
$lang['users error add_user_failed']          = "%s no pudo ser añadido!";
$lang['users error delete_user']              = "<strong>%s</strong> no pudo ser eliminado!";
$lang['users error edit_profile_failed']      = "Su perfil no puede ser modificado!";
$lang['users error edit_user_failed']         = "%s no pudo ser modificado!";
$lang['users error email_exists']             = "El correo electrónico <strong>%s</strong> ya existe!";
$lang['users error email_not_exists']         = "Ese correo electrónico no existe!";
$lang['users error invalid_login']            = "Usuario o contraseña invalido";
$lang['users error password_reset_failed']    = "Hubo un problema al restablecer su contraseña. Por favor, vuelva a intentarlo.";
$lang['users error register_failed']          = "Tu cuenta no pudo crearce en este momento. Por favor, vuelva a intentarlo.";
$lang['users error user_id_required']         = "Se requiere un ID de usuario numérico!";
$lang['users error user_not_exist']           = "Ese usuario no existe!";
$lang['users error username_exists']          = "El usuario <strong>%s</strong> ya existe!";
$lang['users error validate_failed']          = "Hubo un problema al validar su cuenta. Por favor, vuelva a intentarlo.";
$lang['users error too_many_login_attempts']  = "Usted ha hecho demasiados intentos para iniciar sesión con demasiada rapidez. Por favor, espere %s segundos y vuelva a intentarlo.";
$lang['users error fraud']                    = "Lo sentimos, no puede completar esta operación. Póngase en contacto con el soporte técnico para aclaraciones";
$lang['users error form']                     = "Proporcione datos correctos sobre la transferencia";
$lang['users error wallet']                   = "Lo sentimos, no hay fondos suficientes para realizar la operación";

$lang['users error warning']                  = "Advertencia!";
$lang['users error not_fraud']                = "Algunas operaciones están prohibidas para su cuenta. Póngase en contacto con el servicio de asistencia para obtener más información!";
$lang['users error invalid_form']             = "Ha introducido datos incorrectos!";
$lang['users error btc_network']              = "Los fondos serán acreditados en su cuenta después de 6 confirmaciones de red!";

// Vouchers
$lang['users vouchers menu']                  = "Vales";
$lang['users vouchers all']                   = "Todos los vales";
$lang['users vouchers pending']               = "En espera";
$lang['users vouchers activated']             = "Activado";
$lang['users vouchers code']                  = "Código";
$lang['users vouchers code_v']                = "Código de vale";
$lang['users vouchers creator']               = "Creador";
$lang['users vouchers activator']             = "Activador";
$lang['users vouchers voucher']               = "Vale";
$lang['users vouchers detail']                = "Detalle de vale";
$lang['users vouchers date']                  = "Activation date";
$lang['users vouchers new']                   = "Nuevo código";
$lang['users vouchers new_v']                 = "Nuevo vale";
$lang['users vouchers create_v']              = "Crear vale";
$lang['users vouchers ac']                    = "Codigo de activacion";
$lang['users vouchers now']                   = "Activar ahora";
$lang['users vouchers date_created']          = "Fecha de creación";
$lang['users vouchers error']                 = "Este vale no existe o ya ha sido activado en el sistema!";
$lang['users vouchers success']               = "Vale activado correctamente!";
$lang['users vouchers error_new']             = "Comprobar la corrección de los valores introducidos!";
$lang['users vouchers success_new']           = "Vale activado creado!";