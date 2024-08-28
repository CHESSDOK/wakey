<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
   
    </style>
</head>
<body>
    <div class="container">
        <div class="form-group">
            <label for="Present_Address">Present Address:</label>
            <input type="text" name="Present_Address" id="Present_Address" placeholder="Enter your address here" size="50" maxlength="200">
        </div>

        <div class="form-group">
            <label for="Barangay">Barangay:</label>
            <input type="text" name="Barangay" id="Barangay" placeholder="Enter your Barangay here">
        </div>

        <div class="form-group">
            <label for="City">City:</label>
            <input type="text" name="City" id="City" placeholder="Enter your City here">
        </div>

        <div class="form-group">
            <label for="Province">Province:</label>
            <input type="text" name="Province" id="Province" placeholder="Enter your Province here">
        </div>

        <div class="form-group">
            <label for="height">Enter Your Height</label>
            <div class="height-group">
                <input type="number" name="height" id="height" placeholder="e.g., 170">
                <span>cm</span>
            </div>
        </div>

        <div class="form-group">
            <label for="Relegion">Enter your Religion</label>
            <input type="text" name="Relegion" id="Relegion">
        </div>

        <div class="form-group">
            <form action="#" method="post">
                <label for="tin">TIN Number:</label>
                <input type="text" id="tin" name="tin" placeholder="Enter TIN Number" oninput="formatTIN(this)" maxlength="14" required>
            </form>
        </div>

        <div class="form-group">
            <label for="Land_Name">Landline No.</label>
            <input type="text" name="Land_Name" id="Land_Name">
        </div>

        <div class="form-group">
            <label for="Cellphone_No">Cellphone No.</label>
            <input type="text" name="Cellphone_No" id="Cellphone_No">
        </div>

        <div class="form-group">
            <label for="Email_Address">Email:</label>
            <input type="email" name="Email_Address" id="Email_Address">

            <div class="form-group">
                <label>Type of Disability:</label>
                <div class="disability-options">
                    <label><input type="radio" name="disabilityType" value="hearing" required> HEARING</label>
                    <label><input type="radio" name="disabilityType" value="visual" required> VISUAL</label>
                    <label><input type="radio" name="disabilityType" value="speech" required> SPEECH</label>
                    <label><input type="radio" name="disabilityType" value="physical" required> PHYSICAL</label>
                    <label><input type="radio" id="disabilityOther" name="disabilityType" value="other" onclick="toggleOtherInput()" required> OTHER</label>
                </div>
                <input type="text" id="otherInput" class="other-input" name="otherDisability" placeholder="Please specify">
            </div>

       
            <div class="form-group">
                <label>Are you an Overseas Filipino Worker (OFW)?</label>
                <div class="ofw-options">
                    <label><input type="radio" id="ofwYes" name="ofw" value="yes" onclick="toggleCountryInput()" required> YES</label>
                    <label><input type="radio" id="ofwNo" name="ofw" value="no" onclick="toggleCountryInput()" required> NO</label><br>
                    
                    <label>Specify Country</label><br>
                    <input type="SC" name="SC" id="SC">
                </div>

                <div class="form-group">
                <label>Are you a Former OFW?</label>
                <div class="ofw-options">
                    <label><input type="radio" id="ofwYes" name="ofw" value="yes" onclick="toggleCountryInput()" required> YES</label>
                    <label><input type="radio" id="ofwNo" name="ofw" value="no" onclick="toggleCountryInput()" required> NO</label><br>
                    
                    <label>Latest Country Deployment</label><br>
                    <input type="LCS" name="LCS" id="LCS">
                </div>
            </div>

            
            </div>
            </div>
        </div>
    </div>

    
</body>
</html>
