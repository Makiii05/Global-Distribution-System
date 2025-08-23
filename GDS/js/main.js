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
    ["status", "statusValue"]
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
        <div class="mb-2">
          <label class="form-label fw-bold">${key.toUpperCase()}</label>
          <input type="text" class="form-control" name="${key}" value="${value}">
        </div>
        `;
        modalBody.innerHTML += html;
    });

    let myModal = new bootstrap.Modal(document.getElementById('editModal'));
    myModal.show();
}