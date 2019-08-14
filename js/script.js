var keyword = document.getElementById("keyword");
var btnSearch = document.getElementById("btnSearch");
var table = document.getElementById("table");
console.log("test0");
keyword.addEventListener("keyup", function () {
    console.log("test1"); 
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // table.innerHTML = xhr.responseText;
            console.log("test");
            table.innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "ajax/mahasiswa.php?keyword=" + keyword.value, true);
    xhr.send();
    
})