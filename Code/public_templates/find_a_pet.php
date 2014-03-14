<li class="<?php echo $category; ?>-listing listing">
  <div class="photo">
    <a href="<?php echo $peturl; ?>">
    <img src="<?php echo $medium_photo; ?>">
    </a>
  </div>
  <div class="listing_right_side">
    <h4 class="name">
      <a href="<?php echo $peturl; ?>"><?php echo $listing['name']; ?></a>
    </h4>
    <div class="personality"><?php echo $short_personality; ?>…</div>
  </div>

  <?php $gender_class=strtolower($listing['gender']); ?>
  <div class="action_section">
    <dl class="info-line">
      <dt class="gender <?php echo $gender_class; ?>">Gender</dt>
      <dd class="gender <?php echo $gender_class; ?>"><?php echo $listing['gender']; ?></dd>
      <dt class="breed">Breed</dt>
      <dd class="breed"><?php echo $listing['breeds_display']; ?></dd>
    </dl>

    <div class="actions">
      <span id="find_out_more"><a href="<?php echo $peturl; ?>">Find out more</a></span>
    </div>
  </div>
</li>