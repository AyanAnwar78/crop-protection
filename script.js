document.getElementById("sightingForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("./backend/submit_sighting.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                addSightingToPage(data.sighting);
            }
            this.reset();
        })
        .catch(error => console.error("Error:", error));
});

function addSightingToPage(sighting) {
    const container = document.getElementById("sightingsContainer");
    const div = document.createElement("div");
    div.classList.add("sighting-card");
    div.innerHTML = `
        <img src="./uploads/${sighting.image}" alt="${sighting.species}">
        <p><strong>Species:</strong> ${sighting.species}</p>
        <p><strong>Location:</strong> ${sighting.location}</p>
        <p><strong>Count:</strong> ${sighting.count}</p>
        <p><strong>Date:</strong> ${sighting.timestamp}</p>
    `;
    container.prepend(div);
}

function loadSightings() {
    fetch("./backend/fetch_sightings.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(addSightingToPage);
        })
        .catch(error => console.error("Error:", error));
}

document.addEventListener("DOMContentLoaded", loadSightings);









// Initialize Map centered on India
const map = L.map('map').setView([22.3511, 78.6677], 5); // Center of India

// Base Layer - OpenStreetMap
const baseLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Heatmap Data - Example Wildlife Sightings in India
const heatData = [
    [22.57, 88.36, 0.7],  // Kolkata
    [28.61, 77.23, 0.9],  // Delhi
    [28.71, 77.20, 0.9],  // Delhi
    [28.65, 77.22, 0.9],  // Delhi
    [19.07, 72.87, 0.8],  // Mumbai
    [13.08, 80.27, 0.6],  // Chennai
    [26.85, 80.94, 0.7],  // Lucknow
    [25.45, 81.85, 0.8],  // Prayagraj
    [27.17, 78.02, 0.9],  // Agra
    [23.03, 72.58, 0.6],  // Ahmedabad
    [15.30, 74.12, 0.8],  // Goa
    [21.15, 79.09, 0.9],  // Nagpur
    [17.38, 78.48, 0.7],  // Hyderabad
    [11.41, 76.70, 0.8],  // Ooty
    [31.63, 74.87, 0.9],  // Amritsar
    [26.91, 75.78, 0.7]   // Jaipur
];

// Heatmap Layer
const heatLayer = L.heatLayer(heatData, {
    radius: 30, // Spread of the heat points
    blur: 20,
    maxZoom: 10
});

// Animal Sightings - Different Layers
const tigerLayer = L.layerGroup([
    L.marker([22.57, 88.36]).bindPopup("Tiger Sighting - Kolkata"),
    L.marker([21.15, 79.09]).bindPopup("Tiger Sighting - Nagpur"),
    L.marker([26.91, 75.78]).bindPopup("Tiger Sighting - Jaipur")
]);

const elephantLayer = L.layerGroup([
    L.marker([11.41, 76.70]).bindPopup("Elephant Sighting - Ooty"),
    L.marker([17.38, 78.48]).bindPopup("Elephant Sighting - Hyderabad"),
    L.marker([15.30, 74.12]).bindPopup("Elephant Sighting - Goa")
]);

const leopardLayer = L.layerGroup([
    L.marker([28.61, 77.23]).bindPopup("Leopard Sighting - Delhi"),
    L.marker([26.85, 80.94]).bindPopup("Leopard Sighting - Lucknow"),
    L.marker([19.07, 72.87]).bindPopup("Leopard Sighting - Mumbai")
]);

const CowLayer = L.layerGroup([
    L.marker([28.71, 77.20]).bindPopup("Cow Sighting - Delhi"),
    L.marker([28.65, 77.22]).bindPopup("Cow Sighting - Delhi")
]);

// Layer Control
L.control.layers({
    "Base Map": baseLayer
}, {
    "Heatmap (Frequent Sightings)": heatLayer,
    "Tiger Sightings": tigerLayer,
    "Elephant Sightings": elephantLayer,
    "Leopard Sightings": leopardLayer,
    "Cow Sightings": CowLayer
}).addTo(map);

// Default Active Layers
heatLayer.addTo(map);






