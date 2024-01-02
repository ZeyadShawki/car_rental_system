function getAllCustomerData() {
  $.ajax({
    url: "http://localhost/final_db_admin/backend/userEditProfile/userEditProfile.php",
    method: "GET",
    data: {
      get_user_data: true,
    },
    dataType: "json",

    success: function (data) {
      // Update input values based on user interactions
      document.getElementById(
        "customerName"
      ).innerText = `${data.FirstName} ${data.LastName}`;

      if (data.imageLink) {
        var userImageElement = document.getElementById("userImage");
        userImageElement.src = data.imageLink;
      } else {
           var userImageElement = document.getElementById("userImage");
           userImageElement.src =
             "http://localhost/final_db_admin/backend/uploaded_images/Image_not_available (1).png";
      }
      document.getElementById("customerEmail").innerText = data.Email;
      document.getElementById("customerPhone").innerText = data.PhoneNumber;
    },
    error: function (error) {
      console.error("Error fetching customer data:", error);
    },
  });
}

document.addEventListener("DOMContentLoaded", function () {
  // AJAX request
  console.log("aaaaa");
  getAllCustomerData();
});

function updateCarNames(selectedBrand) {
  // 3yz 2update el car name 3shan ghyrt fel brand
  console.log("22222");
  console.log(selectedBrand);
  if (selectedBrand == "Any") {
    //set el tnya b ANY brdo
    var selectCarElement = document.getElementById("carNamesSelect");

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
    type: "POST", // hb3t
    url: "../../backend/user_home/user_home.php", // go to this php file
    data: {
      name_of_new_brand: selectedBrand,
      update_car_name: true,
    },
    dataType: "text",
    success: function (response) {
      // Parse the JSON response
      console.log(response + "arrayyy");
      var carNamesArray = JSON.parse(response);
      console.log("55555555");
      console.log(response);
      // Get the select element
      var selectCarElement = document.getElementById("carNamesSelect");

      // Remove all existing options
      selectCarElement.innerHTML = "";

      // Create a new option element
      var option = document.createElement("option");
      console.log("jordiiii");
      option.value = "Any";
      option.text = "Any";

      // Append the option to the select element
      selectCarElement.appendChild(option);

      // Loop through the car names array and add options to the select element
      for (var i = 0; i < carNamesArray.length; i++) {
        var carName = carNamesArray[i];

        // Create a new option element
        var option = document.createElement("option");
        option.value = carName;
        option.text = carName;

        // Append the option to the select element
        selectCarElement.appendChild(option);
      }
    },
  });
}

function updateBrand(selectedCarName) {
  // hsl update f carname f hnupdate el brand
  var brandSelect = document.getElementById("brandSelect").value;
  // var selectCarElement = document.getElementById('carNamesSelect');
  if (selectedCarName == "Any" && brandSelect == "Any") {
    return;
  } else if (selectedCarName == "Any") {
    console.log("h3ml update l brand b any");
    var brandSelect = document.getElementById("brandSelect");
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
    type: "POST", // hb3t
    url: "../../backend/user_home/user_home.php", // go to this php file
    data: {
      current_brand: brandSelect,
      name_of_new_car: selectedCarName,
      update_brand_name: true,
    },
    dataType: "text",
    success: function (response) {
      var selectedValue = response.trim();
      if (selectedValue !== "nochange") {
        var brandSelect = document.getElementById("brandSelect");
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
    },
  });
}
$(document).ready(function () {
  console.log("zzzzzzz");

  $("#search-form").submit(function (e) {
    e.preventDefault();

    console.log("This message will be displayed in the browser console.");

    var country = document.getElementById("country").value;

    var brand = document.getElementById("brandSelect").value;
    var car = document.getElementById("carNamesSelect").value;
    var yearafter = document.getElementById("afterYear").value;
    var yearbefore = document.getElementById("beforeYear").value;
    var reciveddata = document.getElementById("reciveddata");
    reciveddata.innerHTML = "";

    console.log(country);
    console.log(brand, car, yearafter, yearbefore);

    $.ajax({
      type: "POST", // hb3t
      url: "../../backend/user_home/user_home.php", // go to this php file
      data: {
        country: country, // Add the country parameter

        brand_name: brand, // el variables l hb3tha b POST
        car_name: car,
        after_year: yearafter,
        before_year: yearbefore,
        search: true,
      },
      dataType: "text",
      success: function (response) {
        console.log(response);
        reciveddata.innerHTML = response;
      },
    });
  });
});
