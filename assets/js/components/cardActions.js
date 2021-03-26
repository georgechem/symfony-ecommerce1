const AddToCart = document.querySelectorAll('.Card__content__footer--btn');
let pageOffsetY = localStorage.getItem('offsetY') ?? 0;

window.scrollTo({
    top: pageOffsetY,
    left: 0,
    behavior: 'smooth',
});

setTimeout(function(){
    pageOffsetY = 0;
    localStorage.setItem('offsetY', 0);

},2000);
AddToCart.forEach((addToCartButton)=>{
   addToCartButton.addEventListener('click', function(e){
       //e.preventDefault();
       localStorage.setItem('offsetY', window.pageYOffset);

   });

});

