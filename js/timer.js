
//Citation : Countdown Snippet logic taken from w3schools - https://www.w3schools.com/howto/howto_js_countdown.asp

//Countdown snippet starts
var countDownDate = new Date("Dec 3, 2017 8:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="timer"
    document.getElementById("countdown-days").innerHTML = days
    document.getElementById("countdown-hrs").innerHTML = hours
    document.getElementById("countdown-mins").innerHTML = minutes
    document.getElementById("countdown-secs").innerHTML = seconds
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("counter-days").innerHTML = "--";
        document.getElementById("counter-hrs").innerHTML = "--";
        document.getElementById("counter-mins").innerHTML = "--";
        document.getElementById("counter-secs").innerHTML  = "--";
    }
}, 1000);
//Countdown snippet ends
