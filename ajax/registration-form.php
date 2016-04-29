<h2>Register</h2>
<span>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum </span>
<div id="registration-errors"></div>
       <form method="POST" class="center vertical-center" action="http://localhost/creworsha/index.php/user/register_do" id="reg-form">

        <p><input type="text" name="username" class="form-input" placeholder="Username" id="reg-un" required/></p>
        <div class="reg-error" id="reg-un-error"></div>
        <p><input type="text" name="first-name" maxlength="15" class="form-input form-input-half" id="reg-fn" placeholder="First Name" required/>
        <input type="text" name="last-name" maxlength="30" class="form-input form-input-half" id="reg-ln" placeholder="Last Name" required/>
        </p>
        <div class="reg-error" id="reg-fnln-error"></div>
        <p><input type="email" name="email" class="form-input" placeholder="Email" id="reg-em" required/></p>
        <div class="reg-error" id="reg-em-error"></div>
        <p><input type="password" name="password" class="form-input" placeholder="Password" id="reg-pwd" required/></p>
        <div class="reg-error" id="reg-pwd-error"></div>
        <p><input type="password" name="confirm-password" class="form-input" id="reg-cpwd" placeholder="Confirm Password" required/></p>
        <div class="reg-error" id="reg-cpwd-error"></div>
        <p><input type="submit"  value="Count Me In !"/></p>
        <div class="reg-error" id="mega-error"></div>
       </form>
