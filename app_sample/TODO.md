# TODO: Fix Forget Password Issue

## Tasks to Complete
- [x] Fix forgot password link in login.blade.php to point to correct route
- [x] Create custom forgot-password.blade.php view with Farm Guide styling
- [x] Create custom reset-password.blade.php view with Farm Guide styling
- [x] Update PasswordResetLinkController to use new forgot-password view
- [x] Update NewPasswordController to use new reset-password view
- [x] Clear caches (config, route, view) to apply changes
- [x] Create password_reset_tokens table migration
- [x] Run migration to create the missing table
- [x] Verify migration status and confirm table exists
- [x] Test email functionality (currently logging to laravel.log as expected)
- [x] Verify forgot-password and reset-password views load correctly

## Followup Steps (User Action Required)
- Configure mail settings in .env for actual email sending (currently set to 'log')
- Set MAIL_MAILER=smtp (or other mailer like mailgun, ses, etc.)
- Set MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, etc.
- Test the forgot password flow by:
  1. Going to /forgot-password
  2. Entering a valid email
  3. Checking logs or email for reset link
  4. Using the reset link to set new password
- Ensure the new views display correctly and match the Farm Guide theme
