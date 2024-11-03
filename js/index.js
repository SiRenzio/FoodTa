const storeForm = document.getElementById('storeRegister');
const buttons = document.getElementsByTagName('button');
const customerForm = document.getElementById('customerRegister');

function displayStoreForm(){
    storeForm.style.display = 'flex';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "flex";
    }
}

function displayCustomerForm(){
    customerForm.style.display = 'flex';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "none";
    }
}
