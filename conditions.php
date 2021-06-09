<?php
session_start();
if (isset($_SESSION['username'])) { } elseif (isset($_COOKIE['GS'])) {
    require 'api/classes/logged.php';
} else {
    header('location: 404');
    exit();
}
include 'connect.php';
include 'init.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta lang="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="favico.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $css; ?>style.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>normalize.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>emojionearea.min.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>aos.css" />
    <script type="text/javascript" src="includes/layout/script/jquery-3.3.1.min.js"></script>
    <meta name="description" content="GoStalker helps you to get freinds feedback as votes and good or evil messages !">
    <!--[if It IE 9]>
      <script src="<?php echo $js; ?>html5shiv.min.js"></script>
      <script src="<?php echo $js; ?>respond.min.js"></script>
    <![endif]-->

    <title>GoStalker Terms and Conditions</title>
    <meta name="description" content="">
    <meta name="keywords" content="GoStalker vote socialnetwork poll contactus">
</head>

<body data-spy="scroll" data-target="#navbar-example" style="overflow: unset;background: #f3f3f3;">
    <?php
    if (isset($_SESSION['username'])) {include $template . 'header.php';} else {
        include $template . 'header-out.php';
        echo "<div class='contain'>";
    }
    ?>
    <div class="container-all">
        <style>
            .hide-error {margin: 7px 0;display: none}
                  .hide-error .shapeII{height:40px;}
                  .hide-error .shapeII i{font-size: 25px;padding: 8px 13px;}
              </style>
        <div id="list-example" class="list-group">
            <a class="list-group-item list-group-item-action" href="#list-item-1">About</a>
            <a class="list-group-item list-group-item-action" href="#list-item-2">Terms</a>
            <a class="list-group-item list-group-item-action" href="#list-item-3">Privacy Policy</a>
            <a class="list-group-item list-group-item-action" href="#list-item-4">Cookies Policy</a>
            <a class="list-group-item list-group-item-action" href="#list-item-5">Contact With us</a>
        </div>
        <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
            <h6 id="list-item-1">&emsp;</h6>
            <br>
            <h4>About</h4>
            <h2>Welcome to GoStalker</h2>
            <p>GoStalker is a social network with new features and alot of useful information in the profile account.</p>
            <p></p>
            <h4 id="list-item-2">Terms</h4>
            <p>These terms and conditions outline the rules and regulations for the use of GoStalker's Website.</p> <br />
            <span style="text-transform: capitalize;"> GoStalker</span> is located at:<br />
            <address> , <br /> - , <br />
            </address>
            <p>By accessing this website we assume you accept these terms and conditions in full. Do not continue to use GoStalker's website
                if you do not accept all of the terms and conditions stated on this page.</p>
            <p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice
                and any or all Agreements: “Client”, “You” and “Your” refers to you, the person accessing this website
                and accepting the Company’s terms and conditions. “The Company”, “Ourselves”, “We”, “Our” and “Us”, refers
                to our Company. “Party”, “Parties”, or “Us”, refers to both the Client and ourselves, or either the Client
                or ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake
                the process of our assistance to the Client in the most appropriate manner, whether by formal meetings
                of a fixed duration, or any other means, for the express purpose of meeting the Client’s needs in respect
                of provision of the Company’s stated services/products, in accordance with and subject to, prevailing law
                of . Any use of the above terminology or other words in the singular, plural,
                capitalisation and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>
            <h2>Cookies</h2>
            <p>We employ the use of cookies. By using GoStalker's website you consent to the use of cookies
                in accordance with GoStalker’s privacy policy.</p>
            <p>Most of the modern day interactive web sites
                use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site
                to enable the functionality of this area and ease of use for those people visiting. Some of our
                affiliate / advertising partners may also use cookies.</p>
            <h2>License</h2>
            <p>Unless otherwise stated, GoStalker and/or it’s licensors own the intellectual property rights for
                all material on GoStalker. All intellectual property rights are reserved. You may view and/or print
                pages from https://www.GoStalker.com for your own personal use subject to restrictions set in these terms and conditions.</p>
            <p>You must not:</p>
            <ol>
                <li>Republish material from https://www.GoStalker.com</li>
                <li>Sell, rent or sub-license material from https://www.GoStalker.com</li>
                <li>Reproduce, duplicate or copy material from https://www.GoStalker.com</li>
            </ol>
            <p>Redistribute content from GoStalker (unless content is specifically made for redistribution).</p>
            <h2>User Comments</h2>
            <ol>
                <li>This Agreement shall begin on the date hereof.</li>
                <li>Certain parts of this website offer the opportunity for users to post and exchange opinions, information,
                    material and data ('Comments') in areas of the website. GoStalker does not screen, edit, publish
                    or review Comments prior to their appearance on the website and Comments do not reflect the views or
                    opinions ofGoStalker, its agents or affiliates. Comments reflect the view and opinion of the
                    person who posts such view or opinion. To the extent permitted by applicable laws GoStalkershall
                    not be responsible or liable for the Comments or for any loss cost, liability, damages or expenses caused
                    and or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this
                    website.</li>
                <li>GoStalkerreserves the right to monitor all Comments and to remove any Comments which it considers
                    in its absolute discretion to be inappropriate, offensive or otherwise in breach of these Terms and Conditions.</li>
                <li>You warrant and represent that:
                    <ol>
                        <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to
                            do so;</li>
                        <li>The Comments do not infringe any intellectual property right, including without limitation copyright,
                            patent or trademark, or other proprietary right of any third party;</li>
                        <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material
                            or material which is an invasion of privacy</li>
                        <li>The Comments will not be used to solicit or promote business or custom or present commercial activities
                            or unlawful activity.</li>
                    </ol>
                </li>
                <li>You hereby grant to <strong>GoStalker</strong> a non-exclusive royalty-free license to use, reproduce,
                    edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats
                    or media.</li>
            </ol>
            <h2>Hyperlinking to our Content</h2>
            <ol>
                <li>The following organizations may link to our Web site without prior written approval:
                    <ol>
                        <li>Government agencies;</li>
                        <li>Search engines;</li>
                        <li>News organizations;</li>
                        <li>Online directory distributors when they list us in the directory may link to our Web site in the same
                            manner as they hyperlink to the Web sites of other listed businesses; and</li>
                        <li>Systemwide Accredited Businesses except soliciting non-profit organizations, charity shopping malls,
                            and charity fundraising groups which may not hyperlink to our Web site.</li>
                    </ol>
                </li>
            </ol>
            <ol start="2">
                <li>These organizations may link to our home page, to publications or to other Web site information so long
                    as the link: (a) is not in any way misleading; (b) does not falsely imply sponsorship, endorsement or
                    approval of the linking party and its products or services; and (c) fits within the context of the linking
                    party's site.
                </li>
                <li>We may consider and approve in our sole discretion other link requests from the following types of organizations:
                    <ol>
                        <li>commonly-known consumer and/or business information sources such as Chambers of Commerce, American
                            Automobile Association, AARP and Consumers Union;</li>
                        <li>dot.com community sites;</li>
                        <li>associations or other groups representing charities, including charity giving sites,</li>
                        <li>online directory distributors;</li>
                        <li>internet portals;</li>
                        <li>accounting, law and consulting firms whose primary clients are businesses; and</li>
                        <li>educational institutions and trade associations.</li>
                    </ol>
                </li>
            </ol>
            <p>We will approve link requests from these organizations if we determine that: (a) the link would not reflect
                unfavorably on us or our accredited businesses (for example, trade associations or other organizations
                representing inherently suspect types of business, such as work-at-home opportunities, shall not be allowed
                to link); (b)the organization does not have an unsatisfactory record with us; (c) the benefit to us from
                the visibility associated with the hyperlink outweighs the absence of
                <?= $companyName ?>; and (d) where the
                link is in the context of general resource information or is otherwise consistent with editorial content
                in a newsletter or similar product furthering the mission of the organization.</p>

            <p>These organizations may link to our home page, to publications or to other Web site information so long as
                the link: (a) is not in any way misleading; (b) does not falsely imply sponsorship, endorsement or approval
                of the linking party and it products or services; and (c) fits within the context of the linking party's
                site.</p>

            <p>If you are among the organizations listed in paragraph 2 above and are interested in linking to our website,
                you must notify us by sending an e-mail to <a href="mailto:GoStalkerInc@gmail.com" title="send an email to GoStalkerInc@gmail.com">GoStalkerInc@gmail.com</a>.
                Please include your name, your organization name, contact information (such as a phone number and/or e-mail
                address) as well as the URL of your site, a list of any URLs from which you intend to link to our Web site,
                and a list of the URL(s) on our site to which you would like to link. Allow 2-3 weeks for a response.</p>

            <p>Approved organizations may hyperlink to our Web site as follows:</p>

            <ol>
                <li>By use of our corporate name; or</li>
                <li>By use of the uniform resource locator (Web address) being linked to; or</li>
                <li>By use of any other description of our Web site or material being linked to that makes sense within the
                    context and format of content on the linking party's site.</li>
            </ol>
            <p>No use of GoStalker’s logo or other artwork will be allowed for linking absent a trademark license
                agreement.</p>
            <h2>Iframes</h2>
            <p>Without prior approval and express written permission, you may not create frames around our Web pages or
                use other techniques that alter in any way the visual presentation or appearance of our Web site.</p>
            <h2>Reservation of Rights</h2>
            <p>We reserve the right at any time and in its sole discretion to request that you remove all links or any particular
                link to our Web site. You agree to immediately remove all links to our Web site upon such request. We also
                reserve the right to amend these terms and conditions and its linking policy at any time. By continuing
                to link to our Web site, you agree to be bound to and abide by these linking terms and conditions.</p>
            <h2>Removal of links from our website</h2>
            <p>If you find any link on our Web site or any linked web site objectionable for any reason, you may contact
                us about this. We will consider requests to remove links but will have no obligation to do so or to respond
                directly to you.</p>
            <p>Whilst we endeavour to ensure that the information on this website is correct, we do not warrant its completeness
                or accuracy; nor do we commit to ensuring that the website remains available or that the material on the
                website is kept up to date.</p>
            <h2>Content Liability</h2>
            <p>We shall have no responsibility or liability for any content appearing on your Web site. You agree to indemnify
                and defend us against all claims arising out of or based upon your Website. No link(s) may appear on any
                page on your Web site or within any context containing content or materials that may be interpreted as
                libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or
                other violation of, any third party rights.</p>
            <h2>Disclaimer</h2>
            <p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website (including, without limitation, any warranties implied by law in respect of satisfactory quality, fitness for purpose and/or the use of reasonable care and skill). Nothing in this disclaimer will:</p>
            <ol>
                <li>limit or exclude our or your liability for death or personal injury resulting from negligence;</li>
                <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
                <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
                <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
            </ol>
            <p>The limitations and exclusions of liability set out in this Section and elsewhere in this disclaimer: (a)
                are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer or
                in relation to the subject matter of this disclaimer, including liabilities arising in contract, in tort
                (including negligence) and for breach of statutory duty.</p>
            <p>To the extent that the website and the information and services on the website are provided free of charge,
                we will not be liable for any loss or damage of any nature.</p>
            <h2>Terms</h2>
            <p></p>
            <h2>Credit & Contact Information</h2>
            <p>If you have
                any queries regarding any of our terms, please contact us.</p>
            <hr>
            <h6 id="list-item-2">&emsp;</h6>
            <br>
            <h4>Privacy Policy</h4>
            <h1>Welcome to our Privacy Policy</h1>
            <h3>Your privacy is critically important to us.</h3>
            GoStalker is located at:<br />
            <address>
                GoStalker<br /></address>

            <p>It is GoStalker’s policy to respect your privacy regarding any information we may collect while operating our website. This Privacy Policy applies to <a href="https://www.GoStalker.com">https://www.GoStalker.com</a> (hereinafter, "us", "we", or "https://www.GoStalker.com"). We respect your privacy and are committed to protecting personally identifiable information you may provide us through the Website. We have adopted this privacy policy ("Privacy Policy") to explain what information may be collected on our Website, how we use this information, and under what circumstances we may disclose the information to third parties. This Privacy Policy applies only to information we collect through the Website and does not apply to our collection of information from other sources.</p>
            <p>This Privacy Policy, together with the Terms and conditions posted on our Website, set forth the general rules and policies governing your use of our Website. Depending on your activities when visiting our Website, you may be required to agree to additional terms and conditions.</p>

            <h2>Website Visitors</h2>
            <p>Like most website operators, GoStalker collects non-personally-identifying information of the sort that web browsers and servers typically make available, such as the browser type, language preference, referring site, and the date and time of each visitor request. GoStalker’s purpose in collecting non-personally identifying information is to better understand how GoStalker’s visitors use its website. From time to time, GoStalker may release non-personally-identifying information in the aggregate, e.g., by publishing a report on trends in the usage of its website.</p>
            <p>GoStalker also collects potentially personally-identifying information like Internet Protocol (IP) addresses for logged in users and for users leaving comments on https://www.GoStalker.com blog posts. GoStalker only discloses logged in user and commenter IP addresses under the same circumstances that it uses and discloses personally-identifying information as described below.</p>

            <h2>Gathering of Personally-identifying Information</h2>
            <p>Certain visitors to GoStalker’s websites choose to interact with GoStalker in ways that require GoStalker to gather personally-identifying information. The amount and type of information that GoStalker gathers depends on the nature of the interaction. For example, we ask visitors who sign up for a blog at https://www.GoStalker.com to provide a username and email address.</p>

            <h2>Security</h2>
            <p>The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.</p>

            <h2>Advertisements</h2>
            <p>Ads appearing on our website may be delivered to users by advertising partners, who may set cookies. These cookies allow the ad server to recognize your computer each time they send you an online advertisement to compile information about you or others who use your computer. This information allows ad networks to, among other things, deliver targeted advertisements that they believe will be of most interest to you. This Privacy Policy covers the use of cookies by GoStalker and does not cover the use of cookies by any advertisers.</p>


            <h2>Links To External Sites</h2>
            <p>Our Service may contain links to external sites that are not operated by us. If you click on a third party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy and terms and conditions of every site you visit.</p>
            <p>We have no control over, and assume no responsibility for the content, privacy policies or practices of any third party sites, products or services.</p>

            <h2>GoStalker uses Google AdWords for remarketing</h2>
            <p>Https://www.GoStalker.com uses the remarketing services to advertise on third party websites (including Google) to previous visitors to our site. It could mean that we advertise to previous visitors who haven’t completed a task on our site, for example using the contact form to make an enquiry. This could be in the form of an advertisement on the Google search results page, or a site in the Google Display Network. Third-party vendors, including Google, use cookies to serve ads based on someone’s past visits. Of course, any data collected will be used in accordance with our own privacy policy and Google’s privacy policy.</p>
            <p>You can set preferences for how Google advertises to you using the Google Ad Preferences page, and if you want to you can opt out of interest-based advertising entirely by cookie settings or permanently using a browser plugin.</p>

            <h2>Protection of Certain Personally-identifying Information</h2>
            <p>GoStalker discloses potentially personally-identifying and personally-identifying information only to those of its employees, contractors and affiliated organizations that (i) need to know that information in order to process it on GoStalker’s behalf or to provide services available at GoStalker’s website, and (ii) that have agreed not to disclose it to others. Some of those employees, contractors and affiliated organizations may be located outside of your home country; by using GoStalker’s website, you consent to the transfer of such information to them. GoStalker will not rent or sell potentially personally-identifying and personally-identifying information to anyone. Other than to its employees, contractors and affiliated organizations, as described above, GoStalker discloses potentially personally-identifying and personally-identifying information only in response to a subpoena, court order or other governmental request, or when GoStalker believes in good faith that disclosure is reasonably necessary to protect the property or rights of GoStalker, third parties or the public at large.</p>
            <p>If you are a registered user of https://www.GoStalker.com and have supplied your email address, GoStalker may occasionally send you an email to tell you about new features, solicit your feedback, or just keep you up to date with what’s going on with GoStalker and our products. We primarily use our blog to communicate this type of information, so we expect to keep this type of email to a minimum. If you send us a request (for example via a support email or via one of our feedback mechanisms), we reserve the right to publish it in order to help us clarify or respond to your request or to help us support other users. GoStalker takes all measures reasonably necessary to protect against the unauthorized access, use, alteration or destruction of potentially personally-identifying and personally-identifying information.</p>

            <h2>Aggregated Statistics</h2>
            <p>GoStalker may collect statistics about the behavior of visitors to its website. GoStalker may display this information publicly or provide it to others. However, GoStalker does not disclose your personally-identifying information.</p>

            <h2>Affiliate Disclosure</h2>
            <p>This site uses affiliate links and does earn a commission from certain links. This does not affect your purchases or the price you may pay.</p>

            <h2>Cookies</h2>
            <p>To enrich and perfect your online experience, GoStalker uses "Cookies", similar technologies and services provided by others to display personalized content, appropriate advertising and store your preferences on your computer.</p>
            <p>A cookie is a string of information that a website stores on a visitor’s computer, and that the visitor’s browser provides to the website each time the visitor returns. GoStalker uses cookies to help GoStalker identify and track visitors, their usage of https://www.GoStalker.com, and their website access preferences. GoStalker visitors who do not wish to have cookies placed on their computers should set their browsers to refuse cookies before using GoStalker’s websites, with the drawback that certain features of GoStalker’s websites may not function properly without the aid of cookies.</p>
            <p>By continuing to navigate our website without changing your cookie settings, you hereby acknowledge and agree to GoStalker's use of cookies.</p>


            <h2>Business Transfers</h2>
            <p>If GoStalker, or substantially all of its assets, were acquired, or in the unlikely event that GoStalker goes out of business or enters bankruptcy, user information would be one of the assets that is transferred or acquired by a third party. You acknowledge that such transfers may occur, and that any acquirer of GoStalker may continue to use your personal information as set forth in this policy.</p>

            <h2>Privacy Policy Changes</h2>
            <p>Although most changes are likely to be minor, GoStalker may change its Privacy Policy from time to time, and in GoStalker’s sole discretion. GoStalker encourages visitors to frequently check this page for any changes to its Privacy Policy. Your continued use of this site after any change in this Privacy Policy will constitute your acceptance of such change.</p>
            <h2>Credit &amp; Contact Information</h2>
            <p>If you have any questions about this Privacy Policy, please contact us via <a href="mailto:GoStalkerInc@gmail.com">email</a> or <a href="tel:01027012337">phone</a>.</p>
            <hr>
            <h6 id="list-item-3">&emsp;</h6>
            <br>
            <h4>Cookies Policy</h4>
            <h2>Cookie Policy for GoStalker</h2>
            <p><strong>What Are Cookies</strong></p>
            <p>As is common practice with almost all professional websites this site uses cookies, which are tiny files that are downloaded to your computer, to improve your experience. This page describes what information they gather, how we use it and why we sometimes need to store these cookies. We will also share how you can prevent these cookies from being stored however this may downgrade or 'break' certain elements of the sites functionality.</p>

            <p>For more general information on cookies see the Wikipedia article on HTTP Cookies.</p>

            <p><strong>How We Use Cookies</strong></p>

            <p>We use cookies for a variety of reasons detailed below. Unfortunately in most cases there are no industry standard options for disabling cookies without completely disabling the functionality and features they add to this site. It is recommended that you leave on all cookies if you are not sure whether you need them or not in case they are used to provide a service that you use.</p>

            <p><strong>Disabling Cookies</strong></p>

            <p>You can prevent the setting of cookies by adjusting the settings on your browser (see your browser Help for how to do this). Be aware that disabling cookies will affect the functionality of this and many other websites that you visit. Disabling cookies will usually result in also disabling certain functionality and features of the this site. Therefore it is recommended that you do not disable cookies.</p>

            <p><strong>The Cookies We Set</strong></p>

            <p>If you create an account with us then we will use cookies for the management of the signup process and general administration. These cookies will usually be deleted when you log out however in some cases they may remain afterwards to remember your site preferences when logged out.</p>

            <p>We use cookies when you are logged in so that we can remember this fact. This prevents you from having to log in every single time you visit a new page. These cookies are typically removed or cleared when you log out to ensure that you can only access restricted features and areas when logged in.</p>

            <p>This site offers newsletter or email subscription services and cookies may be used to remember if you are already registered and whether to show certain notifications which might only be valid to subscribed/unsubscribed users.</p>



            <p>From time to time we offer user surveys and questionnaires to provide you with interesting insights, helpful tools, or to understand our user base more accurately. These surveys may use cookies to remember who has already taken part in a survey or to provide you with accurate results after you change pages.</p>

            <p>When you submit data to through a form such as those found on contact pages or comment forms cookies may be set to remember your user details for future correspondence.</p>


            <p>In order to provide you with a great experience on this site we provide the functionality to set your preferences for how this site runs when you use it. In order to remember your preferences we need to set cookies so that this information can be called whenever you interact with a page is affected by your preferences.</p>

            <p><strong>Third Party Cookies</strong></p>

            <p>In some special cases we also use cookies provided by trusted third parties. The following section details which third party cookies you might encounter through this site.</p>

            <p>This site uses Google Analytics which is one of the most widespread and trusted analytics solution on the web for helping us to understand how you use the site and ways that we can improve your experience. These cookies may track things such as how long you spend on the site and the pages that you visit so we can continue to produce engaging content.</p>

            <p>For more information on Google Analytics cookies, see the official Google Analytics page.</p>



            <p>From time to time we test new features and make subtle changes to the way that the site is delivered. When we are still testing new features these cookies may be used to ensure that you receive a consistent experience whilst on the site whilst ensuring we understand which optimisations our users appreciate the most.</p>

            <p>As we sell products it's important for us to understand statistics about how many of the visitors to our site actually make a purchase and as such this is the kind of data that these cookies will track. This is important to you as it means that we can accurately make business predictions that allow us to monitor our advertising and product costs to ensure the best possible price.</p>

            <p>The Google AdSense service we use to serve advertising uses a DoubleClick cookie to serve more relevant ads across the web and limit the number of times that a given ad is shown to you.</p>

            <p>For more information on Google AdSense see the official Google AdSense privacy FAQ.</p>

            <p>We use adverts to offset the costs of running this site and provide funding for further development. The behavioural advertising cookies used by this site are designed to ensure that we provide you with the most relevant adverts where possible by anonymously tracking your interests and presenting similar things that may be of interest.</p>


            <p>In some cases we may provide you with custom content based on what you tell us about yourself either directly or indirectly by linking a social media account. These types of cookies simply allow us to provide you with content that we feel may be of interest to you.</p>



            <p>We also use social media buttons and plugins on this site that allow you to connect with your social network in various ways. For these to work the following social media sites including; , will set cookies through our site which may be used to enhance your profile on their site or contribute to the data they hold for various purposes outlined in their respective privacy policies.</p>

            <h6 id="list-item-5">&emsp;</h6>
            <br>
            <h4>Contact With us:</h4>
            <p><b>Email:</b> GoStalkerInc@gmail.com</p>
            <p><b>PhoneNumber:</b> &#40;&#43;02&#41; 01027012337</p>
            <p style="margin:0;">Social Media:</p>
            <ul class="contact-social">
                <li><a target="_blank" href="https://www.facebook.com/GostalkerInc"><i class="fa fa-facebook-square"></i></a></li>
                <li><a target="_blank" href="https://twitter.com/GoStalkerInc"><i class="fa fa-twitter"></i></a></li>
                <li><a target="_blank" href="https://www.instagram.com/GostalkerInc"><i class="fa fa-instagram"></i></a></li>
                <li><a target="_blank" href="https://www.vk.com/GostalkerInc"><i class="fa fa-vk"></i></a></li>
            </ul>
            <div class="contact-form">
                <h5>Send Message</h5>

                <form action="" method="POST" id="contact-form" onsubmit="return contact();">
                    <input class="fullNameContact normal-input" type="text" name='contact-name' minlength="3" maxlength="20" value="<?php if (isset($Contactname)) {
                                                                                                                                        echo $Contactname;
                                                                                                                                    } ?>" placeholder="Full Name" required>

                    <input type="email" class="emailContact normal-input" name='contact-email' value="<?php if (isset($Contactemail)) {
                                                                                                            echo $Contactemail;
                                                                                                        } ?>" required placeholder="Email">

                    <input class="cellContact normal-input" name='contact-cell' type="number" value="<?php if (isset($Contactcell)) {
                                                                                                            echo $Contactcell;
                                                                                                        } ?>" placeholder="Phone Number">

                    <input class="subjectContact normal-input" type="text" name='contact-subject' minlength="3" maxlength="20" value="<?php if (isset($Contactsubject)) {
                                                                                                                                            echo $Contactsubject;
                                                                                                                                        } ?>" placeholder="Subject" required>

                    <textarea placeholder="Write your message..." onkeyup="countChar(this)" class="commentContact comment-input" name='contact-message' minlength="10" maxlength="500" required><?php if (isset($Contactmessage)) {
                                                                                                                                                                                                    echo $Contactmessage;
                                                                                                                                                                                                } ?></textarea>
                    <div class="counterText">
                        <span id="charNum"></span>
                        <span>/500</span>
                    </div>

                    <div class="g-recaptcha" data-sitekey="6LfttV0UAAAAAIqaFWHkz9l4g-5LVkgLrQf8ozRN"></div>
                    <button type="submit">Submit</button>
                    <button style="background-color:#d60f01;" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo $js; ?>goscripts/countText.js"></script>
    <script type="text/javascript" src="<?php echo $js; ?>ajax/aj-contact.js"></script>
    <?php
    include $template . 'error-section.php';

    include $template . 'footer.php';
    ?>
</body>

</html> 