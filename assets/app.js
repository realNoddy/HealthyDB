function switchMode(){
    var switched = document.getElementById("select").style.display != "none";
    if (switched) {
        document.getElementById("insert").style.display = "";
        document.getElementById("select").style.display = "none";
        document.getElementById("sidebar-switch-icon").classList.add("fa-search");
        document.getElementById("sidebar-switch-icon").classList.remove("fa-plus");
    }else{
        document.getElementById("insert").style.display = "none";
        document.getElementById("select").style.display = "";

        document.getElementById("sidebar-switch-icon").classList.remove("fa-search");
        document.getElementById("sidebar-switch-icon").classList.add("fa-plus");
    }
}
