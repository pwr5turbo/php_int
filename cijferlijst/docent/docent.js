
function showT(){
    document.getElementById("toetsen").style.display = "block";
    document.getElementById("leerlingen").style.display = "none";
    document.getElementById("toevoegLeerling").style.display = "none";
    document.getElementById("toevoegToets").style.display = "none";
}

function showL(){
    document.getElementById("toetsen").style.display = "none";
    document.getElementById("leerlingen").style.display = "block";
    document.getElementById("toevoegToets").style.display = "none";
    document.getElementById("toevoegLeerling").style.display = "none";
}

function show_toevoegToets(){
    document.getElementById("toevoegToets").style.display = "block";
    document.getElementById("toetsen").style.display = "none";
}

function show_toevoegLeerling(){
    document.getElementById("toevoegLeerling").style.display = "block";
    document.getElementById("leerlingen").style.display = "none";
}