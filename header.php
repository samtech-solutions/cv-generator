<style>
  /*----------------------NAV---------------------*/
  .nav_container {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .nav_items {
    display: flex;
    align-items: center;
    gap: 2rem;
  }

  .nav_profile {
    position: relative;
    cursor: pointer;
  }

  li {
    list-style: none;
  }

  i {
    display: flex;
    flex-direction: rows;
    justify-content: space-between;
    margin-right: 5px;
  }

  .nav_profile:hover>ul {
    visibility: visible;
    opacity: 1;
  }

  p {
    text-align: left;
  }

  .nav_profile ul li a {
    padding: 0.6rem;
    color: purple !important;
    border-bottom: 1px dotted blue;
    background: #ffb;
    display: block;
    border-radius: 5px;
    width: 180px;
  }

  li ul li:nth-child(5) a,
  li ul li:nth-child(7) a {
    color: red !important;
    font-size: 18px !important;
  }

  .nav_items ul li a:hover {
    background: #fff;
    border-bottom: 2px solid black;
    margin-bottom: 2px;
    border-radius: 0;
  }

  .nav_items ul {
    position: absolute;
    top: 90%;
    right: 55px;
    display: flex;
    flex-direction: column;
    visibility: hidden;
    opacity: 0;
    animation: animateDropdown 10s 0s ease forwards;
    transform-origin: top;
  }

  .nav_items li:nth-child(2) {
    animation-delay: 200ms;
  }

  .nav_items li:nth-child(3) {
    animation-delay: 400ms;
  }

  .nav_items li:nth-child(4) {
    animation-delay: 600ms;
  }

  .nav_items li:nth-child(5) {
    animation-delay: 800ms;
  }

  .nav_items li:nth-child(6) {
    animation-delay: 1000ms;
  }

  .nav_items li:nth-child(7) {
    animation-delay: 1200ms;

  }

  /*dropdown animation*/
  @keyframes animateDropdown {
    0% {
      transform: rotateX(90deg);
    }

    100% {
      transform: rotateX(0deg);
      opacity: 1;
    }
  }

  #profile {
    display: flex;
    flex-direction: column;

  }

  .profile {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-top: 5px;
    margin-right: 20px;
    display: flex;
    flex-direction: column;
  }
  .profile1 {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      margin-top: 5px;
      margin-right: 40px;

    }

  .logo {
    margin-top: 0px;
    width: auto;
    height: 80px;
  }
  .avatar{
      font-size:20px;
      color:blue;
      margin-right: -50px;
    }
  /*-----------------Viewport less than or equal to 520px----------------*/

  @media (max-width: 520px) {
    .nav_items ul {
      position: absolute;
      top: 90%;
      right: 30px;
    }

    .nav_profile ul li a {
      padding: 0.6rem;
      color: purple !important;
      border-bottom: 1px dotted blue;
      background: #ffb;
      display: block;
      border-radius: 5px;
      width: 130px;
    }

    .nav_items ul li a:hover {
      background: #fff;
      border-bottom: 1px solid black;
      margin-bottom: 2px;
      border-radius: 0;
    }

    li ul li:nth-child(7) a,
    li ul li:nth-child(5) a {
      color: red !important;
      font-size: 12px !important;
    }

    .profile1 {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-top: 5px;
      margin-left: -150px;

    }
    .avatar{
      font-size:20px;
      color:blue;
    }
  }
</style>

<?php

if (isset($current_user_id)) {
  $time =  $_SESSION['time_in'];
  $id = $current_user_id;
  $query10 = "SELECT * FROM tbl_cv WHERE userid=$id";
  $result10 = mysqli_query($conn, $query10);
  $avatar = mysqli_fetch_assoc($result10);
}

?>