//      weather     //
async function getWeather() {
    const city = document.getElementById("city").value;
    if (!city) {
        alert("Please enter a city name");
        return;
    }

    const apiKey = "156d9e29e84dfcd1f8472d9e8fee3031"; // Replace with your actual API key
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

    try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.cod !== 200) {
            document.getElementById("weather-info").innerHTML = `<p class="text-red-500">${data.message}</p>`;
            return;
        }

        document.getElementById("weather-info").innerHTML = `
            <h2 class="text-xl font-semibold">${data.name}, ${data.sys.country}</h2>
            <p class="text-lg">Temperature: ${data.main.temp}°C</p>
            <p class="text-lg">Weather: ${data.weather[0].description}</p>
            <p class="text-lg">Humidity: ${data.main.humidity}%</p>
        `;
    } catch (error) {
        document.getElementById("weather-info").innerHTML = `<p class="text-red-500">Error fetching data</p>`;
    }
}







// async function getWeather() {
//     const city = document.getElementById('city').value;
//     const apiKey = '156d9e29e84dfcd1f8472d9e8fee3031'; // Replace with your OpenWeatherMap API key
//     const weatherInfo = document.getElementById('weather-info');
//     const dashboardWeather = document.getElementById('weatherupdate');

//     if (!city) {
//         weatherInfo.innerHTML = '<p class="text-red-500">Please enter a city name.</p>';
//         return;
//     }

//     try {
//         const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`);
//         const data = await response.json();

//         if (data.cod !== 200) {
//             weatherInfo.innerHTML = `<p class="text-red-500">${data.message}</p>`;
//             return;
//         }

//         const weatherHTML = `
//             <h3 class="font-bold text-lg">${data.name}, ${data.sys.country}</h3>
//             <p class="text-gray-700">Temperature: ${data.main.temp}°C</p>
//             <p class="text-gray-700">Weather: ${data.weather[0].description}</p>
//             <p class="text-gray-700">Humidity: ${data.main.humidity}%</p>
//             <p class="text-gray-700">Wind Speed: ${data.wind.speed} m/s</p>
//         `;

//         // Display weather info in both sections
//         weatherInfo.innerHTML = weatherHTML;
//         dashboardWeather.innerHTML = `<h3 class="font-bold text-lg mb-2">Weather Update</h3>${weatherHTML}`;
//     } catch (error) {
//         weatherInfo.innerHTML = '<p class="text-red-500">Failed to fetch weather data.</p>';
//     }
// }








    // Ensure the animation works dynamically
    let slides = document.getElementById("slides");
    let index = 0;
    let totalSlides = document.querySelectorAll(".slide").length;

    function slideShow() {
        index++;
        if (index >= totalSlides) { index = 0; }
        slides.style.transform = "translateX(-" + (index * 100) + "%)";
    }

    setInterval(slideShow, 4000); // Change slides every 4 seconds







    const menuBtn = document.getElementById("menu-btn");
    const sidebar = document.getElementById("sidebar");
    const closeBtn = document.getElementById("close-btn");

    menuBtn.addEventListener("click", () => {
        sidebar.classList.remove("translate-x-full");
    });

    closeBtn.addEventListener("click", () => {
        sidebar.classList.add("translate-x-full");
    });

    document.addEventListener("click", (event) => {
        if (!sidebar.contains(event.target) && !menuBtn.contains(event.target)) {
            sidebar.classList.add("translate-x-full");
        }
    });










    async function getWeather() {
        const city = document.getElementById("city").value;
        if (!city) {
            alert("Please enter a city name");
            return;
        }
    
        const url = `weather.php?city=${city}`;
    
        try {
            const response = await fetch(url);
            const data = await response.json();
    
            if (data.error) {
                document.getElementById("weather-info").innerHTML = `<p class="text-red-500">${data.error}</p>`;
                return;
            }
    
            document.getElementById("weather-info").innerHTML = `
                <h2 class="text-xl font-semibold">${data.city}, ${data.country}</h2>
                <p class="text-lg">Temperature: ${data.temperature}°C</p>
                <p class="text-lg">Weather: ${data.description}</p>
                <p class="text-lg">Humidity: ${data.humidity}%</p>
            `;
        } catch (error) {
            document.getElementById("weather-info").innerHTML = `<p class="text-red-500">Error fetching data</p>`;
        }
    }
    