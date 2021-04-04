<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="icon" type="zoomImgage/png" href="<?php echo BURL.'assets/img/basic/favicon.png'; ?>" />
    <script type="text/javascript" src="<?php echo BURL.'assets/js/alert.js'; ?>"></script>
    <title>SEABREEZE HOTEL</title>

</head>

<body>

    <?php include(VIEWS.'inc/header_navbar.php'); ?>
    <?php	if(isset($msg2) && $msg2 == "You have to Reserve the Room and Can Reserve Surf") { ?>
    <button style="display:none;" id="error-state"
        onclick="customAlert.alert('You have to Reserve the Room and Can Reserve Surf  Package')">
    </button>
    <?php } if(isset($msg2) && $msg2 == "Plaese login then Reserve Surf") {?>
    <button style="display:none;" id="error-state"
        onclick="customAlert.alert('Plaese login then Reserve Surf Package')">
    </button>
    <?php } ?>
    <?php 



			switch ($id) {
				case '1':
	?>
    <div class="slidecontainer">
        <img class="zoomImgage" src="<?php echo BURL.'assets/img/surf/post9.jpg' ?>" alt="beach side city view">
        <div class="bottom-left">
            <h1>Beginner Courses</h1>
        </div>
    </div>
    <div class="subPageView">
        <div class="first">

            <p class="">Catch your first waves just in front of the hotel, surf teachers from our surf school
                Sunshinestories will take you out and get you up and standing in no time. Learning how to surf is for
                everyone and the feeling of sliding across the ocean is incredible. At Weligama beach just in front of
                Ceylon Sliders we have some of the best surf conditions in the world for a learner.</p>
            <h3> This lesson is for you if</h3>
            <ul>
                <li>You have never surfed before or you have had a lesson or two or you haven’t surfed for sometime. You
                    might be able to stand up and ride whitewater waves but you have limited skill or experience at
                    paddling out to the unbroken waves.</li>
                <li>You want to get a feel for surfing; you will learn the fundamentals of surfing – with these skills
                    and experience you will begin pushing ‘outside’ to unbroken waves.</li>
            </ul>
            <div class="package">

                <img src="<?php echo BURL.'assets/img/surf/sub1.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head"> Our lessons begin on the beach and in the easier white waves
                            where we take you through the basic theory and techniques of surfing..</p>


                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 100USD</dd>
                    </dl>
                    <?php 
                            $package_id = 1;
                    ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>

                </div>

            </div>


            <div class="reviewQuote group">
                <img src="<?php echo BURL.'assets/img/surf/prof1.jpg' ?>">
                <div class="quote-container">
                    <blockquote>
                        <p>Had my first ever surf lesson here and it was incredible! We were recommended Freedom as the
                            best surf school in Weligama by our hostel and I see why- I got a one-to-one lesson for 2000
                            LKR and my teacher was patient, encouraging and gave me feedback on how to improve each time
                            I didn't manage to stand up! ”</p>
                    </blockquote>
                    <cite><span>Olivia Williams</span><br>
                        USA
                    </cite>
                </div>

            </div>



            <div class="package">

                <img src="<?php echo BURL.'assets/img/surf/sub2.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head">Three to six people in the group but need to be booked as a with minimum 3
                            people. Unou Other guests may join this lesson.</p>
                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 50USD</dd>
                    </dl>
                    <?php 
                            $package_id = 2;
                            ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>

                </div>

            </div>
        </div>

        <div class="second">
            <?php include(VIEWS.'inc/surf-catogery.php'); ?>

        </div>

    </div>

    <?php
					break;
				case '2':
	?>
    <div class="slidecontainer">
        <img class="zoomImgage" src="<?php echo BURL.'assets/img/surf/post10.jpg' ?>" alt="beach side city view">
        <div class="bottom-left">
            <h1>Intermediate Courses</h1>
        </div>
    </div>
    <div class="subPageView">
        <div class="first">

            <p class="">Have you been surfing for some time, but feel like you struggle on the board? The developing
                lesson might be the best thing you’ve ever done. Our surf teachers will help you get over any obstacles
                you have and maximise your progression. We’ll take you to the best suitable surf spot for your level and
                requirements on the south coast and help you progress in your surfing as well as having a good time
                together.</p>
            <h3> This lesson is for you if</h3>
            <ul>
                <li>You can handle your board and paddle out the back and ride unbroken waves successfully most of the
                    time. You might be able to perform some basic moves like cutbacks or little floaters on whitewater
                    sections.</li>
                <li>You want to push your limits; you will finetune your paddle, stance and style and begin developing
                    more radical manoeuvers surfing both frontside and backside.</li>
            </ul>
            <div class="package">
                <img src="<?php echo BURL.'assets/img/surf/sub4.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head">We offer experienced professional instructors in small groups which allows for
                            fast learning and lots of fun. Our lessons begin on the beach and in the easier white waves
                            where we take you through the basic theory and techniques of surfing..</p>
                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 100USD</dd>
                    </dl>
                    <?php 
                            $package_id = 3;
                    ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>

            </div>

            <div id="kudo-wrap">
                <div class="adj-layer">
                    <!-- <h1>Kudos</h1> -->
                    <div class="reviewQuote group">
                        <img src="<?php echo BURL.'assets/img/surf/prof2.jpg' ?>">
                        <div class="quote-container">
                            <blockquote>
                                <p>Loved the stay, the location is perfect with a lovely beach in front. W15 being a
                                    simple 15min walk away is a huge plus side. Couldn’t have expected anymore. And a
                                    shout to Sameera for making our stay even more comfortable. ”</p>
                            </blockquote>
                            <cite><span>Jan Baby</span><br>
                                RMT<br>
                                TLC Medical Massage
                            </cite>
                        </div>

                    </div>
                </div>
            </div>

            <div class="package">

                <img src="<?php echo BURL.'assets/img/surf/sub3.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head">Three to six people in the group but need to be booked as a with minimum 3
                            people. Unou Other guests may join this lesson. Too book a private group lesson and
                            guarantee other students won't join the particular lesson we will charge the duo rates.
                            Price per person.</p>
                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 50USD</dd>
                    </dl>
                    <?php 
                            $package_id = 4;
                    ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>

            </div>
        </div>
        <div class="second">
            <?php include(VIEWS.'inc/surf-catogery.php'); ?>
        </div>

    </div>
    <?php
					break;
				case '3':
	?>
    <div class="slidecontainer">
        <img class="zoomImgage" src="<?php echo BURL.'assets/img/surf/post11.jpg' ?>" alt="beach side city view">
        <div class="bottom-left">
            <h1>Advanced Courses</h1>
        </div>
    </div>
    <div class="subPageView">
        <div class="first">

            <p class="">The level 3 lessons are for available for longboarders and shortboarders alike that want to take
                their surfing to the next level – we’ll match you with the best coach depending on what your expectation
                of the lesson and preference of board. Have you been surfing some time, maybe even for a few years but
                feel stuck in your progression? With the level 3 lessons, we’ll take you out and analyze your surfing to
                pinpoint what you need to do to progress into becoming a styling longboarder or frothing shortboarder.
                Our surf teachers will take help you get over any obstacles you have and maximize your progression.
                We’ll take you to the best suitable surf spot for your level and requirements on the south coast and
                help you progress in your surfing as well as having a good time together.</p>
            <h3> This lesson is for you if</h3>
            <ul>
                <li>You’re an experienced surfer and can surf a wide range of conditions with confidence without the
                    help of an in-water coach. You consistently trim, know how to generate speed or stall, perform basic
                    moves and are at least attempting more advanced ones. You can handle yourself in crowds.</li>
                <li>You want to develop your board skills; you will work on perfecting your bottom turns or your stall
                    to cross step, turning cutbacks into round houses or dropknee cutbacks, pushing top turns into airs
                    and barrels or push towards the nose – cheater five’s, hang fives and hang tens.</li>
            </ul>
            <div class="package">

                <img src="<?php echo BURL.'assets/img/surf/sub5.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head">We offer experienced professional instructors in small groups which allows for
                            fast learning and lots of fun. Our lessons begin on the beach and in the easier white waves
                            where we take you through the basic theory and techniques of surfing..</p>
                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 100USD</dd>
                    </dl>
                    <?php 
                            $package_id = 5;
                    ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>

            </div>

            <div id="kudo-wrap">
                <div class="adj-layer">
                    <!-- <h1>Kudos</h1> -->
                    <div class="reviewQuote group">
                        <img src="<?php echo BURL.'assets/img/surf/prof3.jpg' ?>">
                        <div class="quote-container">
                            <blockquote>
                                <p>My girlfriend and I stayed here in a private room for 6 nights and did surf lessons
                                    through the hostel each day. We had an awesome time at layback. The hostel is very
                                    relaxed and surf instructors were great. The location is perfect as it is tucked
                                    away but still close to everything you need. Definitely recommend. ”</p>
                            </blockquote>
                            <cite><span>Jan Baby</span><br>
                                RMT<br>
                                TLC Medical Massage
                            </cite>
                        </div>

                    </div>
                </div>
            </div>

            <div class="package">

                <img src="<?php echo BURL.'assets/img/surf/sub6.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head">Three to six people in the group but need to be booked as a with minimum 3
                            people. Unou Other guests may join this lesson. Too book a private group lesson and
                            guarantee other students won't join the particular lesson we will charge the duo rates.
                            Price per person.</p>
                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 50USD</dd>
                    </dl>
                    <?php 
                            $package_id = 6;
                    ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>

            </div>
        </div>
        <div class="second">
            <?php include(VIEWS.'inc/surf-catogery.php'); ?>
        </div>

    </div>
    <?php
					break;
				case '4':
	?>
    <div class="slidecontainer">
        <img class="zoomImgage" src="<?php echo BURL.'assets/img/surf/post12.jpg' ?>" alt="beach side city view">
        <div class="bottom-left">
            <h1>Group Lesson</h1>
        </div>
    </div>
    <div class="subPageView">
        <div class="first">

            <p class="">During our surf lessons, we’ll be 4 hours at the beach daily. Out of those 4 hours, 2 hours are
                intensive surf lessons with a lot of individual feedback. To prevent being out of energy right after the
                morning session, we’ll take a short lunch break at the beach. After that, you’ll have the chance to
                apply everything you’ve learnt during the day on your own, but always under surveillance of our team of
                course. Here’s what we offer during our surf lessons:</p>

            <h3> 7 Day Package</h3>
            <div class="package">

                <img src="<?php echo BURL.'assets/img/surf/sub7.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head">We offer experienced professional instructors in small groups which allows for
                            fast learning and lots of fun. Our lessons begin on the beach and in the easier white waves
                            where we take you through the basic theory and techniques of surfing..</p>
                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 100USD</dd>
                    </dl>
                    <?php 
                            $package_id = 7;
                    ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>

            </div>

            <div id="kudo-wrap">
                <div class="adj-layer">
                    <!-- <h1>Kudos</h1> -->
                    <div class="reviewQuote group">
                        <img src="<?php echo BURL.'assets/img/surf/prof4.jpg' ?>"">
				        <div class=" quote-container">
                        <blockquote>
                            <p>Best surf instructors ever. They knows how to manage all situations easily and the
                                teaching is really good. Not only do you get to learn surf and progress quickly with
                                amazing local coaches, but you also get to live the local life, experience the best
                                Weligama has to offer and get to know amazing people.”</p>
                        </blockquote>
                        <cite><span>Jan Baby</span><br>
                            RMT<br>
                            TLC Medical Massage
                        </cite>
                    </div>

                </div>
            </div>
        </div>

        <div class="package">

            <img src="<?php echo BURL.'assets/img/surf/sub8.jpg' ?>" alt="" class="packImg">
            <div class="packageInfo">
                <dl class="inline">
                    <p class="head">Three to six people in the group but need to be booked as a with minimum 3 people.
                        Unou Other guests may join this lesson. Too book a private group lesson and guarantee other
                        students won't join the particular lesson we will charge the duo rates. Price per person.</p>
                    <dt>TOUR INCLUDES:</dt>
                    <dd>Camp, Board, Shoes</dd>
                    <dt>DAILY TIMES:</dt>
                    <dd>Tours start 9am daily</dd>
                    <dt>SHEDULE:</dt>
                    <dd>4 hrs long tour</dd>
                    <dt>PRICES:</dt>
                    <dd>1 Lesson - 50USD</dd>
                </dl>
                <?php 
                            $package_id = 8;
                    ; ?>

                <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                        class="fa fa-chevron-right" aria-hidden="true"></i></a>
            </div>

        </div>
    </div>
    <div class="second">
        <?php include(VIEWS.'inc/surf-catogery.php'); ?>
    </div>

    </div>

    <?php
					break;
				case '5':
	?>
    <div class="slidecontainer">
        <img class="zoomImgage" src="<?php echo BURL.'assets/img/surf/post13.jpg' ?>" alt="beach side city view">
        <div class="bottom-left">
            <h1>Solo lesson</h1>
        </div>
    </div>
    <div class="subPageView">
        <div class="first">

            <p class="">Personal attention is a central concept of our teaching philosophy. Therefore our surf classes
                take place in small groups or as private surf lessons. This guarantees quick progress and safety, with
                your coach having an eye on you the whole time. We will help you to get started. You will learn how to
                get into the wave learn the take-off technique in the white water and finally the right position on your
                board.</p>

            <h3> 7 Day and 3 Day Packages</h3>
            <div class="package">

                <img src="<?php echo BURL.'assets/img/surf/sub9.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head">We offer experienced professional instructors in small groups which allows for
                            fast learning and lots of fun.</p>
                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 100USD</dd>
                    </dl>
                    <?php 
                            $package_id = 9;
                    ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>

            </div>

            <div id="kudo-wrap">
                <div class="adj-layer">
                    <!-- <h1>Kudos</h1> -->
                    <div class="reviewQuote group">
                        <img src="<?php echo BURL.'assets/img/surf/prof5.jpg' ?>">
                        <div class="quote-container">
                            <blockquote>
                                <p>We‘ve spent two nights in the 8-bed dorm of Layback Hostel and were positively
                                    surprised about how big and neat the room was. The beds are super-comfortable and
                                    there is a little terrace just above the room which I found very nice. Linda from
                                    the hostel was very helpful in every situation and always made great effort to make
                                    sure we had everything we needed. It was lovely! I would definitely book it again.”
                                </p>
                            </blockquote>
                            <cite><span>Jan Baby</span><br>
                                RMT<br>
                                TLC Medical Massage
                            </cite>
                        </div>

                    </div>
                </div>
            </div>

            <div class="package">

                <img src="<?php echo BURL.'assets/img/surf/sub10.jpg' ?>" alt="" class="packImg">
                <div class="packageInfo">
                    <dl class="inline">
                        <p class="head">Three to six people in the group but need to be booked as a with minimum 3
                            people. Unou Other guests may join this lesson. </p>
                        <dt>TOUR INCLUDES:</dt>
                        <dd>Camp, Board, Shoes</dd>
                        <dt>DAILY TIMES:</dt>
                        <dd>Tours start 9am daily</dd>
                        <dt>SHEDULE:</dt>
                        <dd>4 hrs long tour</dd>
                        <dt>PRICES:</dt>
                        <dd>1 Lesson - 50USD</dd>
                    </dl>
                    <?php 
                            $package_id = 10;
                    ; ?>

                    <a class="btn" href="<?php url('Surf/reservation/'.$package_id.'/'.$id); ?>">BOOK NOW<i
                            class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>

            </div>
        </div>
        <div class="second">
            <?php include(VIEWS.'inc/surf-catogery.php'); ?>
        </div>

    </div>
    <?php
					break;
				default:
					# code...
					break;
			}
	
	?>
    <?php include(VIEWS.'inc/footer.php'); ?>


    <script type="text/javascript">
    window.onload = function() {
        const navbar = document.querySelector(".nav");
        // console.log(navbar);
        navbar.classList.toggle("sticky");
    };
    </script>
    <script>
    if (document.getElementById('error-state')) {
        console.log("shhshdhsdh");
        document.getElementById('error-state').click();
    }
    </script>
</body>

</html>