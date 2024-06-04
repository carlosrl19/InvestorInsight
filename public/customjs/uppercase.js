// UPPERCASE 
function uppercaseIds(...ids) {
    ids.forEach(id => {
      document.getElementById(id).addEventListener("keyup", function() {
        this.value = this.value.toUpperCase();
      });
    });
  }
  
  // ID's
  uppercaseIds(
    "project_name", 
    "project_comment",
    "transfer_comment",
    "investor_name",
    "commissioner_name"
);