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
          },
          animation: {
            'gradient-x': 'gradient-x 15s ease infinite',
          },
          keyframes: {
            'gradient-x': {
              '0%, 100%': { 'background-position': '0% 50%' },
              '50%': { 'background-position': '100% 50%' },
            }
          }
        }
      }
    }
  </script>
</head>
<body class="font-sans antialiased text-bistro-dark relative min-h-screen overflow-auto bg-bistro-bg">

  <!-- Animated flashy background -->
  <div class="fixed inset-0 -z-10">
    <div class="w-full h-full bg-gradient-to-r from-pink-500 via-yellow-400 to-purple-500 bg-[length:200%_200%] animate-gradient-x"></div>
  </div>

  <div class="container mx-auto max-w-6xl px-5 py-16 md:py-20 relative z-10">

    <!-- Page Header -->
    <h1 class="text-center text-5xl md:text-6xl font-extrabold text-bistro-title mb-3 drop-shadow-lg">FoodWin</h1>
    <p class="text-center text-bistro-subtitle text-lg md:text-xl mb-12">Fresh Ingredients • Bold Flavors • Made with Love</p>

    <!-- Appetizers Section -->
    <section class="mb-20">
      <h2 class="text-4xl md:text-5xl font-semibold text-bistro-heading border-b-4 border-bistro-border pb-4 mb-10 inline-block">Appetizers</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- Chin Chin -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="{{ asset('Golden Nigerian chin chin.png') }}" alt="Chin Chin" class="w-full h-56 md:h-64 object-cover"/>
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Chin Chin</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Toasted ciabatta, fresh tomatoes, basil, garlic & balsamic glaze</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$8.99</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 1])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Crispy Calamari -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://www.granvilleislandspiceco.com/cdn/shop/articles/20240306110906-crispy-20calamari-20with-20lemon-pepper-20aioli-20image-203_1200x800.jpg?v=1709723359" alt="Crispy fried calamari rings with lemon aioli" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Crispy Calamari</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Lightly fried squid rings, lemon aioli, fresh herbs</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$11.99</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.6</span>
                <form action="{{route ('pay', ['id' => 2])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Mozzarella Sticks -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://thumbs.dreamstime.com/b/golden-fried-cheese-sticks-served-marinara-sauce-crispy-mozzarella-herbs-white-plate-red-dip-popular-restaurant-appetizer-388305264.jpg" alt="Golden mozzarella sticks with marinara sauce" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Mozzarella Sticks</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Golden breaded mozzarella, warm marinara sauce.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$7.90</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.4</span>
                <form action="{{route ('pay', ['id' => 3])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Main Courses -->
    <section class="mb-20">
      <h2 class="text-4xl md:text-5xl font-semibold text-bistro-heading border-b-4 border-bistro-border pb-4 mb-10 inline-block">Main Courses</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- Beef Burger Deluxe -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://thumbs.dreamstime.com/b/juicy-beef-burger-melted-cheese-fresh-tomato-crispy-french-fries-rustic-plate-ready-to-eat-mouthwatering-close-up-352647615.jpg" alt="Juicy beef burger deluxe with cheese, tomato, and fries" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Beef Burger Deluxe</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">8oz Angus patty, cheddar, bacon, lettuce, tomato, red onion, fries</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$16.90</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>
                <form action="{{route ('pay', ['id' => 4])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Grilled Salmon -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://iheartvegetables.com/wp-content/uploads/2023/12/Exclusive-Cashew-Tofu-and-Vegetable-Stir-Fry-4364-Large.jpeg" alt="Grilled salmon with vegetables" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Grilled Salmon</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Atlantic salmon, lemon-herb butter, roasted vegetables, quinoa</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$22.99</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 5])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Creamy Mushroom Pasta -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://www.veggievibesandvines.com/wp-content/uploads/2024/09/Wild-Mushroom-Truffle-Pasta-scaled.jpg" alt="Creamy mushroom fettuccine with truffle sauce" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Creamy Mushroom Pasta</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Fettuccine, wild mushrooms, truffle cream sauce, parmesan</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$17.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★½ <span class="text-gray-400 text-lg ml-2">4.7</span>
                <form action="{{route ('pay', ['id' => 6])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- You can continue similarly for Nigerian Specialties, Soup, etc. -->

    <footer class="mt-24 pt-10 border-t border-gray-300 text-center text-gray-600 text-sm">Prices are in USD • All ratings based on customer reviews • Menu updated February 2026</footer>

  </div>
</body>
</html>