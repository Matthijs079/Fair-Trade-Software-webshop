'use strict';

import { PageDetection, Page } from '../base';

export class Cart extends PageDetection {

	constructor() {
		super([Page.All, ]);
	}

	initialize() {
		window.addEventListener( 'load', () => {
			let existingEntry = JSON.parse( localStorage.getItem( 'allEntries' ) );
			let cartItems = document.querySelector( '.cart-items__number' );
			
			cartItems.innerHTML = '0';

			if( existingEntry === null ) {
				document.querySelector( '.color-circle' );
			} else {
				let count = 0;

				for( let record in existingEntry ) {
					count += existingEntry[record].quantity;
				}
				cartItems.innerHTML = count;
			}
		});

		document.addEventListener( 'click', ( event ) => {
			let cartIcon = document.querySelector( '.cart-checkbox' );

			if( cartIcon !== null ) {
				let cartCircle = document.querySelector( '.color-circle' );
				let cartNumber = document.querySelector( '.cart-items__number' );

				if( event.target !== cartIcon ) {
					let classString = event.target.className.toString();
					
					if( !classString.includes( 'cart-popup' ) ) {
						if( cartIcon.checked === true ) {
							cartIcon.checked = false;
						}
					}

					if( classString.includes( 'cart-popup' ) ) {
						this.loadCart();
					}

					if( event.target === cartCircle || event.target === cartNumber ) {
						if( cartIcon.checked === false ) {
							cartIcon.checked = true;
						}
					}
				}
			}
		});

		document.querySelector( '.header__icons' ).addEventListener( 'click', this.loadCart() );
	}

	loadCart() {
		let item;
		let cartPopup = document.querySelector( '.cart-popup__info' );
		let shopping = localStorage.getItem( 'allEntries' );
		let endCart = JSON.parse( shopping );
		let totalPrice = 0;

		cartPopup.innerHTML = '';

		let existingEntry = JSON.parse( localStorage.getItem( 'allEntries' ) );
		let cartItems = document.querySelector( '.cart-items__number' );

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
		let genderItem = '';

		for( item in endCart ) {
			let price = String( endCart[item].price * endCart[item].quantity );
			let priceResult = price.replace( '.', ',' );
			let hasActiveColor;

			if( endCart[item].color !== '' ) {
				hasActiveColor = '';
			} else {
				hasActiveColor = 'style="display: none"';
			}

			if( endCart[item].gender !== undefined ) {
				genderItem = `<li class="cart-popup-item-information__specs-left--size">${endCart[item].gender}</li>`;
			} else {
				genderItem = '';
			}

			let zero = 0;
			totalPrice = endCart.reduce( ( accumulator, currentValue ) => {
				return accumulator + parseFloat( currentValue.price * currentValue.quantity );
			}, zero );

			cartPopup.innerHTML += `
				<div class="cart-popup__item">
					<img src="${endCart[item].image}" alt="item" class="cart-popup-item__image">
					<div class="cart-popup-item__information">
						<div class="cart-popup-item-information--title">
							<ul class="cart-popup-item-information__list">
								<li class="cart-popup-item-information__title">${endCart[item].title}</li>
								<li class="cart-popup-item-information__specs-right--delete" onclick="
								let items = JSON.parse(localStorage.getItem('allEntries'));
								items.forEach((item,i) => {
									if( item.id === '${endCart[item].id}') {
										items.splice(i, 1);
										document.querySelector('.cart-items__number').innerHTML = items.length;
										localStorage.setItem('allEntries', JSON.stringify(items));
									}
								});">
							</ul>
						</div>
						<div class="cart-popup-item-information__specs">
							<ul class="cart-popup-item-information__specs-left">
								<li class="cart-popup-item-information__specs-left--quantity">${endCart[item].quantity}</li>
								<li class="cart-popup-item-information__specs-left--color" ${hasActiveColor}><span style="border-color: ${endCart[item].color}" class="cart-popup-item-information__color color-circle-specs ${endCart[item].size}"></span></li>
								<li class="cart-popup-item-information__specs-left--size">${endCart[item].size}</li>
								${genderItem}
							</ul><span class="cart-popup-item-information__specs-right">€ ${ parseFloat( priceResult.replace( ',', '.' ) ).toFixed( 2 ).replace( '.', ',' ) }</span>
						</div>
					</div>
				</div>
			`;
		}
		let popupInfo = document.querySelector( '.cart-popup__info--total-amount' );
		totalPrice = parseFloat( totalPrice ).toFixed( 2 );
		totalPrice = totalPrice.toString().replace( '.', ',' );
		popupInfo.innerHTML = `€ ${totalPrice}`;
	}
}

