setTimeout(function () {
    $("div").remove(".alert");
},
        4000);

function deleteCompany() {
    let x = confirm("Are you sure you want to delete?");
    if (x) {
        alert('You deleted the row');
    } else {
        return false;
    }
}