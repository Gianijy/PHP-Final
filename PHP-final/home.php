<!DOCTYPE html>
<html>
<head>
    <script>
                function confirmLogout() {
                    return confirm("Are you sure you want to log out?");
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
                <td class="dropdown_budget">
                    <select class="dropbtn_budget" >
                        <option value="#" disabled selected>Budget</option>
                        <option >Random</option>
                        <option >Cheap</option>
                        <option >Expensive</option>
                        <option >Custom</option>

                    </select>
                </td>

                <td width="49%"><button class="sell" type="button">Sell</button></td>
                <td><button id="logout" class="log_out" type="button" onclick="if(confirmLogout()) { window.location.href = 'signup.php'; }">Log out</button></td>
            </tr>
        </table>
    </div>

   

   
</body>
</html