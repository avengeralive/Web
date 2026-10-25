<? 
/*
Template name: Support
*/
get_header(); the_post(); ?>
<style>
      @media (max-width: 992px) {
        .support__container p {
          font-size: 12px;
          margin-bottom: 1em;
        }
        .support__container p.text-center {
          margin-bottom: 50px;
        }
      }
	@media (min-width: 993px) {
        .support__container p.text-center {
          padding: 0px 180px;
        }
      }
    </style>
<main class="main padding">
        <div class="support block padding">
          <div class="container">
            <div class="support__container">
              <h4 class="title support__title">Submit a request</h4>
              <p class="text-center">We are here to serve and support you 24/7.<br>
For the fastest answers, browse our <a href="/faq">FAQ</a> page.<br>
You can call us at <a href="tel:0041-22-518-1133">0041-22-518-1133</a> or submit an email request to us around the clock. We respond to all email requests within 24 hours of receipt. To submit your email request, please use <a href="mailto:hello@briz.app">hello@briz.app</a> or fill the form below.</p>
              <? echo do_shortcode('[contact-form-7 id="179" title="Support"]'); ?>
            </div>
          </div>
        </div>
      </main>
<? get_footer(); ?>