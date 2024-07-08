<!DOCTYPE html>
<html>
<head>
<style>
  .budget-range {
    font-family: Arial, sans-serif;
    padding: 10px;
    border-radius: 5px;
   
  }
  .price-inputs {
    display: none; /* Initially hide the price inputs */
    margin-top: 10px; /* Add margin for spacing */
  }
  .price-inputs.show {
    display: block; /* Show the price inputs when 'show' class is applied */
  }
  input {
    padding: 5px;
    margin-right: 5px;
    width: 100px; /* Adjust width as needed */
    box-sizing: border-box; /* Ensure padding is included in width */
  }
</style>
<script>
  // Function to show price inputs based on selected dropdown option
  function showPriceInputs(optionValue) {
    var priceInputs = document.getElementById("priceInputs");

    if (optionValue === "custom") {
      priceInputs.classList.add("show");
    } else {
      priceInputs.classList.remove("show");
    }
  }

  // Function to clear input fields
  function clearFields() {
    document.getElementById("minPrice").value = "";
    document.getElementById("maxPrice").value = "";
  }
</script>
</head>
<body>

<div class="budget-range">
  <select id="priceOption" onchange="showPriceInputs(this.value)">
    <option value="random">Budget Range (Random)</option>
    <option value="cheap">Cheap</option>
    <option value="expensive">Expensive</option>
    <option value="custom">Custom Range</option>
  </select>

  <div id="priceInputs" class="price-inputs">
    <label for="minPrice">PHP Min Price</label>
    <input type="number" id="minPrice" name="minPrice" placeholder="Min Price" min="0" step="any">
    
    -

    <label for="maxPrice">PHP Max Price</label>
    <input type="number" id="maxPrice" name="maxPrice" placeholder="Max Price" min="0" step="any">
    
    <button type="button" onclick="clearFields()">Clear</button>
    <button type="submit">Apply</button>
  </div>
</div>

</body>
</html>