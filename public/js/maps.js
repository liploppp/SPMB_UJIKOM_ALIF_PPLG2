// Simple Google Maps implementation
let map, marker, selectedLat, selectedLng, selectedAddress;
let mapInitialized = false;

function initializeGoogleMaps() {
    console.log('Initializing Google Maps...');
    
    // Check if Google Maps API is loaded
    if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
        console.error('Google Maps API not loaded');
        return false;
    }
    
    return true;
}

function openMapModal() {
    if (!initializeGoogleMaps()) {
        alert('Google Maps tidak tersedia. Silakan isi alamat secara manual.');
        return;
    }
    
    const mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
    mapModal.show();
    
    // Initialize map after modal is shown
    setTimeout(() => {
        if (!mapInitialized) {
            createMap();
        }
    }, 500);
}

function createMap() {
    try {
        const mapElement = document.getElementById('map');
        if (!mapElement) {
            console.error('Map element not found');
            return;
        }
        
        // Remove loading class
        mapElement.classList.remove('loading');
        
        // Default location (Bandung)
        const defaultLocation = { lat: -6.9175, lng: 107.6191 };
        
        // Create map
        map = new google.maps.Map(mapElement, {
            zoom: 13,
            center: defaultLocation,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        
        // Create marker
        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true,
            title: 'Klik dan drag untuk memindahkan lokasi'
        });
        
        // Add event listeners
        map.addListener('click', function(event) {
            marker.setPosition(event.latLng);
            updateSelectedLocation(event.latLng);
        });
        
        marker.addListener('dragend', function(event) {
            updateSelectedLocation(event.latLng);
        });
        
        // Set initial location
        updateSelectedLocation(defaultLocation);
        mapInitialized = true;
        
        console.log('Google Maps initialized successfully');
        
    } catch (error) {
        console.error('Error creating map:', error);
        alert('Terjadi kesalahan saat memuat peta.');
    }
}

function updateSelectedLocation(location) {
    selectedLat = typeof location.lat === 'function' ? location.lat() : location.lat;
    selectedLng = typeof location.lng === 'function' ? location.lng() : location.lng;
    
    // Update address display
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 
        location: { lat: selectedLat, lng: selectedLng } 
    }, function(results, status) {
        if (status === 'OK' && results[0]) {
            selectedAddress = results[0].formatted_address;
            document.getElementById('selectedAddress').textContent = selectedAddress;
        } else {
            selectedAddress = `Koordinat: ${selectedLat.toFixed(6)}, ${selectedLng.toFixed(6)}`;
            document.getElementById('selectedAddress').textContent = selectedAddress;
        }
    });
}

function searchAddress() {
    const searchInput = document.getElementById('searchLocation');
    const address = searchInput.value.trim();
    
    if (!address) {
        alert('Masukkan alamat yang ingin dicari');
        return;
    }
    
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: address }, function(results, status) {
        if (status === 'OK' && results[0]) {
            const location = results[0].geometry.location;
            map.setCenter(location);
            marker.setPosition(location);
            updateSelectedLocation(location);
        } else {
            alert('Alamat tidak ditemukan. Coba dengan alamat yang lebih spesifik.');
        }
    });
}

function confirmLocation() {
    if (!selectedLat || !selectedLng) {
        alert('Silakan pilih lokasi terlebih dahulu');
        return;
    }
    
    // Update form fields
    document.getElementById('alamat_rumah').value = selectedAddress || '';
    document.getElementById('latitude').value = selectedLat;
    document.getElementById('longitude').value = selectedLng;
    
    // Close modal
    const mapModal = bootstrap.Modal.getInstance(document.getElementById('mapModal'));
    mapModal.hide();
    
    alert('Lokasi berhasil dipilih!');
}

// Make functions globally available
window.openMapModal = openMapModal;
window.searchAddress = searchAddress;
window.confirmLocation = confirmLocation;
window.initMap = createMap; // For Google Maps callback

// Google Maps callback
function googleMapsReady() {
    console.log('Google Maps API loaded successfully');
}

window.googleMapsReady = googleMapsReady;