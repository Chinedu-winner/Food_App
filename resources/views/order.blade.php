<h2>Place Order</h2>

<form action="/order" method="POST">
@csrf

<input type="text" name="name" placeholder="Your Name"><br><br>

<input type="text" name="food_name" placeholder="Food Name"><br><br>

<input type="number" name="quantity" placeholder="Quantity"><br><br>

<input type="text" name="price" placeholder="Price"><br><br>

<input type="text" name="address" placeholder="Address"><br><br>

<input type="text" name="phone" placeholder="Phone"><br><br>

<button type="submit">Order Now</button>

</form>