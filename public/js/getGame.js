const getGame = new Vue({
    el: "#app",
    data: {
        game: [],
        noteGraph: '',
        noteGameplay: '',
        noteAmbiance: '',
        notePerso: '',
    },
    methods: {
        load() {
            myFetch = fetch(
                    apiUrl
                )
                .then((response) => response.json())
                .then((response) => {
                    this.game = response;
                })
                .catch((error) => console.log("Erreur : " + error));
        },
    },
    mounted() {
        this.load();
    },

})