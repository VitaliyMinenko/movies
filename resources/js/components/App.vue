<template xmlns="http://www.w3.org/1999/html">
  <div class="container">
  <div class="head bg-primary text-white text-center p-3 font-weight-bold">
    <h1>Movie searcher</h1>
  </div>
    <div class="row mt-1">
      <div class="col">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" :class="{ 'active': activeTab === 'getRandomByNumber' }" @click="getMovies('getRandomByNumber')" >Show 3 random movies.</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" :class="{ 'active': activeTab === 'getByLetterAndPair' }" @click="getMovies('getByLetterAndPair')">Show movies with letter "W" and pair count.</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" :class="{ 'active': activeTab === 'getByMoreThenOneWord' }" @click="getMovies('getByMoreThenOneWord')">Show movies with more then 2 word.</a>
          </li>
        </ul>
        <table class="table">
          <thead>
          <tr>
            <th scope="col">Movie name</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="movie in movies">
            <td>{{movie}}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      activeTab: "",
      movies: []
    }
  },
  mounted() {
    this.activeTab = "getRandomByNumber";
    this.getMovies('getRandomByNumber');
  },
  methods:{
    getMovies(param){
      this.activeTab = param;
      axios.get('/api/v1/movies?action=' + param)
          .then(response => {
            this.movies = response.data.data;
          })
          .catch(error => {
            console.error('Error making GET request:', error);
          });
    }
  },
}

</script>

<style scoped>
.head{
  background-color: #9ca3af;
}
.nav-link{
  color: black;
}
.nav-link:hover {
  cursor: pointer;
}
</style>
