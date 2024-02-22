const asideP = document.querySelector("aside p a");
const asideUl = document.querySelector("aside div");
const currentYear = new Date().getFullYear();

const monthArray = [
  "jan",
  "fev",
  "mar",
  "avr",
  "mai",
  "jui",
  "juil",
  "aou",
  "sept",
  "oct",
  "nov",
  "dec",
];

const categoriesArray = [
  {
  title: "maison", 
  src: "img/housing-icon.png", 
  },
  {
  title: "personnel", 
  src: "img/personal-icon.png", 
  },
  {
  title: "medical", 
  src: "img/medical-icon.png", 
  },
  {
  title: "transportation", 
  src: "img/transportation-icon.png", 
  },
  {
  title: "economie", 
  src: "img/savings-icon.png", 
  },
];

const categoriesDiv = document.getElementById("categories");

asideP.innerHTML += currentYear;

for (let month of monthArray) {
  asideUl.innerHTML += `<p class="colorBlack text-decoration-none fw-bold"><a href="" class="colorBlack text-decoration-none">${month}</a></p>`;
}

for (let category of categoriesArray) {
  categoriesDiv.innerHTML += `
  <a href="" class="colorBlack text-decoration-none">
  <div class='d-flex align-items-center'>
  <figure class="${category.title} border-radius-10">
    <img src=" ${category.src} " alt="${category.title}" class="opacity-20" height='50'>
  </figure>
  <div class="mx-2">
  <p class="m-0 fw-light">${category.title}</p>
  <p class="fs-3 fw-bold"><span>0</span>€</p>
  </div>
  </div>
  </a>
  `;
}
