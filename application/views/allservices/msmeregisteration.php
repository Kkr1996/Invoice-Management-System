<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
  
  .seractive {
    color:var(--white-color) !important;  
    background-color: var(--primary-color);
  }
 
  </style>

<Section id="ser-par-sec">
    <div class="container">
        <div class="llp-hed-par">
            <div class="hed-box hed-one wow slideInLeft data-wow-duration="4s" data-wow-delay="0.4s"">
                <img src="<?php echo base_url();?>assets/users/images/ser-llp.png"/>
            </div>
             <div class="hed-box hed-two wow slideInDown data-wow-duration="4s" data-wow-delay="0.4s"">
                <h2>MSME Registeration</h2>
                <div class="ser-stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <button class="ser-hed-btn"><a href="tel:9971510551">CALL NOW</a></button>
            </div>
             <div class="hed-box hed-three wow slideInRight data-wow-duration="4s" data-wow-delay="0.4s"">
               
                <div class="service-form-par">
                    
                 <?php $this->load->view('admin/includes/_messages.php'); ?>
                <h3>LLP Registration</h3>
                    
       <form action="<?php echo base_url(); ?>services/services_form_submit" method="post">
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Name</label>
                        <input type="text" class="form-control" name="name" id="inputPassword4" placeholder="Full Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email">
                    </div>
                    
                    <input type="hidden" name="staffid" value="4132">
                </div>
                
                <div class="form-group">
                    <label for="inputAddress">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
                </div>
                
                
                
<!--
                <div class="form-group">
                    <label for="inputAddress">Choose Service</label><br>
                    <select id="services" name="services">
                        <option>Select Services</option>
                        <?php
//                            foreach($services as $keys=>$values){
//                                echo '<option value="'.$values['id'].'">'.$values['services'].'</option>';
//                            }
                        ?> 
                    </select>
                    <input type="hidden" name="servicess" id="servicess">
                </div>
-->

               <div class="form-group">
                  
                    <input type="hidden" class="form-control" id="services" name="services" placeholder="Services" value="LLP">
                </div>
           
                <div class="form-group">
              
<input type="hidden" class="form-control" id="subservices" name="subservices" placeholder="subservices" value="Public Limited Company registration
">
                </div>
           
<!--
                <div class="form-group">
                    <label for="inputAddress">Sub Service</label><br>
                    <select id="subservices" name="subservices">
                        <option value="">Select Sub Services</option>
                    </select>
                    <input type="hidden" name="subservicess" id="subservicess">
                    
                </div>
-->
                <div class="form-group">
<!--                     <label for="inputAddress">Prices</label><br>-->
                     <input type="hidden" class="form-control" value="10000" name="prices"  placeholder="Prices" readonly>
                </div>


                
                <div class="form-group">
                    <label for="inputAddress">Message</label>
                    <input type="textarea" class="form-control" name="message" id="inputAddress" placeholder="Ask Any Question">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Accpect Terms &amp; Condtions <a href="#">Privacy Policy</a>
                        </label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form> 
            </div>
            </div>
        </div>
    </div>
</Section>

