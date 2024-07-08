<!DOCTYPE html>
<html>
<head>
    <script>
        function confirmLogout() {
            return confirm('Are you sure you want to log out?');
        }

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
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dropdown.css">
    <link rel="shortcut icon" type="x-icon" href="upperlogo.png">
</head>
<body>
    <div class="topheader">
        <table border="0" class="topcontents">
            <tr>
                <td>
                    <img src="upperlogo.png" alt="Description" width="120" height="100">
                </td>
                <td width="40px"></td>
                <td><button class="home" type="button" onclick="window.location.href = 'home.php';">Home</button></td>
                <td><button class="manage_profile" type="button" onclick="window.location.href = 'manageprofile.php';">Profile</button></td>
                <td><button class="about" type="button" onclick="include('about.php');">About</button></td>
                
                <td class="dropdown">
                    <select class="dropbtn_categories" onchange="window.location.href=this.value;">
                        <option value="#" disabled selected>Categories</option>
                        <option value="ukraine1.php">Ukraine 1</option>
                        <option value="ukraine2.php">Ukraine 2</option>
                        <option value="ukraine3.php">Ukraine 3</option>
                        <option value="ukraine4.php">Ukraine 4</option>
                        <option value="ukraine5.php">Ukraine 5</option>
                    </select>
                </td>
                <td><button class="budget" type="button" onclick="showPriceInputs('custom')">Budget Range</button></td>
                <td width="52%"><button class="sell" type="button">Sell</button></td>
                <td><button id="logout" class="log_out" type="button" onclick="if(confirmLogout()) { window.location.href = 'signup.php'; }">Log out</button></td>
            </tr>
        </table>
    </div>

    <!-- Budget Range HTML -->
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
</html