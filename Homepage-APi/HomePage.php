<div class="new__hide-scroll">
			<div class="new__container">
				<div class="new__row new__row--flex">
					<a class="product__link" href="/c/{{ $products[0]['category']->first()->name }}/{{ $products[0]['name'] }}">
						<div class="product product--left">
							<img class="product__image product__image--left" src="{{ $products[0]['images'] }}"/>
							<div class="product--hover">
								<h3 class="product__title product__title--description">{{ $products[0]['name'] }}</h3>
							</div>
						</div>
					</a>

				<a class="product__link" href="/c/{{ $products[1]['category']->first()->name }}/{{ $products[1]['name'] }}">
						<div class="product product--middle">
							<img class="product__image product__image--middle" src="{{ $products[1]['images'] }}"/>
							<div class="product--hover">
								<h3 class="product__title product__title--description">{{ $products[1]['name'] }}</h3>
							</div>
						</div>
					</a>

					<a class="product__link" href="/c/{{ $products[2]['category']->first()->name }}/{{ $products[2]['name'] }}">
						<div class="product product--right">
							<img class="product__image product__image--right" src="{{ $products[2]['images'] }}"/>
							<div class="product--hover">
								<h3 class="product__title product__title--description">{{ $products[2]['name'] }}</h3>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>