<?php
	class menuItem{
		private $itemName;
		private $description;
		private $price;
		private $picture;
	
		public function __construct($itemName, $description, $price, $picture){
			$this->itemName=$itemName;
			$this->description=$description;
			$this->price=$price;
			$this->picture=$picture;
		}

		public function setItemName($itemName){
			$this->itemName=$itemName;
		}

		public function getItemName(){
			return $this->itemName;
		}

		public function setDescription($description){
			$this->description=$description;
		}

		public function getDescription(){
			return $this->description;
		}

		public function setPrice($price){
			$this->price=$price;
		}		

		public function getPrice(){
			return $this->price;
		}
		
		public function setPicture($picture){
			$this->picture=$picture;
		}
		
		public function getPicture(){
			return $this->picture;
		}
	}	
?>