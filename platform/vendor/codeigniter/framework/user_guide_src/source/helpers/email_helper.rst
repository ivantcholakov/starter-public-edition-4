############
Email Helper
############

The Email Helper provides some assistive functions for working with
Email. For a more robust email solution, see CodeIgniter's :doc:`Email
Class <../libraries/email>`.

.. important:: The Email helper is DEPRECATED and is currently
	only kept for backwards compatibility.

.. contents::
  :local:

.. raw:: html

  <div class="custom-index container"></div>

Loading this Helper
===================

This helper is loaded using the following code::

	$this->load->helper('email');

Available Functions
===================

The following functions are available:


.. php:function:: valid_email($email)

	:param	string	$email: E-mail address
	:returns:	TRUE if a valid email is supplied, FALSE otherwise
	:rtype:	bool

	Checks if the input is a correctly formatted e-mail address. Note that it
	doesn't actually prove that the address will be able to receive mail, but
	simply that it is a validly formed address.

	Example::

		if (valid_email('email@somesite.com'))
		{
			echo 'email is valid';
		}
		else
		{
			echo 'email is not valid';
		}

	.. note:: All that this function does is to use PHP's native ``filter_var()``::

		(bool) filter_var($email, FILTER_VALIDATE_EMAIL);

.. php:function:: send_email($recipient, $subject, $message)

	:param	string	$recipient: E-mail address
	:param	string	$subject: Mail subject
	:param	string	$message: Message body
	:returns:	TRUE if the mail was successfully sent, FALSE in case of an error
	:rtype:	bool

	Sends an email using PHP's native `mail() <http://php.net/function.mail>`_
	function.

	.. note:: All that this function does is to use PHP's native ``mail``

		::

			mail($recipient, $subject, $message);

	For a more robust email solution, see CodeIgniter's :doc:`Email Library
	<../libraries/email>`.
