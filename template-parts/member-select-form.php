<form action="" method="POST" name="member-select-form">
  <div class="row">
    <label for="member-search">Search Email :</label>
    <input type="email" name="member-email" id="member-email">
    <input type="submit" name="member-select" id="memeber-select">
  </div>
</form>

<?php global $member; ?>

<?php if($member) : ?>

<div class="member-search-result">
  <table>
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Name</th>
    </tr>
    <tr>
      <td><?php $member->id ?></td>
      <td><?php $member->user_email ?></td>
      <td><?php $member->name_title . " " . $member->first_name . " " . $member->last_name ?></td>
    </tr>
  </table>
</div>

<?php endif; ?>