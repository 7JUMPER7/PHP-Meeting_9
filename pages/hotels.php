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
                <img src="" alt="">
                <div class="undefinedImage"><svg width="16" height="16" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
                        </svg></div>
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

        let image = clone.querySelector('.hotelCard img')
        if(hotel.ImagePath) {
            image.src = './images/' + hotel.ImagePath;
            image.alt = hotel.ImagePath;
            clone.querySelector('.hotelCard .undefinedImage').style.display = 'none';
        } else {
            image.style.display = 'none';
        }

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