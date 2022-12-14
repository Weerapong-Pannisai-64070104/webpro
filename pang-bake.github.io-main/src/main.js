let shop = document.getElementById("Bestsell");
let shop2 = document.getElementById("new");
let basket = JSON.parse(localStorage.getItem("data")) || [];
let num = 0;

function show(){
  if (num == 0){
    document.getElementById("log-out").style.display = "flex";
    num++;
  }
  else{
    document.getElementById("log-out").style.display = "none";
    num=0;
  }
  
};
function logout(){
  localStorage.clear();
  document.location.reload();
}
let login = document.getElementById("login");
if (localStorage.getItem("Username") != null){
  login.removeAttribute("href");
  login.innerHTML = `<div class='fa fa-user-circle' style='padding-right:10px; padding-top:7px; font-size:20px; cursor: pointer;' onclick="show()"></div>`;
  document.getElementById("log-out").innerHTML = "<div style='text-align:center;'>username : "+localStorage.getItem("Username")+
  "</div><footer style='text-align:center; background-color:white; cursor: pointer; position:absolute; bottom:0; width:100%;' onclick='logout()'>logout</footer>";
}

let savedata = (obj) => {
  const person = {
    id: obj.getAttribute("id"),
    name: obj.getAttribute("name"),
    src: obj.getAttribute("src"),
    desc:obj.getAttribute("value"),
  }
  window.localStorage.setItem('user',   JSON.stringify(person));
};

let generateShop = () => {
  return (shop.innerHTML = Bestseller
    .map((x) => {
      let { id, name, price, desc, img } = x;
      let search = basket.find((x) => x.id === id) || [];
      return `
    <div id=product-id-${id} class="item">
        <a href="detail.html"><img width="100%" src=${img} id="${id}" name="${name}" value="${desc}"onclick="savedata(this)"></a>
        <div class="details">
          <h3>${name}</h3>
          <div class="price-quantity">
            <h2>$ ${price} </h2>
            <div class="buttons">
              <div id=${id} class="quantity" style="display:none;">
              ${search.item === undefined ? 0 : search.item}
              </div>
              <i class="btn btn-primary" onclick="increment(${id})" class="bi bi-plus-lg">add to cart</i>
            </div>
          </div>
        </div>
      </div>
    `;
    })
    .join(""));
};
let generatenew = () => {
  return (shop2.innerHTML = neww
    .map((x) => {
      let { id, name, price, desc, img } = x;
      let search = basket.find((x) => x.id === id) || [];
      return `
    <div id=product-id-${id} class="item">
        <a href="detail.html"><img width="100%" src=${img} id="${id}" name="${name}" value="${desc}"onclick="savedata(this)"></a>
        <div class="details">
          <h3>${name}</h3>
          <div class="price-quantity">
            <h2>$ ${price} </h2>
            <div class="buttons">
              <div id=${id} class="quantity" style="display:none;">
              ${search.item === undefined ? 0 : search.item}
              </div>
              <i class="btn btn-primary" onclick="increment(${id})" class="bi bi-plus-lg">add to cart</i>
            </div>
          </div>
        </div>
      </div>
    `;
    })
    .join(""));
};

generateShop();
generatenew();

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

  // console.log(basket);
  update(selectedItem.id);
  localStorage.setItem("data", JSON.stringify(basket));
};

// ?????????????????????????????????
// let decrement = (id) => {
//   let selectedItem = id;
//   let search = basket.find((x) => x.id === selectedItem.id);

//   if (search === undefined) return;
//   else if (search.item === 0) return;
//   else {
//     search.item -= 1;
//   }
//   update(selectedItem.id);
//   basket = basket.filter((x) => x.item !== 0);
//   // console.log(basket);
//   localStorage.setItem("data", JSON.stringify(basket));
// };
let update = (id) => {
  let search = basket.find((x) => x.id === id);
  // console.log(search.item);
  document.getElementById(id).innerHTML = search.item;
  calculation();
};

let calculation = () => {
  let cartIcon = document.getElementById("cartAmount");
  cartIcon.innerHTML = basket.map((x) => x.item).reduce((x, y) => x + y, 0);
};

calculation();