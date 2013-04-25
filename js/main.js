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
 * @params:		type(String) - type of check, fieldid(String) - the id of the form field to check
 * @returns: 	boolean
 * @desc:		check a form field, types are...
 * 		name: alpha numberic, apostrophe and dashes
 * 		email: email validation to catch most errors without false positives
 * 		length: 
 * =================================================== */
function fieldIsValid(type, fieldid) {
	// define variables
	var valid = false;
	var msg = '';
	
	// Define regular expressions for form validation
	var emailRegEx = /^[a-zA-Z0-9.!#$%&amp;'*+\-\/=?\^_`{|}~\-]+@[a-zA-Z0-9\-]+(?:\.[a-zA-Z0-9\-]+)*$/;
	var	namesRegEx = /^[a-z0-9_\-']+$/i;
	var	minLength = 8;
	
	// get value from field
	var field_val = document.getElementById(fieldid).value;
	
	// trim whitespace from field
	field_val = field_val.trim();
	
	// do test based on type requested
	switch(type) {
		case 'email':
			// check email is likely valid 
			(emailRegEx.test(field_var)) ? valid = true : showFormError(fieldid, 'Your email address does not appear to be valid, please try again.');
			break;
		case 'name':
			// check name only contains alpha, dashses or apostrophes.
			(namesRegEx.test(field_var)) ? valid = true : showFormError(fieldid, 'Your name does not appear to be valid, names may only contain alphabetic characters, apostrpohes or dashes. Please try again.');
			break;
		case 'password':
			// password must be at least 8 characters else display an error
			(field_val.len() > minLength) ? valid = true : showFormError(fieldid, 'Passwords must be at least 8 characters, please try again.');
			break;
	}
		
	return valid;
}
/* =================================================== */


/* ===================================================
 * showFormError function
 * ===================================================
 * @params:		fieldid(String) - the id of the form field to check, msg(String) - the form error to display
 * @returns:	n.a
 * @desc:		displays a formatted error to the user on the form 
 * =================================================== */
function showFormError(fieldid, msg) {
	//set the message
	document.getElementById('validation-error-message').innerHTML = '<strong>Error: </strong>' + msg;
	// show the message
	document.getElementById('validation-error-box').style.display = 'block';
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
	(document.getElementById(fieldid1).value == document.getElementById(fieldid2).value) ? return true : return false;
}
/* =================================================== */
