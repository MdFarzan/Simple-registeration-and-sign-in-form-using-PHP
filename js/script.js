$(document).ready(function(){
    //write all js and jquery below
    // console.log("working");

    //binding methods
    $("[name='email']").on('blur',validateEmail);
    $("[name='mobile-no']").on('blur',validateMobileNo);
    $("[name='passkey']").on('blur',validatePasskey);
    
});

// validating email
function validateEmail(){
    try{
        
        let value = $("[name='email']").val();
        //checking if empty or contains only spaces
        if(value=="" || (/^\s$/).test(value)){
            
            throw "This field cannot be blank!";
        }
        
        else
            throw "";
    }

    catch(err){
        $(this).next().html(err);

        //toggling submission
        if(err!="")
            disableSubmission();
        else
            enableSubmission();

    }
}



//validating mobile no
function validateMobileNo(){
    try{
        //let value = $(this).val();
        let value = this.value;
        //checking if empty on contains only spaces
        if(value=="" || (/^\s$/).test(value))
            throw "This field cannot be blank!";

        if(!(/^[0-9]{10}$/).test(value))
            throw "Please enter 10 digit mobile no.!";
        
        else
            throw "";
    }

    catch(err){
        $(this).next().html(err);

        //toggling submission
        if(err!="")
            disableSubmission();
        else
            enableSubmission();
    }
}


// validating email
function validatePasskey(){
    try{
        
        let value = $("[name='passkey']").val();
        //checking if empty or contains only spaces
        if(value=="" || (/^\s$/).test(value))
            throw "This field cannot be blank!";
        
        if(value.length<8 || value.length>15)
            throw "Password must be between 8 to 15 characters!";


        else
            throw "";
    }

    catch(err){
        $(this).next().html(err);

        //toggling submission
        if(err!="")
            disableSubmission();
        else
            enableSubmission();
    }
}

function enableSubmission(){
    $('[type="submit"]').removeAttr('disabled');
    
}

function disableSubmission(){
    $('[type=submit]').attr('disabled','disabled');
    

}
