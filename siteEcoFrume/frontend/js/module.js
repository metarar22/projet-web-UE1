export class mainprod extends HTMLElement{

    constructor(){
        super()
    }

    static get observedAttributes(){
                //cette fonction est utilsé pour rendre les attributs
                return["product-name", "product-price", "product-category", "product-image"] 
    }

    connectedCallback(){
        this.innerHTML=
        `
        <div class="card text-center" style="width: 18rem;">
            <img src="${this.getAttribute("product-image")}" class="card-img-top" >
            <div class="card-body">
                <h5 class="card-title">${this.getAttribute("product-name")}</h5>
                <p class="card-text">${this.getAttribute("product-category")}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">${this.getAttribute("product-price")} $</li>
             </ul>
             <div class="card-body">
                <button type="button" class="btn btn-success">Ajouter au Panier</button>
           </div>
        </div>
        <div class="col-md-12 text-center text-warning"> <br /></div>
        `
}
}