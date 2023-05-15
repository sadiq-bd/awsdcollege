
<style>
.img-slider{

max-height: 420px !important;
min-height: 420px !important;
width:100% !important;
}
</style>

<section style="background: #fff;padding: 0px;border-bottom: 0px solid #eee;font-size: 14px;">
	<div class="container clearfix">
		<div class="row">
			<div class="col-md-1 col-3">
				<div class="contact-info float-left" style="background:#772B91;padding: 10px 30px;">
					<a href="javascript:void(0);" style="color: #fff;">সংবাদ</a>
				</div>
			</div>
			<div class="col-md-11 col-9">
				<div style="padding: 8px 2px;background:#8cc63f;">
					<marquee scrollamount="2" onmouseover="this.setAttribute('scrollamount', 0, 0);this.stop();" onmouseout="this.setAttribute('scrollamount', 2, 0);this.start();">
						<span style="background:none;color:#000000; font-weight: bold;">
							<span style="color: #ff0000;">*&nbsp;</span>
								<?= $siteOptions['institute_update_notice'] ?>							
							<span style="color: #ff0000;">&nbsp;*</span>
						</span>
					</marquee>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container">
	<div class="row" style="margin-left: 0px;background:#f5f5f5;margin-right:0px;">
		<div class="col-lg-9" style="display:grid;margin-bottom:0px;margin-top:0px;padding:0px;">
			<div class="ssbox">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

					<div class="carousel-inner">


						<!-- carousels -->
						<div class="carousel-item active">
							<img class="d-block img-slider" src="<?= CONFIG['base_url'] ?>/resources/images/institute-building-image.jpg" alt="" title="">							
						</div>

						

					</div>
					<a class="carousel-control-prev" href="javascript:void(0);carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="javascript:void(0);carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>

		</div>


		<div class="col-lg-3" style="display:grid;margin-bottom:0px;margin-top:0px;text-align: center;">
			<div class="sbox">
				<h5 style="border-bottom: 2px solid #ccc;padding-bottom: 8px;">
					সভাপতি				</h5>
			    <p align="center">
				   <img src="<?= CONFIG['base_url'] ?>/resources/images/Head_1642231037_2022-01-15.png" style="width:65%;height:auto;border-radius: 50%;
border: 5px solid #fff;
box-shadow: 0 3px 3px rgba(0, 0, 0, .1);">
			    </p>
				<strong style="color: #772b91;text-decoration: underline;">
					মোহাম্মদ আমিনুল ইসলাম খান				</strong><br>

				<p><span style="color: #0000ff;">জেলা প্রশাসক , চুয়াডাঙ্গা ।</span></p>

		<p align="right"><br><a href="<?= CONFIG['base_url'] ?>/homes/getHeadteacherMessage" class="btn btn-sm btn-secondary">আরও পড়ুন</a></p>

			</div>
		</div>
	</div>
</div>



<style>
.image_index {
	width: 100%;
	height: 250px;
	border-radius: 3%;
}
.header_notice {
    background-image: url('<?= CONFIG['base_url'] ?>/200322/core_media/website/assets/img/emergency/bg_notice_board.png');
    background-repeat: no-repeat;
    padding: 0px 0 20px 85px;
    margin-bottom: 10px;


}
</style>


