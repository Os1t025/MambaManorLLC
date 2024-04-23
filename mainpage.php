<?php include 'top2.php'; ?>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buyer DashBoard</title>
<link rel="stylesheet" href="mainpageStyles.css">
</head>
<body>
<div class="container">
    <div class="map-container">
        <img src="map.jpg" alt="Map" class="map">
        <div class="pin phineas-pin" style="top: 30%; left: 27%;"></div>
        <div class="pin spongebob-pin" style="top: 75%; left: 77%;"></div>
        <div class="pin simpsons-pin" style="top: 62%; left: 22%; "></div>
        <div class="pin familyguy-pin" style="top: 27%; left: 25%;"></div>
    </div>
    <div class="card-container">
        <!-- Add the search bar -->
    <div class="search-container">
        <input type="text" id="search-input" placeholder="Search..." oninput="searchProperties()">
    </div>
    <div class="card phineas-card" data-folder="phineas" data-price="500,000" data-address="2308 Maple Drive" data-bed="3" data-bath="2" data-sqft="1800" data-property-id="1">
    <div class="card-content">
        <div class="image-container">
            <img src="images/Phineas/Phineas1.jpeg" alt="Phineas Image">
        </div>
        <div class="info-container">
            <h2>Phineas</h2>
            <div class="details">
                <p>Price: $500,000</p>
                <p>Address: 2308 Maple Drive</p>
                <p>Beds: 3 | Baths: 2 | Sq Ft: 1800</p>
            </div>
        </div>
    </div>
</div>
<div class="card spongebob-card" data-folder="spongebob" data-price="400,000" data-address="124 Conch Street" data-bed="2" data-bath="1.5" data-sqft="1500" data-property-id="2">
    <div class="card-content">
        <div class="image-container">
            <img src="images/Spongebob/Spongebob1.jpeg" alt="Spongebob Image">
        </div>
        <div class="info-container">
            <h2>Spongebob</h2>
            <div class="details">
                <p>Price: $400,000</p>
                <p>Address: 124 Conch Street</p>
                <p>Beds: 2 | Baths: 1.5 | Sq Ft: 1500</p>
            </div>
        </div>
    </div>
</div>

<div class="card simpsons-card" data-folder="simpsons" data-price="600,000" data-address="742 Evergreen Terrace" data-bed="4" data-bath="3" data-sqft="2500" data-property-id="3">
    <div class="card-content">
        <div class="image-container">
            <img src="images/Simpsons/Simpsons1.jpeg" alt="Simpsons Image">
        </div>
        <div class="info-container">
            <h2>Simpsons</h2>
            <div class="details">
                <p>Price: $600,000</p>
                <p>Address: 742 Evergreen Terrace</p>
                <p>Beds: 4 | Baths: 3 | Sq Ft: 2500</p>
            </div>
        </div>
    </div>
</div>

<div class="card familyguy-card" data-folder="familyguy" data-price="550,000" data-address="101 Spooner St" data-bed="3" data-bath="2.5" data-sqft="2000" data-property-id="4">
    <div class="card-content">
        <div class="image-container">
            <img src="images/Familyguy/Familyguy1.jpeg" alt="Family Guy Image">
        </div>
        <div class="info-container">
            <h2>FamilyGuy</h2>
            <div class="details">
                <p>Price: $550,000</p>
                <p>Address: 101 Spooner St</p>
                <p>Beds: 3 | Baths: 2.5 | Sq Ft: 2000</p>
            </div>
        </div>
    </div>
</div>
        <?php include 'bottom.php'; ?>
    </div>
</div>

<div id="popup-container" class="popup-container">
    <span class="close-btn" onclick="closePopup()">×</span>
    <div class="popup-content">
        <div class="image-container">
            <img id="popup-image" class="popup-image" src="" alt="Popup Image">
            <div class="btn-container">
                <button onclick="prevImage()">Previous</button>
                <button onclick="nextImage()">Next</button>
            </div>
        </div>
        <div id="popup-card-name" class="popup-card-name"></div>
        <div id="popup-details" class="popup-details"></div> <!-- Details section -->
        <button id="make-offer-btn" onclick="makeOffer()">Make Offer</button>
        <button id="add-wishlist-btn" onclick="addWishlist(propertyId, username)">Add to Wishlist</button>
    </div>
