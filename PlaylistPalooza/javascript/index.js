let loadMoreBtn = document.getElementById("loadMoreBtn");

loadMoreBtn.addEventListener("click", loadMoreRequest);

let getLoadLimit = 3

let setLoadLimit = JSON.stringify({
    limit: getLoadLimit
});

let httpRequest;

function loadMoreRequest() {
    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = loadMoreHandler;
    httpRequest.open("POST", "http://localhost/FSD_webdev1_Project/PlaylistPalooza/PlaylistPalooza/includes/loadMore.php", true);
    httpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    httpRequest.send("limit=" + getLoadLimit);
    getLoadLimit += 3;
}

function loadMoreHandler() {
    // data from loadMore.php

    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        // Everything is good, the response was received.

        let response = httpRequest.response

        document.getElementById("eventSection").innerHTML += (response);
    }

}

