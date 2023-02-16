import { mainprod } from "./module.js"


customElements.define('product-code',mainprod)

var url="http://localhost:8000/backend/api/Product.php";


var product=document.getElementById("product")
var form=document.getElementById("myForm") 


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


  
form.addEventListener('submit', function(e) {
    e.preventDefault();

    const payload = new FormData(form);

    fetch('http://localhost:8000/backend/api/User.php', {
        method: "POST",
        body: payload,
    })
    .then(res => res.json)
})