<section id="why-choose-us">
        <div class="container">
            <h2>Why Choose Us</h2>
            <div id="why-choose-par">
                <div class="why-choose-box wow bounceInLeft data-wow-duration="4s" data-wow-delay="0.4s"">
                    <i class="fa fa-briefcase"></i>
                    <h3>True Business advisor</h3>
                    <p>Call2register is a professional managed company , which aims to partner directly with startups/MSMEs to meet their business /Government registration , compliance and taxation related requirements. Our mission is to help MSMEs/startsup sail through most difficult face of business journey. </p>
                </div>
                <div class="why-choose-box wow bounceInUp data-wow-duration="5s" data-wow-delay="0.5s"">
                    <i class="fa fa-user"></i>
                    <h3>CA/CS assisted</h3>
                    <p>All the business queries are handled by team of highly professional people including CA/CS, Lawyers and business consultants. </p>
                </div>
                <div class="why-choose-box wow bounceInDown data-wow-duration="6s" data-wow-delay="0.6s"">
                   <i class="fa fa-hand-holding-usd"></i>
                    <h3>Lowest pricing</h3>
                    <p>We assure to provide you the lowest fee in the market. If we are wrong , we match the offer with the lowest fee in the market. </p>
                </div>
                <div class="why-choose-box wow bounceInRight data-wow-duration="6s" data-wow-delay="0.6s"">
                    <i class="fa fa-clock"></i>
                    <h3>Timely Service</h3>
                    <p>Customer satisfaction and timely service is our utmost priority. we constantly striving to provide best service we offer to our client. We believe in building strong and long term relationship with our clients to bring the best service experience. </p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="ser-fixed-hed-menu sernav">
        <nav class="nav">
            <ul>
                <li class="active"><a class="nav-link seractive" href="#price">Pricing</a></li>       
                <li><a class="nav-link" href="#over">Overview</a></li> 
                <li><a class="nav-link" href="#beni">Benifits</a></li>
                <li><a class="nav-link" href="#docs">Docs</a></li>
                <li><a class="nav-link" href="#pro">Procedure</a></li>
                <li><a class="nav-link" href="#faq">Faq</a></li>
            </ul>
        </nav>
    </section>
    
    <section class="section ser-sec-cus intro active" id="price">
        <div class="wrapper">
       <div class="table basic wow bounceInUp data-wow-duration="4s" data-wow-delay="0.4s"">
           <div class="price-section">
               <div class="price-area">
                   <div class="inner-area">
                       <span class="text">
                         &#8377;
                       </span>
                       <span class="price">4999</span>
                   </div>
               </div>
           </div>
           <div class="package-name">
    
           </div>
           <div class="features">
               <li>
                   <span class="list-name">One Name approval</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">2 Partner DSC</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">2 DIN</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">Capital contribution upto 1 Lakh by partners</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">LLP agreement</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">E-PAN number</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">E-TAN number</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">GST Registration</span>
                   <span class="icon cross"><i class="fa fa-times-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">MSME/Udyog Adhaar</span>
                   <span class="icon cross"><i class="fa fa-times-circle"></i></span>
               </li>
               <div class="btn"><button>Purchase</button></div>
           </div>
       </div>
       <div class="table Premium wow bounceInUp data-wow-duration="4s" data-wow-delay="0.4s"">
           <div class="price-section">
               <div class="price-area">
                   <div class="inner-area">
                       <span class="text">
                         &#8377;
                       </span>
                       <span class="price">7499</span>
                   </div>
               </div>
           </div>
           <div class="package-name">
            
           </div>
           <div class="features">
               <li>
                   <span class="list-name">One Name approval</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">2 Partner DSC</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">2 DIN</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">Capital contribution upto 1 Lakh by partners</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">LLP agreement</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">E-PAN number</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">E-TAN number</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">GST Registration</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">MSME/Udyog Adhaar</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">1 Year ROC annual filings</span>
                   <span class="icon cross"><i class="fa fa-times-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">1 year Income tax return</span>
                   <span class="icon cross"><i class="fa fa-times-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">1 Year Virtual accounting </span>
                   <span class="icon cross"><i class="fa fa-times-circle"></i></span>
               </li>
               <div class="btn"><button>Purchase</button></div>
           </div>
       </div>
       <div class="table Ultimate wow bounceInUp data-wow-duration="4s" data-wow-delay="0.4s"">
           <div class="price-section">
               <div class="price-area">
                   <div class="inner-area">
                       <span class="text">
                          &#8377;
                       </span>
                       <span class="price">14999</span>
                   </div>
               </div>
           </div>
           <div class="package-name">
               
           </div>
           <div class="features">
               <li>
                   <span class="list-name">One Name approval</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">2 Partner DSC</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">2 DIN</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">Capital contribution upto 1 Lakh by partners</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">LLP agreement</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">E-PAN number</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">E-TAN number</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">GST Registration</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">MSME/Udyog Adhaar</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">1 Year ROC annual filings</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">1 year Income tax return</span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">1 Year Virtual accounting </span>
                   <span class="icon check"><i class="fa fa-check-circle"></i></span>
               </li>
               <div class="btn"><button>Purchase</button></div>
           </div>
       </div>
   </div>
    </section>
        
    <section class="section ser-sec-cus about" id="over">
        <div class="container">
            <div class="overview-par-div">
                <div class="over-img3 wow slideInLeft data-wow-duration="4s" data-wow-delay="0.4s"">
                    <img src="<?php echo base_url();?>assets/users/images/Hello-bro.png"/>
                </div>
                <div class="over-cont wow slideInRight data-wow-duration="4s" data-wow-delay="0.4s"">
                    <h3>OVERVIEW</h3>
                    <p>Are you planning to start a business with your friends and want to build a solid business and partnership? Then LLP is the right choice to start with.
                        LLP full form is Limited Liability partnership which means you have a partnership with limited business liabilities. To explain better, LLP is a new version of traditional partnership with some additional benefits of a LLP where the partners have limited liabilities subject to maximum of its capital contribution.
                        It is very easy to register an LLP and start your business as quickly as possible which comes with easy maintenance. It helps partners of the LLP to limit their liabilities and this is the biggest advantage of the Limited Liability Partnership over a traditional Partnership Firm. LLP is usually top pick by Professionals, Small business houses that are owned or closely-held by its partners or founders.
                    </p>
                </div>
            </div>
        </div>
    </section>
            
    <section class="section ser-sec-cus contact" id="beni">
        <h3>Benefits of LLP</h3>
        <div class="container">
            <div class="beni-par-div">
                <div class="beni-box wow slideInLeft data-wow-duration="4s" data-wow-delay="0.4s"">
                    <i class="fa fa-money"></i>
                    <h4>No Minimum Capital</h4>
                    <p>No minimum capital is required to form an LLP. An LLP can be registered with a mere sum of Rs. 1000 as total capital contribution.</p>
                </div>
                <div class="beni-box wow slideInDown data-wow-duration="4s" data-wow-delay="0.4s"">
                    <i class="fa fa-envelope"></i>
                    <h4>Separate Legal Entity</h4>
                    <p>The LLP is a separate legal identity in the court of the law and governed by Limited Liability partnership act 2008, meaning assets and liabilities of the business are not same as the assets and liabilities of the partners. Both are counted as different.</p>
                </div>
                <div class="beni-box wow slideInRight data-wow-duration="4s" data-wow-delay="0.4s"">
                    <i class="fa fa-envelope"></i>
                    <h4>Limited Liability</h4>
                    <p>If the LLP undergoes financial distress because of whatsoever reasons, the personal assets of partners will not be used to pay the debts of the LLP as the Liability of the partner is limited.</p>
                </div>
                
            </div>
            <div class="beni-par-div">
                <div class="beni-box wow slideInLeft data-wow-duration="4s" data-wow-delay="0.4s"">
                    <i class="fa fa-envelope"></i>
                    <h4>Tax benefits</h4>
                    <p>LLP is exempted from taxes like dividend distribution tax and minimum alternative tax. The taxation rates on LLP is comparatively less than the company.</p>
                </div>
                <div class="beni-box wow bounceInUp data-wow-duration="4s" data-wow-delay="0.4s"">
                    <i class="fa fa-envelope"></i>
                    <h4>Higher Credibility</h4>
                    <p>The particulars of the LLP are available on a public database on MCA portal. This improves the credibility of the LLP as it makes it easy to authenticate the details</p>
                </div>
                <div class="beni-box wow slideInRight data-wow-duration="4s" data-wow-delay="0.4s"">
                    <i class="fa fa-envelope"></i>
                    <h4>Perpetual Succession</h4>
                    <p>The LLP keeps on existing in the eyes of law even in the case of death, insolvency, the bankruptcy of any of its member or shareholder. It continues as a legal person until it is legally dissolved.</p>
                </div>
                
            </div>
        </div>
    </section>
    
    <section class="section ser-sec-cus contact" id="docs">
            <div class="overview-par-div">
                <div class="over-img">
        
                </div>
                <div class="over-cont wow slideInRight data-wow-duration="4s" data-wow-delay="0.4s"">
                    <h3>Documents/Information Required </h3>
                    <ul>
                        <li><i class="fa fa-check"></i>Name of LLP</li>
                        <li><i class="fa fa-check"></i> Identity proof of one partner (Voter ID/Driving License/Passport)</li>
                        <li><i class="fa fa-check"></i> Identity proof of one Nominee (Voter ID/Driving License/Passport)</li>
                        <li><i class="fa fa-check"></i> Address proof of all partners (Bank statement /utility Bills)</li>
                        <li><i class="fa fa-check"></i> Registered Business address proof</li>
                        <li><i class="fa fa-check"></i> NOC from owner of business premises</li>
                        <li><i class="fa fa-check"></i> Partners email ID and phone number</li>
                        <li><i class="fa fa-check"></i> Photograph of all partners</li>
                        <li><i class="fa fa-check"></i> Share Capital required by each partners/shareholders</li>
                    </ul>
                </div>
            </div>
            <div class="overview-par-div docs-over">
                <div class="over-cont wow slideInLeft data-wow-duration="4s" data-wow-delay="0.4s"">
                    <h3>PROCEDURE</h3>
                    <ul>
                        <li><i class="fa fa-check"></i> Name approval</li>
                        <li><i class="fa fa-check"></i> Apply DSC</li>
                        <li><i class="fa fa-check"></i> Document review</li>
                        <li><i class="fa fa-check"></i> Preparation of FiLLip form</li>
                        <li><i class="fa fa-check"></i> Filing of LLP Agreement</li>
                        <li><i class="fa fa-check"></i> Get LLP incorporation Certificate</li>
                        <li><i class="fa fa-check"></i> Get LLP PAN and TAN </li>
                    </ul>
                </div>
                <div class="over-img1">
                    
                </div>
            </div>
    </section>
    
    
    <section class="section ser-sec-cus contact wow slideInLeft data-wow-duration="5s" data-wow-delay="0.5s"" id="faq">
        <h3>Frequently Asked Questions</h3>
        <div class="accordion-container">
  <div class="set">
    <a href="a" class="a">
      1.Is it easy to convert traditional partnership firm in LLP? 
      <i class="fa fa-plus"></i>
    </a>
    <div class="content">
      <p>Yes, A traditional partnership firm can be converted into LLP by meeting with the Provisions of the LLP Act.</p>
    </div>
  </div>
  <div class="set">
    <a href="a" class="a">
      2.I want to start my business but I am confused between LLP and company, what should I select? 
      <i class="fa fa-plus"></i>
    </a>
    <div class="content">
      <p> LLP and company have a lot of common yet they both are different in many of its structural setup. When you wish to start your business, there are many factors that one needs to think upon before selecting any business structures. However, before selecting any business structure, you may refer below Normal partnership vs LLP vs Company - A comparison between two important forms of organization in India.</p>
      <table class="table-responsive table-dark table-hover">
  
    <tbody>
      <tr>
        <td></td>
        <td>Private Limited LLP</td>
        <td>LLP</td>
		<td>Limited Liability Partnership</td>
		<td>Partnership Firm</td>
        <td>Proprietorship Firm</td>
      </tr>
      <tr>
        <td>Applicable Law</td>
        <td>Companies Act, 2013</td>
		<td>Companies Act, 2013</td>
        <td>Limited Liability Partnership Act, 2008</td>
		<td>Indian Partnership Act, 1932</td>
        <td>No specified Act</td>
      </tr>
      <tr>
        <td>Registration mandatory</td>
        <td>Yes</td>
        <td>Yes</td>
		<td>Yes</td>
		<td>No, but need to create a partnership deed</td>
		<td>No</td>
      </tr>
	 <tr>
        <td>Min to max Number of members required</td>
        <td>2 – 200</td>
        <td>Only 1</td>
		<td>2 – Unlimited</td>
		<td>2 – 50</td>
		<td>Only 1</td>
      </tr>
	 <tr>
        <td>Separate Legal Entity</td>
        <td>Yes</td>
        <td>Yes</td>
		<td>Yes</td>
		<td>No</td>
		<td>No</td>
      </tr>
     <tr>
        <td>Limited Liability</td>
        <td>Limited</td>
        <td>Limited</td>
		<td>Limited</td>
		<td>Unlimited</td>
		<td>Unlimited</td>
      </tr>
	<tr>
        <td>Statutory LLP Audit</td>
        <td>Mandatory</td>
        <td>Mandatory</td>
		<td>Dependents on certain factors</td>
		<td>Not mandatory</td>
		<td>Not mandatory</td>
      </tr>
    <tr>
        <td>Transferability</td>
        <td>Restricted</td>
        <td>No</td>
		<td>Yes</td>
		<td>No</td>
		<td>No</td>
      </tr>
	<tr>
        <td>Continuous Existence</td>
        <td>Yes</td>
        <td>Yes</td>
		<td>Yes</td>
		<td>No</td>
		<td>No</td>
      </tr>
	<tr>
        <td>Foreign investment /Participation</td>
        <td>Allowed</td>
        <td>Not Allowed</td>
		<td>Allowed</td>
		<td>Not Allowed</td>
		<td>Not Allowed</td>
      </tr>
	<tr>
        <td>Income Tax Rates</td>
        <td>Moderate</td>
        <td>Moderate</td>
		<td>High</td>
		<td>High</td>
		<td>Low</td>
      </tr>
	<tr>
        <td>Statutory Compliances</td>
        <td>High</td>
        <td>Moderate</td>
		<td>Moderate</td>
		<td>Low</td>
		<td>Low</td>
      </tr>
    </tbody>
  </table>
    </div>
  </div>
  <div class="set">
    <a href="a" class="a">
      3.How long will it take to incorporate a LLP in India? I want to start the LLP as soon as possible. 
      <i class="fa fa-plus"></i>
    </a>
    <div class="content">
      <p>It generally takes 8-10 working days to register LLP in India. The time depends on the submission of relevant documents by the client and further speed of Government approvals. To ensure quick and speedy registration, choose a unique name for your LLP. The registration fees for the incorporation is included in the package offered to you.</p>
    </div>
  </div>
  <div class="set">
    <a href="a" class="a">
      4.What are the mandatory annual compliance for a LLP after incorporation? 
      <i class="fa fa-plus"></i> 
    </a>
    <div class="content">
      <p> Every LLP would be required to file Annual Return with ROC. A duly authenticated Annual Return in e- Form-11, is to be filed with the Registrar, together with the prescribed fee, within a period of 60 days from the closure of every financial year. </p>
    </div>
  </div>
