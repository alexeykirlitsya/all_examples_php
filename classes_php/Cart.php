<?php

class Cart
{
	public $items; // ['id' => ['quantity' => , 'price' => , 'data' => ]]
	public $totalQuantity;
	public $totalPrice;
	
	public function __construct($prevCart){
		if($prevCart != null){
			$this->items = $prevCart->items;
			$this->totalQuantity = $prevCart->totalQuantity;
			$this->totalPrice = $prevCart->totalPrice;
			
		} else {
			$this->items = [];
			$this->totalQuantity = 0;
			$this->totalPrice = 0;
		}
	}
	
	public function addItems($id, $product){

	    $price = $product->price;
		if(array_key_exists($id, $this->items)){

			$productToAdd = $this->items[$id];
			$productToAdd['quantity']++;
			$productToAdd['totalSinglePrice'] = $productToAdd['quantity'] * $price;

		} else{

		    $productToAdd = ['quantity' => 1, 'totalSinglePrice' => $price, 'data' => $product];
		}
		$this->items[$id] = $productToAdd;
		$this->totalQuantity++;
		$this->totalPrice += $product->price;
	}

	public function updatePriceAndQunatity(){
	    $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($this->items as $item){
            $totalPrice = $totalPrice + $item['totalSinglePrice'];
            $totalQuantity = $totalQuantity + $item['quantity'];
        }

        $this->totalPrice = $totalPrice;
        $this->totalQuantity = $totalQuantity;
    }
}