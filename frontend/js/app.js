import { mainprod } from "./module.js"

customElements.define('product-code',mainprod)

var url="http://localhost:8000/api/Product.php";
var product=document.getElementById("product")

function fData(data){
    var p=data
    var v
    
    for(v of p){
        console.log(typeof v.productName)
            product.innerHTML+=`<product-code product-name="${v.productName}" product-price="${v.productPrice}" product-category="${v.productCategory}" product-image="${v.productPicture}" ></product-code>`
            
        }
    }
    
    





function fOk(response){
    response.json()
    .then(fData)
}
function fLoadOverHTTPV2() {
    fetch(url)
    .then(fOk)
}

window.addEventListener("load", (event) => {
    fLoadOverHTTPV2();
  });