function getFavorites() {
    const match = document.cookie.match(/(?:^|; )favorites=([^;]*)/);
    return match ? JSON.parse(decodeURIComponent(match[1])) : [];
}

function saveFavorites(favs) {
    document.cookie =
        "favorites=" + encodeURIComponent(JSON.stringify(favs)) +
        "; path=/; max-age=31536000";
}

function toggleFavorite(id) {
    let favs = getFavorites();

    if (favs.includes(id)) {
        favs = favs.filter(f => f !== id);
    } else {
        favs.push(id);
    }

    saveFavorites(favs);
    location.reload();
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            toggleFavorite(parseInt(btn.dataset.id));
        });
    });
});
