const storeForm = document.getElementById('storeRegister');
const buttons = document.getElementsByTagName('button');
const customerForm = document.getElementById('customerRegister');
const bckButton = document.getElementById('backBtn');

function displayStoreForm(){
    storeForm.style.display = 'flex';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "none";
        bckButton[i].style.display = "block";
    }

}

function displayCustomerForm(){
    customerForm.style.display = 'flex';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "none";
        bckButton[i].style.display = "block";
    }
}

function goBack() {
    customerForm.style.display = 'none';
    storeForm.style.display = 'none';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "flex";
    }
}