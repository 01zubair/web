let [minutes, seconds] = [25, 0]; // Set initial time to 25 minutes
let timeRef = document.querySelector(".timer-display");
let int = null;

document.getElementById("start-timer").addEventListener("click", () => {
    if (int === null) {
        int = setInterval(displayTimer, 1000);
    }
});

document.getElementById("pause-timer").addEventListener("click", () => {
    clearInterval(int);
    int = null;
});

document.getElementById("reset-timer").addEventListener("click", () => {
    clearInterval(int);
    int = null;
    [minutes, seconds] = [25, 0]; // Reset to 25 minutes
    displayTimer();
});

function displayTimer() {
    if (minutes > 0 || seconds > 0) {
        if (seconds === 0) {
            seconds = 59;
            minutes--;
        } else {
            seconds--;
        }

        let m = minutes < 10 ? "0" + minutes : minutes;
        let s = seconds < 10 ? "0" + seconds : seconds;

        timeRef.innerHTML = `${m} : ${s}`;
    } else {
        clearInterval(int);
        int = null;
    }
}
