<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="ftco-section contact-section bg-light">
	<div class="container">
		<div class="row d-flex mb-5 contact-info">
			<div class="w-100"></div>
			<div class="col-md-4 d-flex">
				<div class="info bg-white p-4">
					<p><span>Address:</span> Agola Fresh, Nr rachna School, B/h Swapnil Flat, Akhbar Nagar, Nava Vadaj, Ahmedabad - 380013</p>
				</div>
			</div>
			<div class="col-md-4 d-flex">
				<div class="info bg-white p-4">
					<p><span>Phone:</span> <a href="tel://+91 6354072536">+91 6354072536</a></p>
				</div>
			</div>
			<div class="col-md-4 d-flex">
				<div class="info bg-white p-4">
					<p><span>Email:</span> <a href="mailto:agolafresh@gmail.com">agolafresh@gmail.com</a></p>
				</div>
			</div>
		</div>
		<div class="row block-9">
			<div class="col-md-6 order-md-last d-flex">
				<form action="<?= base_url('contact') ?>" class="bg-white p-5 contact-form">
					<div class="form-group">
						<input type="text" class="form-control" name="name" placeholder="Your Name">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Your Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="subject" placeholder="Subject">
					</div>
					<div class="form-group">
						<textarea cols="30" rows="7" name="message" class="form-control" placeholder="Message"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
					</div>
				</form>
			</div>
			<div class="col-md-6 d-flex">
				<div id="map" class="bg-white">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1091.3173472557194!2d72.56089347547582!3d23.070014470332342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e837a2dbcd761%3A0x4ae27492a6f592bc!2sRachana%20High%20School!5e0!3m2!1sen!2sin!4v1598936797515!5m2!1sen!2sin" style="height: 100%; width: 100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				</div>
			</div>
		</div>
	</div>
</section>