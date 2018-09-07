'use strict';

import { PageDetection, Page } from './base';

export class OrderConfirmation extends PageDetection {

	constructor() {
		super([Page.OrderConfirmation, ]);
	}

	initialize() {
		window.addEventListener( 'load', () => {
			let item;
			let endCart = JSON.parse( localStorage.getItem( 'allEntries' ) );
			let totalPrice = 0;
			let shippingcost= '6.95';

			let mydetailproductsPopup = document.querySelector( '.checkout-sidebar__items' );
			let mydetailcostsPopup = document.querySelector( '.costs' );

			window.addEventListener( 'unload', localStorage.clear() );

			mydetailproductsPopup.innerHTML = '';

			for( item in endCart ) {
				totalPrice += parseFloat( endCart[item].price * endCart[item].quantity );
				mydetailproductsPopup.innerHTML += `
					<div class="item">
						<img class="item__block" src="${endCart[item].image}">
			
						<div class="item__block--right">
							<span class="item__text">${endCart[item].title}</span>
							<span class="item__text item__text--grey">&euro; ${parseFloat( endCart[item].price * endCart[item].quantity ).toFixed( 2 )}</span>
							<span class="item__text">${endCart[item].quantity}</span>
						</div>
					</div>
	
					<div class="item__break"></div>
				`;
			}			
			mydetailcostsPopup.innerHTML = `
			<div class="costs__text">
				<span>Shipping cost:</span>
				<span>&euro; ${parseFloat( shippingcost ).toFixed( 2 )}</span>
			</div>
	
			<div class="costs__text">
				<span class="costs__text--green">Total (incl. VAT)</span>
				<span class="costs__text--green">&euro; ${parseFloat( +shippingcost + +totalPrice ).toFixed( 2 )}</span>
			</div>
		`;
		});
	}
}

