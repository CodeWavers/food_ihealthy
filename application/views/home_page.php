<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<section class="home-banner">
	<div class="container">
		<div class="your-doorstep">

			<!--<h1><?php echo $this->lang->line('always_at_door'); ?></h1>-->
			<!--<p><?php echo $this->lang->line('order_fav_rest'); ?></p>-->
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
			<form id="home_search_form" class="search-form">
				<div class="form-group">
					<input type="text" name="address" id="address" onFocus="geolocate('')" placeholder="<?php echo $this->lang->line('enter_address'); ?>" value="">
					<input type="button" name="Search" value="<?php echo $this->lang->line('search'); ?>" class="btn" onclick="fillInAddress('home_page')">
				</div>
			</form>
		</div>
	</div>
</section>

<!-- <section class="quick-searches">
	<div class="container">
		<div class="heading-title">
			<h2><?php echo $this->lang->line('quick_search'); ?></h2>
			<div class="slider-arrow">
				<div id="customNav" class="arrow"></div>
			</div>
		</div>
		<div class="quick-searches-slider owl-carousel">
			<?php if (!empty($categories)) {
				foreach ($categories as $key => $value) { ?>
					<div class="quick-searches-box" onclick="quickSearch(<?php echo $value->entity_id; ?>)">
						<img src="<?php echo ($value->image) ? image_url . $value->image : default_img; ?>" alt="Chinese">
						<h5><?php echo $value->name ?></h5>
					</div>
			<?php }
			} ?>
		</div>
	</div>
