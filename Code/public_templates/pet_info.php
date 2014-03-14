<h2><?php echo $json['name'];?></h2>
<div class="pet_details">
  <div id="primary">
    <article id="listing_content">
      <div class="actions" style="display:none;">
        <span class="add_remove_favourites">
          <form method="post" action="" accept-charset="UTF-8">
        </span>
      </div>
      <div class="share_listing" style="display:none;">
        <h5>Share</h5>
        <span st_via="PetRescue" st_url="<?php echo $petrescue_url; ?>" displaytext="Facebook" class="share_button st_facebook_custom" st_processed="yes">
          <span class="icon"></span>
          Facebook
        </span>
        <span st_via="PetRescue" st_url="<?php echo $petrescue_url; ?>" displaytext="Twitter" class="share_button st_twitter_custom" st_processed="yes">
          <span class="icon"></span>
          Twitter
        </span>
        <span st_via="PetRescue" st_url="<?php echo $petrescue_url; ?>" displaytext="Google +" class="share_button st_googleplus_custom" st_processed="yes">
          <span class="icon"></span>
          Google +
        </span>
        <span displaytext="Email" data-link-to="<?php echo $petrescue_url."/share"; ?>" class="share_button email_custom">
          <span class="icon"></span>
          Email
        </span>
      </div>
      <h2 class="species"><?php echo $json['size'] ?> <?php echo $json['gender']; ?> <?php echo $json['breeds_display']; ?></h2>
      <h4 class="located_in">Located in <?php echo $json['state']; ?></h4>
      <div class="personality"><?php echo $json['personality']; ?></div>
      <h4 class="located_in">Adoption Process</h4>
      <div class="adoption_process"><?php echo $json['adoption_process']; ?></div>
      <h3><?php echo $json['name'] ?> Details</h3>
      <dl class="pets-details">
        <dt class="first age">Age:</dt>
        <dd class="first age"><?php echo $json['age']; ?></dd>
        <dt class="adoption_fee">Adoption Fee</dt>
        <dd class="adoption_fee">$<?php echo $json['adoption_fee']; ?></dd>
        <dt class="desexed">Desexed?</dt>
        <dd class="desexed"><span class="boolean-image-true boolean-image-yes"><?php echo $desexed; ?></span></dd>
        <dt class="vaccinated">Vaccinated?</dt>
        <dd class="vaccinated"><span class="boolean-image-true boolean-image-yes"><?php echo $json['vaccinated']; ?></span></dd>
        <dt class="wormed">Wormed?</dt>
        <dd class="wormed"><span class="boolean-image-true boolean-image-yes"><?php echo $json['wormed']; ?></span></dd>
        <dt class="heart_worm_treated">Heart Worm Treated?</dt>
        <dd class="heart_worm_treated"><span class="boolean-image-false boolean-image-no"><?php echo $json['heart_worm_treated']; ?></span></dd>
      </dl>
    </article>
  </div>
  <div id="secondary">
    <div id="pet_images">
      <div id="featured_photo">
        <a class="lightbox" rel="gallery" href="<?php echo $photo_featured; ?>"><img src="<?php echo $photo_featured; ?>"></a>
      </div>
      <ul id="thumbnails">
        <?php
          $i = 0;
          foreach($json["photos"] as $photosthumb)
          {
            if (++$i > 4) break;
            $photo_thumb=$photosthumb["small_80"];
            $photo_thumb_large=$photosthumb["large_340"];
        ?>
        <li>
          <a class="lightbox" rel="gallery" href="'<?php echo $photo_thumb_large; ?>">
            <img src="<?php echo $photo_thumb; ?>" >
          </a>
        </li>
        <?php
          }
        ?>
      </ul>
    </div>
  </div>
</div>