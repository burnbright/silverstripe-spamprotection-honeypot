<?php
class HoneyPotProtector implements SpamProtector {

	/**
	 * Return the Field that we will use in this protector
	 *
	 * @return string
	 */
	function getFormField($name = "HoneyPotSpamProtectionField", $title = "HoneyPot", $value = null, $form = null, $rightTitle = null) {
		return new HoneyPotSpamProtectionField($name, $title, $value, $form, $rightTitle);
	}

	/**
	 * Needed for the interface. Recaptcha does not have a feedback loop
	 *
	 * @return boolean
	 */
	function sendFeedback($object = null, $feedback = "") {
		return false;
	}
}
