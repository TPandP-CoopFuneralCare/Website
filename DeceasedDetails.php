<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Sentinel Homepage</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="search_position">
        <form class="search" action="action_page.php">
            <input type="text" placeholder="Search..." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="sidebar">
        <a href ="MainPage.php"><img src="coop-logo.png" alt="Home" style="width:85px;height:85px;"></a>
        <a href="FuneralArrangements.php" class="button">Funeral Arrangments</a>
        <a href="CareAndPrep.php" class="button">Care and Preparation</a>
        <a href="Fleet Managment" class="button">Fleet Managment</a>
        <a href="Stock Managment" class="button">Stock Managment</a>
        <a href="Timetables" class="button">Timetable</a>

        <div class="logout">
            <a href="logOut.php" class="button">Logout</a>
        </div>
    </div>
</head>
<body>
<div class="details">
<h1>Deceased Name: [Placeholder]</h1>
<p>Unique ID: [Placeholder]</p>
    <p>Deceased Location: [Placeholder]</p>

</div>
<button type="button" class="collapsible">First Offices</button>
<div class="content">
    <input type="checkbox" id="First Offices Completed" name="First Offices Completed" value="First Offices Completed">
    <label for="First Offices Completed"> First Offices Completed</label><br>
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
</div>

<button type="button" class="collapsible2">Coffin Preparation</button>
<div class="content">
<p>Name Plate</p>
<p>Religion: [Placeholder]</p>
    <p>First Line: [Placeholder]</p>
    <p>Second Line: [Placeholder]</p>
    <p>Third Line: [Placeholder]</p>
    <p>Coffin Type: [Placeholder]</p>
    <p>Coffin Size: [Placeholder]</p>
    <p>Coffin Lining Type: [Placeholder]</p>
    <p>Coffin Lining Colour: [Placeholder]</p>
    <input type="checkbox" id="Coffin Completed" name="Coffin Completed" value="Coffin Completed">
    <label for="Coffin Completed">Coffin Completed</label><br>

<script>
    var coll = document.getElementsByClassName("collapsible2");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
    </script>
</div>

<button type="button" class="collapsible3">Care and Preparation</button>
<div class="content">
    <input type="checkbox" id="First Offices Completed" name="First Offices Completed" value="First Offices Completed">
    <label for="First Offices Completed">First Offices Completed</label><br>
    <input type="checkbox" id="Embalming Completed" name="Embalming Completed" value="Embalming Completed">
    <label for="Embalming Completed ">Embalming Completed</label><br>
    <script>
        var coll = document.getElementsByClassName("collapsible3");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
</div>

<button type="button" class="collapsible4">Encoffining</button>
<div class="content">
    <input type="checkbox" id="Deceased Dressed" name="Deceased Dressed" value="Deceased Dressed">
    <label for="Deceased Dressed">Deceased Dressed</label><br>
    <input type="checkbox" id="Deceased Placed in Chapel" name="Deceased Placed in Chapel" value="Deceased Placed in Chapel">
    <label for="Deceased Placed in Chapel">Deceased Placed in Chapel</label><br>
    <label for="locations">Choose a location:</label>
    <select name="locations" id="locations">
        <option value="chapel 1">Chapel 1</option>
        <option value="chapel 2">Chapel 2</option>
        <option value="chapel 3">Chapel 3</option>
        <option value="chapel 4">Chapel 4</option>
    </select>
    <script>
        var coll = document.getElementsByClassName("collapsible4");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
</div>
</body>

