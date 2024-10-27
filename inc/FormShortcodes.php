<?php

namespace Sepid;

class FormShortcodes {

    public function __construct() {
        add_shortcode('sepid_otp_forms', array($this, 'render_otp_forms'));
    }


    public function render_otp_forms() {

        if(is_user_logged_in())
            wp_safe_redirect($_GET['redirect'] ?? SEPID_REDIRECT_URL);

        ob_start();
        ?>
        <div class="spd-otp-container">
            <!-- Send OTP Form -->
            <form id="send-otp-form" class="otp-form">
                <h3>ورود/ثبت نام</h3>
                <label for="phone" >شماره موبایل</label>
                <input type="text" id="phone" name="phone" placeholder="0912xxxxxxx" required>
                <button class="spd-button" type="submit"><span class="text">ارسال کد تایید</span></button>
                <div id="send-otp-message" class="form-message"></div>
            </form>

            <!-- Verify OTP Form (Initially hidden) -->
            <form id="verify-otp-form" class="otp-form" style="display: none;">
                <h3>اعتبارسنجی</h3>
                <label for="otp_code">کد اعتبارسنجی ارسال شده به شماره <span id="phone-clone"></span> را در کادر زیر وارد نمایید.</label>
                <input type="text" id="otp_code" name="otp_code" placeholder="" required>
                <input type="hidden" id="redirect_url" name="redirect_url" value="<?php echo $_GET['redirect'] ?? SEPID_REDIRECT_URL;?>">
                <button class="spd-button" type="submit"><span class="text">تایید</span></button>
                <div id="verify-otp-message"  class="form-message"></div>
                <div id="resend-otp">
                    <span class="timer"></span>
                    <span class="resend-btn">ارسال مجدد کد یکبارمصرف</span>
                </div>
            </form>

            <form id="complete-registration-form" class="otp-form  spd-hidden-labels" style="display: none;">
                <h3>ثبت نام</h3>
                <label for="first_name">نام</label>
                <input type="text" id="first_name" name="first_name" placeholder="نام" required>

                <label for="last_name">نام خانوادگی:</label>
                <input type="text" id="last_name" name="last_name" placeholder="نام خانوادگی" required>

                <label for="email">ایمیل (اختیاری)</label>
                <input type="email" id="email" name="email" placeholder="ایمیل (اختیاری)">

                <input type="hidden" id="reg_phone" name="reg_phone">
                <input type="hidden" id="reg_redirect_url" name="reg_redirect_url">
                <button class="spd-button" type="submit"><span class="text">تکمیل ثبت نام</span></button>
                <div id="registration-message" class="form-message"></div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}

// Instantiate the Shortcodes class to register the shortcode
new FormShortcodes();