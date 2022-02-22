function validityCheck(form) {

    // Check if name is a locked one
    var listName = form.listName.value;

    if (listName.length == 0) {
        document.getElementById("commandNameError").innerHTML = "The 'Word / Text String\ is empty! <a id='commandNameErrorLink' href='#'><img width='12' height='12' src='main/templates/img/close.png' /></a>";
        
        document.getElementById('commandNameErrorLink').addEventListener('click',function(){
            document.getElementById('commandNameError').style.visibility = "hidden";
        });

        document.getElementById("commandNameError").style.visibility = "visible";
        return false;
    }
}