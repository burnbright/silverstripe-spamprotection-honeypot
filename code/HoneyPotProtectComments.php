<?php
/**
 * HoneyPotProtectComments
 * This is a decorator for
 * @author Jeremy
 *
 */
class HoneyPotProtectComments extends Extension{
	function updatePageCommentForm(&$form){
		$form->Fields()->push(new HoneyPotSpamProtectionField());
	}
}