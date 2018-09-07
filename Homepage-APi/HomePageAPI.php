<?php

namespace App\Http\Controllers;

use App\Models\BaseProduct;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller {
	public function index() {
		$currentCategory = Category::orderBy('id', 'desc')->take(4)->get();
		$allProducts = BaseProduct::orderBy('id', 'desc')->take(3)->get();
		$products = collect();

		foreach ($allProducts as $product) {
			if(count($product->images) !== 0) {
				$products->push(collect([
					'id' => $product->id,
					'name' => $product->name,
					'images' => $product->images->first()->path,
					'category' => $product->categories
				]));
			} else{
				$products->push(collect([
					'id' => $product->id,
					'name' => $product->name,
					'images' => 'https://picsum.photos/800/1000?image=999',
					'category' => $product->categories
				]));
			}
		}

		return view('pages.welcome', [
			'currentCategory' => $currentCategory,
			'products' => $products,
		]);
	}
}
