<div class="container">

    <select id="countries"></select>

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
            console.log(data);
            Array.from(data).forEach((elem) => {
                let option = document.createElement('option');
                option.value = elem.Id;
                option.innerText = elem.Country;
                countriesSelect.append(option);
            });
        }
    }
    document.addEventListener("DOMContentLoaded", async () => await getAllCountries());
</script>