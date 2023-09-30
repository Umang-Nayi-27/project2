function singer_click(name , path){
    document.querySelector(".artist_section").style.zIndex="99";
    alert(path);
    document.getElementById("artist_img").src=path;
}