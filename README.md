How to use?
-----------

* Set up a config file with you directories.
* Place in `less_dir` your .less file (ex. style.less)
* Call the function `Less::compile('style');` in your code. This function was return the address of the file.

Example of using:
~~~
<style src="<?php Less::compile('style') ?>">
~~~

*Note: if in the config `only_development` is true, .less file was compiled every time when function call. Else .less file was compiled, if file does not exist.*