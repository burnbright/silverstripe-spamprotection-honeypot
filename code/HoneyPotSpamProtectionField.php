<?php
/**
 * Honey Pot Spam Protection
 * @author Jeremy Shipman - jeremy [at] burnbright [dot] co [dot] nz
 * 
 * Adds a CSS-hidden field to a form, which if populated will fail validation.
 * Simply add it to a form's fields to use.
 * 
 */
class HoneyPotSpamProtectionField extends SpamProtectorField{
	
	static $validatemembers = false;
	
	function __construct($name = "HoneyPotSpamProtectionField"){
		parent::__construct($name);
		$this->title = _t('HoneyPotSpamProtectionField.TITLE', "Please do not fill this field out. It prevents spam.");
	}
	
	function validate_members($set = true){
		self::$validatemembers = $set;
	}
	
	function Field(){
		//display field after validation if it fails
		if(!$this->messageType){
			$htmlid = $this->name;		
			$css =<<<CSS
				form div#$htmlid{
					margin:0;padding-left:1px;
					height:1px;
					width:0;
					overflow:hidden;
				}
CSS;
			Requirements::customCSS($css,$this->name);
		}
		return parent::Field();
	}
	
	function validate($validator){
		if(Permission::check('ADMIN')){
			return true;
		}
		if(self::$validatemembers && Member::currentUserID()){
			return true;	
		}	
		if($this->value){
			$validator->validationError(
 				$this->name,
				_t('HoneyPotSpamProtectionField.VALIDATION', "This field should not be populated."),
				"validation"
			);
			return false;
		}
		return true;		
	}
	
}