<section id="contact" class="contact" style="padding-top:35px;padding-bottom:0px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 d-flex align-items-stretch aos-init" data-aos="fade-up">
				<div class="info-box">
					<h3>বিজ্ঞপ্তি</h3>
					<ul class="list-group list-group-flush" style="font-size: 15px;">

						<?php
							foreach($notices as $notice) {
						?>
						<li class="list-group-item d-flex justify-content-between align-items-center" style="padding-left: 0px;">
							<span class="fa fa-angle-double-right"></span>&nbsp;&nbsp;
							<a style="color: #000000;" target="_blank" href="<?= CONFIG['base_url'] ?>/notices/<?= $notice['notice_unique_id'] ?>">
								<!-- 2022 -->
								<?= $notice['notice_title'] ?>							
							</a>
							<span class="badge badge-primary badge-pill"><?= date('d M y', strtotime($notice['notice_date'])) ?></span>
						</li>
						<?php
							}
						?>

					</ul>

					<p align="right"><br><a href="<?= CONFIG['base_url'] ?>/notices" class="btn btn-sm btn-secondary"> আরও পড়ুন</a></p>
				</div>
			</div>
     			<div class="col-lg-4 d-flex align-items-stretch aos-init" data-aos="fade-up">
				<div class="info-box" style="text-align: center;">
					<h3>
						প্রধান শিক্ষক					</h3>
					<p align="center"><img class=" image_index" src="<?= CONFIG['base_url'] ?>/resources/images/president_1644300876_2022-02-08.jpg"></p>
					<strong>
						মো: বিলাল হোসেন					</strong><br>
					<p>
						</p><p>আব্দুল ওদুদ শাহ ডিগ্রী কলেজ, দামুড়হুদা<br>চুয়াডাঙ্গা।</p>
					<p></p>
					<p align="right"><br><a href="<?= CONFIG['base_url'] ?>/homes/getPresidentMessage" class="btn btn-sm btn-secondary">আরও পড়ুন</a></p>
				</div>
			</div>
			      			 <div class="col-lg-4 d-flex align-items-stretch aos-init" data-aos="fade-up">
 				<div class="info-box" style="text-align: center;">
 					<h3>স্বাধীনতার সুবর্ণজয়ন্তী </h3>
 					<p align="center"><img class="image_index" src="<?= CONFIG['base_url'] ?>/resources/images/Extra_1647834953_2022-03-21.png"></p>
 					<strong>স্বাধীনতার সুবর্ণজয়ন্তী </strong><br>
 					<p></p><p><span style="font-size: 25px;"><strong>আব্দুল ওদুদ শাহ ডিগ্রী কলেজ, দামুড়হুদা, চুয়াডাঙ্গা ।</strong></span></p><p></p>
 					<p align="right"><br><a href="<?= CONFIG['base_url'] ?>/homes/getExtraMessage" class="btn btn-sm btn-secondary">আরও পড়ুন</a></p>
 				</div>
 			</div>
  	 		</div>
	</div>
</section>