</div>

<script>
const cards = document.querySelectorAll('.card');
const pins = document.querySelectorAll('.pin');
const popupContainer = document.getElementById('popup-container');
const popupImage = document.getElementById('popup-image');
const popupDetails = document.getElementById('popup-details');
let currentImageIndex = 0;
let imagesArray = [];

// Select the Make Offer button by its ID and add an event listener
const makeOfferBtn = document.getElementById('make-offer-btn');
makeOfferBtn.addEventListener('click', makeOffer);
// Select the Add to Wishlist button by its ID and add an event listener
const addWishlistBtn = document.getElementById('add-wishlist-btn');
addWishlistBtn.addEventListener('click', () => {
    const propertyId = document.querySelector('.popup-content').getAttribute('data-property-id');
    addWishlist(propertyId, '<?php echo $username; ?>');
});

// Define arrays for each card's image paths
const phineasImages = ['images/Phineas/Phineas1.jpeg', 'images/Phineas/Phineas2.jpg', 'images/Phineas/Phineas3.jpg', 'images/Phineas/Phineas4.jpg', 'images/Phineas/Phineas5.jpg', 'images/Phineas/Phineas6.jpg', 'images/Phineas/Phineas7.jpg', 'images/Phineas/Phineas8.jpg'];
const simpsonsImages = ['images/Simpsons/Simpsons1.jpeg', 'images/Simpsons/Simpsons2.jpeg', 'images/Simpsons/Simpsons3.jpeg', 'images/Simpsons/Simpsons4.jpg', 'images/Simpsons/Simpsons5.jpeg', 'images/Simpsons/Simpsons6.jpeg', 'images/Simpsons/Simpsons7.jpeg'];
const spongebobImages = ['images/Spongebob/Spongebob1.jpeg', 'images/Spongebob/Spongebob2.jpeg', 'images/Spongebob/Spongebob3.jpeg', 'images/Spongebob/Spongebob4.jpg', 'images/Spongebob/Spongebob5.jpg', 'images/Spongebob/Spongebob6.jpg', 'images/Spongebob/Spongebob7.jpg'];
const familyguyImages = ['images/Familyguy/Familyguy1.jpeg', 'images/Familyguy/Familyguy2.jpeg', 'images/Familyguy/Familyguy3.jpeg', 'images/Familyguy/Familyguy4.jpeg', 'images/Familyguy/Familyguy5.jpeg', 'images/Familyguy/Familyguy6.jpeg', 'images/Familyguy/Familyguy7.jpeg', 'images/Familyguy/Familyguy8.jpeg'];
// Add more arrays for other cards as needed

// Event listeners for the first Phineas card
const firstPhineasCard = document.querySelector('.card.phineas-card');
const firstPhineasPin = document.querySelector('.pin.phineas-pin');

firstPhineasCard.addEventListener('click', () => {
    openPopup('phineas'); 
});

firstPhineasPin.addEventListener('click', () => {
    openPopup('phineas'); 
});

// Event listeners for the first Spongebob card
const firstSpongebobCard = document.querySelector('.card.spongebob-card');
const firstSpongebobPin = document.querySelector('.pin.spongebob-pin');

firstSpongebobCard.addEventListener('click', () => {
    openPopup('spongebob'); 
});

firstSpongebobPin.addEventListener('click', () => {
    openPopup('spongebob'); 
});

// Event listeners for the first Simpsons card
const firstSimpsonsCard = document.querySelector('.card.simpsons-card');
const firstSimpsonsPin = document.querySelector('.pin.simpsons-pin');

firstSimpsonsCard.addEventListener('click', () => {
    openPopup('simpsons'); 
});

firstSimpsonsPin.addEventListener('click', () => {
    openPopup('simpsons'); 
});
    // Event listeners for the first FamilyGuy card
    const firstFamilyGuyCard = document.querySelector('.card.familyguy-card');
