// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';


let genderButton = document.querySelectorAll('.gender-button');
let filmHtmlBlock = document.querySelector('#films-list');

genderButton.forEach( (button) => { button.addEventListener('click', 
    function(e){
        e.stopImmediatePropagation(); 
        e.preventDefault(); 

        console.log(button);
        console.log(button.href);

        fetch(button.href , {
            method: 'GET',
            headers: { "X-Requested-with": "XMLHttpRequest" }
        })
        .then(response => response.text())
        .then((text) => {
            filmHtmlBlock.innerHTML = text;
        })
        .catch(e => alert(e));        

    }) 
});