/* ===================================================
 * General Purpose JS Functions
 * ===================================================
 * 
 * @author:		Mike Walton
 * @updated:	25/04/2013
 * @desc:		general purpose js functions for form
 * 				validation, ui interactions etc.
 * 
 * ================================================== */

/* ===================================================
 * General runtime operations
 * =================================================== */
// 'Constants'
var DEBUG = true;	// turn on console logging

// if trim isn't implemented by the browser then teach it 
if (!String.prototype.trim) {
	String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g,'');
	}
}
/* =================================================== */
 	

/* ===================================================
 * fieldIsValid function
 * ===================================================
 * @params:		type(String) - type of check
 * 				field(Object) - the form field object to check
 * 				fieldmatch(Object) - the form field object to check
 * @returns: 	boolean
 * @desc:		check a form field, types are...
 * 		name: alpha numberic, apostrophe and dashes
 * 		email: email validation to catch most errors without false positives
 * 		length: 
 * =================================================== */
function fieldIsValid(field, type, fieldmatch) {
	// define variables
	var valid = false;
	var msg = '';
	
	// Define regular expressions for form validation
	var emailRegEx = /^[a-zA-Z0-9.!#$%&amp;'*+\-\/=?\^_`{|}~\-]+@[a-zA-Z0-9\-]+(?:\.[a-zA-Z0-9\-]+)*$/;
	var	namesRegEx = /^[a-z\-' ]+$/i;
	var	telephoneRegEx = /^[0-9\+\-\(\)# ]+$/;
	var dateRegEx = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
	var	minLength = 8;
	
	// get field value and trim whitespace from it
	var field_val = field.value.trim();
	
	if (DEBUG) console.log(field_val);
	
	// do test based on type requested
	switch(type) {
		case 'email':
			// check email is likely valid 
			(emailRegEx.test(field_val)) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your <strong>email address</strong> does not appear to be valid, please try again.');
			break;
		case 'name':
			// check name only contains alpha, dashses or apostrophes.
			(namesRegEx.test(field_val)) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your <strong>' + field.placeholder + '</strong> does not appear to be valid. Names may only contain alphabetic characters, apostrophes or dashes. Please try again.');
			break;
		case 'password':
			// password must be at least 8 characters else display an error
			(field_val.length >= minLength) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your <strong>password</strong> must be at least 8 characters, please try again.');
			break;			
		case 'passwordmatch':
			// password must be at least 8 characters else display an error
			(fieldIsEqual(field.id, fieldmatch)) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your <strong>password and password confirmation must match</strong>, please check them and try again.');
			break;
		case 'telephone':
			// check telephone contains only numbers, brackets, dashes or plus signs.
			(telephoneRegEx.test(field_val)) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your <strong>telephone number</strong> does not appear to be valid. Telephone numbers may only contain numbers, dashes, plus symbol or curved braces. Please try again.');
			break
		case 'date':
			// check telephone contains only numbers, brackets, dashes, hashes or plus signs.
			(telephoneRegEx.test(field_val)) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your <strong>Date of Birth</strong> does not appear to be valid. Dates should be inthe format dd/mm/yyyy or dd-mm-yyyy. Please try again.');
			break
	}	
		
	return valid;
}
/* =================================================== */


/* ===================================================
 * validateForm function
 * ===================================================
 * @params:		n.a
 * @returns: 	boolean
 * @desc:		checks the form has all required fields
 * 			completed, are valid and the terms accepted. 
 *
 * 			This function also serves as a backup to
 * 			browsers not implementing the html5 'required'
 * 			tag.
 * =================================================== */
function validateForm() {
	// declare variables
	var valid = true;
	var currentField;
	
	// check all fields (required tag not iterated here as it is not
	// supported in Safari at time of writing).
	
	// validate firstname existence and type
	currentField = document.forms['signup-form']['firstname'];
	if (currentField.value == null || currentField.value == "") {
		showFormError(currentField.id, 'Your <strong>First Name</strong> is required to sign up!');
		valid = false;
	}else{
		// logically AND the current validation status with the result of the type check
		valid = (valid && fieldIsValid(currentField, 'name'));
	}
	//==================================================================
	
	// validate last name existence and type
	currentField = document.forms['signup-form']['lastname'];
	if (currentField.value == null || currentField.value == "") {
		showFormError(currentField.id, 'Your <strong>Last Name</strong> is required to sign up!');
		valid = false;
	}else{
		// logically AND the current validation status with the result of the type check
		valid = (valid && fieldIsValid(currentField, 'name'));
	}
	//==================================================================
	
	// validate email existence and type
	currentField = document.forms['signup-form']['email'];
	if (currentField.value == null || currentField.value == "") {
		showFormError(currentField.id, 'Your <strong>Email</strong> is required to sign up!');
		valid = false;
	}else{
		// logically AND the current validation status with the result of the type check
		valid = (valid && fieldIsValid(currentField, 'email'));
	}
	//==================================================================
	
	// validate password existence and type
	currentField = document.forms['signup-form']['password'];
	if (currentField.value == null || currentField.value == "") {
		showFormError(currentField.id, 'A <strong>Password</strong> is required to sign up!');
		valid = false;
	}else{
		// logically AND the current validation status with the result of the type check
		valid = (valid && fieldIsValid(currentField, 'password'));
	}
	//==================================================================
	
	// validate password confirmation existence and type
	currentField = document.forms['signup-form']['password-confirm'];
	if (currentField.value == null || currentField.value == "") {
		showFormError(currentField.id, 'Please <strong>confirm your password</strong> to sign up!');
		valid = false;
	}else{
		// logically AND the current validation status with the result of the type check
		valid = (valid && fieldIsValid(currentField, 'passwordmatch', 'password'));
	}
	//==================================================================
	
	// validate dob type
	currentField = document.forms['signup-form']['dob'];
	// optional field, check a value has been supplied first
	if (currentField.value != null && currentField.value != "") {
		// logically AND the current validation status with the result of the type check
		valid = (valid && fieldIsValid(currentField, 'date'));
	}
	//==================================================================
	
	// validate telephone type
	currentField = document.forms['signup-form']['telephone'];
	// optional field, check a value has been supplied first
	if (currentField.value != null && currentField.value != "") {
		// logically AND the current validation status with the result of the type check
		valid = (valid && fieldIsValid(currentField, 'telephone'));
	}
	//==================================================================
	
	// validate terms
	// check the terms have been checked/ticked
	currentField = document.forms['signup-form']['terms'];
	if (!currentField.checked) {
		showFormError(currentField.id, 'You must read and accept the <strong>terms and conditions</strong> to sign up!');
		valid = false;
	}
	//==================================================================
	
	// if form valid return true and allow browser to submit form
	if (valid) {
		return true;
	}else{
		// focus at top of form so user can see errors
		window.location.hash = '#top';
		return false;
	}
}


/* ===================================================
 * showFormError function
 * ===================================================
 * @params:		msg(String) - the form error to display
 * @returns:	n.a
 * @desc:		displays a formatted error to the user on the form 
 * =================================================== */
function showFormError(fieldid, msg) {
	
	// check there isn't already an error message for this field
	if (!document.getElementById('validation-error-box_' + fieldid)) {
		// create a unique error message for this form field
		var html = '<div class="alert error" id="validation-error-box_' + fieldid + '"> \
						<button type="button" class="close" data-dismiss="alert">&times;</button> \
						<strong>Error: </strong>' + msg + ' \
					</div>';
		// put message into DOM
		document.getElementById('validation-error-container').innerHTML += html;
	}
}

/* ===================================================
 * removeFormError function
 * ===================================================
 * @params:		errorid(String) - the id of error div to remove
 * @returns:	true
 * @desc:		removes a html element by id
 * =================================================== */
function removeFormError(errorid) {
	// find the element, ask it's parent to remove it (suicide not allowed in JS!)
	if (element = document.getElementById('validation-error-box_' + errorid))	element.parentNode.removeChild(element);
	return true;
}

/* ===================================================
 * fieldIsEqual function
 * ===================================================
 * @params:		fieldid(String) - the first field
 * @returns:	boolean
 * @desc:		checks fields for equality
 * =================================================== */
function fieldIsEqual(fieldid1, fieldid2) {
	// compare fields, return true if the same
	if (document.getElementById(fieldid1).value == document.getElementById(fieldid2).value) {
		 return true;
	} else { 
		return false;
	}
}
/* =================================================== */
