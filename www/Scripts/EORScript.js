//JS fuctions used in EditOrRemove.php


//Fuction that is executed on page load to prepare things
function prep() {
  $("#editForm").hide();

  //exucute relivent functions on button press
  $("#removebtn").click(function(){
    removeRecord();
  });
  $("#cancelbtn").click(function(){
    cancel();
  });
}

//cancels the cueernt edit
function cancel() {
  //clear everything
  document.getElementById("nameField").value = "";
  document.getElementById("colourField").value = "";
  $("#idErr").text("");
  $("#nameErr").text("");
  $("#colourErr").text("");
  $("#result").text("");

  $("#editForm").hide();
  $("#idForm").show()
}

//gets the Record corrisonding to the given ID and populates the edit form
function getRecord() {
  var id = document.getElementById("id").value;
  $("#result").text("");
  if ((id.match(/^[a-zA-Z0-9]*$/))) {
    $("#idErr").text("")

    //returves record by posting to get script
    $.post({
      url: "scripts/get.php",
      data: {"id": id},
      dataType: "json",
      success: function(resp){
        console.log(JSON.stringify(resp)); // good for debugging
        // do something if response returned

        //error checking
        if (JSON.stringify(resp).startsWith("Database Error<br>")){
          $("#result").text("Database Error. Try again later");
        } else if (JSON.stringify(resp) == "\"InvalidID\"") {
          $("#result").text("that ID does not exist");
        }else{
          //If no errors
          var name = resp["Name"].trim();
          var colour = resp["Colour"].trim();
          document.getElementById("nameField").value = name;
          document.getElementById("colourField").value = colour;
          $("#idForm").hide();
          $("#editForm").show()
        }

      },
      error: function(resp){
        console.log(JSON.stringify(resp)); // good for debug
        // server error
      }
    });
  } else {
    $("#idErr").text("ID cannot contain special charicters");
  }

}

//saves changes made in edit form to database
function editRecord() {
  var letterRE = /^[a-zA-Z]+$/;

  var id = document.getElementById("id").value;
  var name = document.getElementById("nameField").value;
  var colour = document.getElementById("colourField").value;

  var success = true;
  if(!(name.match(letterRE) || name=="")) {
    $("#nameErr").text("Special characters and numbers are not allowed in a name");
    success = false;
  } else {
    $("#nameErr").text("");
  }
  if(colour == "") {
    $("#colourErr").text("A colour is required");
    success = false;
  }else if(!(colour.match(letterRE))) {
    $("#colourErr").text("Special characters and numbers are not allowed in a colour");
    success = false;
  } else {
    $("#colourErr").text("");
  }


  if (success == true) {
    //edits record by posting to edit script
    $.post({
      url: "scripts/edit.php",
      data: {"id": id, "name": name, "colour":colour},
      success: function(resp){
        console.log(JSON.stringify(resp)); // good for debugging
        if (JSON.stringify(resp).startsWith("Database Error<br>")){
          $("#result").text("Database Error. Try again later");
        } else{
          $("#result").text("Your changes have been saved");
        }
        $("#editForm").hide();
        $("#idForm").show()

      },
      error: function(resp){
        console.log(JSON.stringify(resp)); // good for debug
        $("#result").text("Server Error. Try again later");

      }
    });
  }
}

//Removes the curretly selected Record from the database
function removeRecord() {
  var id = document.getElementById("id").value;
  //removes record by posting to remove script
  $.post({
    url: "scripts/remove.php",
    data: {"id": id},
    success: function(resp){
      console.log(JSON.stringify(resp)); // good for debugging

      if (JSON.stringify(resp).startsWith("Database Error<br>")){
        $("#result").text("Database Error. Try again later");
      }  else {
        $("#editForm").hide();
        $("#idForm").show()
        $("#result").text("Your responce has been removed");
        document.getElementById("id").value = "";
      }

    },
    error: function(resp){
      console.log(JSON.stringify(resp)); // good for debug
      $("#result").text("Server Error. Try again later");

    }
  });
}
