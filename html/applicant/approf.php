<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .photo-container {
            margin-top: 15px;
            text-align: center;
        }

        .photo-preview {
            width: 160px;
            height: 160px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 10px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            color: #888;
        }

        .photo-preview img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 4px;
        }

        .upload-button {
            padding: 8px 15px;
            border: 1px solid #007bff;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 5px;
        }

        .upload-button:hover {
            background-color: #0056b3;
        }

        input[type="file"] {
            display: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    
        <form action="../php/approf.php" method="post">
            <div class="FN-group">
            <h2>Applicant Profile</h2>
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" required>
            </div>
            
            <div class="LN-group">
                <label for="Last_Name">Last Name:</label>
                <input type="text" name="Last_Name" id="Last_Name" required>
            </div>

            <div class="MN-group">
                <label for="Middle_Name">Middle Name:</label>
                <input type="text" name="Middle_Name" id="Middle_Name">
            </div>

            <div class="dob-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div class="Sex-group">
                <label for="sex">Select Your Sex</label>
                <select id="sex" name="sex" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="CS-group">
                <label for="Civil_Status">Civil Status</label>
                <select id="Civil_Status" name="Civil_Status" required>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>

            <div class="photo-container">
                <div class="photo-preview" id="photoPreview">
                    <img src="../img/user.png" alt="Default Icon">
                </div>
                <div>
                    <input type="file" id="photo" class="file-input" accept="image/*" onchange="previewImage(event)">
                    <button type="button" class="upload-button" onclick="document.getElementById('photo').click()">UPLOAD PHOTO</button>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Update" class="submit-button">
            </div>
        </form>
    </div>
</body>
</html>