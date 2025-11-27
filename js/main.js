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

//show edit modal 
function modal(rowData) { 
    let modalBody = document.querySelector("#modalBody"); 
    let idCon = document.querySelector("#idCon"); 
    modalBody.innerHTML = ""; 

    let id = rowData.id; 
    idCon.value = id; 
    
    // skip id in form fields 
    let entries = Object.entries(rowData).slice(1); 
    entries.forEach(([key, value]) => { 
        title = key.split("_").map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(" ");
        let html = `
        <div class="mb-2"> <label class="form-label fw-bold">${title}
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
        <table class="table table-bordered border-dark align-middle shadow-sm rounded-3 me-3">
          <thead class="table-dark sticky-top">
            <tr><th colspan=3 class="text-center">BASE PRICE</th></tr>
            <tr><th>First Class Price</th><th>Business Class Price</th><th>Economy Class Price</th></tr>
          </thead>
          <tbody>
            <tr>
            <td>$${parseFloat(rowData["fclass_price"]).toFixed(2)}</td>
            <td>$${parseFloat(rowData['cclass_price']).toFixed(2)}</td>
            <td>$${parseFloat(rowData['yclass_price']).toFixed(2)}</td></tr>
          </tbody>
        </table>
        <table class="table table-bordered border-dark align-middle shadow-sm rounded-3 me-3">
          <thead class="table-dark sticky-top">
            <tr><th colspan=3 class="text-center">INFLATION (+${rowData["inflation"]}%)</th></tr>
            <tr><th>First Class Price</th><th>Business Class Price</th><th>Economy Class Price</th></tr>
          </thead>
          <tbody>
            <tr>
            <td>+$${parseFloat((rowData["inflation"])/100*rowData["fclass_price"]).toFixed(2)}</td>
            <td>+$${parseFloat((rowData["inflation"])/100*rowData["cclass_price"]).toFixed(2)}</td>
            <td>+$${parseFloat((rowData["inflation"])/100*rowData["yclass_price"]).toFixed(2)}</td></tr>
          </tbody>
        </table>
        <table class="table table-bordered border-dark align-middle shadow-sm rounded-3 me-3">
          <thead class="table-dark sticky-top">
            <tr><th colspan=3 class="text-center">WINDOW FEE (+${rowData["window_fee_percent"]}%)</th></tr>
            <tr><th>First Class Price</th><th>Business Class Price</th><th>Economy Class Price</th></tr>
          </thead>
          <tbody>
            <tr>
            <td>+$${parseFloat((rowData["window_fee_percent"])/100*rowData["fclass_price"]).toFixed(2)}</td>
            <td>+$${parseFloat((rowData["window_fee_percent"])/100*rowData["cclass_price"]).toFixed(2)}</td>
            <td>+$${parseFloat((rowData["window_fee_percent"])/100*rowData["yclass_price"]).toFixed(2)}</td></tr>
          </tbody>
        </table>
        <table class="table table-bordered border-dark align-middle shadow-sm rounded-3 me-3">
          <thead class="table-dark sticky-top">
            <tr><th colspan=3 class="text-center">AISLE FEE (+${rowData["aisle_fee_percent"]}%)</th></tr>
            <tr><th>First Class Price</th><th>Business Class Price</th><th>Economy Class Price</th></tr>
          </thead>
          <tbody>
            <tr>
            <td>+$${parseFloat((rowData["aisle_fee_percent"])/100*rowData["fclass_price"]).toFixed(2)}</td>
            <td>+$${parseFloat((rowData["aisle_fee_percent"])/100*rowData["cclass_price"]).toFixed(2)}</td>
            <td>+$${parseFloat((rowData["aisle_fee_percent"])/100*rowData["yclass_price"]).toFixed(2)}</td></tr>
          </tbody>
        </table>
        `;
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

// show layout modal
function modalLayout(rowData) {
    // Helper: draw 1 class layout
    function drawSection(prefix, colorClass) {
        const cols = rowData[`${prefix}_col`];
        const rows = rowData[`${prefix}_row`];
        const seatplan = rowData[`${prefix}_seatplan`];
        const ort = rowData[`${prefix}_orientation`]; // front/middle/back
        var seatname = generateSeatNames(cols, rows, seatplan)

        let className = prefix == "f" ? "FIRST" : (prefix == "c" ? "BUSINESS" : "ECONOMY") ;
        const container = document.getElementById(`${ort}_section`);
        document.getElementById(`${ort}_text`).innerHTML = `${className.toUpperCase()} CLASS`;
        container.innerHTML = "";

        // Apply grid sizes
        container.style.gridTemplateColumns = `repeat(${cols}, auto)`;
        container.style.gridTemplateRows = `repeat(${rows}, auto)`;

        const totalSeats = cols * rows;
        currIndex = 0
        for (let i = 0; i < totalSeats; i++) {
            const seat = document.createElement("div");
            seat.classList.add("seat", "border");

            if (seatplan[i] === "1") {
                seat.classList.add(colorClass, "border-3");
                seat.innerText = `${seatname[currIndex]}`;
                currIndex++
            } else {
                seat.classList.add("border-secondary");
            }

            container.appendChild(seat);
        }
    }

    // Draw F, C, Y class sections
    drawSection("f", "border-success"); // FIRST CLASS: green
    drawSection("c", "border-danger");  // BUSINESS CLASS: red
    drawSection("y", "border-warning"); // ECONOMY CLASS: yellow

    // Show modal
    const myModal = new bootstrap.Modal(document.getElementById('layoutModal'));
    myModal.show();
}

function modalScheduleLayout(rowData, seatStatus){
  console.log(seatStatus)
    // Helper: draw 1 class layout
    function drawSection(prefix, className, colorClass) {
        const cols = rowData[`${prefix}_col`];
        const rows = rowData[`${prefix}_row`];
        const seatplan = rowData[`${prefix}_seatplan`];
        const ort = rowData[`${prefix}_orientation`]; // front/middle/back

        const container = document.getElementById(`${ort}_section`);
        document.getElementById(`${ort}_text`).innerHTML = `${className.toUpperCase()} CLASS`;
        container.innerHTML = "";

        // Apply grid sizes
        container.style.gridTemplateColumns = `repeat(${cols}, auto)`;
        container.style.gridTemplateRows = `repeat(${rows}, auto)`;

        const totalSeats = cols * rows;
        const seatStatusMap = [];
        seatStatus.forEach(seat => {
          //fetch all data where class is = First
          if(seat.class === className){
            seatStatusMap.push(seat);
          }
        });
        
        number_aisle = 0;
        for (let i = 0; i < cols; i++) {
          if(seatplan[i] === "0")
            number_aisle ++;
        }

        last_seat = seatStatusMap[cols - number_aisle - 1 ].seat_name[0]
        
        let curSeatIndex = 0;
        for (let i = 0; i < totalSeats; i++) {
            const seat = document.createElement("div");
            seat.classList.add("seat", "border");

            if (seatplan[i] === "1") {
                let seatInfo = seatStatusMap[curSeatIndex]

                inflated = (parseFloat(seatInfo.inflation)/100)*parseFloat(seatInfo.f_price)
                if(seatInfo.seat_name[0] === "A" || seatInfo.seat_name[0] == last_seat ) { 
                  addFee = `Add Fee(Window Seat): ${seatInfo.window_fee}%\n`
                  priceAddFee = ` | +Add Fee`
                  price = parseFloat(seatInfo.f_price) + inflated + ((parseFloat(seatInfo.window_fee)/100)*inflated)
                } else if(seatplan[i - 1] === "0" || seatplan[i + 1] === "0") {
                  addFee = `Add Fee(Aisle Seat): ${seatInfo.aisle_fee}%\n`
                  priceAddFee = ` | +Add Fee`
                  price = parseFloat(seatInfo.f_price) + inflated + ((parseFloat(seatInfo.aisle_fee)/100)*inflated)
                } else {
                  addFee = ""
                  priceAddFee = ``
                  price = parseFloat(seatInfo.f_price) + ((parseFloat(seatInfo.inflation)/100)*parseFloat(seatInfo.f_price))
                }

                if(seatInfo.status === "unavailable"){
                  seat.classList.add(`bg-${colorClass}`, `text-white`)
                  seat.title = `SEAT INFORMATION\nSeat Name: ${seatInfo.seat_name}\nClass: ${seatInfo.class}\nStatus: Occupied\n\nTICKET INFORMATION\nTicket: ${seatInfo.ticket_no}\nInflation: ${seatInfo.inflation}%\n${addFee}Price(+Inflation ${priceAddFee}): $${price}\n\nPASSENGER INFORMATION\nPassenger: ${seatInfo.passenger_name}\nAgency Contact: ${seatInfo.contact_agency}\nPassenger Contact: ${seatInfo.contact_passenger}`
                }else{
                  seat.classList.add(`border-${colorClass}`, "border-3");
                  seat.title = `SEAT INFORMATION\nSeat Name: ${seatInfo.seat_name}\nClass: ${seatInfo.class}\nStatus: Available\n\nTICKET INFORMATION\nTicket: ${seatInfo.ticket_no}\nInflation: ${seatInfo.inflation}%\n${addFee}Price(+Inflation ${priceAddFee}): $${price}`
                }
                seat.textContent = seatInfo.seat_name;
                curSeatIndex++;
            } else {
                seat.classList.add("border-secondary");
                seat.title = "Aisle"
            }

            container.appendChild(seat);
        }
    }

    // Draw F, C, Y class sections
    drawSection("f", "First", "success"); // FIRST CLASS: green
    drawSection("c", "Business", "danger");  // BUSINESS CLASS: red
    drawSection("y", "Economy", "warning"); // ECONOMY CLASS: yellow

    const myModal = new bootstrap.Modal(document.getElementById('scheduleLayoutModal'));
    myModal.show();
}

function generateSeatNames(cols, rows, seatplan) {
    const seatNames = [];
    const letters = Array.from({ length: 26 }, (_, i) => String.fromCharCode(65 + i));
    let position = 0;

    // Loop through each row
    for (let row = 1; row <= rows; row++) {
        let seatLetter = 0; // Counter for A, B, C...

        // Loop through each column
        for (let col = 0; col < cols; col++) {
            // Check if this position has a seat
            if (seatplan[position] === '1') {
                seatNames.push(letters[seatLetter] + row);
                seatLetter++; // Move to next seat letter
            }
            position++;
        }
    }

    return seatNames;
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
          const d = new Date();

          // Local date (YYYY-MM-DD)
          const date = d.toLocaleDateString("en-CA");

          // Local time (HH:mm)
          const time = d.toLocaleTimeString("en-GB", {
            hour: "2-digit",
            minute: "2-digit",
            hour12: false
          });

          document.getElementById("dateDepartureValue").value = date;
          document.getElementById("dateArrivalValue").value = date;
          document.getElementById("timeDepartureValue").value = time;
          document.getElementById("timeArrivalValue").value = time;
          document.getElementById("dateDeparture").value = date;
          document.getElementById("dateArrival").value = date;
          document.getElementById("timeDeparture").value = time;
          document.getElementById("timeArrival").value = time;
          submitBtn.innerHTML = "<i class='bi bi-file-plus me-1'></i>Insert"
          submitInp.value = "insert_schedule"
        }
    });
});