</div>
    </section>


<script>
   $(document).ready(function () {
    $(document).on("scroll", onScroll);
    
    //smoothscroll
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('a').each(function () {
            $(this).removeClass('seractive');
        })
        $(this).addClass('seractive');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.nav ul li a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.nav ul li a').removeClass("seractive");
            currLink.addClass("seractive");
        }
        else{
            currLink.removeClass("seractive");
        }
    });
}
</script>

 <script>
//jquery form service
$(document).ready(function() {
  $(".set > a").on("click", function() {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this)
        .siblings(".content")
        .slideUp(200);
      $(".set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
    } else {
      $(".set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
      $(this)
        .find("i")
        .removeClass("fa-plus")
        .addClass("fa-minus");
      $(".set > a").removeClass("active");
      $(this).addClass("active");
      $(".content").slideUp(200);
      $(this)
        .siblings(".content")
        .slideDown(200);
    }
  });
});
$(document).ready(function(){
  $(".a").click(function(event){
    event.preventDefault();
  });
});
/*sticky header*/
jQuery(window).scroll(function(){
    if (jQuery(window).scrollTop() >= 1300) {
       jQuery('.ser-fixed-hed-menu').addClass('fixed-ser');
    }
    else {
       jQuery('.ser-fixed-hed-menu').removeClass('fixed-ser');
    }
});

