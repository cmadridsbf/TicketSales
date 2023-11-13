if(document.querySelector('#mapa')) {

    const lat = 14.917743666650669
    const lng = -88.23431793309571
    const zoom = 16
 
    const map = L.map('mapa').setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup(`
            <h2 class="mapa__heading">Universidad Tecnológica de Honduras</h2>
            <p class="mapa__texto">Centro de Conferencias, Santa Bárbara</p>
        `)
        .openPopup();
}