<section id="contact" class="contact" style="padding-top:15px;padding-bottom:0px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 d-flex align-items-stretch aos-init" data-aos="fade-up">
				<div class="info-box">
									<h3>শিক্ষার্থীদের ওভারভিউ</h3>
					<div class="row no-gutters">
						<div class="col-lg-6 col-md-6 content-item aos-init" data-aos="fade-up" style="border: 1px solid #f9f9f9;padding: 10px;">
							<p style="background-color: #008000;
								border-radius: 50px;
								color: #FFFFFF;
								font-size: 20px;" align="center">
								২৩২২							</p>
							<p align="center">মোট শিক্ষার্থীর</p>
						</div>

						<div class="col-lg-6 col-md-6 content-item aos-init" data-aos="fade-up" style="border: 1px solid #f9f9f9;padding: 10px;">
							<p style="background-color: #004d00;
								border-radius: 50px;
								color: #FFFFFF;
								font-size: 20px;" align="center">
								০							</p>
							<p align="center">উপস্থিত শিক্ষার্থীর</p>
						</div>

						<div class="col-lg-6 col-md-6 content-item aos-init" data-aos="fade-up" style="border: 1px solid #f9f9f9;padding: 10px;">
							<p style="background-color: #ff4d4d;
								border-radius: 50px;
								color: #FFFFFF;
								font-size: 20px;" align="center">
								২৩২২							</p>
							<p align="center">অনুপস্থিত শিক্ষার্থীর</p>
						</div>

						<div class="col-lg-6 col-md-6 content-item aos-init" data-aos="fade-up" style="border: 1px solid #f9f9f9;padding: 10px;">
							<p style="background-color: #e6b800;
								border-radius: 50px;
								color: #FFFFFF;
								font-size: 20px;" align="center">
								০							</p>
							<p align="center">ছুটি শিক্ষার্থীর</p>
						</div>
					</div>
			  	
										<h3>শিক্ষক/শিক্ষিকাদের ওভারভিউ</h3>
					<div class="row no-gutters">
						<div class="col-lg-6 col-md-6 content-item aos-init" data-aos="fade-up" style="border: 1px solid #f9f9f9;padding: 10px;">
							<p style="background-color: #008000;
								border-radius: 50px;
								color: #FFFFFF;
								font-size: 20px;" align="center">
								৫২							</p>
							<p align="center">মোট শিক্ষক</p>
						</div>

						<div class="col-lg-6 col-md-6 content-item aos-init" data-aos="fade-up" style="border: 1px solid #f9f9f9;padding: 10px;">
							<p style="background-color: #004d00;
								border-radius: 50px;
								color: #FFFFFF;
								font-size: 20px;" align="center">
								০							</p>
							<p align="center">উপস্থিত শিক্ষক</p>
						</div>

						<div class="col-lg-6 col-md-6 content-item aos-init" data-aos="fade-up" style="border: 1px solid #f9f9f9;padding: 10px;">
							<p style="background-color: #ff4d4d;
								border-radius: 50px;
								color: #FFFFFF;
								font-size: 20px;" align="center">
								৫২							</p>
							<p align="center">অনুপস্থিত শিক্ষক</p>
						</div>

						<div class="col-lg-6 col-md-6 content-item aos-init" data-aos="fade-up" style="border: 1px solid #f9f9f9;padding: 10px;">
							<p style="background-color: #e6b800;
								border-radius: 50px;
								color: #FFFFFF;
								font-size: 20px;" align="center">
								০							</p>
							<p align="center">ছুটি শিক্ষক</p>
						</div>
					</div>
									</div>
			</div>

     			<div class="col-lg-4 col-md-5 d-flex align-items-stretch aos-init" data-aos="fade-up">
				<div class="info-box">
					<h3>
          স্কুলের সকল ফি বাড়িতে বসেই যে কোনো মাধ্যম দিয়ে পেমেন্ট করতে পারবেন সহজেই					</h3>
					<p align="center"><img class="image_index" src="<?= CONFIG['base_url'] ?>/resources/images/Welcome_messages_1647835853_2022-03-21.jpg"></p>
					<p>
						</p><p>স্কুলের সকল ফি বাড়িতে বসেই যে কোনো মাধ্যম দিয়ে পেমেন্ট করতে পারবেন সহজেই</p>					<p></p>
					<p align="right"><br><a href="<?= CONFIG['base_url'] ?>/homes/getWelcomeMessage" class="btn btn-sm btn-secondary"> আরও পড়ুন</a></p>
				</div>
			</div>
		
			<div class="col-lg-4 col-md-4 aos-init" data-aos="fade-up">
				<div class="row">
					<div class="col-lg-12 col-md-12 aos-init" data-aos="fade-up">
						<div class="boxn">
							<h5 class="boxt" style="background: #772B91 !important;">গুরুত্বপূর্ণ লিঙ্ক</h5>
             				<ul>
								<li><a target="_blank" href="https://www.jessoreboard.gov.bd/">মাধ্যমিক ও উচ্চ মাধ্যমিক শিক্ষা বোর্ড, যশোর</a></li>
								<li><a target="_blank" href="http://www.chuadanga.gov.bd/">জেলা প্রশাসক , চুয়াডাঙ্গা ।</a></li>
								<li><a target="_blank" href="http://www.moedu.gov.bd/">শিক্ষা মন্ত্রণালয় </a></li>
								<li><a target="_blank" href="http://www.educationboardresults.gov.bd/">এইসএসসি/এসএসসি/জেএসসি রেজাল্ট</a></li>
								<li><a target="_blank" href="http://www.muktopaath.gov.bd/">মুক্তপাঠ</a></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- <div class="boxn">
					<h5 class="boxt" style="background: #772B91 !important;" >Services</h5>
					<ul>
						<li><a href="#">EGP</a></li>
						<li><a href="#">Online App</a></li>
						<li><a href="#">CIRT</a></li>
						<li><a href="#">Ebook</a></li>
						<li><a href="#">Forum</a></li>
						<li><a href="#">Digital</a></li>
						<li><a href="#">Newspaper</a></li>
						<li><a href="#">CTO</a></li>
					</ul>
				</div> -->
			</div>

		</div>
	</div>
</section>



