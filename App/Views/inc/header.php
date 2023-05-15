<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?php if (!empty($pageTabTitle)) echo $pageTabTitle . ' || '; echo $siteOptions['institute_title']; ?></title>
	<meta content="<?= !empty(CONFIG['page']['description']) ? CONFIG['page']['description'] : '' ?>" name="descriptison">
	<meta content="<?= !empty(CONFIG['page']['keywords']) ? CONFIG['page']['keywords'] : '' ?>" name="keywords">
	<!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
	<!-- Favicons -->
	<link href="<?= !empty(CONFIG['page']['favicon']) ? CONFIG['page']['favicon'] : '' ?>" rel="icon">
	<link href="<?= !empty(CONFIG['page']['favicon']) ? CONFIG['page']['favicon'] : '' ?>" rel="apple-touch-icon">
	<!-- Google Fonts -->
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/css" rel="stylesheet">
	<!-- Vendor CSS Files -->
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/bootstrap.min.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/icofont.min.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/boxicons.min.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/animate.min.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/venobox.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/aos.css" rel="stylesheet">
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/jquery.fancybox.min.css" rel="stylesheet">
	<!-- Main CSS File -->
	<link href="<?= CONFIG['base_url'] ?>/resources/styles/style.css" rel="stylesheet">
	
	
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
	

	<!-- JS App Config -->
	<script src="<?= CONFIG['base_url'] ?>/resources/scripts/config.js" type="text/javascript"></script>


	<script src="<?= CONFIG['base_url'] ?>/resources/scripts/custom-functions.js"></script>
	<noscript><center style="color:red; font-size:30px">Javascript must be enabled in this browser in order to use this application</center><meta HTTP-EQUIV="refresh" content=0;url="<?= CONFIG['base_url'] ?>/error/noscript"></noscript>
</head>

<body>
	
<script type="text/javascript">
let navCss = document.createElement('link');navCss.type = 'text/css';navCss.rel = 'stylesheet';navCss.href = '<?= CONFIG['base_url'] ?>/resources/styles/nav-styles.css';document.head.appendChild(navCss);
</script>



<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-none d-lg-block" style="background:#772B91;color:#fff;padding: 8px 0px;">
	<div class="container clearfix">
		<div class="contact-info float-left">
			<a href="javascript:void(0);" style="color: #fff;">
				<?php
					echo date('d M, Y');
				?>
			</a>
		</div>
		<div class="float-right btnd">
			<a href="javascript:void(0);" style="background:none;"><?= $siteOptions['institute_address'] ?></a>&nbsp;|&nbsp;
			
			<a href="javascript:void(0);" style="background:none;"><?= !empty($siteOptions['institute_hotline']) ? $siteOptions['institute_hotline'] : $siteOptions['institute_contact_mobile'] ?></a>&nbsp;

			&nbsp;&nbsp;|&nbsp;&nbsp;EIIN <?= $siteOptions['institute_eiin'] ?>	&nbsp;&nbsp;

			<a href="<?= CONFIG['base_url'] ?>/login/teacher" style="background: #b30000;color: #fff;padding: 3px 10px;border: 1px white solid;">Login</a>
		
			<a href="<?= CONFIG['base_url'] ?>/login/student" style="background: green;color: #fff;padding: 3px 10px;border: 1px white solid;">Student Login</a>
			
		</div>
	</div>
</section>


