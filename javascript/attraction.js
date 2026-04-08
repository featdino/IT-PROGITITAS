let slideIndex = 1; 
let gallery;
let rating;
let upload;

document.addEventListener("DOMContentLoaded", () => 
{ 
    gallery = document.getElementById("gallery-modal");
    rating = document.getElementById("rating-modal");
    upload = document.getElementById("upload-modal");

    const galleryBtn = document.getElementById("gallery-modal-btn");
    const ratingBtn = document.getElementById("rating-modal-btn");
    const uploadBtn = document.getElementById("upload-modal-btn");

    galleryBtn.addEventListener('click', () => 
    {
        gallery.classList.add("show");
        showSlides(slideIndex);
    });

    ratingBtn.addEventListener('click', () => 
    {
        rating.classList.add("show");
    });

    uploadBtn.addEventListener('click', () =>
    {
        upload.classList.add("show");
    })

    window.addEventListener('click', (event) => 
    {
        if (event.target === gallery) closeGalleryModal();
        if (event.target === rating) closeRatingModal();
        if (event.target === upload) closeUploadModal(); 
    })
});

function closeGalleryModal() 
{
    gallery.classList.remove("show");
}

function changeSlide(n) 
{
    showSlides(slideIndex += n);
}

function showSlides(n) 
{
    let i;
    let slides = document.getElementsByClassName("ofc-image");
    let counter = document.getElementById("slide-counter");

    if (n > slides.length) 
    { 
        slideIndex = 1 
    }    

    if (n < 1) 
    { 
        slideIndex = slides.length 
    }
    
    for (i = 0; i < slides.length; i++) 
    {
        slides[i].style.display = "none";  
    }
    
    slides[slideIndex-1].style.display = "block";  
    
    if(counter) 
    {
        counter.innerHTML = `${slideIndex} / ${slides.length}`;
    }
}

function closeRatingModal() 
{
    rating.classList.remove("show");
}

function closeUploadModal() 
{
    upload.classList.remove("show");
}
