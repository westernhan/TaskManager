function validateForm() {
    let x = document.forms["myForm"]["Email"].value;
    let y = document.forms["myForm"]["Username"].value;
    let z = document.forms["myForm"]["Password"].value;
    fail = validateEmail(x);
    fail += validateUsername(y);
    fail += validatePassword(z);
    if (fail == "") {
        return true;
    }
    else {
        alert(fail);
        return false;
    }
  }
  
  function validateEmail(field){
      if (field == ""){
          return "No Email was entered.\n";
      }
      else if (!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field)){
          return "The Email address is invalid.\n";
      }
      else{
          return "";
      }
  }
  
  function validateUsername(field){
      if (field == ""){
          return "No Username was entered.\n";
      }
      else if (field.length < 5){
          return "Usernames must be at least 5 characters.\n";
      }
      else if (/[^a-zA-Z0-9_-]/.test(field)){
          return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n";
      }
      else{
          return "";
      }
  }
  
  function validatePassword(field){
      if (field == ""){
          return "No Password was entered.\n";
      }
      else if (field.length < 6){
          return "Passwords must be at least 6 characters.\n";
      }
      else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||!/[0-9]/.test(field)){
          return "Passwords require one each of a-z, A-Z and 0-9.\n";
      }
      else{
          return "";
      }
  }