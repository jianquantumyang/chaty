// Get the button element
let themeButton = document.querySelectorAll('.theme-toggle');
try {
    if (localStorage.getItem('theme') != 'light') {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
    }

}
catch (e) {
    document.documentElement.classList.add('light');

}
// Add click event listener to the button
// Получаем все элементы с классом "theme-toggle"
let themeButtons = document.querySelectorAll('.theme-toggle');

// Перебираем коллекцию и добавляем обработчик события к каждому элементу
themeButtons.forEach(button => {
    button.addEventListener('click', () => {
        if (document.documentElement.classList.contains("light")) {
            document.documentElement.classList.remove('light');
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
            localStorage.setItem('theme', 'light');
        }
    });
});

const navbarBtn = document.querySelector(".close-profile-bar");
const profileMenu = document.querySelector(".profile-menu");

navbarBtn.addEventListener("click", () => {
  let results = profileMenu.classList.contains('invisible');
  if (results) {
    profileMenu.classList.remove('invisible');
    profileMenu.classList.add('visible');
  } else {
    profileMenu.classList.remove('visible');
    profileMenu.classList.add('invisible');
  }
});

//mobile
const navbarBtnm = document.querySelector(".close-profile-bar-mobile");
const profileMenum = document.querySelector(".profile-menu-mobile");


navbarBtnm.addEventListener('click',() => {
        let results = profileMenum.classList.contains('invisible');
        if(results) {
            profileMenum.classList.remove('invisible');
            profileMenum.classList.add('visible');
        } else {
            profileMenum.classList.remove('visible');
            profileMenum.classList.add('invisible');
        }
    });




const mobileMenuButton = document.querySelector('.mobile-menu-button');
const mobileMenu = document.querySelector('.mobile-menu');

mobileMenuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});