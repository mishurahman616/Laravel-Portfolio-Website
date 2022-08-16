// Owl Carousel Start..................
$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});

// Owl Carousel End..................


// Contact Send

$('#contactSendButton').click(function () {
    var contactName= $('#contactName').val();
    var contactMobile= $('#contactMobile').val();
    var contactEmail= $('#contactEmail').val();
    var contactMsg= $('#contactMessage').val();
    sendMessage(contactName,contactMobile,contactEmail,contactMsg);
});

function sendMessage(contact_name,contact_mobile,contact_email,contact_msg) {

    if(contact_name.trim().length==0){
        $('#contactSendButton').html('আপনার নাম লিখুন !');
        setTimeout(function () {
            $('#contactSendButton').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_mobile.trim().length==0){
        $('#contactSendButton').html('আপনার মোবাইল নং লিখুন !')
        setTimeout(function () {
            $('#contactSendButton').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_email.trim().length==0){
        $('#contactSendButton').html('আপনার ইমেইল  লিখুন !')
        setTimeout(function () {
            $('#contactSendButton').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_msg.trim().length==0){

        $('#contactSendButton').html('আপনার মেসেজ লিখুন !')
        setTimeout(function () {
            $('#contactSendButton').html('পাঠিয়ে দিন');
        },2000)

    }
    else {
        $('#contactSendButton').html('পাঠানো হচ্ছে...')

        axios.post('/sendMessage',{
            name:contact_name,
            mobile:contact_mobile,
            email:contact_email,
            message: contact_msg,
        })
            .then(function (response) {
                if(response.status==200){
                    if(response.data==1){
                        $('#contactSendButton').html('পাঠানো হয়েছে!');
                        $('#contactForm :input').val('');
                        setTimeout(function () {
                            $('#contactSendButton').html('পাঠিয়ে দিন');

                        },4000)

                    }
                    else{
                        $('#contactSendButton').html('অনুরোধ ব্যার্থ হয়েছে ! আবার চেষ্টা করুন ')
                        setTimeout(function () {
                            $('#contactSendButton').html('পাঠিয়ে দিন');
                        },4000)
                    }
                }
                else {
                    $('#contactSendButton').html('অনুরোধ ব্যার্থ হয়েছে ! আবার চেষ্টা করুন ')
                    setTimeout(function () {
                        $('#contactSendButton').html('পাঠিয়ে দিন');
                    },4000)
                }

            }).catch(function (error) {
                alert(error.message)
            $('#contactSendButton').html('আবার চেষ্টা করুন')
            setTimeout(function () {
                $('#contactSendButton').html('পাঠিয়ে দিন');
            },4000)
        })
    }
}



$(document).ready(function(){
    // Add smooth scrolling to all links
    $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
});
