let loadMoreBtn = document.getElementById("loadMoreBtn");

loadMoreBtn.addEventListener("click", loadMoreRequest);

let getLoadLimit = 3
let httpRequest_loadEvents;

function loadMoreRequest() {
    httpRequest_loadEvents = new XMLHttpRequest();
    httpRequest_loadEvents.onreadystatechange = loadMoreHandler;
    httpRequest_loadEvents.open("POST", "http://localhost/FSD_webdev1_Project/PlaylistPalooza/PlaylistPalooza/includes/loadMore.php", true);
    httpRequest_loadEvents.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    httpRequest_loadEvents.send("limit=" + getLoadLimit);
    getLoadLimit += 3;
}

function loadMoreHandler() {
    // data from loadMore.php

    if (httpRequest_loadEvents.readyState === XMLHttpRequest.DONE) {
        // Everything is good, the response was received.

        let response = httpRequest_loadEvents.response;

        if (response == "") {
            loadMoreBtn.style.display = "none";
        } else {
            document.getElementById("eventSection").innerHTML += (response);
        }
    }
}

