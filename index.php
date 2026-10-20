<?php
require_once 'core/models.php';
$applications = getAllApplications($pdo);
$edit = isset($_GET['edit']) ? getApplicationByID($pdo, $_GET['edit']) : null;
function v($edit, $key) { return $edit ? htmlspecialchars($edit[$key] ?? '') : ''; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cloud Engineer Job Application</title>
<style>
  body { font-family: Arial, sans-serif; margin: 30px; }
  label { display: inline-block; width: 160px; margin: 6px 0; }
  input, select { padding: 6px; width: 240px; }
  button { padding: 7px 16px; cursor: pointer; }
  table { border-collapse: collapse; margin-top: 30px; width: 100%; }
  th, td { border: 1px solid #333; padding: 6px 8px; font-size: 14px; }
  th { background: #0b72b5; color: #fff; }
</style>
</head>
<body>
<p>DB Connection to cloud_job_db successful!</p>
<h2>Welcome to the Cloud Engineer Job Application System</h2>
<p><?= $edit ? "Editing application #" . (int)$edit['application_id'] : "Fill in your details to apply" ?></p>

<form action="core/handleForms.php" method="POST">
  <?php if ($edit): ?>
    <input type="hidden" name="application_id" value="<?= (int)$edit['application_id'] ?>">
  <?php endif; ?>

  <label>First Name</label><input type="text" name="first_name" value="<?= v($edit,'first_name') ?>" required><br>
  <label>Last Name</label><input type="text" name="last_name" value="<?= v($edit,'last_name') ?>" required><br>
  <label>Email</label><input type="email" name="email" value="<?= v($edit,'email') ?>" required><br>
  <label>Phone Number</label><input type="text" name="phone_number" value="<?= v($edit,'phone_number') ?>"><br>
  <label>Years of Experience</label><input type="number" min="0" name="years_of_experience" value="<?= v($edit,'years_of_experience') ?>"><br>
  <label>Cloud Platform</label>
  <select name="cloud_platform">
    <?php foreach (['AWS','Microsoft Azure','Google Cloud','Multi-cloud'] as $p): ?>
      <option <?= ($edit && $edit['cloud_platform'] === $p) ? 'selected' : '' ?>><?= $p ?></option>
    <?php endforeach; ?>
  </select><br>
  <label>Certification</label><input type="text" name="certification" placeholder="e.g. AWS Solutions Architect" value="<?= v($edit,'certification') ?>"><br>
  <label>GitHub Link</label><input type="text" name="github_link" value="<?= v($edit,'github_link') ?>"><br><br>

  <?php if ($edit): ?>
    <button type="submit" name="updateBtn">Update</button>
    <a href="index.php">Cancel</a>
  <?php else: ?>
    <button type="submit" name="insertBtn">Submit</button>
  <?php endif; ?>
</form>

<table>
  <tr>
    <th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th>
    <th>Years Exp.</th><th>Cloud Platform</th><th>Certification</th><th>GitHub</th>
    <th>Date Added</th><th>Actions</th>
  </tr>
  <?php foreach ($applications as $a): ?>
  <tr>
    <td><?= $a['application_id'] ?></td>
    <td><?= htmlspecialchars($a['first_name']) ?></td>
    <td><?= htmlspecialchars($a['last_name']) ?></td>
    <td><?= htmlspecialchars($a['email']) ?></td>
    <td><?= htmlspecialchars($a['phone_number']) ?></td>
    <td><?= $a['years_of_experience'] ?></td>
    <td><?= htmlspecialchars($a['cloud_platform']) ?></td>
    <td><?= htmlspecialchars($a['certification']) ?></td>
    <td><?= htmlspecialchars($a['github_link']) ?></td>
    <td><?= $a['date_added'] ?></td>
    <td>
      <a href="index.php?edit=<?= $a['application_id'] ?>">Edit</a>
      <form action="core/handleForms.php" method="POST" style="display:inline" onsubmit="return confirm('Delete this record?');">
        <input type="hidden" name="application_id" value="<?= $a['application_id'] ?>">
        <button type="submit" name="deleteBtn">Delete</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
