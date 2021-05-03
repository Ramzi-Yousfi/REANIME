

let _stripe = Stripe("pk_test_51Imf9aHkgexrIntIfain65CGPVLQ3oKxAG6vwVOhUpafmHTKm9rUndN7m8tuw2a5L4bNE9dCV2yhLcTcTwxagpee00WvUqlSJ6");
let checkoutButton = document.getElementById("checkout-button");
checkoutButton.addEventListener("click", function () {
    fetch("/commande/create-session", {
        method: "POST",
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (session) {
            return _stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
            // If redirectToCheckout fails due to a browser or network
            // error, you should display the localized error message to your
            // customer using error.message.
            if (result.error) {
                alert(result.error.message);
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
});

