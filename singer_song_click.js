function singer_song_click(song, poster, name, lyrics, artist) {
    document.getElementById("song").src = song;
    document.getElementById("pbimg").src = poster;
    document.getElementById("song-name").innerHTML = name;
    document.getElementById("lyrics_area").innerHTML = lyrics;
    document.getElementById("playback_singer_name").innerHTML = artist;

    document.getElementById("song").play();
    document.getElementById("play").innerHTML = '<i class="fa-solid fa-pause"></i>';

    gsap.from("#lyrics_area", {
        y: 10,
        duration: 1,
        opacity: 0,
        ease: "power2.in"
    })
    gsap.from("#pbimg", {
        duration: 1,
        opacity: 0,
        ease: "power2.in"
    })
    gsap.from("#song-name", {
        y: 5,
        duration: 1,
        opacity: 0,
        ease: "power2.in"
    })
    gsap.from("#playback_singer_name", {
        y: 5,
        duration: 1,
        opacity: 0,
        ease: "power2.in"
    })

    $.ajax({
        type:"POST",
        url:"song_recomendation.php",
        data:{},
        datatype:"JSON",
        sucess:function(){

        },
        error:function(){
            
        }
    })

}