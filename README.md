## Vocation
Code will show how it is able to use PHP7's function filter_var(), regular expression to validate credentials on cyrillic first name, last name 
and email type, show how can be used:
 * regular expression in callback function,
 * filter_var() function with FILTER_VALIDATE_EMAIL filter,
 * functions file_get_contents(), file_put_contents() to read from file & write data to file,
 * splitting a string into an array and joining back,
 * ternary operator in outputing to browse. 

## Description
Page takes credentials(first name, last name, email) from html-form, validates them, outputs text of error weather they were taken or inputs credantials in file.
Each line in file matchs to this three users's credentials. Script watches that credantials are uniqual in file. Weather this three credentials are 
consists in file it outputs error.
