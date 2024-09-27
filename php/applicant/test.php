<?php
// Sample array of companies data
$companies = [
    [
        'logo' => 'logo1.png',
        'name' => 'Company One',
        'address' => '123 Main St, City',
        'email' => 'info@companyone.com',
        'tel' => '(555) 123-4567',
        'vacant' => 'Yes'
    ],
    [
        'logo' => 'logo2.png',
        'name' => 'Company Two',
        'address' => '456 Elm St, City',
        'email' => 'contact@companytwo.com',
        'tel' => '(555) 987-6543',
        'vacant' => 'No'
    ]
];
?>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

</head>

<!-- Table structure using Bootstrap classes -->
<table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Logo</th>
            <th scope="col">Company Info</th>
            <th scope="col">Vacant</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($companies as $company): ?>
            <tr>
                <!-- Company Logo -->
                <td>
                    <img src="<?= $company['logo']; ?>" alt="Company Logo" class="img-fluid" style="max-width: 50px; height: auto;">
                </td>
                
                <!-- Company Info: Name, Address, Email, Tel -->
                <td>
                    <strong><?= $company['name']; ?></strong><br>
                    <?= $company['address']; ?><br>
                    <a href="mailto:<?= $company['email']; ?>"><?= $company['email']; ?></a><br>
                    <?= $company['tel']; ?>
                </td>
                
                <!-- Vacant Display -->
                <td>
                    <span class="badge <?= $company['vacant'] === 'Yes' ? 'bg-success' : 'bg-danger'; ?>">
                        <?= $company['vacant'] === 'Yes' ? 'Vacant' : 'Not Vacant'; ?>
                    </span>
                </td>
                
                <!-- Apply Icon with Link -->
                <td>
                    <a href="apply.php?company=<?= urlencode($company['name']); ?>" class="btn btn-primary">
                        Apply <i class="fa fa-arrow-right"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
