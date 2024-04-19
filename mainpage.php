<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buyer DashBoard</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="mainpageStyles.css">
</head>
<body>
<div class="container">
    <div class="map-container">
        <img src="map.jpg" alt="Map" class="map">
        <div class="pin" style="top: 30%; left: 27%;"></div>
        <div class="pin" style="top: 62%; left: 22%;"></div>
        <div class="pin" style="top: 75%; left: 77%;"></div>
    </div>
    <div class="card-container">
        <div class="card" data-folder="phineas">Phineas</div>
        <div class="card" data-folder="spongebob">Spongebob</div>
        <div class="card" data-folder="simpsons">Simpsons</div>
        <div class="card" data-folder="familyguy">Family Guy</div>

        <!-- Add more cards as needed -->
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
        <div id="popup-card-name" class="popup-card-name"></div> <!-- Placeholder for card name -->
    </div>
</div>

<script>
    const cards = document.querySelectorAll('.card');
    const popupContainer = document.getElementById('popup-container');
    const popupImage = document.getElementById('popup-image');
    const popupCardName = document.getElementById('popup-card-name');
    let currentImageIndex = 0;
    let imagesArray = [];

    // Define arrays for each card's image paths
    const phineasImages = ['images/Phineas/Phineas1.jpeg', 'images/Phineas/Phineas2.jpg', 'images/Phineas/Phineas3.jpg', 'images/Phineas/Phineas4.jpg', 'images/Phineas/Phineas5.jpg', 'images/Phineas/Phineas6.jpg', 'images/Phineas/Phineas7.jpg', 'images/Phineas/Phineas8.jpg'];
    const simpsonsImages = ['images/Simpsons/Simpsons1.jpeg', 'images/Simpsons/Simpsons2.jpeg', 'images/Simpsons/Simpsons3.jpeg', 'images/Simpsons/Simpsons4.jpg', 'images/Simpsons/Simpsons5.jpeg', 'images/Simpsons/Simpsons6.jpeg', 'images/Simpsons/Simpsons7.jpeg',];
    const spongebobImages = ['images/Spongebob/Spongebob1.jpeg', 'images/Spongebob/Spongebob2.jpeg', 'images/Spongebob/Spongebob3.jpeg', 'images/Spongebob/Spongebob4.jpg', 'images/Spongebob/Spongebob5.jpg', 'images/Spongebob/Spongebob6.jpg', 'images/Spongebob/Spongebob7.jpg'];
    const familyguyImages=['images/Familyguy/Familyguy1.jpeg', 'images/Familyguy/Familyguy2.jpeg', 'images/Familyguy/Familyguy3.jpeg', 'images/Familyguy/Familyguy4.jpeg', 'images/Familyguy/Familyguy5.jpeg', 'images/Familyguy/Familyguy6.jpeg', 'images/Familyguy/Familyguy7.jpeg', 'images/Familyguy/Familyguy8.jpeg'];
    // Add more arrays for other cards as needed

    function openPopup(cardName) {
        popupCardName.textContent = cardName; // Set the card name dynamically
        currentImageIndex = 0; // Reset image index to start from the first image
        updatePopupImage();
        // Show the popup only when a card is clicked
        popupContainer.style.display = 'block';
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
            openPopup(card.textContent.trim());
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
            // Add cases for other cards as needed
                    default:
                return [];
        }
    }
</script>
</body>
</html>
