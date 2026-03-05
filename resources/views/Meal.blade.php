<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FoodWin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'bistro-bg': '#f8f1e9',
            'bistro-dark': '#2d1e12',
            'bistro-title': '#6b3e26',
            'bistro-subtitle': '#8b5a2b',
            'bistro-heading': '#8b4513',
            'bistro-border': '#d4a373',
            'bistro-price': '#b22222',
            'bistro-star': '#ffa41c',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-bistro-bg text-bistro-dark font-sans antialiased">

  <div class="container mx-auto max-w-6xl px-5 py-16 md:py-20">
    <h1 class="text-center text-5xl md:text-6xl font-bold text-bistro-title mb-3">FoodWin</h1>
    <p class="text-center text-bistro-subtitle text-lg md:text-xl mb-10">
      Fresh Ingredients • Bold Flavors • Made with Love
    </p>

    <!-- Header Nigerian food platter -->
    <div class="mb-12">
      <!-- <img         src="https://tb-static.uber.com/prod/image-proc/processed_images/49f1582049623a9705790aa4acc69451/268ee1a1296808aa6eae11eb597de84d.jpeg" 
        alt="Authentic Nigerian food platter with Jollof rice, egusi soup, plantain, meats and more" 
        class="w-full h-auto rounded-2xl shadow-2xl object-cover max-h-[500px]"
      > -->

    </div>

    <!-- Appetizers -->
    <section class="mb-20">
      <h2 class="text-4xl md:text-5xl font-semibold text-bistro-heading border-b-4 border-bistro-border pb-4 mb-10 inline-block">Appetizers</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="{{ asset('Golden Nigerian chin chin.png') }}" alt="Chin Chin" class="w-full h-56 object-cover"/>
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Chin Chin </h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Toasted ciabatta, fresh tomatoes, basil, garlic & balsamic glaze </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$8.99</span>
              <div class="text-xl text-bistro-star">
                ★★★★★ <span class="text-gray-400 text-lg">4.8</span>
                <form action="{{route ('pay', ['id' => $meal->id])}}" method="GET">
                  @csrf
                  <button type="submit" class="ml-4 px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://www.granvilleislandspiceco.com/cdn/shop/articles/20240306110906-crispy-20calamari-20with-20lemon-pepper-20aioli-20image-203_1200x800.jpg?v=1709723359" alt="Crispy fried calamari rings with lemon aioli" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Crispy Calamari</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              Lightly fried squid rings, lemon aioli, fresh herbs
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$11.99</span>
              <div class="text-xl text-bistro-star">
                ★★★★☆ <span class="text-gray-400 text-lg">4.6</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://thumbs.dreamstime.com/b/golden-fried-cheese-sticks-served-marinara-sauce-crispy-mozzarella-herbs-white-plate-red-dip-popular-restaurant-appetizer-388305264.jpg" alt="Golden mozzarella sticks with marinara sauce" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Mozzarella Sticks</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Golden breaded mozzarella, warm marinara sauce. </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$7.90</span>
              <div class="text-xl text-bistro-star">
                ★★★★☆ <span class="text-gray-400 text-lg">4.4</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="mb-20">
      <h2 class="text-4xl md:text-5xl font-semibold text-bistro-heading border-b-4 border-bistro-border pb-4 mb-10 inline-block">Main Courses</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://thumbs.dreamstime.com/b/juicy-beef-burger-melted-cheese-fresh-tomato-crispy-french-fries-rustic-plate-ready-to-eat-mouthwatering-close-up-352647615.jpg" alt="Juicy beef burger deluxe with cheese, tomato, and fries" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Beef Burger Deluxe</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              8oz Angus patty, cheddar, bacon, lettuce, tomato, red onion, fries
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$16.90</span>
              <div class="text-xl text-bistro-star">
                ★★★★★ <span class="text-gray-400 text-lg">4.9</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img 
            src="https://iheartvegetables.com/wp-content/uploads/2023/12/Exclusive-Cashew-Tofu-and-Vegetable-Stir-Fry-4364-Large.jpeg" 
            alt="Grilled salmon with vegetables" 
            class="w-full h-48 object-cover"
          >
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Grilled Salmon</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              Atlantic salmon, lemon-herb butter, roasted vegetables, quinoa
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$22.99</span>
              <div class="text-xl text-bistro-star">
                ★★★★★ <span class="text-gray-400 text-lg">4.8</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img 
            src="https://www.veggievibesandvines.com/wp-content/uploads/2024/09/Wild-Mushroom-Truffle-Pasta-scaled.jpg" 
            alt="Creamy mushroom fettuccine with truffle sauce" 
            class="w-full h-48 object-cover"
          >
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Creamy Mushroom Pasta</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              Fettuccine, wild mushrooms, truffle cream sauce, parmesan
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$17.50</span>
              <div class="text-xl text-bistro-star">
                ★★★★½ <span class="text-gray-400 text-lg">4.7</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img 
            src="https://www.connoisseurusveg.com/wp-content/uploads/2016/09/peanut-butter-tofu-stir-fry-1200-2-of-2.jpg" 
            alt="Vegetable stir-fry bowl with tofu and rice" 
            class="w-full h-48 object-cover"
          >
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Vegetable Stir-Fry Bowl</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              Seasonal vegetables, tofu or chicken option, ginger-soy glaze, rice
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$14.90</span>
              <div class="text-xl text-bistro-star">
                ★★★★☆ <span class="text-gray-400 text-lg">4.5</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Nigerian Specialties -->
    <section class="mb-20">
      <h2 class="text-4xl md:text-5xl font-semibold text-bistro-heading border-b-4 border-bistro-border pb-4 mb-10 inline-block">
        Nigerian Specialties
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img 
            src="https://sisijemimah.com/wp-content/uploads/2015/06/IMG_7971.jpg" 
            alt="Party Jollof Rice with fish and plantain" 
            class="w-full h-48 object-cover"
          >
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Jollof Rice</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              Smoky tomato-based rice with bell peppers, onions, thyme & spices, served with grilled chicken & fried plantains (dodo)
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$18.50</span>
              <div class="text-xl text-bistro-star">
                ★★★★★ <span class="text-gray-400 text-lg">4.9</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://allnigerianfoods.com/wp-content/uploads/egusi_soup-1.jpg" alt="Egusi Soup with pounded yam" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Egusi Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              Rich melon seed soup with spinach, assorted meats, crayfish & palm oil, served with pounded yam or eba
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$19.99</span>
              <div class="text-xl text-bistro-star">
                ★★★★★ <span class="text-gray-400 text-lg">4.8</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://www.dashofjazz.com/wp-content/uploads/2025/06/Dash-of-Jazz-Oven-Baked-Suya-10.jpg" alt="Spicy Nigerian Suya beef skewers" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Suya</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              Spicy grilled beef skewers coated in peanut & spice rub (yaji), served with onions, tomatoes & extra pepper
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$15.90</span>
              <div class="text-xl text-bistro-star">
                ★★★★½ <span class="text-gray-400 text-lg">4.7</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img 
            src="https://sisijemimah.com/wp-content/uploads/2016/11/kale-efo-riro-11.jpg" 
            alt="Efo Riro vegetable stew with assorted meats" 
            class="w-full h-48 object-cover"
          >
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Efo Riro</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">
              Flavorful stewed spinach with peppers, locust beans, assorted meats & fish, served with white rice or swallow
            </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$17.50</span>
              <div class="text-xl text-bistro-star">
                ★★★★☆ <span class="text-gray-400 text-lg">4.6</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Soup -->
    <section class="mb-20">
      <h2 class="text-4xl md:text-5xl font-semibold text-bistro-heading border-b-4 border-bistro-border pb-4 mb-10 inline-block">Soup </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://cruiseradio.net/wp-content/uploads/2024/11/CHOCOLATE-MELTING-CAKE-1030x578.jpeg" alt="Warm chocolate lava cake with melting center and ice cream" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Ofe Nsala</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Traditional Igbo white soup made with fresh fish & yam thickener</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$5.50</span>
              <div class="text-xl text-bistro-star">
                ★★★★★ <span class="text-gray-400 text-lg">4.9</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://travelandmunchies.com/wp-content/uploads/2022/11/IMG_5749.jpg" alt="Classic New York cheesecake with berry compote" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">  Ofe Onugbu</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Bitterleaf soup thickened with cocoyam & flavored with traditional spices </p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$20.20</span>
              <div class="text-xl text-bistro-star">★★★★½ <span class="text-gray-400 text-lg">4.6</span></div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <footer class="mt-24 pt-10 border-t border-gray-300 text-center text-gray-600 text-sm">Prices are in USD • All ratings based on customer reviews • Menu updated February 2026</footer>
  </div>

</body>
</html>