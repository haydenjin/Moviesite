// Signup page validation

var sign = document.getElementById("SignUp");
if (sign) {
    sign.addEventListener("submit", SignUpForm);
}

// Login page validation

var log = document.getElementById("Login");
if (log) {
    log.addEventListener("submit", LoginForm);
}

// Search bar validation
var search = document.getElementById("searchButton");
if (search) {
    search.addEventListener("submit", Search);
}

// Add a watchlist
var watch = document.getElementById("watch");
if (watch) {
    watch.addEventListener("submit", Watch);
}

// Watchlist word counter
var count = document.getElementById("watch");
if (count) {
    count.addEventListener("keyup", Count);
}
