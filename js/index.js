const storeForm = document.getElementById('storeRegister');
const buttons = document.getElementsByTagName('button');
const customerForm = document.getElementById('customerRegister');
const deliveryForm = document.getElementById('deliveryRegister');
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

function displayDeliveryForm(){
    deliveryForm.style.display = 'flex';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "none";
        bckButton[i].style.display = "block";
    }
}

function goBack() {
    customerForm.style.display = 'none';
    storeForm.style.display = 'none';
    deliveryForm.style.display = 'none';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = "flex";
    }
}

let startTime = null;
let elapsedTime = 0;
let intervalId = null;

const display = document.getElementById('display');
const startButton = document.getElementById('start');
const stopButton = document.getElementById('stop');
const resetButton = document.getElementById('reset');

function formatTime(ms) {
    const totalSeconds = Math.floor(ms / 1000);
    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;

    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}

function updateDisplay() {
    const currentTime = Date.now();
    const deltaTime = currentTime - startTime + elapsedTime;
    display.textContent = formatTime(deltaTime);
}

function startStopwatch() {
    if (!intervalId) {
        startTime = Date.now();
        intervalId = setInterval(updateDisplay, 100);
        startButton.disabled = true;
        stopButton.disabled = false;
        resetButton.disabled = false;
    }
}

startButton.addEventListener('click', startStopwatch);

stopButton.addEventListener('click', () => {
    if (intervalId) {
        elapsedTime += Date.now() - startTime;
        clearInterval(intervalId);
        intervalId = null;
        startButton.disabled = false;
        stopButton.disabled = true;
    }
});

resetButton.addEventListener('click', () => {
    clearInterval(intervalId);
    intervalId = null;
    startTime = null;
    elapsedTime = 0;
    display.textContent = '00:00:00';
    startButton.disabled = false;
    stopButton.disabled = true;
    resetButton.disabled = true;
});

// Automatically start the stopwatch when the page loads
window.onload = startStopwatch;

