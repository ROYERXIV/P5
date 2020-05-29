// class GetGames {
//   constructor() {
//     window.onload = this.fetchGames();
//   }

//   fetchGames() {
//     this.myFetch = fetch(
//         "https://api.rawg.io/api/games?dates=2019-01-01,2019-12-31&ordering=-added"
//       )
//       .then((response) => response.json())
//       .then((response) => console.log(response.results))
//       .catch((error) => console.log("Erreur : " + error));
//   }
// }


// const getGames = new GetGames();

const getGames = new Vue({
  el: "#app",
  data: {
    games: [],
    pageId: 1,
    // pageDiff: 0,

  },
  methods: {
    load() {
      this.myFetch = fetch(
          url = apiUrl + this.pageId
        )
        .then((response) => response.json())
        .then((response) => {
          this.games = response.results;
        })
        .catch((error) => console.log("Erreur : " + error));
    },
    nextPage() {
      this.pageId++;
      this.load();
    },
    prevPage() {
      this.pageId--;
      this.load();
    },
    getPage(pageDiff){
      this.pageId = this.pageId + pageDiff;
      this.load();
    }
  },
  mounted() {
    this.load();
  }
});

// const vue = new Vue({
//   el: "#app",
//   data: {
//     games: [],
//     pageId: 1,
//     url: "apiUrl" +pageId+ "&page_size=18",

//   },
//   methods: {
//     load() {
//       this.myFetch = fetch(
//           url
//         )
//         .then((response) => response.json())
//         .then((response) => {
//           this.games = response.results;
//         })
//         .catch((error) => console.log("Erreur : " + error));
//     },
//     nextPage() {
//       this.pageId++;
//       this.load();
//     },
//   },
//   mounted() {
//     this.load();
//   }
// });