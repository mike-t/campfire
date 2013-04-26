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
	var	namesRegEx = /^[a-z\-']+$/i;
	var dateRegEx = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
	var	minLength = 8;
	
	// get field value and trim whitespace from it
	var field_val = field.value.trim();
	
	console.log(field_val);
	
	// do test based on type requested
	switch(type) {
		case 'email':
			// check email is likely valid 
			(emailRegEx.test(field_val)) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your email address does not appear to be valid, please try again.');
			break;
		case 'name':
			// check name only contains alpha, dashses or apostrophes.
			(namesRegEx.test(field_val)) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your ' + field.placeholder + ' does not appear to be valid, names may only contain alphabetic characters, apostrpohes or dashes. Please try again.');
			break;
		case 'password':
			// password must be at least 8 characters else display an error
			(field_val.length >= minLength) ? valid = removeFormError(field.id) : showFormError(field.id, 'Passwords must be at least 8 characters, please try again.');
			break;			
		case 'passwordmatch':
			// password must be at least 8 characters else display an error
			(fieldIsEqual(field.id, fieldmatch)) ? valid = removeFormError(field.id) : showFormError(field.id, 'Your password and password confirmation must match, please check them and try again.');
			break;
	}	
		
	return valid;
}
/* =================================================== */


/* ===================================================
 * showFormError function
 * ===================================================
 * @params:		msg(String) - the form error to display
 * @returns:	n.a
 * @desc:		displays a formatted error to the user on the form 
 * =================================================== */
function showFormError(fieldid, msg) {	
	// create a unique error message for this form field
	var html = '<div class="alert error" id="validation-error-box_' + fieldid + '"> \
					<button type="button" class="close" data-dismiss="alert">&times;</button> \
					<strong>Error: </strong>' + msg + ' \
				</div>';
	// put message into DOM
	document.getElementById('validation-error-container').innerHTML = html;
}

/* ===================================================
 * removeFormError function
 * ===================================================
 * @params:		errorid(String) - the id of error div to remove
 * @returns:	n.a
 * @desc:		removes a html element by id
 * =================================================== */
function removeFormError(errorid) {
	// find the element, ask it's parent to remove it (suicide not allowed in JS!)
	if (element = document.getElementById('validation-error-box_' + errorid))	element.parentNode.removeChild(element);
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
