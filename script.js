// Add mouseover/mouseout behavior to all videos
document.querySelectorAll('.video').forEach(video => {
    video.addEventListener('mouseover', function() {
        this.play();
    });
    video.addEventListener('mouseout', function() {
        this.pause();
        this.currentTime = 0; // Optional: Reset video on mouseout
    });
});

// Click handlers for specific videos
const videoLinks = [
    { selector: '.box.item-1 .video', url: 'boxshadow.html' },
    { selector: '.box.item-2 .video', url: 'buttonstyles.html' },
    { selector: '.box.item-3 .video', url: 'emailtemplate.html' },
    { selector: '.box.item-4 .video', url: 'modernloginpage.html' },
    { selector: '.main .video', url: 'modernloginpage.html' } // Added for ourbstsnp.html
];

videoLinks.forEach(link => {
    const element = document.querySelector(link.selector);
    if (element) {
        element.addEventListener('click', function(event) {
            event.stopPropagation();
            window.location.href = link.url;
        });
    }
});
