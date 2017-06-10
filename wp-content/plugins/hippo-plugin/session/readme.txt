
1. Use `Hippo_Session::get_instance()` in your code.

First, make a reference to the Hippo_Session instance.
Then, use it like an associative array, just like `$_SESSION`:

`$Hippo_Session = Hippo_Session::get_instance();
$Hippo_Session['user_name'] = 'User Name';                            // A string
$Hippo_Session['user_contact'] = array( 'email' => 'user@name.com' ); // An array
$Hippo_Session['user_obj'] = new WP_User( 1 );                        // An object`

By default, session variables will live for 24 minutes from the last time they were accessed - either read or write.

This value can be changed by using the `hippo_session_expiration` filter:

`add_filter( 'hippo_session_expiration', function() { return 60 * 60; } ); // Set expiration to 1 hour`
