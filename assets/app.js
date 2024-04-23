import './bootstrap.js';
 
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';   

const $ = require('jquery'); 
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
// require('bootstrap');


let genderButton = document.querySelectorAll('#menu-block button');
let filmHtmlBlock = document.querySelector('#films-list');

console.log(genderButton.length);
genderButton.forEach( (button) => { button.addEventListener('click', 
    function(e){
        e.stopImmediatePropagation(); 
        e.preventDefault(); 

        console.log(button);
        console.log(button.value);

        fetch(button.value , {
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



$(function() {
$('::marker').remove();
});
