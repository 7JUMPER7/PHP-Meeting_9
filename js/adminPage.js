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

async function getAllHotels() {
    let resp = await fetch("http://localhost/PHP-Meeting_9/api/getHotels.php", {
        method: "GET",
        headers: {
            "Accept": "application/json"
        }
    });
    if(resp.ok === true) {
        return await resp.json();
    }
    return null;
}

async function renderHotels() {
    let data = await getAllHotels();
    if(data) {
        let body = document.getElementById('Hotels').querySelector('tbody');
        Array.from(data).forEach((elem) => {
            let tr = document.createElement('tr');
    
            let inputTd = document.createElement('td');
            let input = document.createElement('input');
            input.type = "checkbox";
            input.name = "deleteItem" + elem.Id;
            inputTd.append(input);
            
            let id = document.createElement('td');
            id.innerText = elem.Id;
    
            let hotel = document.createElement('td');
            hotel.innerText = elem.Hotel;
    
            let place = document.createElement('td');
            place.innerText = elem.City + ', ' + elem.Country;
    
            let stars = document.createElement('td');
            if(!elem.Stars) {
                stars.innerText = '-';
            } else {
                stars.innerText = elem.Stars;
            }
    
            let price = document.createElement('td');
            price.innerText = elem.Price;
    
            tr.append(inputTd);
            tr.append(id);
            tr.append(hotel);
            tr.append(place);
            tr.append(stars);
            tr.append(price);
            body.append(tr);
        });
        let countriesSelect = document.getElementById('Hotels').querySelector('select[name="Place"]');
        let countries = await getAllCities();
        if(countries) {
            Array.from(countries).forEach((elem) => {
                let option = document.createElement('option');
                option.value = elem.Id;
                option.innerText = elem.City + ', ' + elem.Country;
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
            return data;
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
            return data;
        }
    }
}

async function addHotel(e) {
    const submitter = e.target;
    const form = submitter.closest('form');
    const hotel = form.querySelector('input[name="Hotel"]').value;
    const cityId = form.querySelector('select[name="Place"]').value;
    const price = form.querySelector('input[name="Price"]').value;
    const description = form.querySelector('input[name="Description"]').value;
    if(hotel != '') {
        let formData = new FormData();
        formData.append('hotel', hotel);
        formData.append('cityId', cityId);
        formData.append('price', price);
        formData.append('description', description);
        let resp = await fetch('http://localhost/PHP-Meeting_9/api/addHotel.php', {
            method: "POST",
            headers:  {
                "Accept": "application/json"
            },
            body: formData
        });
        if(resp.ok) {
            let data = resp.json();
            return data;
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
document.addEventListener("DOMContentLoaded", async () => await renderHotels());