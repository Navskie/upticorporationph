<?php include 'include/header.php'; ?>
<style>
    .faq-heading{
    border-bottom: #777;
    padding: 20px 60px;
}
.faq-container{
display: flex;
justify-content: center;
flex-direction: column;
}
.hr-line{
  width: 60%;
  margin: auto;
  
}
/* Style the buttons that are used to open and close the faq-page body */
.faq-page {
    /* background-color: #eee; */
    color: #444;
    cursor: pointer;
    padding: 30px 20px;
    width: 60%;
    border: none;
    outline: none;
    transition: 0.4s;
    margin: auto;
}
.faq-body{
    margin: auto;
    
    /* text-align: center; */
   width: 60%; 
   padding: auto;
   
}

.faq-body p {
    padding: 30px 0;
}
/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active,
.faq-page:hover {
    background-color: #F9F9F9;
}
/* Style the faq-page panel. Note: hidden by default */
.faq-body {
    padding: 0 18px;
    background-color: white;
    display: none;
    overflow: hidden;
}
.faq-page:after {
    content: '\02795';
    /* Unicode character for "plus" sign (+) */
    font-size: 13px;
    color: #777;
    float: right;
    margin-left: 5px;
}
.active:after {
    content: "\2796";
    /* Unicode character for "minus" sign (-) */
}
</style>
<!--Body Content-->
<div id="page-content">     
    <main>
        <h1 class="faq-heading container">Frequently asked questions</h1>
        <section class="faq-container">
            <div class="faq-one">
                <!-- faq question -->
                <h1 class="faq-page">What does a UVIP Reseller do?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>As a UVIP Reseller you can make extra money selling products. You may also invite others to join as UVIP Resellers and build a team of your own. When your team generates product sales of their own, you can earn cash bonuses on their sales.
                        <br><br>
                        You may also save money on the beauty products you buy for yourself and your family as you will buy them at a discounted price. Many of our UVIP Resellers choose to turn their K-Beauty sideline into more of a business, while others are happy making extra money off product sales. Whatever you prefer, we’d love to have you with us, and we’ll support you all the way.
                    </p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-two">
                <!-- faq question -->
                <h1 class="faq-page">How do I join as a UVIP Reseller?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>It’s easy, just register with us or contact a UVIP Reseller you already know who will sign you up as a new UVIP Reseller.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
            <h1 class="faq-page">How much time do I need to put in?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>You decide how much time you want to put in on sharing, promoting and selling our products. Whether you want to make extra money selling products on the side or to put in more time and energy by inviting others to be resellers, you will have the freedom to plan your time in a way that suits you and your life. It’s up to you!</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
            <h1 class="faq-page">How do I get started?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>Once you’ve joined, we’ll provide you access to our training vault, that will lead you on the first stages of your journey, step by step. When everything is set-up, you can start to share, promote and sell K-Beauty by Uptimised products.
                        <br><br>
                        You may also contact your sponsor for more details and support on getting started. 
                    </p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
            <h1 class="faq-page">How can I make money?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>There are five ways of making money as a UVIP Reseller, but two major ways are: One, sell products and make 40% on your customer orders. In addition, you can also invite others to join as UVIP Resellers. When they generate product sales of their own, you can qualify to earn cash bonuses on their sales.
                        <br><br>
                        How often you get paid? You don’t have to wait till the end of the month. You can receive your earnings on a weekly basis.
                    </p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
            <h1 class="faq-page">Is there a joining fee?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>Yes, the joining fee is P3400, then you access to a host of trainings in beauty and business.
                        <br><br>
                        Why wait? Register today and become a UVIP Reseller!
                    </p>
                </div>
            </div>
        </section>
    </main>
</div>
<!--End Body Content-->
<script>
    // main.js file
    var faq = document.getElementsByClassName("faq-page");
    var i;
    for (i = 0; i < faq.length; i++) {
        faq[i].addEventListener("click", function () {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");
            /* Toggle between hiding and showing the active panel */
            var body = this.nextElementSibling;
            if (body.style.display === "block") {
                body.style.display = "none";
            } else {
                body.style.display = "block";
            }
        });
    }
</script>
<?php include 'include/footer.php'; ?>