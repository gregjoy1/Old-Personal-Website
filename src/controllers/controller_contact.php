<?php

	class cContact
	{

		private $_uri;

		public function __construct($uri)
		{
			$this->setURI($uri);
		}
		
		public function execute()
		{

			if(isset($_POST['submit']))
			{
				
				$previousFields = array(
					'name'		=> $_POST['name'],
					'email'		=> $_POST['email'],
					'message'	=> $_POST['message']
				);

				$errorMessage = '';

				// $errorMessage .= (!$this->_validateCaptcha() ? '<li>Please enter a valid CAPTCHA.</li>' : '');

				$errorMessage .= (
					!$this->_validateName($previousFields['name']) ? 
						'<li>Please enter your name.</li>' : 
						''
				);

				$errorMessage .= (
					!$this->_validateEmail($previousFields['email']) ? 
						'<li>Please enter a valid email address.</li>' : 
						''
				);

				$errorMessage .= (
					!$this->_validateMessage($previousFields['message']) ? 
						'<li>Please enter a message.</li>' : 
						''
				);

				if($errorMessage != '')
				{
					$errorMessage = '<ul>'.$errorMessage.'</ul>';
					$this->_drawFormPage($errorMessage, $previousFields);
				}
				else
				{
					$this->_sendMessage($previousFields);
					$this->_drawSuccessPage();
				}
			}
			else
			{
				$this->_drawFormPage();
			}

		}

		private function _drawSuccessPage()
		{
			ViewHelper::DrawHead('Contact', $this->getURI(), true);

				echo '<h1 class="page-header">';
					echo 'Contact Me';
				echo '</h1>';

				echo '<h3 class="contact-me-success">';
					echo 'Thank you for your message, I will get in touch as soon as possible.';
				echo '</h3>';

			ViewHelper::DrawFoot(true);
		}

		private function _drawFormPage($errorMessage = false, $previousFields = false)
		{
			ViewHelper::DrawHead('Contact', $this->getURI(), true);

				echo '<h1 class="page-header">';
					echo 'Contact Me';
				echo '</h1>';

				$this->_drawForm($errorMessage, $previousFields);

			ViewHelper::DrawFoot(true);
		}

		private function _drawForm($errorMessage = false, $previousFields = false)
		{

			global $publickey;

			if($previousFields)
			{
				$previousName = $previousFields['name'];
				$previousEmail = $previousFields['email'];
				$previousMessage = $previousFields['message'];
			}
			else
			{
				$previousName = '';
				$previousEmail = '';
				$previousMessage = '';
			}

			if($errorMessage)
			{
				echo '<span class="error-message">';
					echo $errorMessage;
				echo '</span>';
			}

			echo '<form class="contact-me-form" action="/contact" method="POST">';

				echo '<input type="text" name="name" placeholder="Your name" value="'.$previousName.'">';

				echo '<input type="text" name="email" placeholder="Your email address" value="'.$previousEmail.'">';

				echo '<textarea name="message" placeholder="message">'.$previousMessage.'</textarea>';

				echo recaptcha_get_html($publickey);

				echo '<input type="submit" name="submit" value="Send">';

			echo '</form>';
		}

		private function _validateName($name)
		{
			return (!is_null($name) && $name != '');
		}

		private function _validateEmail($email)
		{
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

		private function _validateMessage($message)
		{
			return (!is_null($message) && $message != '');
		}

		private function _validateCaptcha()
		{
			global $privatekey;

			return recaptcha_check_answer(
				$privatekey,
                $_SERVER["REMOTE_ADDR"],
                $_POST["recaptcha_challenge_field"],
                $_POST["recaptcha_response_field"]
            );
		}

		public function setURI($uri)
		{
			$this->_uri = $uri;
		}

		public function getURI()
		{
			return $this->_uri;
		}

		private function _sendMessage($previousFields)
		{

		}

	}

?>