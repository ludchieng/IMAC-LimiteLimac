let create_form = document.getElementById("create-form");
let join_form = document.getElementById("join-form");
let create_button = document.getElementById("create-button");
let join_button = document.getElementById("join-button");


document.getElementById("create-button").addEventListener("click", dispCreateForm);

document.getElementById("join-button").addEventListener("click", dispJoinForm);

function dispCreateForm() {
    create_form.style.display = "inline-block";
    join_form.style.display = "none";
    return;
}

function dispJoinForm(){
    join_form.style.display = "inline-block";
    create_form.style.display = "none";
    return;

}