<nav>
  <div class="nav_container">
    <h3 align="center"><img src="../payment/images/cv1.png" class="logo"></h3>
    <div id="profile">

      <ul class="nav_items">
        <li class= "avatar">Welcome: <?= $avatar['firstname'] ?></li>
        <li>

        </li>

        <li class="nav_profile">
          <div id="profile">
            <h3 align="left"> <img src="../profile/images/<?= $avatar['avatar'] ?>" alt="." class="profile" /></h3>
          </div>
          <?php
          $new_trans_id = $_SESSION['newuser'];
          //echo $new_trans_id;
          $status = '';
          $type = '';

          $res4 = mysqli_query($conn, "SELECT * FROM payment WHERE id ='$new_trans_id'");

          while ($row4 = mysqli_fetch_array($res4)) {

            $status = $row4['userstatus'];
            $type = $row4['package_type'];
          }

          if ($status == "Paid") {
            $current_user_id = $_SESSION["user-id"];
            //echo $current_user_id;
            echo '<ul>
                    
                      <li><a href="../dashboard.php"><i class="far fa-user-circle" aria-hidden="true"></i>My profile</a></li> 
                      <li><a href="../index.php"><i class="fa fa-user-plus" aria-hidden="true"></i>Create User</a></li>
                      
                      <li><a href="../invoice.php">
                      <i class="fas fa-file-invoice" aria-hidden="true"></i>Invoice</a></li>
       
                      <li><a href="" data-bs-toggle="modal" data-bs-target="#exampleModalFeedback">
                                     <i class="far fa-envelope" aria-hidden="true"></i>Feedback</a></li>
                      <li><a href="../static/contact.php" data-bs-toggle="modal" data-bs-target="#exampleModalContact">
                                     <i class="fas fa-phone-alt" aria-hidden="true"></i>Contact Us</a></li>
                      <li><a href="../static/privacy.php" data-bs-toggle="modal" data-bs-target="#exampleModalData">
                                     <i class="fa fa-user-shield" aria-hidden="true"></i>Data Protection</a></li>
                      <li><a href="../static/help.php" data-bs-toggle="modal" data-bs-target="#exampleModalHelp">
                                     <i class="far fa-question-circle" aria-hidden="true"></i>Get Help</a></li>
                      <li><a href="../user_logout_time.php" ><i class="fa fa-sign-out-alt" aria-hidden="true"></i>Logout</a></li>
                    </ul>
                </li>';
          } else {
            echo '<li class="nav_profile">
                  <div id="profile">
                  
                    <h3 align="center"> <img src="../images/profile1.png" alt="P" class="profile1" /></h3>
                  
                  </div>

                  <ul>
                      <li><a href="../static/privacy.php"  data-bs-toggle="modal" data-bs-target="#exampleModalData">
                                     <i class="fa fa-user-shield" aria-hidden="true"></i>Data Protection</a></li>
                      
                     <li><a href="../invoice.php">
                                     <i class="fas fa-file-invoice" aria-hidden="true"></i>Invoice</a></li>
                      
                     <li><a href="" data-bs-toggle="modal" data-bs-target="#exampleModalFeedback">
                                     <i class="far fa-envelope" aria-hidden="true"></i>Feedback</a></li>
                      <li><a href="../static/contact.php" data-bs-toggle="modal" data-bs-target="#exampleModalContact">
                                     <i class="fas fa-phone-alt" aria-hidden="true"></i>Contact Us</a></li>
                      <li><a href="../static/help.php" data-bs-toggle="modal" data-bs-target="#exampleModalHelp">
                                     <i class="far fa-question-circle" aria-hidden="true"></i>Get Help</a></li>
                      <li><a href="../user_logout_time.php" style="color:red" ><i class="fa fa-sign-out-alt" aria-hidden="true"></i> Logout</a></li>
                  </ul>
              </li>';
          }

          ?>

    </div>

  </div>
</nav>

