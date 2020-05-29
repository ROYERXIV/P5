const getGame = new Vue({
    el: "#app",
    data: {
        game: [],
        note: "",
    },
    methods: {
        load() {
            myFetch = fetch(
                    apiUrl
                )
                .then((response) => response.json())
                .then((response) => {
                    this.game = response.results[0];
                })
                .catch((error) => console.log("Erreur : " + error));
        },
    },
    mounted() {
        this.load();
    }
})