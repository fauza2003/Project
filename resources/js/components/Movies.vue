<template>
    <div class="movies-section">
      <div class="container">
        <h2>🎥 Film yang Sedang Tayang</h2>
        <p>Temukan film favoritmu dan pesan tiketnya sekarang juga!</p>
  
        <!-- Movies Grid -->
        <div class="movies-grid row">
          <div
            v-for="movie in movies"
            :key="movie.id"
            class="movie-card col-md-4 col-sm-6 mb-4"
          >
            <img
              :src="movie.poster"
              :alt="movie.title"
              class="img-fluid"
            />
            <h3>{{ movie.title }}</h3>
            <p>⭐ {{ movie.rating || 'N/A' }} | {{ movie.genre }}</p>
            <a
              :href="`/order/${movie.title}`"
              class="btn btn-primary"
            >
              Pesan Tiket
            </a>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "Movies",
    data() {
      return {
        movies: [], // Data film
      };
    },
    mounted() {
      this.fetchMovies();
    },
    methods: {
      async fetchMovies() {
        try {
          const response = await axios.get("/api/movies");
          this.movies = response.data;
        } catch (error) {
          console.error("Gagal memuat data film:", error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .movies-section {
    margin-top: 20px;
  }
  .movie-card {
    text-align: center;
  }
  .movie-card img {
    border-radius: 10px;
    margin-bottom: 10px;
  }
  </style>
  