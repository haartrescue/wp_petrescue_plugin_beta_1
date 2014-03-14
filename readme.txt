=== WP PetRescue Plugin ===
Contributors: Dave Forster & Greg Tangey
Plugin Name: PetRescue WordPress Plugin
Plugin URI: http://www.haart.org.au/plugins/petrescue
Author URI: http://www.haart.org.au
Donate link: https://www.haart.org.au/donate
Tags: PetRescue, Australia, Dog, Cat, Rescue, HAART, Animal
Requires at least: 3.7.1
Tested up to: 3.8.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add the PetRescue API Functionality to any WordPress installation with the Find a Pet and Pet Info shortcodes.

== Description ==

This plugin uses the PetRescue API functionality to import the rescue organisation's animals into a WordPress Post or Page.

It uses the PetRescue API Key and Group ID of the rescue to display pets for adoption using the shortcodes:

* [petrescue_find_a_pet] - Brings all pets for the group into a list
* [petrescue_find_a_pet category="dog"] - Brings all dogs for the group into a list
* [petrescue_find_a_pet category="cat"] - Brings all cats for the group into a list
* [petrescue_find_a_pet category="other"] - Brings all other animals for the group into a list (Other than Cats and Dogs)
* [petrescue_pet_info] - This shortcode is added to a single page and is used for displaying any animal on the site in it's own page.
* [petrescue_pet_info petid="12345"] - Brings the single pet info into a page based on the PetID (PetRescue listing number)

### Features: ###

* Settings page to enter you PetRescue API Key and Group ID
* Choose the page for the Find a Pet and Pet Info on the settings page, meaning you can format anything you like before and after the shortcode
* It's free, but donations to HAART or PetRescue are gratefully received!

= Sponsorships =

* The original code was created by Dave Forster (http://www.haart.org.au) for the HAART website.
* Plugin creation was generously donated by Greg Tangey (http://ignite.digitalignition.net).
* JB at PetRescue (http://www.petrescue.com.au) was also instrumental to getting this off the ground.

Thanks to everyone!

= Requirements: =
* Wordpress 3.3 or above
* PetRescue API Key and Account - Please email John Bishop (jb@petrescue.com.au) for your API Key.  Your Group ID can be found in your Admin Panel of PetRescue.com.au

== Installation ==

After uploading and activating this plugin, you need to configure it.

1. Create a Page with any of the "petrescue_find_a_pet" shortcodes as the single line.  You can add anything above or below, but for this excercise as the only line. (see above).
2. Create a Page with the "[petrescue_pet_info]" shortcode as the only line in the page.
3. Go to Settings > WP PetRescue Plugin
4. Insert your API Key and Group ID into the relevant fields.
5. Choose your Pet Info Page from the drop-down list.
6. Click Save
7. Navigate to the Find a Pet page you created in step 1.  It should display all the animals you requested it to.
8. Click on an animal from the list and it should navigate to the Pet Info page you specified in step 5 and display the animal details that you clicked on.

== Frequently Asked Questions ==

= What is PetRescue =

PetRescue is a growing national movement inspiring Australians to discover the joy and unconditional love a rescue pet brings. They believe there is a home for every rescue pet and enough love to save every life.

Driven by this belief, they created the PetRescue website and embraced social media to give homeless pets a voice and make adoption the first choice for all.

Today, with the awesome support of their growing community of pet lovers, PetRescue has become Australia’s most visited charity website. Every day they bring pet seekers face-to-furry-face with thousands of adorable rescue pets from shelters and rescue groups nationwide, empowering Australians to save over 4,000 lives every month.

= Who is HAART =

HAART (The Homeless and Abused Animal Rescue Team) is a Western Australian based rescue group saving the lives of 100's of animals each year.

HAART is 100% no-kill and relies on the generosity of the general public to continue it's work.

= ChangeLog =

= 1.0.0 [2014-03-12] =
* private version, not released to public (beta only)