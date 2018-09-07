'use strict';

import { PageDetection, Page } from './base';

export class MyDetailValidation extends PageDetection {

	constructor() {
		super([Page.MyDetail, ]);
	}

	initialize() {
		const DROPDOWN = document.querySelectorAll( '.form__custom-select-span' );
		DROPDOWN[0].innerHTML = 'Country';
		DROPDOWN[1].innerHTML = 'Country';
		DROPDOWN[2].innerHTML = 'Bank';
		DROPDOWN[3].innerHTML = 'Country';
		DROPDOWN[4].innerHTML = 'Bank';

		let formFields = document.querySelectorAll( '.form__field' );
		let formInputs = document.querySelectorAll( '.form__input--customer' );
		let billingInput = document.querySelectorAll( '.form__input--billing' );
		let billingFields = document.querySelectorAll( '.form__field--billing' );
		let businessInput = document.querySelectorAll( '.form__input--business' );
		let businessFields = document.querySelectorAll( '.form__field--business' );
		let tabs = document.querySelectorAll( '.my-detail__tab' );

		for( let i = 0; i < tabs.length; i++ ) {
			tabs[i].addEventListener( 'click', function() {
				if( i === 0 ) {
					for( let p = 0; p < businessInput.length; p++ ) {
						businessInput[p].innerHTML = '';
					}
				}
			}.bind( null, i ) );
		}

		// Delivery Address
		for( let i = 0; i < formInputs.length; i++ ) {
			formInputs[i].addEventListener( 'keyup', function() {
				// Fullname
				if( i === 0 ) {
					if( formInputs[0].value.match( /^[a-zA-Z ]*$/g ) && formInputs[0].value.length > 0 ) {
						formFields[0].classList.remove( 'false' );
						formFields[0].classList.add( 'valid' );
					} else {
						formFields[0].classList.remove( 'valid' );
						formFields[0].classList.add( 'false' );
					}
				}

				if( i === 1 ) {
					if( formInputs[1].value.match( /^[a-zA-Z ]*$/g ) && formInputs[1].value.length > 0 ) {
						formFields[1].classList.remove( 'false' );
						formFields[1].classList.add( 'valid' );
					} else {
						formFields[1].classList.remove( 'valid' );
						formFields[1].classList.add( 'false' );
					}
				}

				if( i === 2 ) {
					if( formInputs[2].value.match( /^\d+$/ ) && formInputs[2].value.length > 0 ) {
						formFields[2].classList.remove( 'false' );
						formFields[2].classList.add( 'valid' );
					} else {
						formFields[2].classList.remove( 'valid' );
						formFields[2].classList.add( 'false' );
					}
				}

				if( i === 4 ) {
					if( formInputs[4].value.match( /^[a-z0-9]+$/i ) && formInputs[4].value.length >= 4 ) {
						formFields[4].classList.remove( 'false' );
						formFields[4].classList.add( 'valid' );
					} else {
						formFields[4].classList.remove( 'valid' );
						formFields[4].classList.add( 'false' );
					}
				}

				if( i === 6 ) {
					if( formInputs[6].value.match( /^[a-zA-Z ]*$/g ) && formInputs[6].value.length > 0 ) {
						formFields[6].classList.remove( 'false' );
						formFields[6].classList.add( 'valid' );
					} else {
						formFields[6].classList.remove( 'valid' );
						formFields[6].classList.add( 'false' );
					}
				}

			}.bind( null, i ) );
		}
		// Billing Address

		for( let l = 0; l < billingInput.length; l++ ) {

			billingInput[l].addEventListener( 'keyup', function() {
				if( l === 0 ) {
					if( billingInput[0].value.match( /^[a-zA-Z ]*$/g ) && billingInput[0].value.length > 0 ) {
						billingFields[0].classList.remove( 'false' );
						billingFields[0].classList.add( 'valid' );
					} else {
						billingFields[0].classList.remove( 'valid' );
						billingFields[0].classList.add( 'false' );
					}
				}

				if( l === 1 ) {
					if( billingInput[1].value.match( /^[a-zA-Z ]*$/g ) && billingInput[1].value.length > 0 ) {
						billingFields[1].classList.remove( 'false' );
						billingFields[1].classList.add( 'valid' );
					} else {
						billingFields[1].classList.remove( 'valid' );
						billingFields[1].classList.add( 'false' );
					}
				}

				if( l === 2 ) {
					if( billingInput[2].value.match( /^\d+$/ ) && billingInput[2].value.length > 0 ) {
						billingFields[2].classList.remove( 'false' );
						billingFields[2].classList.add( 'valid' );
					} else {
						billingFields[2].classList.remove( 'valid' );
						billingFields[2].classList.add( 'false' );
					}
				}

				if( l === 4 ) {
					if( billingInput[4].value.match( /^[a-z0-9]+$/i ) && billingInput[4].value.length >= 4 ) {
						billingFields[4].classList.remove( 'false' );
						billingFields[4].classList.add( 'valid' );
					} else {
						billingFields[4].classList.remove( 'valid' );
						billingFields[4].classList.add( 'false' );
					}
				}

				if( l === 6 ) {
					if( billingInput[6].value.match( /^[a-zA-Z]*$/g ) && billingInput[6].value.length > 0 ) {
						billingFields[6].classList.remove( 'false' );
						billingFields[6].classList.add( 'valid' );
					} else {
						billingFields[6].classList.remove( 'valid' );
						billingFields[6].classList.add( 'false' );
					}
				}

				if( l === 7 ) {
					if( billingInput[7].value.match( /^\d{10}$/ ) ||
						billingInput[7].value.match( /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/ ) ||
						billingInput[7].value.match( /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{5})$/ ) ||
						billingInput[7].value.match( /^\+?([0-9]{1})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{7})$/ ) ||
					billingInput[7].value.match( /^\+?([0-9]{3})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/ ) && billingInput[7].value.length > 1 ) {

						billingFields[7].classList.remove( 'false' );
						billingFields[7].classList.add( 'valid' );
					} else {
						billingFields[7].classList.remove( 'valid' );
						billingFields[7].classList.add( 'false' );
					}
				}
			}.bind( null, l ) );
		}
		// Business

		for( let k = 0; k < businessInput.length; k++ ) {
			businessInput[k].addEventListener( 'keyup', function() {
				// Fullname
				if( k === 0 ) {
					if( businessInput[0].value.match( /^[a-zA-Z ]*$/g ) && businessInput[0].value.length > 0 ) {
						businessFields[0].classList.remove( 'false' );
						businessFields[0].classList.add( 'valid' );
					} else {
						businessFields[0].classList.remove( 'valid' );
						businessFields[0].classList.add( 'false' );
					}
				}

				if( k === 1 ) {
					if( businessInput[1].value.match( /^[a-zA-Z ]*$/g ) && businessInput[1].value.length > 0 ) {
						businessFields[1].classList.remove( 'false' );
						businessFields[1].classList.add( 'valid' );
					} else {
						businessFields[1].classList.remove( 'valid' );
						businessFields[1].classList.add( 'false' );
					}
				}

				if( k === 2 ) {
					if( businessInput[2].value.match( /^[a-zA-Z ]*$/g ) && businessInput[2].value.length > 0 ) {
						businessFields[2].classList.remove( 'false' );
						businessFields[2].classList.add( 'valid' );
					} else {
						businessFields[2].classList.remove( 'valid' );
						businessFields[2].classList.add( 'false' );
					}
				}

				if( k === 3 ) {
					if( businessInput[3].value.match( /^\d+$/ ) && businessInput[3].value.length > 0 ) {
						businessFields[3].classList.remove( 'false' );
						businessFields[3].classList.add( 'valid' );
					} else {
						businessFields[3].classList.remove( 'valid' );
						businessFields[3].classList.add( 'false' );
					}
				}

				if( k === 5 ) {
					if( businessInput[5].value.match( /^[a-z0-9]*$/g ) && businessInput[5].value.length >= 4 ) {
						businessFields[5].classList.remove( 'false' );
						businessFields[5].classList.add( 'valid' );
					} else {
						businessFields[5].classList.remove( 'valid' );
						businessFields[5].classList.add( 'false' );
					}
				}

				if( k === 7 ) {
					if( businessInput[7].value.match( /^[a-zA-Z ]*$/g ) && businessInput[7].value.length > 0 ) {
						businessFields[7].classList.remove( 'false' );
						businessFields[7].classList.add( 'valid' );
					} else {
						businessFields[7].classList.remove( 'valid' );
						businessFields[7].classList.add( 'false' );
					}
				}

				if( k === 8 ) {
					if( businessInput[8].value.match( /^[a-zA-Z0-9 ]*$/g ) && businessInput[8].value.length > 0 ) {
						businessFields[8].classList.remove( 'false' );
						businessFields[8].classList.add( 'valid' );
					} else {
						businessFields[8].classList.remove( 'valid' );
						businessFields[8].classList.add( 'false' );
					}
				}
			}.bind( null, k ) );
		}
	}
}