<section id="contact" class="contact" style="padding-top:15px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 aos-init" data-aos="fade-up">
				<div class="row">

						<div class="col-md-6" style="display: grid;">
							<div class="boxm">
								<h5>
									স্বাধীনতার সুবর্ণজয়ন্তী								
								</h5>
								<div class="row">
									<div class="col-md-4">
										<p align="center">
											<img height="100" width="100" src="<?= CONFIG['base_url'] ?>/resources/images/icon_1647836554_2022-03-21.png">
										</p>
									</div>
									<div class="col-md-8">
										<ul>														
											<li>																		
												<a href="<?= CONFIG['base_url'] ?>/homes/content/cVZwVlZidjJkRmN0bHNwOU9iWEJyQT09">
													লোগোর মুল ডিজাইন ও লোগো ব্যবহার সংক্রান্ত নির্দেশিকা
												</a>
											</li>
											<li>
												<a href="<?= CONFIG['base_url'] ?>/homes/content/R21zcGtacUhrM1lITWJLL1RhZ2Jidz09">
													“৫০টি জাতীয় পতাকা সম্বলিত সুবর্ণজয়ন্তী র‌্যালি” শীর্ষক কর্মসূচীর অনুমোদিত ডিজাইন
												</a>
											</li>
											<li>
												<a target="_blank" href="http://www.molwa.gov.bd/site/page/a125e4bc-b6dd-4810-b34f-d464dbb84d61/%E0%A6%B8%E0%A7%8D%E0%A6%AC%E0%A6%BE%E0%A6%A7%E0%A7%80%E0%A6%A8%E0%A6%A4%E0%A6%BE%E0%A6%B0-%E0%A6%B8%E0%A7%81%E0%A6%AC%E0%A6%B0%E0%A7%8D%E0%A6%A3%E0%A6%9C%E0%A7%9F%E0%A6%A8%E0%A7%8D%E0%A6%A4%E0%A7%80-%E0%A6%AC%E0%A6%BF%E0%A6%AD%E0%A6%BF%E0%A6%A8%E0%A7%8D%E0%A6%A8-%E0%A6%AA%E0%A6%A4%E0%A7%8D%E0%A6%B0">
													স্বাধীনতার সুবর্ণজয়ন্তী বিভিন্ন পত্র															
												</a>	
											</li>
																						
										</ul>
									</div>
								</div>
							</div>
						</div>

					
				</div>
			</div>

			<div class="col-lg-4 col-md-4 aos-init" data-aos="fade-up">
				<!-- <div class="row">
					<div class="col-lg-12 col-md-12" data-aos="fade-up">
						<div class="boxn">
							<h5 class="boxt" style="background: #772B91 !important;" >Nation</h5>
							<ul>
								<li><a href="#">Forum</a></li>
								<li><a href="#">Digital</a></li>
								<li><a href="#">Newspaper</a></li>
								<li><a href="#">CTO</a></li>
							</ul>
						</div>
					</div>
				</div> -->

				<div class="boxn">
					<h5 class="boxt" style="background: #772B91 !important;"> জরুরী হটলাইন</h5>
					<div class="text-center">
			     <img class="img-fluid" src="<?= CONFIG['base_url'] ?>/resources/images/hotline.png">
			  	</div>
				</div>
			</div>

		</div>

	</div>
</section>




