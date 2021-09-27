1. The issue with using $_SERVER["PHP_SELF"] as the form action is that allows anyone to insert HTML or javascript code into the forms and run it once it's past the client-side verification. To avoid that you should declare action as action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>".

2. Server-side validation ensures that no Cross-site scripting has occurred and that the validation done on the client-side is up to date. Having both allows for speed and security. The client-side validation will warn users of mis-inputs and doesn't require them to completely reload the screen to fix it. The server-side validation deals with hacking issues or mismatching of validation with the client-side validation, so it doesn't have to worry about the user as much.

Note for grader: I wasn't able to get folders to work on luna.mines.edu, so I tested this application assuming the images were in the same folder. I have changed my code to look for the images in the images folder I have included, but if there is any issue with my images, that may be why.

Given 1 day extension by Professor Rader