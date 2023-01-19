<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <style>
  
  
  
  #section1 {padding-top:50px;height:500px;color: #fff; background-color: #1E88E5;}
  #section2 {padding-top:50px;height:500px;color: #fff; background-color: #673ab7;}
  #section3 {padding-top:50px;height:500px;color: #fff; background-color: #ff9800;}
  #section41 {padding-top:50px;height:500px;color: #fff; background-color: #00bcd4;}
  #section42 {padding-top:50px;height:500px;color: #fff; background-color: #009688;}
  
  .seractive {
    color: #fff !important;
    background-color: #f57a1a;
  }
  
  @media (min-width: 768px) {
.navbar-nav {
    display: block;
    margin: 0;
}
  }
  </style>

<nav class="sernav navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
     
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a class="seractive" href="#section1">Section 1</a></li>
          <li><a href="#section2">Section 2</a></li>
          <li><a href="#section3">Section 3</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Section 4 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#section41">Section 4-1</a></li>
              <li><a href="#section42">Section 4-2</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>    

<div id="section1" class="container-fluid ser-sec">
  <h1>Section 1</h1>
  <p>Click on the different Section links in the navbar to see the smooth scrolling effect.</p>
</div>
<div id="section2" class="container-fluid ser-sec">
  <h1>Section 2</h1>
  <p>Click on the different Section links in the navbar to see the smooth scrolling effect.</p>
</div>
<div id="section3" class="container-fluid ser-sec">
  <h1>Section 3</h1>
  <p>Click on the different Section links in the navbar to see the smooth scrolling effect.</p>
</div>



<div id="section41" class="container-fluid ser-sec">
  <h1>Section 4 Submenu 1</h1>
  <p>Click on the different Section links in the navbar to see the smooth scrolling effect.</p>
</div>
<div id="section42" class="container-fluid ser-sec">
  <h1>Section 4 Submenu 2</h1>
  <p>Click on the different Section links in the navbar to see the smooth scrolling effect.</p>
</div>



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
    $('.navbar-nav li a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.navbar-nav li a').removeClass("seractive");
            currLink.addClass("seractive");
        }
        else{
            currLink.removeClass("seractive");
        }
    });
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>