const searchButton = document.getElementById("search-button"),
    searchBar = document.getElementById("search-bar");

searchButton.addEventListener("click", () => {
    if (searchBar.style.display == 'none') {
        searchBar.style.display = 'inline-block';
    } else {
        searchBar.style.display = 'none';
    }
}, false);
