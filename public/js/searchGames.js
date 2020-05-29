const searchGames = new Vue({
  el: "#searchGames",
  data: {
    games: [],
    pageId: 1,
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
    getPage(pageDiff) {
      this.pageId = this.pageId + pageDiff;
      this.load();
    },
  },
  mounted() {
    this.load();
  }
})