<!-- Video Gallery -->
<section class="courses section" id="news" style="background: #f5f5f5;">
	<div class="container">

		<style>
		.img-item{
			height: 210px;
     width: 300px;
		}
		</style>

		<div class="row">


			<div class="col-md-12">
				<p class="vde">	ছবি গ্যালারী</p>

				<div class="row">


					

					<div class="item design col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3 col-6" style="display:grid;">
						<a href="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234921_2022-01-15.jpg" class="item-wrap fancybox" data-fancybox="gallery2" data-caption="">
							<span class="icon-search2"></span>
							<img class="img-item img-fluid img-thumbnail" src="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234921_2022-01-15.jpg" alt="">
						</a>
					</div>

					

					<div class="item design col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3 col-6" style="display:grid;">
						<a href="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234893_2022-01-15.jpg" class="item-wrap fancybox" data-fancybox="gallery2" data-caption="">
							<span class="icon-search2"></span>
							<img class="img-item img-fluid img-thumbnail" src="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234893_2022-01-15.jpg" alt="">
						</a>
					</div>

					

					<div class="item design col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3 col-6" style="display:grid;">
						<a href="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234877_2022-01-15.jpg" class="item-wrap fancybox" data-fancybox="gallery2" data-caption="">
							<span class="icon-search2"></span>
							<img class="img-item img-fluid img-thumbnail" src="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234877_2022-01-15.jpg" alt="">
						</a>
					</div>

					

					<div class="item design col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3 col-6" style="display:grid;">
						<a href="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234866_2022-01-15.jpg" class="item-wrap fancybox" data-fancybox="gallery2" data-caption="">
							<span class="icon-search2"></span>
							<img class="img-item img-fluid img-thumbnail" src="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234866_2022-01-15.jpg" alt="">
						</a>
					</div>

					

					<div class="item design col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3 col-6" style="display:grid;">
						<a href="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234859_2022-01-15.jpg" class="item-wrap fancybox" data-fancybox="gallery2" data-caption="">
							<span class="icon-search2"></span>
							<img class="img-item img-fluid img-thumbnail" src="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234859_2022-01-15.jpg" alt="">
						</a>
					</div>

					

					<div class="item design col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3 col-6" style="display:grid;">
						<a href="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234850_2022-01-15.jpg" class="item-wrap fancybox" data-fancybox="gallery2" data-caption="">
							<span class="icon-search2"></span>
							<img class="img-item img-fluid img-thumbnail" src="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234850_2022-01-15.jpg" alt="">
						</a>
					</div>

					

					<div class="item design col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3 col-6" style="display:grid;">
						<a href="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234908_2022-01-15.jpg" class="item-wrap fancybox" data-fancybox="gallery2" data-caption="">
							<span class="icon-search2"></span>
							<img class="img-item img-fluid img-thumbnail" src="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234908_2022-01-15.jpg" alt="">
						</a>
					</div>

					

					<div class="item design col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3 col-6" style="display:grid;">
						<a href="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234834_2022-01-15.jpg" class="item-wrap fancybox" data-fancybox="gallery2" data-caption="">
							<span class="icon-search2"></span>
							<img class="img-item img-fluid img-thumbnail" src="<?= CONFIG['base_url'] ?>/resources/images/MC_1642234834_2022-01-15.jpg" alt="">
						</a>
					</div>

					
				</div>

				<p align="right"><br><a href="<?= CONFIG['base_url'] ?>/homes/getPhotoGallery" class="btn btn-md btn-secondary"> আরও দেখুন</a></p>

			</div>


		</div>





	</div>
</section>
<!--/ Video Gallery -->



<style>
	.leftbox{    background: red;
		padding: 10px;
		font-size: 15px;
		color: #fff;}
	.leftboxp{ font-size: 16px;color: #777;padding: 15px;   background: #f7f7f7;border: 1px solid #cccccc82;}
	.vde{font-size: 18px;
		color: #666;
		font-weight: 700;
		margin: 0px 0px 12px;

		padding-bottom: 5px;}

	.boxm i{    font-size: 75px;
		color: #88288f;}
	.boxm h5{
		font-size: 16px;
		font-weight: 700;    padding-bottom: 10px;
	}
	.boxm{border-radius: 3px;
		border: 1px solid #f5f5f5;
		padding: 10px;
		background: #f9f9f9;margin-bottom:20px;}
	.boxm a{font-size: 14px;
		color: #444;}
	.boxm ul{
		padding-left: 25px;
	}
	/* .boxm ul li{} */
	.boxt{    background: #88288f;
		padding: 10px;
		margin-left: -9px;
		margin-right: -9px;
		margin-top: -9px;
		color: #fff;}
	.boxn{border-radius: 3px;
		border: 1px solid #f5f5f5;
		padding: 10px;
		background: #f9f9f9;margin-bottom:20px;}

	.boxn ul{list-style:square;}
	.boxn a {color:#444;}

	a:link {
		text-decoration: none;
	}

	a:visited {
		text-decoration: none;
	}

	a:hover {
		text-decoration: underline;
	}

	a:active {
		text-decoration: underline;
	}

</style>



