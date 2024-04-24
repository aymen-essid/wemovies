import './bootstrap.js';
 
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';   

const $ = require('jquery'); 
const bootstrap = require('bootstrap'); 
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
// require('bootstrap');


let genderButton = document.querySelectorAll('#menu-block button');
let filmHtmlBlock = document.querySelector('#films-list');
let searchField = document.querySelector('.basicAutoComplete');

bootstrap.autoComplete();

console.log(genderButton.length);
genderButton.forEach( (button) => { button.addEventListener('click', 
    function(e){
        e.stopImmediatePropagation();  
        e.preventDefault(); 
        $("#spinner-div").show(); 
        console.log($("#spinner-div"));
        fetch(button.value , {
            method: 'GET',
            headers: { "X-Requested-with": "XMLHttpRequest" }
        })
        .then(response => response.text())
        .then((text) => {
            filmHtmlBlock.innerHTML = text;
            $("#spinner-div").hide();
        })
        .catch(e => alert(e));  

    }) 
});







var myModal = new bootstrap.Modal(document.getElementById('myModal'));


$(function() { 

    
 
}); 
