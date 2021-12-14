async function getAllCountries() {
    let resp = await fetch("http://localhost/PHP-Meeting_9/api/getCountries.php",
        {
            method: "GET",
            headers: {
                "Accept": "application/json"
            }
        }
    );
    if(resp.ok === true) {
        return await resp.json();
    }
    return null;
}

async function renderCountries() {
    let data = await getAllCountries();
    if(data) {
        let body = document.getElementById('Countries').querySelector('tbody');
        Array.from(data).forEach((elem) => {
            let tr = document.createElement('tr');
    
            let inputTd = document.createElement('td');
            let input = document.createElement('input');
            input.type = "checkbox";
            input.name = "deleteItem" + elem.Id;
            inputTd.append(input);
            
            let id = document.createElement('td');
            id.innerText = elem.Id;
    
            let country = document.createElement('td');
            country.innerText = elem.Country;
    
            tr.append(inputTd);
            tr.append(id);
            tr.append(country);
            body.append(tr);
        });
    }
}

async function getAllCities() {
    let resp = await fetch("http://localhost/PHP-Meeting_9/api/getCities.php",
        {
            method: "GET",
            headers: {
                "Accept": "application/json"
            }
        }
    );
    if(resp.ok === true) {
        return await resp.json();
    }
    return null;
}

async function renderCities() {
    let data = await getAllCities();
    if(data) {
        let body = document.getElementById('Cities').querySelector('tbody');
        console.log(data);
        Array.from(data).forEach((elem) => {
            let tr = document.createElement('tr');
    
            let inputTd = document.createElement('td');
            let input = document.createElement('input');
            input.type = "checkbox";
            input.name = "deleteItem" + elem.Id;
            inputTd.append(input);
            
            let id = document.createElement('td');
            id.innerText = elem.Id;
    
            let city = document.createElement('td');
            city.innerText = elem.City;
    
            let country = document.createElement('td');
            country.innerText = elem.Country;
    
            tr.append(inputTd);
            tr.append(id);
            tr.append(city);
            tr.append(country);
            body.append(tr);
        });
        let countriesSelect = document.getElementById('Cities').querySelector('select[name="countries"]');
        let countries = await getAllCountries();
        if(countries) {
            Array.from(countries).forEach((elem) => {
                let option = document.createElement('option');
                option.value = elem.Id;
                option.innerText = elem.Country;
                countriesSelect.append(option);
            });
        }
    }
}

async function addCountry(e) {
    const submitter = e.target;
    const country = submitter.closest('form').querySelector('input[name="Country"]').value;
    if(country != '') {
        let formData = new FormData();
        formData.append('country', country);
        let resp = await fetch('http://localhost/PHP-Meeting_9/api/addCountry.php', {
            method: "POST",
            headers:  {
                "Accept": "application/json"
            },
            body: formData
        });
        if(resp.ok) {
            let data = resp.json();
            console.log(data);
        }
    }
}

async function addCity(e) {
    const submitter = e.target;
    const city = submitter.closest('form').querySelector('input[name="City"]').value;
    const countryId = submitter.closest('form').querySelector('select[name="countries"]').value;
    if(city != '') {
        let formData = new FormData();
        formData.append('city', city);
        formData.append('countryId', countryId);
        let resp = await fetch('http://localhost/PHP-Meeting_9/api/addCity.php', {
            method: "POST",
            headers:  {
                "Accept": "application/json"
            },
            body: formData
        });
        if(resp.ok) {
            let data = resp.json();
            console.log(data);
        }
    }
}

async function deleteFromTable(e) {
    const submitter = e.target;
    const form = submitter.closest('form');
    const table = form.id;
    
    let formData = new FormData();
    formData.append('table', table);
    form.querySelectorAll('input[type="checkbox"]').forEach(input => {
        if(input.checked) {
            let buf = input.name.replace('deleteItem', '');
            formData.append('ids[]', +buf);
        }
    })
    await fetch("http://localhost/PHP-Meeting_9/api/delete.php", {
        method: "POST",
        headers: {
            "Accept": "application/json"
        },
        body: formData
    });

}

document.addEventListener("DOMContentLoaded", async () => await renderCountries());
document.addEventListener("DOMContentLoaded", async () => await renderCities());