<!-- Modal for Feedback popup-->
<div class="modal fade" id="exampleModalFeedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-envelope" aria-hidden="true"></i>Send a Feedback</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../feedback.php" method="POST">

        <div class="modal-body">

          <div class="container" style="border:none">
            <?php
            $id = $current_user_id;

            $res6 = mysqli_query($conn, "SELECT * FROM tbl_cv WHERE userid='$id'");
            while ($row6 = mysqli_fetch_assoc($res6)) {

              $firstname = $row6['firstname'];
              //echo $firstname;
            }

            ?>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $firstname ?>" placeholder="Enter your name" style="width:100%" />

            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" value="" placeholder="Enter your Subject" style="width:100%" />
            <br>
            <label for="message">Message:</label><br>
            <textarea type="text" name="message" cols="18" rows="3" placeholder="Enter your opinions here" style="width:100%"></textarea>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
              <button type="submit" name="submit" id="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModal0">
                <i class="fa fa-paper-plane" aria-hidden="true"></i> Send </button>
            </div>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End  feebback modal-->

<!-- Modal for Data protection popup-->
<div class="modal fade" id="exampleModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-user-shield" aria-hidden="true"></i>Data Protection</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">

        <div class="modal-body" style="text-align:left">

          <h1>Privacy policy</h1>
          <p>We respect your privacy and are committed to protecting it through our compliance with this privacy policy (&#8220;Policy&#8221;). This Policy describes the types of information we may collect from you or that you may provide (&#8220;Personal Information&#8221;) on the <a href="https://www.isamdevelopers.com">isamdevelopers.com</a> website (&#8220;Website&#8221;), &#8220;Cv plus generator&#8221; mobile application (&#8220;Mobile Application&#8221;), and any of their related products and services (collectively, &#8220;Services&#8221;), and our practices for collecting, using, maintaining, protecting, and disclosing that Personal Information. It also describes the choices available to you regarding our use of your Personal Information and how you can access and update it.</p>
          <p>This Policy is a legally binding agreement between you (&#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221;) and this Website operator and Mobile Application developer (&#8220;Operator&#8221;, &#8220;we&#8221;, &#8220;us&#8221; or &#8220;our&#8221;). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms &#8220;User&#8221;, &#8220;you&#8221; or &#8220;your&#8221; shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Services. By accessing and using the Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Policy. This Policy does not apply to the practices of companies that we do not own or control, or to individuals that we do not employ or manage.</p>
          <div class="wpembed-toc">
            <h3>Table of contents</h3>
            <ol class="wpembed-toc">
              <li><a href="#collection-of-personal-information">Collection of personal information</a></li>
              <li><a href="#privacy-of-children">Privacy of children</a></li>
              <li><a href="#use-and-processing-of-collected-information">Use and processing of collected information</a></li>
              <li><a href="#managing-information">Managing information</a></li>
              <li><a href="#disclosure-of-information">Disclosure of information</a></li>
              <li><a href="#retention-of-information">Retention of information</a></li>
              <li><a href="#do-not-track-signals">Do Not Track signals</a></li>
              <li><a href="#email-marketing">Email marketing</a></li>
              <li><a href="#links-to-other-resources">Links to other resources</a></li>
              <li><a href="#information-security">Information security</a></li>
              <li><a href="#data-breach">Data breach</a></li>
              <li><a href="#changes-and-amendments">Changes and amendments</a></li>
              <li><a href="#acceptance-of-this-policy">Acceptance of this policy</a></li>
              <li><a href="#contacting-us">Contacting us</a></li>
            </ol>
          </div>
          <h2 id="collection-of-personal-information">Collection of personal information</h2>
          <p>You can access and use the Services without telling us who you are or revealing any information by which someone could identify you as a specific, identifiable individual. If, however, you wish to use some of the features offered on the Services, you may be asked to provide certain Personal Information (for example, your name and e-mail address).</p>
          <p>We receive and store any information you knowingly provide to us when you create an account, publish content, or fill any forms on the Services. When required, this information may include the following:</p>
          <ul>
            <li>Account details (such as user name, unique user ID, password, etc)</li>
            <li>Contact information (such as email address, phone number, etc)</li>
            <li>Basic personal information (such as name, country of residence, etc)</li>
            <li>Any other materials you willingly submit to us (such as articles, images, feedback, etc)</li>
          </ul>
          <p>You can choose not to provide us with your Personal Information, but then you may not be able to take advantage of some of the features on the Services. Users who are uncertain about what information is mandatory are welcome to contact us.</p>
          <h2 id="privacy-of-children">Privacy of children</h2>
          <p>We do not knowingly collect any Personal Information from children under the age of 18. If you are under the age of 18, please do not submit any Personal Information through the Services. If you have reason to believe that a child under the age of 18 has provided Personal Information to us through the Services, please contact us to request that we delete that child&#8217;s Personal Information from our Services.</p>
          <p>We encourage parents and legal guardians to monitor their children&#8217;s Internet usage and to help enforce this Policy by instructing their children never to provide Personal Information through the Services without their permission. We also ask that all parents and legal guardians overseeing the care of children take the necessary precautions to ensure that their children are instructed to never give out Personal Information when online without their permission.</p>
          <h2 id="use-and-processing-of-collected-information">Use and processing of collected information</h2>
          <p>We act as a data controller and a data processor when handling Personal Information, unless we have entered into a data processing agreement with you in which case you would be the data controller and we would be the data processor.</p>
          <p>Our role may also differ depending on the specific situation involving Personal Information. We act in the capacity of a data controller when we ask you to submit your Personal Information that is necessary to ensure your access and use of the Services. In such instances, we are a data controller because we determine the purposes and means of the processing of Personal Information.</p>
          <p>We act in the capacity of a data processor in situations when you submit Personal Information through the Services. We do not own, control, or make decisions about the submitted Personal Information, and such Personal Information is processed only in accordance with your instructions. In such instances, the User providing Personal Information acts as a data controller.</p>
          <p>In order to make the Services available to you, or to meet a legal obligation, we may need to collect and use certain Personal Information. If you do not provide the information that we request, we may not be able to provide you with the requested products or services. Any of the information we collect from you may be used for the following purposes:</p>
          <ul>
            <li>Create and manage user accounts</li>
            <li>Respond to inquiries and offer support</li>
            <li>Request user feedback</li>
            <li>Improve user experience</li>
            <li>Enforce terms and conditions and policies</li>
            <li>Protect from abuse and malicious users</li>
            <li>Run and operate the Services</li>
          </ul>
          <p>Processing your Personal Information depends on how you interact with the Services, where you are located in the world and if one of the following applies: (i) you have given your consent for one or more specific purposes; (ii) provision of information is necessary for the performance of an agreement with you and/or for any pre-contractual obligations thereof; (iii) processing is necessary for compliance with a legal obligation to which you are subject; (iv) processing is related to a task that is carried out in the public interest or in the exercise of official authority vested in us; (v) processing is necessary for the purposes of the legitimate interests pursued by us or by a third party. We may also combine or aggregate some of your Personal Information in order to better serve you and to improve and update our Services.</p>
          <p>Note that under some legislations we may be allowed to process information until you object to such processing by opting out, without having to rely on consent or any other of the legal bases. In any case, we will be happy to clarify the specific legal basis that applies to the processing, and in particular whether the provision of Personal Information is a statutory or contractual requirement, or a requirement necessary to enter into a contract.</p>
          <h2 id="managing-information">Managing information</h2>
          <p>You are able to delete certain Personal Information we have about you. The Personal Information you can delete may change as the Services change. When you delete Personal Information, however, we may maintain a copy of the unrevised Personal Information in our records for the duration necessary to comply with our obligations to our affiliates and partners, and for the purposes described below.</p>
          <h2 id="disclosure-of-information">Disclosure of information</h2>
          <p>To maintain the highest level of privacy and to protect your Personal Information to the full extent, we do not share your Personal Information with anyone and for any reason.</p>
          <h2 id="retention-of-information">Retention of information</h2>
          <p>We will retain and use your Personal Information for the period necessary as long as your user account remains active, to enforce our agreements, resolve disputes, and unless a longer retention period is required or permitted by law.</p>
          <p>We may use any aggregated data derived from or incorporating your Personal Information after you update or delete it, but not in a manner that would identify you personally. Once the retention period expires, Personal Information shall be deleted. Therefore, the right to access, the right to erasure, the right to rectification, and the right to data portability cannot be enforced after the expiration of the retention period.</p>
          <h2 id="do-not-track-signals">Do Not Track signals</h2>
          <p>Some browsers incorporate a Do Not Track feature that signals to websites you visit that you do not want to have your online activity tracked. Tracking is not the same as using or collecting information in connection with a website. For these purposes, tracking refers to collecting personally identifiable information from consumers who use or visit a website or online service as they move across different websites over time. How browsers communicate the Do Not Track signal is not yet uniform. As a result, the Services are not yet set up to interpret or respond to Do Not Track signals communicated by your browser. Even so, as described in more detail throughout this Policy, we limit our use and collection of your Personal Information. For a description of Do Not Track protocols for browsers and mobile devices or to learn more about the choices available to you, visit <a href="https://www.internetcookies.com" target="_blank" ref="nofollow noreferrer noopener external">internetcookies.com</a></p>
          <h2 id="email-marketing">Email marketing</h2>
          <p>We offer electronic newsletters to which you may voluntarily subscribe at any time. We are committed to keeping your e-mail address confidential and will not disclose your email address to any third parties except as allowed in the information use and processing section. We will maintain the information sent via e-mail in accordance with applicable laws and regulations.</p>
          <p>In compliance with the CAN-SPAM Act, all e-mails sent from us will clearly state who the e-mail is from and provide clear information on how to contact the sender. You may choose to stop receiving our newsletter or marketing emails by following the unsubscribe instructions included in these emails or by contacting us. However, you will continue to receive essential transactional emails.</p>
          <h2 id="links-to-other-resources">Links to other resources</h2>
          <p>The Services contain links to other resources that are not owned or controlled by us. Please be aware that we are not responsible for the privacy practices of such other resources or third parties. We encourage you to be aware when you leave the Services and to read the privacy statements of each and every resource that may collect Personal Information.</p>
          <h2 id="information-security">Information security</h2>
          <p>We secure information you provide on computer servers in a controlled, secure environment, protected from unauthorized access, use, or disclosure. We maintain reasonable administrative, technical, and physical safeguards in an effort to protect against unauthorized access, use, modification, and disclosure of Personal Information in our control and custody. However, no data transmission over the Internet or wireless network can be guaranteed.</p>
          <p>Therefore, while we strive to protect your Personal Information, you acknowledge that (i) there are security and privacy limitations of the Internet which are beyond our control; (ii) the security, integrity, and privacy of any and all information and data exchanged between you and the Services cannot be guaranteed; and (iii) any such information and data may be viewed or tampered with in transit by a third party, despite best efforts.</p>
          <p>As the security of Personal Information depends in part on the security of the device you use to communicate with us and the security you use to protect your credentials, please take appropriate measures to protect this information.</p>
          <h2 id="data-breach">Data breach</h2>
          <p>In the event we become aware that the security of the Services has been compromised or Users&#8217; Personal Information has been disclosed to unrelated third parties as a result of external activity, including, but not limited to, security attacks or fraud, we reserve the right to take reasonably appropriate measures, including, but not limited to, investigation and reporting, as well as notification to and cooperation with law enforcement authorities. In the event of a data breach, we will make reasonable efforts to notify affected individuals if we believe that there is a reasonable risk of harm to the User as a result of the breach or if notice is otherwise required by law. When we do, we will mail you a letter.</p>
          <h2 id="changes-and-amendments">Changes and amendments</h2>
          <p>We reserve the right to modify this Policy or its terms related to the Services at any time at our discretion. When we do, we will revise the updated date at the bottom of this page, post a notification within the Services, send you an email to notify you. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.</p>
          <p>An updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Services after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes. However, we will not, without your consent, use your Personal Information in a manner materially different than what was stated at the time your Personal Information was collected.</p>
          <h2 id="acceptance-of-this-policy">Acceptance of this policy</h2>
          <p>You acknowledge that you have read this Policy and agree to all its terms and conditions. By accessing and using the Services and submitting your information you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to access or use the Services. This privacy policy was created with the help of <a href="https://www.websitepolicies.com/privacy-policy-generator" target="_blank">WebsitePolicies</a>.</p>
          <h2 id="contacting-us">Contacting us</h2>
          <p>If you have any questions, concerns, or complaints regarding this Policy, the information we hold about you, or if you wish to exercise your rights, we encourage you to contact us using the details below:</p>
          <p><a href="https://www.isamdevblogs.000webhostapp.com">https://www.isamdevblogs.000webhostapp.com</a><br /><a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;&#105;&#115;amdev&#101;lope&#114;s&#64;&#103;ma&#105;&#108;.com">&#105;&#115;a&#109;dev&#101;lop&#101;&#114;&#115;&#64;&#103;mail.&#99;&#111;m</a></p>
          <p>We will attempt to resolve complaints and disputes and make every reasonable effort to honor your wish to exercise your rights as quickly as possible and in any event, within the timescales provided by applicable data protection laws.</p>
          <p>This document was last updated on April 22, 2023</p>
          <p>****************************************</p>
          <h4><a href="https://drive.google.com/file/d/1gpIIRlVvBVrPD-yhIi6XUzcAXGyBDp11/view?usp=share_link">DATA PROTECTION LAW</a></h4>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!-- End  Data protection modal-->


<!-- Modal for Contact popup-->
<div class="modal fade" id="exampleModalContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> <i class="fa fa-phone-alt" aria-hidden="true"></i>Contact Us</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">

        <div class="modal-body">

          <!--================================ABOUT START==============================-->
          <section class="about" style="text-align:center;margin-left:20px;">

            <h3 style="text-align:left;margin-left:20px"><i class="fa fa-map-marker" aria-hidden="true" style="color:black"></i> Location</h3>
            <p style="text-align:left">Nairobi - Meru Highway</p>
            <p style="text-align:left">Embu, Kenya</p>

            <h3 style="text-align:left;margin-left:20px"><i class="fa fa-envelope" aria-hidden="true"></i> Email</h3>
            <p style="text-align:left">isamdevelopers@gmail.com</p>

            <h3 style="text-align:left ;margin-left:20px"><i class="fa fa-phone" aria-hidden="true"></i> Phone</h3>
            <p style="text-align:left">+254706652754</p>
          </section>

          <!--================================ ABOUT SECTION END===============================-->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
          <button type="submit" name="submit" id="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModal0" style="color:white !important">
            <i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+254706652754" style="color:white !important"><b>Call Us!</b></a></button>
        </div>

      </form>
    </div>
  </div>
</div>
<!-- End  contact modal-->

<!-- Modal for help popup-->
<div class="modal fade" id="exampleModalHelp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-question-circle" aria-hidden="true"></i> Get Help</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../help.php" method="POST">

        <div class="modal-body">
          <div class="container" style="border:none">
            <?php
            $id = $current_user_id;

            $res5 = mysqli_query($conn, "SELECT * FROM tbl_cv WHERE userid='$id'");
            while ($row5 = mysqli_fetch_assoc($res5)) {

              $email = $row5['email'];
            }

            ?>

            <label for="name">Your Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter your  email adddress" style="width:100%" />

            <label for="message">Your Question?</label><br>
            <textarea type="text" name="message" cols="25" rows="3" placeholder="Type your question here!!" style="width:100%"></textarea>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
              <button type="submit" name="submit" id="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModal0">
                <i class="fa fa-paper-plane" aria-hidden="true"></i> Inquire </button>


            </div>

          </div>
        </div>

      </form>
    </div>
  </div>
</div>
<!-- End help modal-->