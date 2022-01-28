

    fadeInFunc("imm_p", 0.005);
    function fadeTime(){
        fadeOutFunc("container", 1);
    }
        setTimeout(fadeTime, 2000);


    function fadeInFunc(elemento, time) {
        if(time == null){
            time = 0.01;
        }
        var el = document.getElementById(elemento);
        el.style.opacity = 0;
        var tick = function() {
            el.style.opacity = +el.style.opacity + time;
            if (+el.style.opacity < 1) {
                (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
            }
        };
        tick();
    }

    function fadeOutFunc(elemento, time) {
        if(time == null){
            time = 0.01;
        }
        var el = document.getElementById(elemento);
        el.style.opacity = 1;
        var tick = function() {
            el.style.opacity = +el.style.opacity - time;
            if (+el.style.opacity > 0) {
                (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
            }
        };
        tick();
    }

        var oldM = -1;
        window.addEventListener("scroll", (event) => {
        let scrollY = this.scrollY;
        var newMO = 0;
            if(oldM != newMO){
                if(scrollY < 300){
                    setTimeout(fadeOutFunc("container", 1), 900);
                    oldM = newMO;
                }
            }

            var newMI = 1;
            if(oldM != newMI){
                if(scrollY > 450){
                    setTimeout(fadeInFunc("container"), 900);
                    oldM = newMI;
                }
            }
        //console.log(scrollY)
        });

