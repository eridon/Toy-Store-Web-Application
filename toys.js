window.addEventListener('load', function () {
    "use strict";
});

const URL = 'getOffers.php';
// Anonymous function
const fetchData = function () {

    fetch(URL)
        .then(
            // Step 1. function needed here to process the response into JSON data
            function (response) {
                return response.json();
            }
        )
        .then(
            // Step 2. function needed here to do something with the JSON data
            function (json) {
                document.getElementById("offers").innerHTML = "<p><b>Toy Name: </b> " + json.toyName + "</p>";
                document.getElementById("offers").innerHTML += "<p><b>Category: </b>" + json.catDesc + "</p>";
                document.getElementById("offers").innerHTML += "<p><b>Price: </b>" + json.toyPrice + "</p>";
            }

        )
        .catch(
            // Step 3. function needed here to do something if there is an error
            function (err) {
                console.log("Something went wrong!", err);
            }
        );
}
// set interval feature
fetchData();
setInterval(fetchData, 5000);