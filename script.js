const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
const testimonialTrack = document.querySelector('.testimonial-track');
const testimonials = document.querySelectorAll('.testimonial-card');
const totalTestimonials = testimonials.length;
let currentIndex = 0;

// Function to update the position of the testimonial track
function updateTestimonialPosition() {
    const testimonialWidth = testimonials[0].clientWidth;
    testimonialTrack.style.transform = `translateX(-${currentIndex * testimonialWidth}px)`;
}

// Next button functionality
// nextButton.addEventListener('click', () => {
//     currentIndex++;
//     if (currentIndex >= totalTestimonials) {
//         currentIndex = 0; // Loop back to the first testimonial
//     }
//     updateTestimonialPosition();
// });

// Previous button functionality
// prevButton.addEventListener('click', () => {
//     currentIndex--;
//     if (currentIndex < 0) {
//         currentIndex = totalTestimonials - 1; // Loop to the last testimonial
//     }
//     updateTestimonialPosition();
// });

// Optional: Auto-scroll testimonials every 5 seconds
setInterval(() => {
    currentIndex++;
    if (currentIndex >= totalTestimonials) {
        currentIndex = 0; // Loop back to the first testimonial
    }
    updateTestimonialPosition();
}, 55000);

function moveToNextSlide() {
  if (counter >= slides.length) return; // Prevent over-sliding
  counter++;
  track.style.transition = "transform 0.5s ease-in-out";
  track.style.transform = `translateX(${-size * counter}px)`;

  track.addEventListener('transitionend', () => {
    if (counter === slides.length) {
      track.style.transition = "none"; // Remove transition to prevent flicker
      counter = 1; // Reset to the first real slide
      track.style.transform = `translateX(${-size * counter}px)`;
    }
  });
}

function moveToPrevSlide() {
  if (counter <= 0) return; // Prevent over-sliding
  counter--;
  track.style.transition = "transform 0.5s ease-in-out";
  track.style.transform = `translateX(${-size * counter}px)`;

  track.addEventListener('transitionend', () => {
    if (counter === 0) {
      track.style.transition = "none"; // Remove transition to prevent flicker
      counter = slides.length - 1; // Reset to the last real slide
      track.style.transform = `translateX(${-size * counter}px)`;
    }
  });
}

// Next and Prev button functionality
next.addEventListener('click', () => {
  clearInterval(autoSlide); // Stop automatic slide when user clicks
  moveToNextSlide();
  startAutoSlide(); // Restart automatic slide after manual interaction
});

prev.addEventListener('click', () => {
  clearInterval(autoSlide); // Stop automatic slide when user clicks
  moveToPrevSlide();
  startAutoSlide(); // Restart automatic slide after manual interaction
});

// Start auto sliding
startAutoSlide();


function toggleMenu() {
  const menu = document.querySelector('nav ul');
  const authButtons = document.querySelector('.auth-buttons');
  menu.classList.toggle('active');
  authButtons.classList.toggle('active');
}






// Check if the user is signed in
// Fetch session data to determine login state
document.addEventListener('DOMContentLoaded', () => {
  fetch('php/session.php')
      .then(response => response.json())
      .then(data => {
          const signInBtn = document.getElementById('signInBtn');
          const registerBtn = document.getElementById('registerBtn');
          const signOutBtn = document.getElementById('signOutBtn');

          if (data.loggedin) {
              signInBtn.style.display = 'none';
              registerBtn.style.display = 'none';
              signOutBtn.style.display = 'inline-block';
          } else {
              signInBtn.style.display = 'inline-block';
              registerBtn.style.display = 'inline-block';
              signOutBtn.style.display = 'none';
          }

          // Add the event listener for the Sign Out button
          if (signOutBtn) {
              signOutBtn.addEventListener('click', (e) => {
                  e.preventDefault();
                  fetch('php/logout.php')
                      .then(response => {
                          if (response.ok) {
                              window.location.reload(); // Reload to update UI
                          } else {
                              console.error('Logout failed:', response.status);
                          }
                      })
                      .catch(error => console.error('Error during logout:', error));
              });
          }
      })
      .catch(error => console.error('Error fetching session data:', error));
});

// Optional: Add a click listener to the "Sign Out" button
document.getElementById('signOutBtn').addEventListener('click', (e) => {
  e.preventDefault(); // Prevent default link behavior
  fetch('php/logout.php')
      .then(response => {
          if (response.ok) {
              console.log('Logged out successfully');
              window.location.reload(); // Reload to update UI
          } else {
              console.error('Logout failed:', response.status);
          }
      })
      .catch(error => console.error('Error during logout:', error));
});





    var swiper = new Swiper(".review-slider", {
      slidesPerView: 3, // Show 3 slides side by side
      spaceBetween: 20, // Add spacing between slides
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
    