<form id="growupContactForm" class="growup-contact-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

    <div class="form-group">
        <input type="text" placeholder="Your Name" class="form-control growup-form-control" id="name" name="name" >
        <small class="invalid-feedback">Your Name is Required.</small>
    </div>

    <div class="form-group">
        <input type="email" placeholder="Your Email" class="form-control growup-form-control" id="email" name="email" >
        <small class="invalid-feedback">Your Email is Required.</small>
    </div>

    <div class="form-group">
        <textarea placeholder="Your Message" name="message" id="message" class="form-control growup-form-control"></textarea>
        <small class="invalid-feedback">Message is Required.</small>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-default btn-lg btn-growup-form">Submit</button>
        
        <small class="text-info invalid-feedback js-form-submission ml-1">Submission is on Processing! please wait...</small>
        <small class="text-success invalid-feedback js-form-success">Message Successfully Sent.</small>
        <small class="text-danger invalid-feedback js-form-error">There is a problem with contact form, please try again.</small>
    </div>

</form>