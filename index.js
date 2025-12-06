console.log("index.js loaded");
document.getElementById('movie-search').addEventListener('input', handleSearch);
function handleSearch() {
    const query = document.getElementById('movie-search').value.toLowerCase();
    const movies = document.querySelectorAll('.movie-card');
    movies.forEach(movie => {
        const title = movie.querySelector('h3').innerText.toLowerCase();
        if (title.includes(query)) {
            movie.style.display = 'block';
        } else {
            movie.style.display = 'none';
        }
    });
};

document.getElementById('search-filter').addEventListener('change', handleSort);
function handleSort() {
    const filter = document.getElementById('search-filter').value;
    const movies = Array.from(document.querySelectorAll('.movie-card'));
    const movieList = document.querySelector('.movie-list');
    movies.sort((movieA, movieB) => {
        const yearA = Number(movieA.querySelector('.movie-year').innerText);
        const yearB = Number(movieB.querySelector('.movie-year').innerText);
        if (filter === 'asc-by-year') return yearA - yearB;
        if (filter === 'desc-by-year') return yearB - yearA;
        return 0;
    });
    movies.forEach(movie => movieList.appendChild(movie));
};
