import { secprod } from "./module2.js";
customElements.define('cart-code',secprod);

var url2="http://localhost:8000/backend/api/Cart.php";
var cart=document.getElementById('Cart')

function fData(data){
    var d=data
    var c
    
    for(c of d){
        console.log(c.productName)
            cart.innerHTML+=`<cart-code product-name="${c.productName}" product-price="${c.productPrice}" product-category="${c.productCategory}" product-image="${c.productPicture}" ></cart-code>`
            
        }
    }
    
    





function fOk(response){
    response.json()
    .then(fData)
}
function fLoadOverHTTPV2() {
    fetch(url2)
    .then(fOk)
}


window.addEventListener("load", (event) => {
    fLoadOverHTTPV2();
  });