<!-- ======= Top Bar ======= -->
	<section style="background: #f5f5f5;padding: 20px 0px;" class=" d-none d-lg-block">
		<div class="container clearfix">
			<div class="contact-info float-left">
				<a href="<?= CONFIG['base_url'] ?>/homes">
					<span>
						<img src="<?= CONFIG['page']['favicon'] ?>" style="height: 65px;margin-top: -8px">
					</span>
				</a>
				<span style="font-size:25px;">
					<strong>
					<?= $siteOptions['institute_title'] ?>		
					</strong>
				</span>
			</div>
			<form action="<?= CONFIG['base_url'] ?>/contents/getStudentsByID" method="post" enctype="multipart/form-data" style="font-size: 13px;">
			<div class="contact-info float-right">
				<div class="input-group md-form form-sm form-2 pl-0">
					<input class="form-control my-0 py-1 lime-border" type="text" name="id" placeholder="শিক্ষার্থী আইডি" aria-label="Search">

					<div class="float-right">
						<input type="submit" name="submit" value="অনুসন্ধান করুন" class="btn btn-success" style="height: 35px;background: #772B91; color: #fff;text-transform: uppercase !important;">
						<br>   <br>
					</div>
				</div>
			</div>
		</form>
		</div>
	</section>

<!-- ======= Header ======= -->
<div id="header-sticky-wrapper" class="sticky-wrapper" style="height: 70px;">

<header id="header" class="" style="width: 1349px;">
	<div class="container">
		<div class="contact-info float-left d-block d-sm-none">
		<a href="<?= CONFIG['base_url'] ?>/">
			<span>
				<img src="<?= CONFIG['page']['favicon'] ?>" style="height: 65px;margin-top: -8px">
			</span>
		</a>
		</div>
		<nav class="nav-menu d-none d-lg-block">
			


<ul class="float-left">
	<li class="">
		<a class="yellow" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>">
			<i class="fa fa-home" aria-hidden="true"></i>&nbsp; প্রথম পাতা
		</a>
	</li>

	<li class="">
		<a class="scarlet" style="text-transform: uppercase !important;" href="javascript:void(0);">
			রুটিন 
		</a>
	</li>

	<li class="drop-down">
		<a class="orange" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/result">
			ফলাফল	   	
		</a>
	</li>
	
	<li class="drop-down">
		<a class="red" style="text-transform: uppercase !important;" href="javascript:void(0);">
			অ্যাকাউন্ট	   	
		</a>
		
	</li>
					
	<li class="drop-down">
	
		<a class="violet" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/admission">
			ভর্তি	   	
		</a>
		<!-- সাব মেন্যু -->
		<!-- 			 				
		<ul>
									
			<li>
				<a class="violet" href="<?= CONFIG['base_url'] ?>/online_admissions/institute_instruction">
					ইনস্টিটিউট থেকে নির্দেশনা					
				</a>
			</li>

        	<li>
				<a class="violet" href="<?= CONFIG['base_url'] ?>/online_admissions/index">
					আবেদন করুন					
				</a>
			</li>

        	<li>
				<a class="violet" href="<?= CONFIG['base_url'] ?>/online_admissions/makePayment">
					পেমেন্ট					
				</a>
			</li>

        	<li>
				<a class="violet" href="<?= CONFIG['base_url'] ?>/online_admissions/getAdmitCard">
					প্রবেশপত্র					
				</a>
			</li>

        </ul> -->
					
	</li>

	<li class="">
		<a class="purple" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/payment">
			ফি পেমেন্ট	   	
		</a>
		 		
	</li>

    <li class="drop-down">
		
		<a class="yellow" style="text-transform: uppercase !important;" href="javascript:void(0);">
			লগইন 
		</a>

		<ul>
								
			<li>
				<a class="violet" href="<?= CONFIG['base_url'] ?>/login/student">
					ছাত্র 				
				</a>
			</li>
	
			<li>
				<a class="violet" href="<?= CONFIG['base_url'] ?>/login/teacher">
					শিক্ষক				
				</a>
			</li>
	
			<li>
				<a class="violet" href="<?= CONFIG['base_url'] ?>/login/admin">
					এডমিন	 			
				</a>
			</li>

		</ul>
		
	</li>
    
						
	<li class="drop-down">
		<a class="burgundy" style="text-transform: uppercase !important;" href="javascript:void(0);">
			আমাদের সম্পর্কে	   	
		</a>
			 				
		<ul>					
			<li>
				<a class="burgundy" href="<?= CONFIG['base_url'] ?>/homes/getAboutInfo">
					আমাদের সম্পর্কে					
				</a>
			</li>

        	<li>
				<a class="burgundy" href="<?= CONFIG['base_url'] ?>/homes/getHistoryInfo">
					ইতিহাস					
				</a>
			</li>

        	<li>
				<a class="burgundy" href="<?= CONFIG['base_url'] ?>/homes/getRulesAndRegulation">
					বিধি ও প্রবিধান					
				</a>
			</li>

        </ul>
	</li>
	
