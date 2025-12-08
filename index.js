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
        const yearA = Number(movieA.querySelector('.movie-year').innerText.trim());
        const yearB = Number(movieB.querySelector('.movie-year').innerText.trim());
        const titleA = movieA.querySelector('.movie-title').innerText.trim().toLowerCase();
        const titleB = movieB.querySelector('.movie-title').innerText.trim().toLowerCase();
        const idA = Number(movieA.querySelector('.movie-id').innerText.trim());
        const idB = Number(movieB.querySelector('.movie-id').innerText.trim());

        if (filter === 'asc-by-year') return yearA - yearB;
        if (filter === 'desc-by-year') return yearB - yearA;
        if (filter === 'asc-by-title') return titleA.localeCompare(titleB);
        if (filter === 'desc-by-title') return titleB.localeCompare(titleA);
        if (filter === 'asc-by-id') return idA - idB;
        if (filter === 'desc-by-id') return idB - idA;
        return 0;
    });
    movies.forEach(movie => movieList.appendChild(movie));
};
