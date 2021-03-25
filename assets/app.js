/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './styles/login.scss';
import './styles/components/shoppingCart.scss';

// start the Stimulus application
import './bootstrap';

export const toggleClass = (id, className) => {
    const element = document.getElementById(id);
    element.classList.toggle(className);
}
export const addClass = (id, className) => {
    const element = document.getElementById(id);
    element.classList.add(className);
}
export const removeClass = (id, className) => {
    const element = document.getElementById(id);
    element.classList.remove(className);
}
const handleActiveItem = () => {
    const home = document.getElementById('home');
    const user = document.getElementById('user');

    home.addEventListener('click', function(){
        toggleClass('home','active');
        removeClass('user','active');

        if(home.classList.contains('active')){
            removeClass('homeNav','hide');
            addClass('userNav', 'hide');
        }else{
            addClass('homeNav', 'hide');
        }
    });
    user.addEventListener('click', function(){
        toggleClass('user', 'active');
        removeClass('home', 'active');
        if(user.classList.contains('active')){
            removeClass('userNav','hide');
            addClass('homeNav','hide');
        }else{
            addClass('userNav', 'hide');
        }
    });


}
handleActiveItem();

