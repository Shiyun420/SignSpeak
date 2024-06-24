// webcam.js
document.addEventListener('DOMContentLoaded', function() {
    // Open the webcam when the page is loaded
    const webcamContainer = document.getElementById('webcam-container');

    // Example code to open the webcam using HTML5
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            const video = document.createElement('video');
            video.srcObject = stream;
            video.autoplay = true;
            video.playsInline = true;
            webcamContainer.appendChild(video);
        })
        .catch(error => {
            console.error('Error opening webcam:', error);
        });
});