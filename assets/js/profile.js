let mainContent = document.getElementById('content1');
let passbutton = document.getElementById('changeBtn');
let contentPassword = document.getElementById('secondContent');
let mainsett = document.getElementById('mainsettings');
let passbutton2 = document.getElementById('changeBtn22');
let miansett2 = document.getElementById('mainsettings2');

function passbtn(){
  contentPassword.style.display = "flex";
  mainContent.style.display = "none";
  passbutton.style.color = "#F28123";
  mainsett.style.color = "white";
  myOrdersBtn.style.color = "white";
  myOrders.style.display = "none";
  mainsett.style.color = "white";
  passbutton2.style.color = "#F28123";
  miansett2.style.color = "white";
  myorders2.style.color = "white";
  BurgerMenuContainer.style.left = "-110%";
  burgerButton.style.display = "block";
  burgerExitButton.style.display = "none";
}
   


function defaultContent(){
  passbutton2.style.color = "white";
  miansett2.style.color = "#F28123";
  contentPassword.style.display = "none";
  mainContent.style.display = "flex";
  passbutton.style.color = "white";
  mainsett.style.color = "#F28123";
  myOrders.style.display = "none";
  myOrdersBtn.style.color = "white";
  myorders2.style.color = "white";
  BurgerMenuContainer.style.left = "-110%";
  burgerButton.style.display = "block";
  burgerExitButton.style.display = "none";
}



let myOrders = document.getElementById('thridcontent');
let myOrdersBtn = document.getElementById('myOrders');
let myorders2 = document.getElementById('myOrders2');

function myOrdersbtn(){
  myorders2.style.color = "#F28123";
  passbutton2.style.color = "white";
  miansett2.style.color = "white";
  contentPassword.style.display = "none";
  mainContent.style.display = "none";
  myOrders.style.display = "flex";
  myOrdersBtn.style.color = "#F28123";
  mainsett.style.color = "white";
  passbutton.style.color = "white";
  burgerButton.style.display = "block";
  burgerExitButton.style.display = "none";
  BurgerMenuContainer.style.left = "-110%";
}


let burgerButton = document.getElementById('burgerBtn');
let burgerExitButton = document.getElementById('burgerExit');
let BurgerMenuContainer = document.getElementById('BurgerContainer');

burgerButton.addEventListener('click', function(){
  burgerButton.style.display = "none";
  burgerExitButton.style.display = "block";
  BurgerMenuContainer.style.left = "0%";
});

burgerExitButton.addEventListener('click', function(){
  burgerButton.style.display = "block";
  burgerExitButton.style.display = "none";
  BurgerMenuContainer.style.left = "-110%";
});

let deleteAccountContainer = document.getElementById("acceptContainer");
let deleteButton = document.getElementById('deleteBtn');
let noButton = document.getElementById('no');

deleteButton.addEventListener('click', function(){
  deleteAccountContainer.style.display = "flex";
  mainContent.setAttribute('readonly', true);
});

noButton.addEventListener('click', function(){
  deleteAccountContainer.style.display = "none";
  mainContent.setAttribute('readonly', false);
});