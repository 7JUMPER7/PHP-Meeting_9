<div class="container">
    <div class="params">
        <div class="selects">
            <label for="countries">Country:
                <select id="countries">
                    <option value="-1">All</option>
                </select>
            </label>
            <label for="cities">City:
                <select id="cities">
                    <option value="-1">All</option>
                </select>
            </label>
        </div>
        <div class="result">Found <span>5</span> hotels</div>
    </div>

    <div class="hotelsWrapper" id="hotels"></div>

    <template id="hotelTemplate">
        <a href="?page=hotel&id=1">
            <div class="hotelCard">
                <img src="./images/hilton2.jpeg" alt="hilton1.jpeg">
                <div class="cardBody">
                    <div class="infoBox">
                        <h1>Hilton</h1>
                        <p>Кривой Рог, Украина</p>
                    </div>
                    <div class="priceBox">2700 грн</div>
                </div>
            </div>
        </a>
    </template>
</div>
<script>
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
            let countriesSelect = document.getElementById('countries');
            let data = await resp.json();
            Array.from(data).forEach((elem) => {
                let option = document.createElement('option');
                option.value = elem.Id;
                option.innerText = elem.Country;
                countriesSelect.append(option);
            });
        }
    }

    async function getAllCities(countryId) {
        let formData = new FormData();
        let resp = await fetch("http://localhost/PHP-Meeting_9/api/getCities.php?countryId="+countryId, {
            method: "GET",
            headers: {
                "Accept": "application/json"
            }
        });
        if(resp.ok === true) {
            let citiesSelect = document.getElementById('cities');
            citiesSelect.innerText = '';
            let data = await resp.json();

            let option = document.createElement('option');
            option.value = -1;
            option.innerText = 'All';
            citiesSelect.append(option);

            Array.from(data).forEach((elem) => {
                option = document.createElement('option');
                option.value = elem.Id;
                option.innerText = elem.City;
                citiesSelect.append(option);
            });
        }
    }

    async function generateHotel(hotel) {
        let hotels = document.getElementById('hotels');
        let template = document.getElementById('hotelTemplate');

        let clone = template.content.cloneNode(true);
        clone.querySelector('a').href = '?page=hotel&id=' + hotel.Id;

        // let image = clone.querySelector('img')
        // image.src = '';
        // image.alt = '';

        clone.querySelector('.infoBox h1').innerText = hotel.Hotel;
        clone.querySelector('.infoBox p').innerText = hotel.City + ', ' + hotel.Country;
        clone.querySelector('.priceBox').innerText = hotel.Price + ' грн';

        hotels.append(clone);
    }

    async function getAllHotels(countryId = -1, cityId = -1) {
        let formData = new FormData();
        formData.append('countryId', countryId);
        formData.append('cityId', cityId);
        let resp = await fetch("http://localhost/PHP-Meeting_9/api/getHotels.php?countryId="+countryId+"&cityId="+cityId, {
            method: "GET",
            headers: {
                "Accept": "application/json"
            }
        });
        if(resp.ok === true) {
            document.getElementById('hotels').innerText = '';
            let data = await resp.json();
            let hotels = Array.from(data);
            document.querySelector('.container .params .result span').innerText = hotels.length;
            hotels.forEach((elem) => {
                generateHotel(elem);
            });
        }
    }

    document.addEventListener("DOMContentLoaded", async () => {
        await getAllCountries();
        await getAllHotels();
    });
    document.getElementById('countries').addEventListener("change", async (e) => {
        let countryId = e.target.value;
        await getAllCities(countryId);
        await getAllHotels(countryId);
    });
    document.getElementById('cities').addEventListener('change', async (e) => {
        let countryId = document.getElementById('countries').value;
        getAllHotels(countryId, e.target.value);
    });
</script>