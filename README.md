# Fair-Trade-Software-webshop

The Fair Trade Software Webshop is a big project where a lot of developers have worked on.
In this project I have done a lot of things and made a few changes.

### Homepage-API

In the Homepage.php I have made so the 3 most recent products are on the homepage.
The code is made with BEM to keep structure in the code and it is easy to read.
The product are clickable and go to the Product detail were you can chose a color and size.

The API is made with Laravel.
In the API there is made a call to the database and get the product from the database.
If the products are from the database all the components get a name so you can use them easily.
Than if the components have all names the API push them to the page where the are needed.

### Order Validation

In the orderValidation.js is a javascript code to check if all the field are good.
The Javascript is a forloop so he checks every time the is a change, 
if the change is good the is added a class to that field with valid this works with sass so that the field becomes green.
If the change is wrong than that field becomes red becaus the javascript added False.

### ShoppingCart

In the shopping cart you can see all the product that you want. This is because they are stored in the Cart localstorage a function form javascript.
The shopping cart is made for desktop and for your mobile phone so there are 2 PHP files and 2 SCSS files.

In the file ShoppingCart-desktop.php is the shoppingcart for desktop all the products are seen on the page 
with a load function, this loads the cartPopup.innerHTML with the HTML from the products.

There are some dropdown but not all products have a size so the was made a check to check if the product have some of all of the dropdowns.

In the order-confimation.php is only the localstorage uses so you can see the products after you have paid on a sidebar of your screen.
