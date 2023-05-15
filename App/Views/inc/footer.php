<br>

<!-- ======= Footer ======= -->
<footer id="footer">
	<div class="footer-top" style="background-color: #772B91;background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 footer-info">
					<h3>যোগাযোগ</h3>
					<p>
						<strong>ঠিকানা</strong><br>
						<?= $siteOptions['institute_address'] ?> <br>

						<strong>মোবাইল</strong><br>
						<?= $siteOptions['institute_contact_mobile'] ?><br><br>

						<?php if (!empty($siteOptions['institute_hotline'])) { ?>
						<strong>হটলাইন</strong><br>
						<?= $siteOptions['institute_hotline'] ?><br><br>
						<?php } ?>

						<strong>ই-মেইল</strong><br>
						<a href="mailto:<?= $siteOptions['institute_contact_email'] ?>"><?= $siteOptions['institute_contact_email'] ?></a>

					</p>
					<div class="social-links mt-3">
						<a target="_blank" href="https://www.facebook.com/profile.php?id=100063576222490" class="facebook"><i class="fa fa-facebook"></i></a>
						<a target="_blank" href="<?= CONFIG['base_url'] ?>/#" class="twitter"><i class="fa fa-youtube"></i></a>
					</div>
				</div>


				<div class="col-lg-4 col-md-6 footer-links">
					<h4>সরাসরি লিঙ্ক</h4>
					<ul>
						<li class=""><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp; <a href="<?= CONFIG['base_url'] ?>/homes">প্রথম পাতা</a></li>
						<li class=""><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp; <a href="<?= CONFIG['base_url'] ?>/homes/getAboutInfo">আমাদের সম্পর্কে</a></li>
						<li class=""><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp; <a href="<?= CONFIG['base_url'] ?>/homes/getHistoryInfo">ইতিহাস</a></li>
						<li class=""><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp; <a href="<?= CONFIG['base_url'] ?>/homes/getAllNoticeInfo">বিজ্ঞপ্তি</a></li>
						<li class=""><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp; <a href="<?= CONFIG['base_url'] ?>/homes/getContactInfo">যোগাযোগ</a></li>
					</ul>
				</div>

				<div class="col-lg-4 col-md-6 footer-newsletter">
					<h4>আমাদের সাথে থাকুন</h4>
					<iframe src="<?= CONFIG['base_url'] ?>/resources/page.html" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>				</div>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="copyright">
			কপিরাইট © 2022 - <?= date('Y') ?>, সর্বস্বত্ব সংরক্ষিত, <?= $siteOptions['institute_title'] ?> । <br>
			ডেভেলপার - Sadiq Ahmed			
			<br>

		</div>
	</div>
</footer><!-- End Footer -->

<a href="<?= CONFIG['base_url'] ?>/#" class="back-to-top" style="display: none;"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>



<!-- Vendor JS Files -->
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/jquery.min.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/bootstrap.bundle.min.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/jquery.easing.min.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/validate.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/jquery.sticky.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/venobox.min.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/jquery.waypoints.min.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/counterup.min.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/isotope.pkgd.min.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/aos.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/facnybox.min.js"></script>
<script src="<?= CONFIG['base_url'] ?>/resources/scripts/main.js"></script>



</body>
</html>
