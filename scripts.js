//Admin törlés szerkesztés lehetőség:







//Felhasználó tovább navigálása

const rows = document.querySelectorAll('tr');

const dataMap = new Map();

rows.forEach( row =>{
    row.addEventListener('click',function(){
        const id = this.getAttribute('id');

        const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
                document.getElementById('cikkek').innerText = this.responseText;
            }

       
    };

    xhr.open('GET','posts.php?id=' + id,true);
    xhr.send();
});
});
function displayData(data) {
    const cikkekDiv = document.getElementById('cikkek');
    cikkekDiv.innerHTML = ''; // Clear previous content

    data.forEach(item => {
        const h3 = document.createElement('h3');
        h3.textContent = item.cim;

        const p = document.createElement('p');
        p.textContent = item.rovidismerteto;

        const h6 = document.createElement('h6');
        h6.textContent = `Szerző: ${item.szerzo}`;

        cikkekDiv.appendChild(h3);
        cikkekDiv.appendChild(p);
        cikkekDiv.appendChild(h6);
    });
}