</script>
    
  
<script>
jQuery(document).ready(function(){
    jQuery("#services").change(function(event){
         let selectservicesid = jQuery(this).val();
         var optionSelected = jQuery("option:selected", this);
         var textSelected   = optionSelected.text();
         jQuery("#servicess").val(textSelected);
        
        
        
        $.ajax({
             url: "<?php echo base_url(); ?>" + "Dashboard/selectservicesid",
             method: 'post',
             data: {selectservicesid: selectservicesid},
             dataType: 'text',
             success: function(data){
              jQuery("#subservices").html(data);

             }
        });
    });
});
</script>
<script>
jQuery(document).ready(function(){
    jQuery("#subservices").change(function(event){
        let subservices_key = jQuery(this).val();
        let selectservicesid = jQuery("#services").val();
        
         var optionSelected = jQuery("option:selected", this);
         var textSelected   = optionSelected.text();
         jQuery("#subservicess").val(textSelected);
        
        $.ajax({
             url: "<?php echo base_url(); ?>" + "Dashboard/selectprice_bykeys",
             method: 'post',
             data: {selectservicesid:selectservicesid,subservices_key:subservices_key},
             dataType: 'text',
             success: function(data){
                let prices_filter = data.replace(/ /g,'');
                let count = data.length;
                jQuery("#prices").val(prices_filter);
                 
             }
        });
    });
});
</script>
  
    
    
<?php 
if(!$this->session->has_userdata('is_user_login')){
?>
<script>
//    jQuery(document).ready(function(){
//        jQuery("form :input").prop("disabled", true);
//        jQuery("body form").click(function(){
//            alert("Please login before submit a services form");
//        });
//    });
</script>
<?php
 }
?>
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    
    
    
    
    
    
    
    
    
    
    
    
    