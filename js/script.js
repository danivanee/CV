const but = document.querySelector('button');
const parrafo = document.getElementById('apiResponse');

but.addEventListener('click', getData)

const url = 'https://api.chucknorris.io/jokes/random'

async function getData(){
    try{
    const data = await fetch(url);
    const json = await data.json();
    
    //console.log(json);
    //console.log(json.value);
    parrafo.textContent = json.value;
    return parrafo.textContent

}
catch(e){
    console.error(e);
}

}