const firstFamilyGuyPin = document.querySelector('.pin.familyguy-pin');

firstFamilyGuyCard.addEventListener('click', () => {
    openPopup('familyguy'); 
});

firstFamilyGuyPin.addEventListener('click', () => {
    openPopup('familyguy'); 
});
function openPopup(cardName) {
    const card = document.querySelector(`.card[data-folder="${cardName.toLowerCase()}"]`);
    const price = card.getAttribute('data-price');
    const address = card.getAttribute('data-address');
    const beds = card.getAttribute('data-bed');
    const baths = card.getAttribute('data-bath');
    const sqft = card.getAttribute('data-sqft');

    let description = '';
    switch (cardName.toLowerCase()) {
        case 'phineas':
            description = "Step into the world of adventure and creativity at 2308 Maple Drive in Danville! Phineas and Ferb's expansive modern home is a haven for innovation and fun. Boasting a cutting-edge design, spacious rooms, an observatory for stargazing, and a backyard that's perfect for building, exploring, and inventing, this property is a dream come true for imaginative minds.";
            imagesArray = phineasImages; 
            break;
        case 'spongebob':
            description = "Charming and cozy, Spongebob's pineapple-shaped home offers a unique living experience in the heart of Bikini Bottom. Perfect for a single occupant or a small family, this cheerful abode features a bright interior, a spacious living area, and a quaint garden, creating an inviting atmosphere reminiscent of beachside living.";
            imagesArray = spongebobImages; 
            break;
        case 'simpsons':
            description = "Welcome to the iconic Simpsons' family home at 742 Evergreen Terrace! This spacious two-story house is ideal for families looking for comfort and convenience. With four bedrooms, a cozy living room, a fully equipped kitchen, and a backyard perfect for outdoor gatherings, this home provides ample space for your family's needs.";
            imagesArray = simpsonsImages; 
            break;
        case 'familyguy':
            description = "Nestled on 101 Spooner St in Quahog, Rhode Island, the Griffin family home is a charming retreat offering a blend of comfort and character. Featuring multiple levels, a versatile floor plan, and a vibrant neighborhood setting, this residence is perfect for families seeking a cozy yet lively living environment.";
            imagesArray = familyguyImages; 
            break;
        default:
            description = "Description not available.";
            imagesArray = []; 
    }

    popupDetails.innerHTML = `
        <div class="price">Price: $${price}</div>
        <div class="address">Address: ${address}</div>
        <div class="specs">Beds: ${beds} | Baths: ${baths} | Sq Ft: ${sqft}</div>
        <div class="description"><p>${description}</p></div>
    `;
    popupContainer.style.display = 'block';
    currentImageIndex = 0;
    updatePopupImage();
}

function closePopup() {
    popupContainer.style.display = 'none';
}

function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + imagesArray.length) % imagesArray.length;
    updatePopupImage();
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % imagesArray.length;
    updatePopupImage();
}

function updatePopupImage() {
    popupImage.src = imagesArray[currentImageIndex];
}

cards.forEach(card => {
    card.addEventListener('click', () => {
        const folder = card.getAttribute('data-folder');
        imagesArray = getImagesArray(folder);
        if (imagesArray.length > 0) {
            openPopup(card.textContent.trim());
        }
    });

    card.addEventListener('mouseenter', () => {
        const folder = card.getAttribute('data-folder');
        const pin = document.querySelector(`.pin.${folder}-pin`);
        card.style.backgroundColor = '#37882c';
        pin.style.backgroundColor = 'yellow';
    });

    card.addEventListener('mouseleave', () => {
        const folder = card.getAttribute('data-folder');
        const pin = document.querySelector(`.pin.${folder}-pin`);
        card.style.backgroundColor = '';
        pin.style.backgroundColor = '';
    });
});

