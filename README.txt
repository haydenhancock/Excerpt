STEP ONE:
Insert plugin tag into your template. Set paramters and variables.

PARAMETERS:
The tag has two parameters:

1) excerpt_length - The number of words to include in the excerpt (default = 55 words).

2) excerpt_more - The string that is appended at the end of the excerpt (default = ...).

EXAMPLE:
{exp:excerpt excerpt_length="12" excerpt_more="[...]"}
    {description}
{/exp:excerpt}

ABOUT:
This plugin should function similar to WordPress excerpts.