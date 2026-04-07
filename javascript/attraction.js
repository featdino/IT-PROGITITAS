let slideIndex = 1;
let modal; 

document.addEventListener("DOMContentLoaded", () => 
{ 
    modal = document.getElementById("gallery-modal");
    const modalBtn = document.getElementById("modal-btn");

    modalBtn.addEventListener('click', () => 
    {
        modal.classList.add("show");
        showSlides(slideIndex);
    });

    window.addEventListener('click', (event) => 
    {
        if (event.target === modal) 
        {
            closeModal();
        }
    });
});

function closeModal() 
{
    modal.classList.remove("show");
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