pins.forEach(pin => {
    pin.addEventListener('click', () => {
        const folder = pin.classList[1].replace('-pin', '');
        const card = document.querySelector(`.card.${folder}-card`);
        imagesArray = getImagesArray(folder);
        if (imagesArray.length > 0) {
            openPopup(card.textContent.trim());
        }
    });

    pin.addEventListener('mouseenter', () => {
        const folder = pin.classList[1].replace('-pin', '');
        const card = document.querySelector(`.card.${folder}-card`);
        card.style.backgroundColor = '#37882c';
        pin.style.backgroundColor = 'yellow';
    });

    pin.addEventListener('mouseleave', () => {
        const folder = pin.classList[1].replace('-pin', '');
        const card = document.querySelector(`.card.${folder}-card`);
        card.style.backgroundColor = '';
        pin.style.backgroundColor = '';
    });
});

function getImagesArray(folder) {
    switch (folder) {
        case 'phineas':
            return phineasImages;
        case 'spongebob':
            return spongebobImages;
        case 'simpsons':
            return simpsonsImages;
        case 'familyguy':
            return familyguyImages;
        default:
            return [];
    }
}
// Add function to handle search
function searchProperties() {
    const searchTerm = document.getElementById('search-input').value;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `data3.php?search_term=${searchTerm}`, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                updateDashboard(response);
            } else {
                console.error('Error fetching search results:', xhr.status);
            }
        }
    };
    xhr.send();
}

// Function to attach event listeners for cards and pins
function attachEventListeners() {
    cards.forEach(existingCard => {
        existingCard.addEventListener('click', () => {
            const folder = existingCard.getAttribute('data-folder');
            openPopup(folder);
        });
    });

    pins.forEach(existingPin => {
        existingPin.addEventListener('click', () => {
            const folder = existingPin.classList[1].replace('-pin', '');
            openPopup(folder);
        });
    });
}

// Function to update dashboard with search results
function updateDashboard(result) {
    const cardContainer = document.querySelector('.card-container');
    cardContainer.innerHTML = '';

    // Add the search bar back to the card container
    const searchBarHTML = `
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Search..." oninput="searchProperties()">
        </div>
    `;
    cardContainer.innerHTML += searchBarHTML;

    // Create and append the card with search result
    const card = document.createElement('div');
    card.classList.add('card');
    card.innerHTML = `
        <div class="card-content">
            <div class="image-container">
                <img src="${result.image_path}" alt="${result.name} Image">
            </div>
            <div class="info-container">
                <h2>${result.name}</h2>
                <div class="details">
                    <p>Price: $${result.price}</p>
                    <p>Address: ${result.address}</p>
                    <p>Beds: ${result.beds} | Baths: ${result.baths} | Sq Ft: ${result.sqft}</p>
                </div>
            </div>
        </div>
    `;
    
    cardContainer.appendChild(card);

    // Reattach event listener for the new card
    card.addEventListener('click', () => {
        openPopup(result.name.toLowerCase());
    });

    // Reattach event listener for the pin
    const newPin = document.querySelector(`.pin.${result.name.toLowerCase()}-pin`);
    newPin.addEventListener('click', () => {
        openPopup(result.name.toLowerCase());
    });

    // Reattach event listeners for all existing cards and pins
    attachEventListeners();
}
function makeOffer() {
    
    popupDetails.innerHTML = `
        <h3>Your offer will be sent to the owner</h3>
        <label for="offer">Enter your offer amount: </label>

        <input type="number" id="offer" name="offer" min="0" max="10000000" />
        <button id="submit-offer-btn">Submit Offer</button>
    `;
    popupContainer.style.display = 'block';
    // Select the Make Offer button by its ID and add an event listener
    const submitOfferBtn = document.getElementById('submit-offer-btn');
    submitOfferBtn.addEventListener('click', submitOffer);
}

function submitOffer() {
    closePopup();
    alert('Offer made!');
}
function addWishlist(propertyId, userId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'data4.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert(response.message); // Success message
                } else {
                    alert(response.message); // Error message
                }
            } else {
                console.error('Error:', xhr.status); // Handle HTTP errors
            }
        }
    };
    xhr.send(`property_id=${propertyId}&user_id=${userId}`);
}
</script>
</body>
</html>