export class secprod extends HTMLElement{

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
        <div class="card mb-3">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
              <div>
                <img
                  src="${this.getAttribute("product-image")}"
                  class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
              </div>
              <div class="ms-3">
                <h5>${this.getAttribute("product-name")}</h5>
                <p class="small mb-0">${this.getAttribute("product-category")}</p>
              </div>
            </div>
            <div class="d-flex flex-row align-items-center">
              <div style="width: 50px;">
                <h5 class="fw-normal mb-0">2</h5>
              </div>
              <div style="width: 80px;">
                <h5 class="mb-0">${this.getAttribute("product-price")} $ </h5>
              </div>
              <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
            </div>
          </div>
        </div>
      </div>

        `
}
}