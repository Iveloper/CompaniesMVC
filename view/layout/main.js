    setTimeout(function () {
        $("div").remove(".alert");
    },
            6000);


function deleteCompany(event) {
    if(confirm("Are you sure you want to delete?")){
        alert('okay');
    }
    else{
        event.preventDefault();
    }
}