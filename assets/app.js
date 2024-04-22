// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';


let genderButton = document.querySelector('.gender-button');

genderButton.addEventListener('click', function(e){

    console.log(this.href);
    e.preventDefault(); 
    fetchData(this);

});

async function fetchData(element) {
    
    let filmList = document.querySelector('#films-list');

    try {
    
        let response = await fetch(element.href, {
            method: 'GET',
            headers: { "X-Requested-with": "XMLHttpRequest" },
        });
        
        filmList.innerHTML = await response.text();
        
    } catch (error) {
    
        console.error("Erreur lors de la récupération des données:", error);
    }
}






// const genderButton = document.querySelector('.gender-button');
// const filmListByGender = document.querySelector('#films-list-by-gender');

// genderButton.addEventListener('click', function(e){
//     e.preventDefault();


//     fetch(this.href, {
//         method: 'GET'
//     })
//         .then(response => response)
//         .then(json => {
//             handleResponse(json);
//         })
// });


// const handleResponse = function(response) {

//     console.log(response); 
//     // filmListByGender.innerHTML+= response.html
// }