</section> -->
<?php if (!empty($feature_items)) { ?>
	<section class="quick-searches">
		<div class="container">
			<div class="heading-title">
				<h2><?php echo "Feature Items" ?></h2>
				<div class="slider-arrow">
					<div id="customNav" class="arrow"></div>
				</div>
			</div>
			<div class="quick-searches-slider owl-carousel">
				<?php
				foreach ($feature_items as $key => $value) { ?>
					<div class="quick-searches-box">
						<img src="<?php echo ($value->image) ? image_url . $value->image : default_img; ?>" alt="image">
						<h5><?php echo $value->name ?></h5>
						<?php
						if ($value->check_add_ons == 1) { ?>
							<div class="add-btn" style="display: flex; flex-direction: column;">
								<?php $add = 'Add'; ?>
								<span class="cust"><?php echo $this->lang->line('customizable') ?></span>
								<button class="btn <?php echo strtolower($add); ?> addtocart-<?php echo $value->entity_id; ?>" id="addtocart-<?php echo $value->entity_id; ?>" onclick="checkCartRestaurant(<?php echo $value->entity_id; ?>,<?php echo $value->restaurant_id; ?>,'addons',this.id)"> Add </button>
							</div>
						<?php } else { ?>
							<div class="add-btn" style="display: flex; flex-direction: column;">
								<?php $add = 'Add'; ?>
								<span class="cust" style="opacity: 0;"><?php echo $this->lang->line('customizable') ?></span>
								<button class="btn <?php echo strtolower($add); ?> addtocart-<?php echo $value->entity_id; ?>" id="addtocart-<?php echo $value->entity_id; ?>" onclick="checkCartRestaurant(<?php echo $value->entity_id; ?>,<?php echo $value->restaurant_id; ?>,'',this.id)"> Add </button>
							</div>
						<?php }
						?>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>

<div class="modal modal-main" id="myModal"></div>

<div class="modal modal-main" id="anotherRestModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $this->lang->line('add_to_cart') ?> ?</h4>
				<button type="button" class="close" data-dismiss="modal"><i class="iicon-icon-23"></i></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="custom_cart_restaurant_form">
					<h5><?php echo $this->lang->line('res_details_text1') ?> <br><?php echo $this->lang->line('res_details_text2') ?></h5>
					<div class="popup-radio-btn-main">
						<div class="radio-btn-box">
							<div class="radio-btn-list">
								<label>
									<input type="hidden" name="rest_entity_id" id="rest_entity_id" value="">
									<input type="hidden" name="rest_restaurant_id" id="rest_restaurant_id" value="">
									<input type="hidden" name="is_addon" id="rest_is_addon" value="">
									<input type="hidden" name="item_id" id="item_id" value="">
									<input type="radio" class="radio_addon" name="addNewRestaurant" id="discardOld" value="discardOld">
									<span><?php echo $this->lang->line('discard_old') ?></span>
								</label>
							</div>
							<div class="radio-btn-list">
								<label>
									<input type="radio" class="radio_addon" name="addNewRestaurant" id="keepOld" value="keepOld">
									<span><?php echo $this->lang->line('keep_old') ?></span>
								</label>
							</div>
						</div>
					</div>
					<div class="popup-total-main">
						<div class="total-price">
							<button type="button" class="cartrestaurant btn" id="cartrestaurant" onclick="ConfirmCartRestaurant()"><?php echo $this->lang->line('confirm') ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php if ($this->session->userdata('is_user_login')) { ?>
	<section class="best-offers campaign_div">

	</section>
<?php } ?>

<?php if ($this->session->userdata('is_user_login')) { ?>
	<div id="popular-restaurants">
		<section class="popular-restaurants">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading-title">
							<h2><?php echo $this->lang->line('nearby_restaurants') ?></h2>
							<?php if (!empty($restaurants)) {
								if (count($restaurants) > 9) { ?>
									<a href="<?php echo base_url() . 'restaurant'; ?>">
										<div class="view-all btn"> <?php echo $this->lang->line('view_all'); ?></div>
									</a>
							<?php }
							} ?>
						</div>
					</div>
				</div>
				<div class="row rest-box-row">
					<?php if (!empty($restaurants)) {
						foreach ($restaurants as $key => $value) {
							if ($key <= 8) { ?>
								<div class="col-sm-12 col-md-6 col-lg-4">
									<div class="popular-rest-box">
										<a href="<?php echo base_url() . 'restaurant/restaurant-detail/' . $value['restaurant_slug']; ?>">
											<div class="popular-rest-img">
												<img src="<?php echo ($value['image']) ? $value['image'] : default_img; ?>" alt="<?php echo $value['name']; ?>">
												<?php echo ($value['ratings'] > 0) ? '<strong>' . $value['ratings'] . '</strong>' : '<strong class="newres">' . $this->lang->line("new") . '</strong>'; ?>
												<div class="openclose-btn">
													<div class="openclose <?php echo ($value['timings']['closing'] == "Closed") ? "closed" : ""; ?>"> <?php echo ($value['timings']['closing'] == "Closed") ? $this->lang->line('closed') : $this->lang->line('open'); ?> </div>
													<!-- <?php //echo $value['timings']['closing'];
															?> -->
												</div>
											</div>
											<div class="popular-rest-content">
												<h3><?php echo $value['name']; ?></h3>
												<div class="popular-rest-text">
													<p class="address-icon"><?php echo $value['address']; ?> </p>
												</div>
											</div>
										</a>
									</div>
								</div>
						<?php }
						}
					} else { ?>
						<div class="row">
							<div class="col-lg-12">
								<div>
									<h6><?php echo $this->lang->line('no_such_res_found') ?></h6>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
	</div>
<?php } else { ?>
	<div id="popular_restaurant2">
		<section class="popular-restaurants">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading-title">
							<h2><?php echo $this->lang->line('popular_restaurants') ?></h2>
							<?php if (!empty($restaurants)) {
								if (count($restaurants) > 9) { ?>
									<a href="<?php echo base_url() . 'restaurant/popular'; ?>">
										<div class="view-all btn"> <?php echo $this->lang->line('view_all'); ?></div>
									</a>
							<?php }
							} ?>
						</div>
					</div>
				</div>
				<div class="row rest-box-row">
					<?php if (!empty($restaurants)) {
						foreach ($restaurants as $key => $value) {
							if ($key <= 8) { ?>
								<div class="col-sm-12 col-md-6 col-lg-4">
									<div class="popular-rest-box">
										<a href="<?php echo base_url() . 'restaurant/restaurant-detail/' . $value['restaurant_slug']; ?>">
											<div class="popular-rest-img">
												<img src="<?php echo ($value['image']) ? $value['image'] : default_img; ?>" alt="<?php echo $value['name']; ?>">
												<?php echo ($value['ratings'] > 0) ? '<strong>' . $value['ratings'] . '</strong>' : '<strong class="newres">' . $this->lang->line("new") . '</strong>'; ?>
												<div class="openclose-btn">
													<div class="openclose <?php echo ($value['timings']['closing'] == "Closed") ? "closed" : ""; ?>"> <?php echo ($value['timings']['closing'] == "Closed") ? $this->lang->line('closed') : $this->lang->line('open'); ?> </div>
													<!-- <?php //echo $value['timings']['closing'];
															?> -->
												</div>
											</div>
											<div class="popular-rest-content">
												<h3><?php echo $value['name']; ?></h3>
												<div class="popular-rest-text">
													<p class="address-icon"><?php echo $value['address']; ?> </p>
												</div>
											</div>
										</a>
									</div>
								</div>
						<?php }
						}
					} else { ?>
						<div class="row">
							<div class="col-lg-12">
								<div>
									<h6><?php echo $this->lang->line('no_such_res_found') ?></h6>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
	</div>
<?php } ?>
<input type="hidden" id="user_login" value="<?= $this->session->userdata('is_user_login') ?>">
<!-- Modal -->
<div class="modal std-modal" tabindex="-1" role="dialog" id="campaign_modal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="row align-items-center">
				<div class="col-12">
					<div class="modal-header">
						<h5 class="modal-title">Campaign</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span> </button>
					</div>

					<div class="modal-body">
						<div class="campaign-restaurants"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->

<section class="restaurant-app">
	<div class="container">
		<div class="restaurant-app-content">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="restaurant-app-img wow pulse">
						<img src="<?php echo base_url(); ?>assets/front/images/restaurant-app.png" alt="Restaurant app">
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="restaurant-app-text">
						<div class="heading-title-02">
							<h4><?php echo $this->lang->line('welcome_to') ?> <br><span><?php echo $this->lang->line('site_title'); ?> <?php echo $this->lang->line('res_app') ?></span></h4>
						</div>
						<p><?php echo $this->lang->line('home_text1') ?></p>
						<p><?php echo $this->lang->line('home_text3') ?></p>
						<div class="app-download">
							<a href="<?= ANDROID_APK_LINK ?>"><img src="<?php echo base_url(); ?>assets/front/images/google-play.png" alt="Google play"></a>
							<a href="<?= IOS_APK_LINK ?>"><img src="<?php echo base_url(); ?>assets/front/images/app-store.png" alt="App store"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- <div class="long-bar"></div> -->
<section class="restaurant-contact-div">
	<div class="contact-left text-right">
		<!-- <h2 class="title-main">For Restaurant</h2>
		<p style="font-size: 12px;">We provide the best service for your restaurant.</p> -->
	</div>
	<!-- <div class="solid-bar"></div> -->
	<div style="display: flex; flex-direction: column; gap: 10px">
		<a href="<?= base_url() ?>contact-us/restaurant">
			<button class="btn btn-primary w-100">Get Started</button>
		</a>
		<a href="<?= RESTAURANT_ANDROID_APK_LINK ?>"><img src="<?php echo base_url(); ?>assets/front/images/google-play.png" alt="Google play"></a>
	</div>
</section>
<div class="long-bar"></div>
<section class="rider-app-div">

	<div class="contact-left text-right">
		<!-- <h2 class="title-main">For Rider</h2>
		<p style="font-size: 12px;">We provide the best service for you.</p> -->
	</div>
	<!-- <div class="solid-bar"></div> -->
	<div>
		<h3 class="title-main" style="color:white">For Rider</h3>

		<a href="<?= RIDER_ANDROID_APK_LINK ?>"><img src="<?php echo base_url(); ?>assets/front/images/google-play.png" alt="Google play"></a>

	</div>
</section>


<!-- <section class="driver-app">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-4">
				<div class="driver-app-content">
					<div class="heading-title-02">
						<h4><?php echo $this->lang->line('download') ?> <span><?php echo $this->lang->line('driver_app') ?></span></h4>
					</div>
					<p><?php echo $this->lang->line('site_title'); ?> <?php echo $this->lang->line('home_text2') ?></p>
					<div class="app-download">
						<a href="#"><img src="<?php echo base_url(); ?>assets/front/images/google-play.png" alt="Google play"></a>
						<a href="#"><img src="<?php echo base_url(); ?>assets/front/images/app-store.png" alt="App store"></a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-8">
				<div class="driver-app-img wow pulse">
					<img src="<?php echo base_url(); ?>assets/front/images/driver-app.svg">
				</div>
			</div>
		</div>
	</div>
</section> -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= MAP_API_KEY ?>&libraries=places"></script>
<script>
	$(document).on('ready', function() {
		initAutocomplete('address');
		// auto detect location if even searched once.
		if (SEARCHED_LAT == '' && SEARCHED_LONG == '' && SEARCHED_ADDRESS == '') {
			getLocation('home_page');
		} else {
			getSearchedLocation(SEARCHED_LAT, SEARCHED_LONG, SEARCHED_ADDRESS, 'home_page');
		}

		$(window).keydown(function(event) {
			if (event.keyCode == 13) {
				event.preventDefault();
				return false;
			}
		});

	});

	function getCampaignDetails(campaign_id) {
		html = "";
		$.ajax({
			type: "POST",
			url: BASEURL + "v1/api/getCampaignRestaurants",
			data: {
				latitude: SEARCHED_LAT,
				longitude: SEARCHED_LONG,
				campaign_id: campaign_id
			},
			success: function(data) {
				$(".modal-title").html(data.restaurant[0].campaign[0].name);
				data.restaurant.map((key, index) => {
					html += '<a href="<?php echo base_url() . 'restaurant/restaurant-detail/' ?>/' + key.restaurant_slug + '">'
					html += "<div class='camp_res'>" +
						"<div class='camp_img'><img alt='image' src='" + key.image + "' /></div>" +
						"<div class='camp_details'>" +
						"<div><strong>" + key.name + "</strong></div>" +
						"<div>" + key.address + "</div>" +
						"</div>" +
						"</div>";
				})

				$(".campaign-restaurants").html(html);
				$("#campaign_modal").modal('show');
			}

		})
	};
</script>
<?php $this->load->view('footer'); ?>