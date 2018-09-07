'use strict';

import { PageDetection, Page } from '../base';

export class CartPagemobile extends PageDetection {

	constructor() {
		super([Page.Cart, ]);
	}

	addListenerMulti( element, eventNames, listener ) {
		let events = eventNames.split( ' ' );

		for( let i=0, iLen=events.length; i<iLen; i++ ) {
			element.addEventListener( events[i], listener, false );
		}
	}

	initialize() {
		this.addListenerMulti( window, 'load click', event => {
			if( event.type !== 'load' && event.target.className !== 'svg__close' ) {
				return;
			}
			let existingEntry = JSON.parse( localStorage.getItem( 'allEntries' ) );
			let cartItems = document.querySelector( '.cart-items__number' );
			cartItems.innerHTML = '0';

			if( existingEntry === null || existingEntry.length < 1 ) {
				cartItems.innerHTML = '';
				document.querySelector( '.color-circle' ).style.display = 'none';
			} else {
				let count = 0;

				for( let record in existingEntry ) {
					count += existingEntry[record].quantity;
				}
				cartItems.innerHTML = count;
				document.querySelector( '.color-circle' ).style.display = 'flex';
			}
			let item;
			let endCart = JSON.parse( localStorage.getItem( 'allEntries' ) );

			let cartPopup = document.querySelector( '.cart-mobile-product' );

			cartPopup.innerHTML = '';

			for( item in endCart ) {

				let sizeOptions = '';

				if( endCart[item].sizes.length > 0 ) {
					for( let i = 0; i < endCart[item].sizes.length;i++ ) {
						if( endCart[item].size === endCart[item].sizes[i]) {
							sizeOptions += `<option selected value="${endCart[item].sizes[i]}">${endCart[item].sizes[i]}</option>`;
						} else {
							sizeOptions += `<option value="${endCart[item].sizes[i]}">${endCart[item].sizes[i]}</option>`;
						}
					}
				}

				let colorOptions = '';

				if( endCart[item].colors.length > 0 ) {
					for( let i = 0; i < endCart[item].colors.length;i++ ) {
						if( endCart[item].color === endCart[item].colors[i]) {
							colorOptions +=`<option selected value="${endCart[item].colors[i]}">${endCart[item].colors[i]}</option>`;
						} else {
							colorOptions += `<option value="${endCart[item].colors[i]}">${endCart[item].colors[i]}</option>`;
						}
					}
				}
				cartPopup.innerHTML += `
					<div class="cart-mobile-product__container">
						<img class="cart-mobile-product__image" src="${endCart[item].image}" alt="">
						<div class="cart-mobile-product__details">
							<div class="cart-mobile-product__options cart-mobile-product__options--container">
								<div class="cart-mobile-product__options cart-mobile-product__options--upper">
									<span class="cart-mobile-product__title">${endCart[item].title}</span>
		
									<div class="cart-mobile-product__options">
									<span class="cart-mobile-product__action-icon cart-mobile-product__action-icon--remove"
									 onclick="
				                        let items = JSON.parse(localStorage.getItem('allEntries'));
				                        items.forEach((item,i) => {
				                            if( item.id === '${endCart[item].id}') {
				                                items.splice(i, 1);
				                                document.querySelector('.cart-items__number').innerHTML = items.length;
				                                localStorage.setItem('allEntries', JSON.stringify(items));
				                            	}
				                        	});">
										<img src="images/svg/close.svg">
									</span>
									</div>
								</div>
								<p class="cart-product__price">&euro; ${parseFloat( endCart[item].price ).toFixed( 2 )}</p>
							</div>
						</div>
					</div>
		
					<div class="dropdown-mobile">
						<ul class="dropdown-mobile__menu">
							<div class="dropdown-mobile__quantity">${endCart[item].quantity}</div>
							<li class="dropdown-mobile__menu dropdown-mobile__menu--items">
								<div class="circle__mobile" style="background-color: ${endCart[item].color}">
								</div>
								<select class="dropdown-mobile__menu-options dropdown-mobile__menu-options--color form__custom-dropdown">
									${colorOptions}
								</select>
							</li>
							<li class="dropdown-mobile__menu dropdown-mobile__menu--items">
								<select class="dropdown-mobile__menu-options dropdown-mobile__menu-options--size form__custom-dropdown">
									${sizeOptions}
								</select>
							</li>
						</ul>
					</div>
				`;
			}

			for( let i = 0; i < document.querySelectorAll( '.dropdown-mobile__menu-options--color' ).length; i++ ) {
				document.querySelectorAll( '.dropdown-mobile__menu-options--color' )[i].addEventListener( 'change', changeEventHandler );
			}

			function changeEventHandler( event ) {
				let circle = document.querySelectorAll( '.circle__mobile' );

				for( let i = 0; i < circle.length; i++ ) {

					if( circle[i] === this.parentNode.querySelector( '.circle__mobile' ) ) {
						circle[i].style.backgroundColor = event.target.value;
					}
				}
			}
		});
	}
}

