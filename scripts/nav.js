const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav_menu");
const navButton = document.getElementById('nav_button');
hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
});

document.querySelectorAll(".nav_links").forEach((link) => {
  link.addEventListener("click", () => {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
  });
});
navButton.addEventListener('change', () => {
  const selectedIndex = navButton.selectedIndex;
  if (selectedIndex >= 1) {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
  }
});
