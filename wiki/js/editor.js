document.body.addEventListener("keyup", () => {
    document.getElementById("box").innerHTML = document.getElementById("area").value;
});
document.getElementById("h2").addEventListener("click", () => {
    document.getElementById("area").value += "\n<h2></h2>";
});
document.getElementById("h3").addEventListener("click", () => {
    document.getElementById("area").value += "\n<h3></h3>";
});
document.getElementById("p").addEventListener("click", () => {
    document.getElementById("area").value += "\n<p></p>";
});
document.getElementById("ul").addEventListener("click", () => {
    document.getElementById("area").value += "\n<ul>\n<li></li>\n<li></li>\n<li></li>\n</ul>";
});
document.getElementById("a").addEventListener("click", () => {
    document.getElementById("area").value += "\n<a href=''></a>";
});
document.getElementById("br").addEventListener("click", () => {
    document.getElementById("area").value += "<br>";
});
document.getElementById("img").addEventListener("click", () => {
    document.getElementById("area").value += "\n<img src='images/ここにimgの名前' width='300' height='300'>";
});