function updateCarNames(selectedBrand) {    // 3yz 2update el car name 3shan ghyrt fel brand   
    if (selectedBrand == "Any") {//set el tnya b ANY brdo
        var selectCarElement = document.getElementById('carNamesSelect');

        for (var i = 0; i < selectCarElement.options.length; i++) {
            if (selectCarElement.options[i].value === "Any") {
                selectCarElement.options[i].selected = true;
            } else {
                selectCarElement.options[i].selected = false;
            }
        }
        return;
    }
    $.ajax({
        type: "POST",// hb3t
        url: "user.php",// go to this php file
        data: {
          name_of_new_brand : selectedBrand,
          update_car_name: true
        },
        dataType: "text",
        success: function(response){
        var selectedValue = response.trim();
        console.log(response);
        // Get the select element
        var selectCarElement = document.getElementById('carNamesSelect');
        // Loop through options and set the selected attribute for the matching value
        for (var i = 0; i < selectCarElement.options.length; i++) {
            if (selectCarElement.options[i].value === selectedValue) {
                selectCarElement.options[i].selected = true;
            } else {
                selectCarElement.options[i].selected = false;
            }
        }
        }
    });
}

function updateBrand(selectedCarName) {// hsl update f carname f hnupdate el brand
    var brandSelect = document.getElementById('brandSelect').value;
    // var selectCarElement = document.getElementById('carNamesSelect');
    if(selectedCarName == "Any" && brandSelect == "Any"){
        return;
    }
    else if (selectedCarName == "Any"){
        console.log ("h3ml update l brand b any");
        var brandSelect = document.getElementById('brandSelect');
        for (var i = 0; i < brandSelect.options.length; i++) {
            if (brandSelect.options[i].value === "Any") {
                brandSelect.options[i].selected = true;
            } else {
                brandSelect.options[i].selected = false;
            }
        return;
    }
    }

    $.ajax({
        type: "POST",// hb3t
        url: "user.php",// go to this php file
        data: {
          current_brand : brandSelect,
          name_of_new_car : selectedCarName,
          update_brand_name: true
        },
        dataType: "text",
        success: function(response){
            var selectedValue = response.trim();
            if (selectedValue !== "nochange") {
                var brandSelect = document.getElementById('brandSelect');
                for (var i = 0; i < brandSelect.options.length; i++) {
                    // console.log(brandSelect.options[i].value);
                    if (brandSelect.options[i].value === selectedValue) {
                        brandSelect.options[i].selected = true;
                        // console.log("true");
                    } else {
                        brandSelect.options[i].selected = false;
                        // console.log("false");

                    }
                }
            }
        }
    });

}
$(document).ready(function(){
    $("#search-form").submit(function(e){
        e.preventDefault();

        console.log('This message will be displayed in the browser console.');

        var brand = document.getElementById('brandSelect').value;
        var car = document.getElementById('carNamesSelect').value;
        var yearafter = document.getElementById('afterYear').value;
        var yearbefore = document.getElementById('beforeYear').value;
        var reciveddata = document.getElementById('reciveddata');
        reciveddata.innerHTML = "";
        console.log(brand,car,yearafter,yearbefore)

        $.ajax({
          type: "POST",// hb3t
          url: "user.php",// go to this php file
          data: {
            brand_name : brand ,// el variables l hb3tha b POST
            car_name : car ,
            after_year : yearafter,
            before_year : yearbefore,
            search: true
          },
          dataType: "text",
          success: function(response){
            console.log(response);
            reciveddata.innerHTML = response;
          }
      });
    });
});