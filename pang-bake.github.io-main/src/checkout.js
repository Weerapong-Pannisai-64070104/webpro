let label = document.getElementById("label");
let ShoppingCart = document.getElementById("shopping-cart");

let basket = JSON.parse(localStorage.getItem("data")) || [];

let calculation = () => {
  let cartIcon = document.getElementById("cartAmount");
  cartIcon.innerHTML = basket.map((x) => x.item).reduce((x, y) => x + y, 0);
};

calculation();

let generateCartItems = () => {
  if (basket.length !== 0) {
    return (ShoppingCart.innerHTML = basket
      .map((x) => {
        let { id, item } = x;
        let search = Bestseller.find((y) => y.id === id) || neww.find((x) => x.id === id) || ButterCake.find((x) => x.id === id)||
        icecreamecake.find((x) => x.id === id) || cookies.find((x) => x.id === id) || Milk.find((x) => x.id === id) || 
        Juice.find((x) => x.id === id) || Tea.find((x) => x.id === id) || Coffee.find((x) => x.id === id) ||
        snack.find((x) => x.id === id) ||[];
        return `
      <div class="cart-item">
        <img width="120px" src=${search.img} alt="" />
        <div>
          <div class="title-price-x m-2">
              <h4 class="title-price">
                <p>${search.name}</p>
              </h4>
          </div>
          <div id=${id} class="quantity m-2">amount : ${item}</div>

          <h3 class="m-2">$ ${item * search.price}</h3>
        </div>
      </div>
      `;
      })
      .join(""));
  } else {
    ShoppingCart.innerHTML = ``;
    label.innerHTML = `
    <h2>Cart is Empty</h2>
    <a href="index.html">
      <button class="HomeBtn">Back to home</button>
    </a>
    `;
  }
};

generateCartItems();

let increment = (id) => {
  let selectedItem = id;
  let search = basket.find((x) => x.id === selectedItem.id);

  if (search === undefined) {
    basket.push({
      id: selectedItem.id,
      item: 1,
    });
  } else {
    search.item += 1;
  }

  generateCartItems();
  update(selectedItem.id);
  localStorage.setItem("data", JSON.stringify(basket));
};
let decrement = (id) => {
  let selectedItem = id;
  let search = basket.find((x) => x.id === selectedItem.id);

  if (search === undefined) return;
  else if (search.item === 0) return;
  else {
    search.item -= 1;
  }
  update(selectedItem.id);
  basket = basket.filter((x) => x.item !== 0);
  generateCartItems();
  localStorage.setItem("data", JSON.stringify(basket));
};

let update = (id) => {
  let search = basket.find((x) => x.id === id);
  // console.log(search.item);
  document.getElementById(id).innerHTML = search.item;
  calculation();
  TotalAmount();
};

let removeItem = (id) => {
  let selectedItem = id;
  // console.log(selectedItem.id);
  basket = basket.filter((x) => x.id !== selectedItem.id);
  generateCartItems();
  TotalAmount();
  localStorage.setItem("data", JSON.stringify(basket));
};

let clearCart = () => {
  basket = [];
  generateCartItems();
  localStorage.setItem("data", JSON.stringify(basket));
};

let TotalAmount = () => {
  if (basket.length !== 0) {
    let amount = basket
      .map((x) => {
        let { item, id } = x;
        let search = Bestseller.find((y) => y.id === id) || neww.find((x) => x.id === id) || ButterCake.find((x) => x.id === id) || 
        icecreamecake.find((x) => x.id === id) || cookies.find((x) => x.id === id) || Milk.find((x) => x.id === id) || 
        Juice.find((x) => x.id === id) || Tea.find((x) => x.id === id) || Coffee.find((x) => x.id === id) ||
        snack.find((x) => x.id === id) ||[];

        return item * search.price;
      })
      .reduce((x, y) => x + y, 0);
    // console.log(amount);
    label.innerHTML = `
    <h2>Total Bill : $ ${amount}</h2>
    <button class="checkout">Checkout</button>
    <button onclick="clearCart()" class="removeAll">Clear Cart</button>
    `;
  } else return;
};

TotalAmount();