</ul>
 
<ul class="float-right d-none d-lg-block">
 	
	<li class="">
		<a target="_blank" href="<?= CONFIG['base_url'] ?>/admission" style="background: #772B91; color: #fff;text-transform: uppercase !important;">
			আবেদন করুন
		</a>
	</li>
 
</ul>
</nav>

</div>

</header>
</div>


<!-- Mobile sidebar Navigation -->

<button type="button" class="mobile-nav-toggle d-lg-none"></button>

<nav class="mobile-nav d-lg-none">
	<ul class="float-left">
		<li class=""><a class="yellow" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/"><i class="icofont-home"></i>&nbsp;প্রথম পাতা</a></li>
	
		<li class="drop-down">
			<a class="scarlet" style="text-transform: uppercase !important;" href="javascript:void(0);">
				একাডেমিক	   	
			</a>
				 				
			<ul>
										
				<li>						
					<a class="scarlet" href="<?= CONFIG['base_url'] ?>/homes/getMcMemberInfo">	
						পরিচালনা কমিটি					
					</a>			 	
				</li>
	
	        	<li>
					<a class="scarlet" href="<?= CONFIG['base_url'] ?>/homes/getTeacherInfo/t">
						শিক্ষক/শিক্ষিকাদের তথ্য					
					</a>
				</li>
	
	        	<li>
					<a class="scarlet" href="<?= CONFIG['base_url'] ?>/homes/getTeacherInfo/s">
						প্রশাসনিক কর্মকর্তা/কর্মচারী					
					</a>
				</li>
	
	        	<li>
					<a class="scarlet" href="<?= CONFIG['base_url'] ?>/contents/getStudentInformation">
						সকল শিক্ষার্থীদের তথ্য					
					</a>
				</li>
	
	        	<li>
					<a class="scarlet" href="<?= CONFIG['base_url'] ?>/contents/getAllHeadTeacherInfo">
						সকল প্রধানশিক্ষক					
					</a>
				</li>
	
	        	<li>
					<a class="scarlet" href="<?= CONFIG['base_url'] ?>/contents/getAllSuccessStudentsInfo">
						সকল সফল শিক্ষার্থীর তথ্য					
					</a>
				</li>
	
	        </ul>
		</li>
		
		<li class="drop-down">
			<a class="orange" style="text-transform: uppercase !important;" href="javascript:void(0);">
				বিজ্ঞপ্তি	   	
			</a>
				 		
			<ul>
										
				<li>		
					<a class="orange" href="<?= CONFIG['base_url'] ?>/homes/getAllNoticeInfo">
						বিজ্ঞপ্তি					
					</a>
				</li>
	
	
				<li>	
					<a class="orange" href="<?= CONFIG['base_url'] ?>/contents/getAcademicHoliday">
						একাডেমিক ছুটির দিন					
					</a>	
				</li>
			
			</ul>
						
		</li>
						
		<li class="drop-down">
			<a class="red" style="text-transform: uppercase !important;" href="javascript:void(0);">
				ফলাফল	   	
			</a>
			
			<ul>
				<li>
					<a class="red" href="<?= CONFIG['base_url'] ?>/contents/getResult">
						ফলাফল সংরক্ষণাগার					
					</a>
				</li>
	
	        	<li>
					<a class="red" href="<?= CONFIG['base_url'] ?>/homes/getAllUploadedResultInfo">
						ফলাফল ডাউনলোড					
					</a>
				</li>
	
	        </ul>
						
		</li>
						
		<li class="drop-down">
			<a class="violet" style="text-transform: uppercase !important;" href="javascript:void(0);">
				ভর্তি	   	
			</a>
				 				
			<ul>
										
				<li>
					<a class="violet" href="<?= CONFIG['base_url'] ?>/online_admissions/institute_instruction">
						ইনস্টিটিউট থেকে নির্দেশনা					
					</a>
				</li>
	
	        	<li>
					<a class="violet" href="<?= CONFIG['base_url'] ?>/online_admissions/index">
						আবেদন করুন					
					</a>
				</li>
	
	        	<li>
					<a class="violet" href="<?= CONFIG['base_url'] ?>/online_admissions/makePayment">
						পেমেন্ট					
					</a>
				</li>
	
	        	<li>
					<a class="violet" href="<?= CONFIG['base_url'] ?>/online_admissions/getAdmitCard">
						প্রবেশপত্র					
					</a>
				</li>
	
	        </ul>
						
		</li>
						
		<li class="drop-down">
			<a class="burgundy" style="text-transform: uppercase !important;" href="javascript:void(0);">
				আমাদের সম্পর্কে	   	
			</a>
				 				
			<ul>
										
				<li>
					<a class="burgundy" href="<?= CONFIG['base_url'] ?>/homes/getAboutInfo">
						আমাদের সম্পর্কে					
					</a>
				</li>
	
	        	<li>
					<a class="burgundy" href="<?= CONFIG['base_url'] ?>/homes/getHistoryInfo">
						ইতিহাস					
					</a>
				</li>
	
	        	<li>
					<a class="burgundy" href="<?= CONFIG['base_url'] ?>/homes/getRulesAndRegulation">
						বিধি ও প্রবিধান					
					</a>
				</li>
	
	        </ul>
						
		</li>
						
		<li class="drop-down">
			<a class="purple" style="text-transform: uppercase !important;" href="javascript:void(0);">
				তথ্য	   	
			</a>
				 				
			<ul>
										
				<li>
					<a class="purple" href="<?= CONFIG['base_url'] ?>/homes/getAllDonorlist">
						দাতা তালিকা					
					</a>
				</li>
	
	
				<li>
					<a class="purple" href="<?= CONFIG['base_url'] ?>/homes/getAllFounderlist">
						প্রতিষ্ঠাতা তালিকা					
					</a>
				</li>
	
	        </ul>
						
		</li>
						
		<li class="">
			<a class="blue" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/homes/getContactInfo">
				যোগাযোগ	   	
			</a>
				 		
		</li>
						
		<li class="">
			<a class="purple" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/200322/osp">
				ফি পেমেন্ট	   	
			</a>	 		
		</li>
		    
		<li class="d-xl-none"><a target="_blank" class="scarlet" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/online_admissions/index"><i class=""></i>&nbsp;আবেদন করুন</a></li>
	
		<li class="d-xl-none"><a target="_blank" class="yellow" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/login/teacher"><i class=""></i>&nbsp;লগইন</a></li>
	
		<li class="d-xl-none"><a target="_blank" class="violet" style="text-transform: uppercase !important;" href="<?= CONFIG['base_url'] ?>/login/student"><i class=""></i>&nbsp;শিক্ষার্থীর লগইন</a></li>
	
	</ul>
	<ul class="float-right d-none d-lg-block">
		<li class=""><a target="_blank" href="<?= CONFIG['base_url'] ?>/online_admissions/index" style="background: #772B91; color: #fff;text-transform: uppercase !important;">আবেদন করুন</a></li>
	</ul>
	
</nav>

<div class="mobile-nav-overly"></div>

<script type="text/javascript">
	setTimeout(() => {
		document.getElementById('header').style.width = screen.width + 'px';
	}, 500);

</script>
<br>


