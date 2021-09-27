Carter Fowler

1. What styling is used to make the links display horizontally (i.e., on larger screens)

	Setting the links' (specifically .topnav a) float to left and display to block, otherwise they take up the width of the screen.

2. What part of the code (in the HTML file) actually causes the hamburger icon to appear? Be specific.

	The first @media block of code (on line 82) in nav.css is what makes the icon (which was declared in the nav tag of aboutme.html), as whenever the screen width is smaller than 600 pixels it sets the icon's display to block instead of its standard none. This is also where the other links other than the home link are removed from the display.

3. How does this code use CSS pseudo-classes to display only home and the hamburger when the screen size is small?

	It uses a:not(:first-child) to exclude the home link (which is the first link under nav) from having it's display set to none, all of which is done inside the @media block of code I mentioned in question #2