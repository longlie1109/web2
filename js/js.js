// function openLoginForm() {
//     document.getElementById("modal").style.display = "flex";
//     document.querySelector(".Login").style.display = "block";
//     document.querySelector(".Register").style.display = "none";
// }
// function openLoginRegisterForm() {
//     document.getElementById("modal").style.display = "flex";
//     document.querySelector(".Register").style.display = "block";
//     document.querySelector(".Login").style.display = "none";

// }
function closeDetailBook() {
  document.querySelector("#modal1").style.display="none";
}
function closeForm() {
    document.querySelector("#modal").style.display="none";
   
}
function  openRegisterForm() {
   var parrent = document.querySelector("#modal");
   document.querySelector("#form_login").style.display="none";
   document.querySelector("#form_register").style.display="flex"
   parrent.style.display = "flex";

}
// function openDetailBook(){
//     var parrent = document.querySelector("#modal");
//     let s = ` <div class="col l-2-4 m-4 c-6">
//     <a class="home-product-item"  href="#">
//         <div src="" alt="" class="home-product__img" style="background-image: url(https://cf.shopee.vn/file/8f7c06e8c90390c5f507ba0601be6fea_tn);"></div>
//         <h4 class="home-product__name">
//             [ Ảnh Thật ] ÁO HOODIE UNISEX Nam Nữ BASIC CAO CẤP
//         </h4>
//         <div class="home-produt-item__price-old">
//             <span class="home-product-item__priced">
//                 1.200.000đ
//             </span>
//             <span class="home-produt-item__price-current">
//                 900.000đ
//             </span>
//         </div>
//         <div class="home-produt-item__aciton">
//             <span class="home-produt-item__heart home-produt-item__heart--liked">
//                 <i class="home-produt-item__heart--liked-icon-emty far fa-heart"></i>
//                 <i class="home-produt-item__heart--liked-icon-fill fas fa-heart"></i>
//             </span>
//             <div class="home-produt-item__rating">
//                 <i class="home-produt-item-star-gold fas fa-star"></i>
//                 <i class="home-produt-item-star-gold fas fa-star"></i>
//                 <i class="home-produt-item-star-gold fas fa-star"></i>
//                 <i class="home-produt-item-star-gold fas fa-star"></i>
//                 <i class="far fa-star"></i>

//             </div>
//             <span class="home-produt-item--sold">
//                 1 Đã bán
//             </span>
//         </div>
//         <div class="home-produt-item__origin">
//             <span class="home-produt-item__brand">Whoo</span>
//             <span class="home-produt-item__origin-name">Nhật bản</span>
//         </div>
//         <div class="home-produt-item__favourite">
//             <i class="fas fa-check"></i>
//             <span>
//                 Yêu thích
//             </span>
//         </div>
//         <div class="home-produt-item__sale-off">
//             <span class="home-produt-item__sale-off_percent">
//                 10%
//             </span>
//             <span class="home-produt-item__sale-off-label">Giảm</span>
//         </div>
//     </a>
    
    
// </div>`
//     parrent.style.display = "flex";
//     parrent.innerHTML = s;
// }
function  openLoginForm() {
    var parrent = document.querySelector("#modal");
    document.querySelector("#form_register").style.display="none";
    document.querySelector("#form_login").style.display="flex";
    parrent.style.display = "flex";
 }
// var s = [
//     {
//         name:'lan'
//     },
//     {
//         A:"le"
//     },
//     [
//         a= "le"
//     ]

// ]

// // localStorage.setItem('text', JSON.stringify(s));
// // console.log(JSON.parse(localStorage.getItem('text')))

function removeFormLoginAndRegiter(){
var a = document.querySelectorAll(".header__navbar-item.header__navbar-item--bold");
for (i = 0; i < a.length; i++) {
    a[i].style.display="none";
  }
}


