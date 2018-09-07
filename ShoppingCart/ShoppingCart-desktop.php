'use strict';

import { PageDetection, Page } from '../base';
import {ProductDetailSelect} from './ProductDetailSelect';

export class CartPage extends PageDetection {

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
				cartItems.innerHTML = existingEntry.length;
				document.querySelector( '.color-circle' ).style.display = 'flex';
			}
			let item;
			let endCart = JSON.parse( localStorage.getItem( 'allEntries' ) );
			let totalPrice = 0;
			let shippingcost= '6.95';

			let cartPopup = document.querySelector( '.cart__content' );
			let calcPopup = document.querySelector( '.costs__content' );

			cartPopup.innerHTML = '';

			for( item in endCart ) {
				let genderHide = '';

				if( endCart[item].gender === '' ) {
					genderHide = 'hidden';
				}

				let sizeHide = '';

				if( endCart[item].sizes === '' ) {
					sizeHide = 'hidden';
				}

				let colorHide = '';

				if( endCart[item].color === '' ) {
					colorHide = 'hidden';
				}

				let zero = 0;
				totalPrice = endCart.reduce( ( accumulator, currentValue ) => {
					return accumulator + parseFloat( currentValue.price * currentValue.quantity );
				}, zero );

				cartPopup.innerHTML += `
				<div class="cart-product-title">${endCart[item].title}</div>
				<div class="cart-product" item-id=${endCart[item].id}>
					<img class="cart-product__image" src="${endCart[item].image}" alt="">
					<div class="cart-product__details">
						<div class="cart-product__options cart-product__options--upper">
							<div class="cart-product__options">
								<div class="cart-product__action-icon cart-product__action-icon--remove">
									<img src='images/svg/close.svg' class='svg__close' onclick="
									let items = JSON.parse(localStorage.getItem('allEntries'));
									items.forEach((item,i) => {
										if( item.id === '${endCart[item].id}') {
											items.splice(i, 1);
											document.querySelector('.cart-items__number').innerHTML = items.length;
											localStorage.setItem('allEntries', JSON.stringify(items));
										}
									});">
								</div>
								<div class="cart-product__options cart-product__options--down">
								
									<div class="cart-product__options cart-product__options--variants">
										<div class="cart-product__options-select">
											<input class="cart-product__options-amount" type="number" min="0" max="9999" value="${endCart[item].quantity}" onchange="
											let items = JSON.parse( localStorage.getItem( 'allEntries' ) );
											let products = document.querySelectorAll( '.cart-product' );
											let cart = JSON.parse(localStorage.getItem('allEntries'));
											let price = ${totalPrice};

											
												for( let c of cart ){
													for( let p of products ){
														try{
															if( '${endCart[item].id}' == c.id ){
																c.quantity = parseInt(this.value);
																localStorage.allEntries = JSON.stringify(cart);
																console.log(JSON.parse(localStorage.getItem('allEntries')));
																totalPrice = 0;
																for(let item of cart) {
																	console.log(item.price, item.quantity);
																	console.log(item.price * item.quantity);
																	totalPrice += item.price * item.quantity;
																}
																
																window.location.reload();
																
															}
														}catch(err){
														}
													}
												}
											
											">
										</div>
										<div class="dropdown">
											<ul class="dropdown__menu">
												<li class="dropdown__menu dropdown__menu-items dropdown__menu-item-color ${colorHide}">
													<div class="cart-product__options-select">${endCart[item].color}</div>
												
												</li>
												<li class="dropdown__menu dropdown__menu-items ${sizeHide}">
													<div class="cart-product__options-select"">${endCart[item].size}</div>
												</li>
												<li class="dropdown__menu dropdown__menu-items ${genderHide}">
													<div class="cart-product__options-select"">${endCart[item].gender}</div>
												</li>
											</ul>
										</div>
										<p class="cart-product__price">&euro; ${parseFloat( endCart[item].price * endCart[item].quantity ).toFixed( 2 )}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				`;
			}

			ProductDetailSelect.generateDropDowns();
			window.addEventListener( 'click', function( event ) {
				ProductDetailSelect.closeDropDown( event );
			});

			for( let i = 0; i < document.querySelectorAll( '.options--color' ).length; i++ ) {
				document.querySelectorAll( '.options--color' )[i].addEventListener( 'change', changeEventHandler );
			}

			function changeEventHandler( event ) {
				let circle = document.querySelectorAll( '.circle__desktop' );

				for( let i = 0; i < circle.length; i++ ) {

					if( circle[i] === this.parentNode.querySelector( '.circle__desktop' ) ) {
						circle[i].style.backgroundColor = event.target.value;
					}
				}
			}

			calcPopup.innerHTML = '';

			calcPopup.innerHTML += `
				<div class="costs__text">
					<span>Sub total</span>
					<span class="costs__text--price">&euro; ${parseFloat( totalPrice ).toFixed( 2 )}</span>
				</div>

				<div class="costs__text">
					<span>Shipping costs</span>
					<span class="costs__text--price">&euro; ${parseFloat( shippingcost ).toFixed( 2 )}</span>
				</div>

				<div class="costs__text">
					<span class="costs__text costs__text--green">Total (incl. VAT)</span>
					<span class="costs__text costs__text--green costs__text--price">&euro; ${parseFloat( +shippingcost + +totalPrice ).toFixed( 2 )}</span>
				</div>
				<div class="delivery">
					<span class="delivery--text">Expected delivery at: 09/11/2017</span>
				</div>
			`;
		});
	}
}
