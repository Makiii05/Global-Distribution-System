// checkbox logic
document.addEventListener('DOMContentLoaded', function() {
  const fields = [
    ["iata", "iataValue"],
    ["icao", "icaoValue"],
    ["airportName", "airportNameValue"],
    ["locationServe", "locationServeValue"],
    ["time", "timeValue"],
    ["dst", "dstValue"],
    ["model", "modelValue"],
    ["airlineName", "airlineNameValue"],
    ["callsign", "callsignValue"],
    ["region", "regionValue"],
    ["comment", "commentValue"],
    ["aid", "aidValue"],
    ["oapid", "oapidValue"],
    ["dapid", "dapidValue"],
    ["roundTrip", "roundTripValue"],
    ["acid", "acidValue"],
    ["auid", "auidValue"],
    ["frid", "fridValue"],
    ["dateDeparture", "dateDepartureValue"],
    ["timeDeparture", "timeDepartureValue"],
    ["dateArrival", "dateArrivalValue"],
    ["timeArrival", "timeArrivalValue"],
    ["status", "statusValue"],
    ["fclassPrice", "fclassPriceValue"],
    ["cclassPrice", "cclassPriceValue"],
    ["yclassPrice", "yclassPriceValue"],
  ];
  
  // Only run if at least one field exists (indicates we're on the right page)
  const firstCheckbox = document.getElementById(fields[0][0]);
  const firstInput = document.getElementById(fields[0][1]);
  

  fields.forEach(([checkboxId, inputId]) => {
    const checkbox = document.getElementById(checkboxId);
    const textInput = document.getElementById(inputId);

    // Skip if either element doesn't exist
    if (!checkbox || !textInput) {
      return; // Continue to next iteration
    }

    textInput.addEventListener("input", () => {
      checkbox.value = textInput.value;
    });

    checkbox.addEventListener("change", () => {
      if (checkbox.checked) {
        textInput.setAttribute("required", "true");
        checkbox.value = textInput.value;
      } else {
        textInput.removeAttribute("required");
        checkbox.value = "";
      }
    });
  });
});

//show nodal 
function modal(rowData) { 
    let modalBody = document.querySelector("#modalBody"); 
    let idCon = document.querySelector("#idCon"); 
    modalBody.innerHTML = ""; 

    // get id (assuming first key in rowData is 'id') 
    let id = rowData.id || Object.values(rowData)[0]; 
    idCon.value = id; 
    
    // skip id in form fields 
    let entries = Object.entries(rowData).slice(1); 
    entries.forEach(([key, value]) => { 
        
        let html = `
        <div class="mb-2"> <label class="form-label fw-bold">${key.toUpperCase()}
        </label> <input type="text" class="form-control" name="${key}" value="${value}"> </div>`; 
        modalBody.innerHTML += html; 
    }); 
    
    let myModal = new bootstrap.Modal(document.getElementById('editModal')); 
    myModal.show(); 
}

//show price nodal 
function modalSeat(rowData, type) {
    console.log(rowData)
    let modalBody = document.querySelector("#seatModalBody"); 
    let modalSubmitCon = document.querySelector(".submit_con"); 
    let modalLabel = document.querySelector("#seatModalLabel");
    modalBody.innerHTML = "";
    modalSubmitCon.innerHTML = "";
    modalLabel.innerHTML = "";

    if (type == "price") {
      modalLabel.innerHTML = `<i class="bi bi-currency-dollar me-2 text-dark"></i> View Price`;
      modalBody.innerHTML = `
        <table class="table table-bordered border-dark align-middle shadow-sm rounded-3">
          <thead class="table-dark sticky-top">
            <tr><th>First Class Price</th><th>Business Class Price</th><th>Economy Class Price</th></tr>
          </thead>
          <tbody>
            <tr><td>$${rowData["fclass_price"]}</td><td>$${rowData['cclass_price']}</td><td>$${rowData['yclass_price']}</td></tr>
          </tbody>
        </table>`;
    }else{
      modalBody.innerHTML = "";
      let table = `<table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Ticket Number</th>
                        <th>Seat</th>
                        <th>Class</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>`;
      rowData.forEach(seat => {
          table += `<tr>
                      <td>${seat.ticket_no}</td>
                      <td>${seat.seat_name}</td>
                      <td>${seat.class}</td>
                      <td>${seat.status}</td>
                    </tr>`;
      });
      table += "</tbody></table>";

      modalBody.innerHTML = table;
      modalLabel.innerHTML = `<i class="bi bi-people-fill me-2 text-dark"></i> View Seat Status`;

    }
    
    let myModal = new bootstrap.Modal(document.getElementById('seatModal')); 
    myModal.show(); 
}

// login toggle
const roleButtons = document.querySelectorAll("[data-role]");
const checkInputDiv = document.querySelectorAll(".input-group-text");
const checkInputField = document.querySelectorAll("input[type=checkbox]");
const InputValueField = document.querySelectorAll(".form-control");
const submitBtn = document.querySelector("#submit_btn");
const submitInp = document.querySelector("#submit_inp");
roleButtons.forEach(btn => {
    btn.addEventListener("click", () => {
        // reset buttons
        roleButtons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        // update submit button value
        submitBtn.value = btn.dataset.role;

        if (submitBtn.value == "search_schedule") {
          for (let i = 0; i < checkInputField.length; i++) {
            checkInputDiv[i].style.display = "block";        
            checkInputField[i].checked = false;
            InputValueField[i].required = false;
          }
          submitBtn.innerHTML = "<i class='bi bi-search me-1'></i>Search"
          submitInp.value = "search_schedule"
        } else if(submitBtn.value == "insert_schedule") {
          for (let i = 0; i < checkInputField.length; i++) {
            checkInputDiv[i].style.display = "none";        
            checkInputField[i].checked = true;
            InputValueField[i].required = true;      
          }
          submitBtn.innerHTML = "<i class='bi bi-file-plus me-1'></i>Insert"
          submitInp.value = "insert_schedule"
        }
    });
});