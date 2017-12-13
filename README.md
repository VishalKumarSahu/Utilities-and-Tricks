# Codeigniter Utilities and Tricks
##### Code snippets from codeigniter

### Input Sanitization/Validation in One Go in CI
#### sanitize-input-helper.php
Basic class for sanitizing input in codeigniter using PHP 5.6+ built in functions

The Sanitize_input class basically contains handy methods for validating and filtering input. Coded for using in Codeigniter framework. It validates and filters data based on defined callback function. If fails returns "null" for now.

Expecting to add some tutorial and example soon. 
Anyone can use and modify the code at his/her own risk. It is basic idea for validation. Although CI provide filtering facility builtin.

**Usage:**
Refer `Test_controller.php` for usage. 

### JS/CSS Loading in Codeigniter Made Easy
#### load_css_js_helper.php
Easy to load js and css.
**Usage:**

    $css = [
        'path' => 'assets/css/%s.css',
        'files' => ['bootstrap.min','style']
    ];
    load_css($css['files'], $css['path'], '1.0', TRUE);

