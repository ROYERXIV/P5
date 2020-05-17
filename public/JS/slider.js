class Diaporama {
    constructor(id){
        this.slider = document.getElementById(id);
        this.slides = document.getElementsByClassName("slide");
        this.index = 0;
        this.show();
        this.slideInterval = setInterval(()=> {
            this.next();
        }, 5000);

    }

    show(){
        for (let i = 0, i < this.slides.length, i++){
            this.slides[i].style.display ="none";
        }
        this.slides[this.index].style.display = "block";
    }

    next(){
        this.index++;
        if(this.index > this.slides.length -1){
            this.index = 0;
        }
    }
}

const homePageSlider = new Diaporama("slider");